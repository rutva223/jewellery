<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{
    public function loginDashboard()
    {
        if (Session::has('a_type')) {
            $id = Session::get('login_id');
            $admin = User::where('id', $id)->where('is_deleted', 0)->first();
            $admin->email_otp = null;
            $admin->otp_expired = null;
            $admin->save();

            $categories = Category::where('status', 'Active')->where('is_deleted',0)->count();
            $products = Product::where('status', 'Active')->where('is_deleted',0)->count();
            $orders = Order::count();
            $pendingOrders = Order::where('shipping_status', 'pending')->count();

            return view('admin.dashboard', compact('categories', 'products', 'orders', 'pendingOrders'));
        } else {
            return redirect()->route('login');
        }
    }

     public function login()
    {
        return view('auth.login');
    }
    public function ChangesPassword()
    {
        return view('layouts.changepassword');
    }

    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        $login_id = Session::get('login_id');

        if (Session::has('a_type')) {
            $user = User::where('id', $login_id)->first();
            if ($user) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->with('error', 'The old password does not match.');
                }
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->back()->with('success', 'Password successfully');
            }
        }
    }

    public function verifyCurrentPassword(Request $request)
    {
        $currentPassword = $request->current_password;
        $user = User::where('id', $request->id)->where('is_deleted', 0)->first();

        if (Hash::check($currentPassword, $user->password)) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }
}
