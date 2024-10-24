<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function saveCheckout(Request $request)
    {
        // Validate the incoming request
        $request->validate([
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
        ]);

        // Save the data to the database
        $checkout = new ShippingAddress();
        $checkout->company_name = $request->input('billing_company');
        $checkout->first_name = $request->input('billing_first_name');
        $checkout->last_name = $request->input('billing_last_name');
        $checkout->phone = $request->input('billing_phone');
        $checkout->email = $request->input('billing_email');
        $checkout->address_1 = $request->input('billing_address_1');
        $checkout->address_2 = $request->input('billing_address_2');
        $checkout->city = $request->input('billing_city');
        $checkout->state = $request->input('billing_state');
        $checkout->country = $request->input('billing_country');
        $checkout->postcode = $request->input('billing_postcode');
        $checkout->order_comments = $request->input('order_comments');

        $checkout->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Checkout details saved successfully.',
            'data' => $checkout,
        ]);
    }
}
