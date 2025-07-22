<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function success($orderId)
    {
        $order = Order::with(['items', 'shippingAddress'])->find($orderId);
        
        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found');
        }
        
        $body = 'checkout';
        return view('front_end.order_success', compact('order', 'body'));
    }
    
    public function myOrders()
    {
        $user_id = session()->get('login_id');
        
        if (!$user_id) {
            return redirect()->route('user-login')->with('error', 'Please login to view orders');
        }
        
        $orders = Order::with(['items', 'shippingAddress'])
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $body = 'shop';
        return view('front_end.my_orders', compact('orders', 'body'));
    }
}