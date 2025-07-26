<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class LandingpageController extends Controller
{
    public function index()
    {
        $products = Product::where('is_deleted',0)->take(4)->get();
        $body = 'home';

        $categories = Category::where('is_deleted',0)->get();

        $user_id = Session::get('login_id');
        $wishlistItems = Wishlist::where('user_id', $user_id)
                    ->pluck('product_id')->toArray();

        return view('front_end.home',compact('products','body', 'categories', 'wishlistItems'));
    }

   public function CatWiseProduct($slug = null)
    {
        if($slug) {
            $category = Category::where('name', $slug)->where('is_deleted',0)->first();
        }

        $all_products = Product::where('is_deleted', 0);
        if(isset($category)) {
            $all_products = $all_products->where('cat_id', $category->id);
        }
        $max_price = (int) $all_products->max('sell_price');

        $page = 1;
        $per_page_limit = config('global.per_api_limit') ?? 6;
        $total_record =  0;
        $start_index = ($page - 1) * $per_page_limit;
        $end = $start_index + $per_page_limit;
        if ($total_record <= $end) {
            $text_for_pagination = "Showing " . ($start_index + 1) . " to {$total_record} of {$total_record} entries";
        } else {
            $text_for_pagination = "Showing " . ($start_index + 1) . " to {$end} of {$total_record} entries";
        }

        $products = $all_products->paginate($per_page_limit);

        $body = 'shop';
        $cat_name = !empty($category) ? $category->name : 'All Products';
        $cat_id = !empty($category) ? $category->id : null;

        $user_id = Session::get('login_id');
        $wishlistItems = Wishlist::where('user_id', $user_id)
                    ->pluck('product_id')->toArray(); 
        $cartItems = Cart::where('user_id', $user_id)
                    ->pluck('product_id')->toArray();

        return view('front_end.product',compact('products','body','cat_name', 'text_for_pagination','cat_id', 'wishlistItems', 'max_price','cartItems'));
    }

    private function getAvailableColors($query)
    {
        $products = $query->whereNotNull('available_colors')->get();
        $colors = [];
        
        foreach ($products as $product) {
            if ($product->available_colors) {
                $colors = array_merge($colors, $product->available_colors);
            }
        }
        
        return array_unique($colors);
    }

    private function getAvailableBrands($query)
    {
        return $query->whereNotNull('brand')
                    ->distinct()
                    ->pluck('brand')
                    ->filter()
                    ->toArray();
    }

    private function getAvailableMaterials($query)
    {
        $products = $query->whereNotNull('materials')->get();
        $materials = [];
        
        foreach ($products as $product) {
            if ($product->materials) {
                $materials = array_merge($materials, $product->materials);
            }
        }
        
        return array_unique($materials);
    }

    public function TermsCondition() {
        $body = 'shop';
        return view('front_end.terms_condition', compact('body'));
    }

    public function PrivacyPolicy()
    {
        $body = 'shop';
        return view('front_end.privacy_policy', compact('body'));
    }

    public function product_detail($id)
    {
        
        $body = 'shop';
        $product = Product::find($id);

        $user_id = Session::get('login_id');
        $wishlistItems = Wishlist::where('user_id', $user_id)
                    ->pluck('product_id')->toArray();
        $cartItems = Cart::where('user_id', $user_id)
                    ->pluck('product_id')->toArray();

        return view('front_end.product_detail', compact('product','body', 'wishlistItems','cartItems'));
    }

    public function checkout($id = null)
    {
        $user_id = Session::get('login_id');
        $body = 'checkout';
        
        if (!$user_id) {
            return redirect()->route('user-login')->with('error', 'Please login to checkout');
        }
        
        // If specific product ID is provided (Buy It Now), add it to cart first
        if ($id && $id !== 'cart') {
            $product = Product::find($id);
            if ($product) {
                // Check if product already in cart
                $cartItem = Cart::where('user_id', $user_id)
                    ->where('product_id', $id)
                    ->first();
                
                if (!$cartItem) {
                    // Add product to cart
                    Cart::create([
                        'user_id' => $user_id,
                        'product_id' => $product->id,
                        'product_name' => $product->product_name,
                        'price' => $product->sell_price,
                        'quantity' => 1,
                        'total' => $product->sell_price,
                        'image' => json_encode($product->images),
                    ]);
                }
            }
        }
        
        // Get all cart items
        $products = Cart::where('user_id', $user_id)
            ->with('product')
            ->get();
            
        if ($products->isEmpty()) {
            return redirect()->route('catwiseproduct')->with('error', 'Your cart is empty. Please add items to checkout.');
        }

        // Calculate subtotal
        $subtotal = 0;
        foreach ($products as $product) {
            // Decode images from cart
            $product->images = json_decode($product->image, true) ?: [];
            // product_name is already available in cart, no need to reassign
            $subtotal += $product->price * $product->quantity;
        }

        // Get available shipping methods based on order amount
        try {
            $shippingMethods = ShippingMethod::active()
                ->byOrderAmount($subtotal)
                ->orderBy('sort_order')
                ->get();
        } catch (\Exception $e) {
            // If shipping methods table doesn't exist or there's an error, use empty collection
            $shippingMethods = collect([]);
        }

        return view('front_end.checkout', compact('body', 'products', 'subtotal', 'shippingMethods'));
    }

    public function placeOrder(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'billing_company' => 'nullable|string|max:255',
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name' => 'required|string|max:255',
            'billing_phone' => 'required|string|max:15',
            'billing_email' => 'required|email|max:255',
            'billing_address_1' => 'required|string|max:255',
            'billing_address_2' => 'nullable|string|max:255',
            'billing_city' => 'required|string|max:255',
            'billing_state' => 'required|string|max:255',
            'billing_country' => 'required|string|max:255',
            'billing_postcode' => 'required|string|max:20',
            'order_comments' => 'nullable|string',
            'payment_method' => 'required|string',
            'shipping_method' => 'required|string',
        ]);

        $user_id = Session::get('login_id');
        
        if (!$user_id) {
            return response()->json(['success' => false, 'message' => 'Please login to place order']);
        }

        // Get cart items
        $cartItems = Cart::where('user_id', $user_id)->get();
        
        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Your cart is empty']);
        }

        DB::beginTransaction();
        
        try {
            // Create or update shipping address
            $shippingAddress = ShippingAddress::updateOrCreate(
                ['user_id' => $user_id],
                [
                    'company_name' => $validated['billing_company'],
                    'first_name' => $validated['billing_first_name'],
                    'last_name' => $validated['billing_last_name'],
                    'phone' => $validated['billing_phone'],
                    'email' => $validated['billing_email'],
                    'address_1' => $validated['billing_address_1'],
                    'address_2' => $validated['billing_address_2'],
                    'city' => $validated['billing_city'],
                    'state' => $validated['billing_state'],
                    'country' => $validated['billing_country'],
                    'postcode' => $validated['billing_postcode'],
                    'order_comments' => $validated['order_comments'],
                ]
            );

            // Calculate total
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item->price * $item->quantity;
            }

            // Create order
            $order = Order::create([
                'user_id' => $user_id,
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'payment_status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'shipping_status' => 'pending',
                'shipping_address_id' => $shippingAddress->id,
                'order_notes' => $validated['order_comments'],
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

            // Handle payment method
            if ($validated['payment_method'] === 'razorpay') {
                // Create Razorpay order
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                
                $razorpayOrder = $api->order->create([
                    'amount' => $totalAmount * 100, // Amount in paise
                    'currency' => 'INR',
                    'receipt' => $order->order_number,
                    'payment_capture' => 1,
                ]);

                $order->razorpay_order_id = $razorpayOrder->id;
                $order->save();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'razorpay_order_id' => $razorpayOrder->id,
                    'amount' => $totalAmount * 100,
                    'customer_name' => $validated['billing_first_name'] . ' ' . $validated['billing_last_name'],
                    'customer_email' => $validated['billing_email'],
                    'customer_phone' => $validated['billing_phone'],
                ]);
            } else {
                // For COD and other payment methods
                if ($validated['payment_method'] === 'cod') {
                    $order->payment_status = 'cod';
                }

                // Clear cart after successful order
                Cart::where('user_id', $user_id)->delete();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'order_id' => $order->id,
                    'message' => 'Order placed successfully!'
                ]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error placing order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function orderSuccess($order_id)
    {
        $user_id = Session::get('login_id');
        
        if (!$user_id) {
            return redirect()->route('home')->with('error', 'Please login to view order details.');
        }
        
        $order = Order::with(['orderItems', 'shippingAddress'])
            ->where('id', $order_id)
            ->where('user_id', $user_id)
            ->first();
            
        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }
        
        $body = "order-success";
        
        return view('front_end.order_success', compact('body', 'order'));
    }
}
