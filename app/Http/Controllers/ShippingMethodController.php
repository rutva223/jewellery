<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Session::has('a_type')) {
            return redirect()->route('login');
        }

        $shippingMethods = ShippingMethod::orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('shipping.index', compact('shippingMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Session::has('a_type')) {
            return redirect()->route('login');
        }

        return view('shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,flat_rate',
            'cost' => 'required|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer|min:0',
        ]);

        ShippingMethod::create([
            'name' => $request->name,
            'type' => $request->type,
            'cost' => $request->cost,
            'minimum_order_amount' => $request->minimum_order_amount,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->route('shipping-methods.index')
            ->with('success', 'Shipping method created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Session::has('a_type')) {
            return redirect()->route('login');
        }

        $shippingMethod = ShippingMethod::findOrFail($id);
        return view('shipping.edit', compact('shippingMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,flat_rate',
            'cost' => 'required|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer|min:0',
        ]);

        $shippingMethod = ShippingMethod::findOrFail($id);
        $shippingMethod->update([
            'name' => $request->name,
            'type' => $request->type,
            'cost' => $request->cost,
            'minimum_order_amount' => $request->minimum_order_amount,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->route('shipping-methods.index')
            ->with('success', 'Shipping method updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);
        $shippingMethod->delete();

        return response()->json([
            'status' => true,
            'message' => 'Shipping method deleted successfully.'
        ]);
    }

    /**
     * Toggle the active status of a shipping method.
     */
    public function toggleStatus(Request $request)
    {
        $shippingMethod = ShippingMethod::findOrFail($request->id);
        $shippingMethod->is_active = !$shippingMethod->is_active;
        $shippingMethod->save();

        return response()->json([
            'status' => true,
            'message' => 'Status updated successfully.',
            'is_active' => $shippingMethod->is_active
        ]);
    }
}