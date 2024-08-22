<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
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
            $categories = Category::where('is_deleted', 0)->get()->pluck('name', 'id');

            return view('sub_category.index', compact('per_page_limit', 'get_data', 'text_for_pagination', 'total_record', 'categories'));
        } else {
            return redirect()->route('login');
        }
    }

    public function AllSubCategoryTableData(Request $request)
    {
        $page = $request->input('page', Session::get('page', 1));
        Session::put('page', $page);
        $per_page_limit = $request->input('per_page_option', 10);
        $searchTerm = $request->input_value;
        $get_data = SubCategory::where('is_deleted', 0);
        if (!empty($searchTerm)) {
            $get_data->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%$searchTerm%")
                  ->orWhere('id', '=', $searchTerm) // Add this line to search by ID
                    ->orWhereHas('category', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', "%$searchTerm%");
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

        $categories = Category::get()->pluck('name', 'id');

        return view('sub_category.indexTable', compact('get_data', 'text_for_pagination', 'per_page_limit', 'start_index', 'categories'));
    }

    public function ChangeSubCategoryStatus(Request $request)
    {
        if (!Session::has('a_type')) {
            return redirect()->route('login');
        }
        $type = $request->input('type');
        $category = SubCategory::find($request->id);

        if ($category) {
            // Update the status based on the type provided in the request
            $category->status = $type;
            $category->save();

            return response()->json(['status' => true, 'message' => 'Status updated successfully']);
        }

        return response()->json(['status' => true, 'message' => 'Data delete successfully']);
    }

    public function checkSubCategoryName(Request $request)
    {
        if($request->id) {
            $exists = SubCategory::where('name', $request->input('name'))->where('id', '!=', $request->id)->exists();
        } else {
            $exists = SubCategory::where('name', $request->input('name'))->exists();
        }
        return response()->json(['exists' => $exists]);
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
        if ($request->id) {
            // Update existing record
            $subCategory = SubCategory::find($request->id);
            $subCategory->cat_id = $request->cat_id;
            $subCategory->name = $request->name;
            $subCategory->name_slug = Str::slug($request->name);
            $subCategory->save();
        } else {
            // Create new record
            SubCategory::create([
                'cat_id' => $request->cat_id,
                'name' => $request->name,
            ]);
        }

        $categories = Category::where('status', 'Active')->pluck('name', 'id');

        return response()->json(['status' => true, 'categories' => $categories, 'message' => 'Data saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::where('status', 'Active')->where('is_deleted', 0)->pluck('name', 'id');

        return view('sub_category.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sub_category = SubCategory::find($id);
        $sub_category->cat_id = $request->cat_id;
        $sub_category->name = $request->name;
        $sub_category->name_slug = Str::slug($request->name) ?? $sub_category->name_slug;
        $sub_category->save();

        return response()->json(['status' => true, 'message' => 'Data update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        if($subCategory)
        {
            $subCategory->update(['is_deleted' => 1]);

            return response()->json(['status' => true, 'message' => 'Data deleted successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Sub Category Not Found']);
    }
}
