<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
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

    public function AllCategoryTableData(Request $request)
    {
        $page = $request->input('page', Session::get('page', 1));
        Session::put('page', $page);
        $per_page_limit = $request->input('per_page_option', 10);
        $searchTerm = $request->input_value;

        $get_data = Cart::where('is_deleted', 0);
        if (!empty($searchTerm)) {
            $get_data->where(function ($q) use ($searchTerm) {
                    $q->orWhere('name', 'like', "%$searchTerm%")
                    ->orWhere('id', '=', $searchTerm);
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

    public function AllCartTableData(Request$request)
    {
        dd($request->all());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
