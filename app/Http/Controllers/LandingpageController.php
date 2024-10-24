<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Session;

class LandingpageController extends Controller
{
    public function index()
    {
        $products = Product::where('is_deleted',0)->take(4)->get();
        $body = 'home';

        $categories = Category::where('is_deleted',0)->get();

        $user_id = Session::has('login_id');
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

        $user_id = Session::has('login_id');
        $wishlistItems = Wishlist::where('user_id', $user_id)
                    ->pluck('product_id')->toArray();

        return view('front_end.product',compact('products','body','cat_name', 'text_for_pagination','cat_id', 'wishlistItems', 'max_price'));
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

        $user_id = Session::has('login_id');
        $wishlistItems = Wishlist::where('user_id', $user_id)
                    ->pluck('product_id')->toArray();

        return view('front_end.product_detail', compact('product','body', 'wishlistItems'));
    }

    public function checkout($id)
    {
        $user_id = Session::has('login_id');
        $body = 'checkout';
        $products = Cart::where('user_id', $user_id)->get();

        // Calculate subtotal
        $subtotal = 0;
        foreach ($products as $product) {
            $subtotal += $product->price * $product->total; // Assuming price and quantity fields exist
        }

        return view('front_end.checkout', compact('body', 'products', 'subtotal'));
    }

    public function placeOrder(Request $request)
    {
        // Validate and process the order here
        // E.g., save order to database, send confirmation email, etc.

        return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
    }
}
