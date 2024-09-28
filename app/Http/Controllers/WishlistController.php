<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        // Get the product ID from the request
        $productId = $request->input('product_id');

        // Get the logged-in user's ID (assuming you're storing it in the session)
        $userId = Session::get('login_id');

        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'User not logged in'], 401);
        }

        // Check if the item is already in the wishlist
        $exists = Wishlist::where('user_id', $userId)
                          ->where('product_id', $productId)
                          ->exists();

        if ($exists) {
            return response()->json(['status' => 'error', 'message' => 'Item already in wishlist']);
        }

        // Add item to the wishlist
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Item added to wishlist']);    
    }

    public function ViewWishlist(Request $request)
    {
        $userId = Session::get('login_id');

        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'User not logged in'], 401);
        }

        // Check if the item is already in the wishlist
        $products = Wishlist::with('product')
                    ->where('user_id', $userId)
                    ->get();

        $body = 'WishList';

        return view('front_end.wishlist', compact('products', 'body'));
    }

    public function remove(Request $request)
    {

        $userId = Session::get('login_id'); // Get the logged-in user ID

        // Check if the item belongs to the user and then delete
        $wishlistItem = Wishlist::where('id', $request->id)->where('user_id', $userId)->first();

        if ($wishlistItem) {
            $wishlistItem->delete();  // Remove item from the wishlist
            return response()->json(['status' => 'success', 'message' => 'Item removed from wishlist']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Item not found or does not belong to the user'], 404);
        }
    }

    public function CountWishlist()
    {
        $userId = Session::get('login_id'); // Get the logged-in user ID
        $wishlistCount = Wishlist::where('user_id', $userId)->count(); // Count the items in the wishlist for the user

        return response()->json(['count' => $wishlistCount]);
    }


}
