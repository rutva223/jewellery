<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\Product;


class CommonController extends Controller
{
    public function EmailSendCode($to_email, $encrypt_otp)
    {
        if (env('APP_URL')) {
            try {
                $details = [
                    // 'title' => 'Success',
                    'otp_val' => $encrypt_otp
                ];
                $mailData = getMailData();

                $from_email = $mailData['from_email'];
                $fromName = $mailData['from_name'];
                $to_client_email = $to_email;

                Mail::send("email.forgot_otp", $details, function ($message) use ($from_email, $to_client_email, $fromName) {
                    $message->to($to_client_email);
                    $message->from($from_email, $fromName)
                        ->subject('OTP verify Mail');
                });

                Log::info("TRY  SendOTP1 mail Success");
                return true;
            } catch (Exception $e) {
                // send telegram msg
                Log::info("catch SendOTP1 mail FAILED: {$e->getMessage()}");
                return false;
            }
        } else {
            return false;
        }
    }

    public function LoginTheme(Request $request)
    {
        $id = Session::get('login_id');
        // dump($id, $request->all());
        if (Session::has('a_type')) {
            $user = User::where('id', $id)->first();
        }

        if ($user) {
            session()->forget('login_theme');
            if ($user->user_theme == 'dark') {
                Session()->put('login_theme', 'light');
                $user->user_theme = 'light';
                $user->save();
            } elseif ($user->user_theme == 'light') {
                Session()->put('login_theme', 'dark');
                $user->user_theme = 'dark';
                $user->save();
            }
        }
        return response()->json(['status' => true, 'theme' => $user->user_theme]);
    }

    public function passwordEmailForm()
    {
        return view('auth.passwords_email_frm');
    }

    public function SendOTP(Request $request)
    {
        $request->session()->forget('opt_page');
        $email = $request->input('email');
        $password = $request->input('password');
        // $encrypt_otp = 123456;

        $admin = User::where('email', $email)->where('is_deleted', 0)->first();
        Session()->put('email', $admin->email);
            Session()->put('admin_name', $admin->name);
            Session()->put('admin_id', $admin->id);
            Session()->put('login_id', $admin->id);
            Session()->put('admin_email', $admin->email);
            Session()->put('a_type', 1);
            return redirect()->route('dashboard');
        if ($admin && Hash::check($password, $admin->password)) {



            // $admin->update(['email_otp' => $encrypt_otp]);

            // $admin->created_at = Carbon::now()->setTimezone('UTC')->toDateTimeString();
            // $expiryTime = Carbon::now('UTC')->addMinutes(2); // 2 minutes expiration
            // $admin->otp_expired = $expiryTime;
            // $admin->save();

            // $this->EmailSendCode($email, $encrypt_otp);

            // Session()->put('email', $admin->email);
            // Session()->put('admin_name', $admin->name);
            // Session()->put('admin_id', $admin->id);
            // Session()->put('login_id', $admin->id);
            // Session()->put('admin_email', $admin->email);
            // Session()->put('a_type', 1);

            // return view('auth.login_OTP');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function otpResend(Request $request)
    {
        $email = $request->input('email');
        $admin = User::where('email', $email)->where('is_deleted', 0)->first();
        if ($admin) {
            $otp_val = 123456;
            $admin->email_otp = $otp_val;

            $expiryTime = Carbon::now('UTC')->addMinutes(2); // 2 minutes expiration
            $admin->otp_expired = $expiryTime;
            $admin->save();
            Session()->put('decrypt_otp', $otp_val);
            Session()->put('email', $email);

            $this->EmailSendCode($email, $otp_val);

            return response()->json(['status' => true, 'otp_sent' => true, 'message' => 'OTP resent successfully']);
        }
    }

    public function addToCart(Request $request)
    {
        // Validate the product ID
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Find the product
        $product = Product::findOrFail($request->product_id);

        // Set user ID from session
        $userId = Session::get('login_id');
        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'User not logged in'], 401);
        }

        // Check if the product is already in the cart
        $cart = Cart::where('user_id', $userId)
                    ->where('product_id', $product->id)
                    ->first();

        // Determine the quantity, defaulting to 1 if not provided
        $quantity = $request->input('quantity', 1);

        if ($cart) {
            // Update existing cart item
            $cart->quantity += $quantity;
            $cart->price = $product->sell_price;
            $cart->total = $cart->quantity * $product->sell_price;
            $cart->image = json_encode($product->images);
            $cart->product_name = $product->product_name;
            $cart->save();
        } else {
            // Add new item to cart
            $cart = Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->sell_price,
                'total' => $quantity * $product->sell_price,
                'image' => json_encode($product->images),
                'product_name' => $product->product_name,
            ]);
        }

        // Fetch updated cart data
        $carts = Cart::where('user_id', $userId)->get();
        $totalAmount = $carts->sum('total');

        // Return JSON response with updated cart data
        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart!',
            'total_amount' => $totalAmount,
            'carts' => $carts
        ]);
    }

    public function deletetocart(Request $request){
        // $cart = Cart::where('product_id',$request->product_id)->first();
        // if(!empty($cart)){
        //     $cart->delete();
        // }
        // $CartCount = Cart::where()->count();
        // return response()->json(['CartCount' => $CartCount]);

        $userId = Session::get('login_id'); // Get the logged-in user ID

        // Check if the item belongs to the user and then delete
        $cart = Cart::where('id', $request->id)->where('user_id', $userId)->first();

        if ($cart) {
            $cart->delete();
            return response()->json(['status' => 'success', 'message' => 'Item removed from Cart']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Item not found or does not belong to the user'], 404);
        }

    }
    public function ViewCartlist(Request $request){
        $userId = Session::get('login_id');
        $cart = Cart::with('product')->where('user_id', $userId)->get();
        
        // Decode images for each cart item
        foreach ($cart as $item) {
            $item->images = json_decode($item->image, true) ?: [];
        }
        
        $body = 'CartList';

        return view('front_end.cart', compact('cart','body'));
    }

    public function CartCount()
    {
        $userId = Session::get('login_id');
        
        $CartCount = Cart::where('user_id', $userId)->count();
        return response()->json(['count' => $CartCount]);
    }

    public function updateCartQuantity(Request $request)
    {
        $userId = Session::get('login_id');
        
        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'User not logged in']);
        }

        $cart = Cart::where('id', $request->id)
                    ->where('user_id', $userId)
                    ->first();

        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->total = $cart->price * $request->quantity;
            $cart->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Quantity updated successfully',
                'total' => $cart->total
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Cart item not found']);
    }
}
