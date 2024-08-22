<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BlogApiController extends Controller
{
    public function BlogList(Request $request)
    {
        $page = $request->input('page') ?? 1;
        $row_per_page = $request->input('limit') ?? config("global.per_api_limit");
        $start_index = ($page - 1) * $row_per_page;

        // Initial query with conditions
        $blogsQuery = Blog::with(['subCategory' => function ($query) {
            $query->select('id', 'name');
        }])
        ->where('blogs.is_deleted', 0)
        ->orderBy('blogs.id', 'desc')
        ->join('sub_categories', 'blogs.sub_cat_id', '=', 'sub_categories.id')
        ->select('blogs.*');  // Select all columns from the blogs table

        // Apply search filter
        if ($request->search) {
            $blogsQuery->where('blogs.title', 'LIKE', '%' . $request->search . '%');
        }

        // Apply slug filter if provided
        if ($request->slug) {
            $blogsQuery->where('sub_categories.name_slug', $request->slug);
        }

        // Get total record count after applying filters
        $total_record = $blogsQuery->count();

        // Apply pagination
        $blogs = $blogsQuery->limit($row_per_page)->offset($start_index)->get();

        return response()->json([
            "total_record" => $total_record,
            'data' => $blogs,
            "message" => "Blog List Get Successfully",
            'status' => true
        ]);
    }


    public function BlogDetail(Request $request)
    {
        $rules = [
            'slug' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["data" => (object)[], "message" => "Invalid Fields", "status" => false], 422);
        }

        $blog = Blog::with(['subCategory' => function ($query) {
            $query->select('id', 'name');
        }])->where('title_slug', $request->slug)->where('is_deleted', 0)->first();
        if (!$blog) {
            return response()->json(["data" => (object)[], "message" => "Blog Not Found!", "status" => false], 404);
        }
        return response()->json(['data' => $blog, "message" => "Blog Get Successfully", 'status' => true]);
    }

    public function Category(Request $request)
    {
        $page = $request->input('page') ?? 1;
        $row_per_page = config("global.per_api_limit");
        $start_index = ($page - 1) * $row_per_page;

         // Use eager loading to load subcategories with categories
        $categories = Category::with(['subCategories' => function($query) {
            $query->where('is_deleted', 0);
        }])
        ->where('is_deleted', 0)
        ->orderBy('categories.id', 'desc')
        ->where('status', 'Active')
        ->skip($start_index)
        ->take($row_per_page)
        ->get();

        // Total count of all active and not deleted categories
        $total_record = Category::where('is_deleted', 0)
                                ->where('status', 'Active')
                                ->count();

        return response()->json(["total_record" => $total_record, 'data' => $categories, "message" => "Category Get Successfully", 'status' => true]);
    }

    public function TopCategoryList()
    {
        $topSubCategories = DB::table('sub_categories')
            ->select('sub_categories.id', 'sub_categories.name', DB::raw('COUNT(blogs.id) as blog_count'))
            ->leftJoin('blogs', 'sub_categories.id', '=', 'blogs.sub_cat_id')
            ->groupBy('sub_categories.id', 'sub_categories.name')
            ->orderByDesc('blog_count')
            ->limit(4)
            ->get();

        // $topSubCategories = SubCategory::select('sub_categories.id', 'sub_categories.name')
        //     ->withCount('blogs')
        //     ->orderBy('blogs_count', 'desc')
        //     ->limit(4)
        //     ->get();

        return response()->json(['data' => $topSubCategories, "message" => "Top Category List Get Successfully", 'status' => true]);
    }

}
