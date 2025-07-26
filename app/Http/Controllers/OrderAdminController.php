<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::has('a_type')) {
            $page = Session::get('page') ?? 1;
            $per_page_limit = 10;
            $get_data = [];
            $total_record =  0;
            $start_index = ($page - 1) * $per_page_limit;
            $end = $start_index + $per_page_limit;
            if ($total_record <= $end) {
                $text_for_pagination = "Showing " . ($start_index + 1) . " to {$total_record} of {$total_record} entries";
            } else {
                $text_for_pagination = "Showing " . ($start_index + 1) . " to {$end} of {$total_record} entries";
            }
            return view('order.index', compact('per_page_limit', 'get_data', 'text_for_pagination', 'total_record'));
        } else {
            return redirect()->route('login');
        }
    }

    public function AllOrderTableData(Request $request)
    {
        $page = $request->input('page', Session::get('page', 1));
        Session::put('page', $page);
        $per_page_limit = $request->input('per_page_option', 10);
        $searchTerm = $request->input_value;

        $get_data = Order::with(['user', 'shippingAddress', 'orderItems']);
        
        if (!empty($searchTerm)) {
            $get_data->where(function ($q) use ($searchTerm) {
                $q->orWhere('order_number', 'like', "%$searchTerm%")
                  ->orWhere('id', '=', $searchTerm)
                  ->orWhereHas('user', function($query) use ($searchTerm) {
                      $query->where('name', 'like', "%$searchTerm%")
                            ->orWhere('email', 'like', "%$searchTerm%");
                  });
            });
        }
        
        $get_data = $get_data->orderBy('id', 'desc')->paginate($per_page_limit);

        $total_record =  $get_data->total();
        $start_index = ($page - 1) * $per_page_limit;
        $end = $start_index + $per_page_limit;
        if ($total_record <= $end) {
            if ($start_index < 0) {
                $text_for_pagination = "Showing 0 to {$total_record} of {$total_record} entries";
            } else {
                $text_for_pagination = "Showing " . ($start_index + 1) . " to {$total_record} of {$total_record} entries";
            }
        } else {
            $text_for_pagination = "Showing " . ($start_index + 1) . " to {$end} of {$total_record} entries";
        }

        return view('order.indexTable', compact('get_data', 'text_for_pagination', 'per_page_limit', 'start_index'));
    }

    public function AllCategoryTableData(Request $request)
    {
        return $this->AllOrderTableData($request);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Session::has('a_type')) {
            $order = Order::with(['user', 'shippingAddress', 'orderItems.product'])->findOrFail($id);
            return view('order.show', compact('order'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Session::has('a_type')) {
            $order = Order::with(['user', 'shippingAddress', 'orderItems'])->findOrFail($id);
            return view('order.edit', compact('order'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Session::has('a_type')) {
            $order = Order::findOrFail($id);
            
            $request->validate([
                'payment_status' => 'required|string',
                'shipping_status' => 'required|string',
                'order_notes' => 'nullable|string'
            ]);

            $order->update([
                'payment_status' => $request->payment_status,
                'shipping_status' => $request->shipping_status,
                'order_notes' => $request->order_notes
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Order updated successfully!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Session::has('a_type')) {
            $order = Order::findOrFail($id);
            $order->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Order deleted successfully!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
    }
    
    /**
     * Update order status
     */
    public function updateStatus(Request $request)
    {
        if (Session::has('a_type')) {
            $request->validate([
                'id' => 'required|exists:orders,id',
                'field' => 'required|in:payment_status,shipping_status',
                'value' => 'required|string'
            ]);

            $order = Order::findOrFail($request->id);
            $order->update([
                $request->field => $request->value
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Status updated successfully!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
    }
}
