<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\ShippingAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{

    public function store(Request $request) {
        $input = $request->all();
        $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payment = Payment::create([
                    'r_payment_id' => $response['id'],
                    'method' => $response['method'],
                    'currency' => $response['currency'],
                    'user_email' => $response['email'],
                    'amount' => $response['amount']/100,
                    'json_response' => json_encode((array)$response)
                ]);
            } catch(Exception $e) {
                return $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        Session::put('success',('Payment Successful'));
        return redirect()->back();
    }

    public function createOrder(Request $request)
    {
        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            
            $orderData = [
                'receipt'         => 'order_' . time(),
                'amount'          => $request->amount, // amount in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];
            
            $razorpayOrder = $api->order->create($orderData);
            
            // Store order details in session for later verification
            Session::put('razorpay_order_id', $razorpayOrder['id']);
            Session::put('razorpay_amount', $request->amount);
            Session::put('checkout_form_data', $request->form_data);
            
            return response()->json([
                'status' => 'success',
                'order_id' => $razorpayOrder['id'],
                'amount' => $request->amount,
                'razorpay_key' => env('RAZORPAY_KEY')
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];
            
            $api->utility->verifyPaymentSignature($attributes);
            
            // Payment is verified, now process the order
            parse_str($request->form_data, $formData);
            
            $user_id = Session::get('login_id');
            
            if (!$user_id) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not logged in'
                ], 401);
            }
            
            DB::beginTransaction();
            
            try {
                // Create or update shipping address
                $shippingAddress = ShippingAddress::updateOrCreate(
                    ['user_id' => $user_id],
                    [
                        'company_name' => $formData['billing_company'] ?? '',
                        'first_name' => $formData['billing_first_name'],
                        'last_name' => $formData['billing_last_name'],
                        'phone' => $formData['billing_phone'],
                        'email' => $formData['billing_email'],
                        'address_1' => $formData['billing_address_1'],
                        'address_2' => $formData['billing_address_2'] ?? '',
                        'city' => $formData['billing_city'],
                        'state' => $formData['billing_state'],
                        'country' => $formData['billing_country'],
                        'postcode' => $formData['billing_postcode'],
                        'order_comments' => $formData['order_comments'] ?? '',
                    ]
                );
                
                // Get cart items
                $cartItems = Cart::where('user_id', $user_id)->get();
                
                // Calculate total
                $totalAmount = Session::get('razorpay_amount', 0) / 100;
                
                // Create order
                $order = Order::create([
                    'user_id' => $user_id,
                    'order_number' => Order::generateOrderNumber(),
                    'total_amount' => $totalAmount,
                    'payment_status' => 'paid',
                    'payment_method' => 'razorpay',
                    'shipping_status' => 'pending',
                    'shipping_address_id' => $shippingAddress->id,
                    'order_notes' => $formData['order_comments'] ?? '',
                    'razorpay_order_id' => $request->razorpay_order_id,
                ]);
                
                // Create order items
                foreach ($cartItems as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'product_name' => $cartItem->product_name,
                        'price' => $cartItem->price,
                        'quantity' => $cartItem->quantity,
                        'total' => $cartItem->price * $cartItem->quantity,
                        'image' => $cartItem->image,
                    ]);
                }
                
                // Create payment record
                $payment = Payment::create([
                    'r_payment_id' => $request->razorpay_payment_id,
                    'method' => 'razorpay',
                    'currency' => 'INR',
                    'user_email' => $formData['billing_email'] ?? '',
                    'amount' => $totalAmount,
                    'json_response' => json_encode($attributes)
                ]);
                
                // Clear cart after successful order
                Cart::where('user_id', $user_id)->delete();
                
                // Clear wishlist if needed (optional - you may want to keep wishlist items)
                // \App\Models\Wishlist::where('user_id', $user_id)->delete();
                
                DB::commit();
                
                // Clear session data
                Session::forget(['razorpay_order_id', 'razorpay_amount', 'checkout_form_data']);
                Session::put('success', 'Payment successful! Your order has been placed.');
                Session::put('order_id', $order->id);
                Session::put('order_number', $order->order_number);
                
                return response()->json([
                    'status' => 'success',
                    'redirect_url' => route('order.success', ['order_id' => $order->id])
                ]);
                
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
            
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 400);
        }
    }
    
}
