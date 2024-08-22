<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
            return view('category.index', compact('per_page_limit', 'get_data', 'text_for_pagination', 'total_record'));
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

        $get_data = Category::where('is_deleted', 0);
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

        return view('category.indexTable', compact('get_data', 'text_for_pagination', 'per_page_limit', 'start_index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function ChangeCategoryStatus(Request $request)
    {
        if (!Session::has('a_type')) {
            return redirect()->route('login');
        }
        $type = $request->input('type');
        $category = Category::find($request->id);

        if ($category) {
            // Update the status based on the type provided in the request
            $category->status = $type;
            $category->save();

            return response()->json(['status' => true, 'message' => 'Status updated successfully']);
        }

        return response()->json(['status' => true, 'message' => 'Data delete successfully']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        // return redirect()->route('category.index');
        return response()->json(['status' => true, 'message' => 'Data saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return response()->json(['status' => true, 'message' => 'Data update successfully']);
    }

    public function checkCategoryName(Request $request)
    {
        if($request->id) {
            $exists = Category::where('name', $request->input('name'))->where('is_deleted',0)->where('id', '!=', $request->id)->exists();
        } else {
            $exists = Category::where('name', $request->input('name'))->where('is_deleted',0)->exists();
        }
        return response()->json(['exists' => $exists]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category)
        {
            SubCategory::where('cat_id', $category->id)->update(['is_deleted' => 1]);
            Blog::whereIn('cat_id', function($query) use ($category) {
                $query->select('id')
                      ->from('sub_categories')
                      ->where('cat_id', $category->id);
            })->update(['is_deleted' => 1]);
            $category->update(['is_deleted' => 1]);

            return response()->json(['status' => true, 'message' => 'Data deleted successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Category Not Found']);
    }
}
