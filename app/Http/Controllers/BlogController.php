<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BlogController extends Controller
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
            return view('blogs.index', compact('per_page_limit', 'get_data', 'text_for_pagination', 'total_record'));
        } else {
            return redirect()->route('login');
        }
    }

    public function AllBlogTableData(Request $request)
    {
        $page = $request->input('page', Session::get('page', 1));
        Session::put('page', $page);
        $per_page_limit = $request->input('per_page_option', 10);
        $searchTerm = $request->input_value;

        $get_data = Blog::where('is_deleted', 0)->with(['category', 'subCategory']);

        if (!empty($searchTerm)) {
            $get_data->where(function ($q) use ($searchTerm) {
                $q->orWhere('title', 'like', "%$searchTerm%")
                    ->orWhere('headline', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%")
                    ->orWhere('id', $searchTerm)
                    ->orWhereHas('category', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', "%$searchTerm%");
                    })->orWhereHas('subCategory', function ($query) use ($searchTerm) {
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

        return view('blogs.indexTable', compact('get_data', 'text_for_pagination', 'per_page_limit', 'start_index'));
    }

    public function ChangeBlogStatus(Request $request)
    {
        if (!Session::has('a_type')) {
            return redirect()->route('login');
        }
        $type = $request->input('type');
        $category = Blog::find($request->id);

        if ($category) {
            // Update the status based on the type provided in the request
            $category->status = $type;
            $category->save();

            return response()->json(['status' => true, 'message' => 'Status updated successfully']);
        }

        return response()->json(['status' => true, 'message' => 'Data delete successfully']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_deleted', 0)->get()->pluck('name', 'id');
        $Sub_categories = SubCategory::where('is_deleted', 0)->get()->pluck('name', 'id');

        return view('blogs.create', compact('categories', 'Sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->cat_id = $request->cat_id;
        $blog->sub_cat_id = $request->sub_cat_id;
        $blog->title = $request->title;
        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;

        // Check for uniqueness
        $count = 1;
        while (Blog::where('title_slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        $blog->title_slug = $slug;
        $blog->headline = $request->headline;
        // $category->description = $request->description;
        $blog->description = $this->handleSummernoteImages($request->description);

        $imageBase64 = $request->image;
        if ($imageBase64 != null) {
            $upload_image = UploadImageFolder('blog_image/', $imageBase64);
            $blog->image = $upload_image;
        }
        $blog->save();

        return redirect()->action([BlogController::class, 'index'])->with('success', 'Data saved successfully');
    }

    public function getSubCategories($catId)
    {
        $subCategories = SubCategory::where('is_deleted', 0)->where('cat_id', $catId)->pluck('name', 'id');
        return response()->json($subCategories);
    }

     // Handle images within the Summernote description
     protected function handleSummernoteImages($description)
     {
         $dom = new \DOMDocument();
         libxml_use_internal_errors(true);
         $dom->loadHTML($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
         libxml_clear_errors();

         $images = $dom->getElementsByTagName('img');

         foreach ($images as $img) {
             $src = $img->getAttribute('src');

             // If the image source is base64, handle the upload
             if (preg_match('/^data:image\/(\w+);base64,/', $src)) {
                 $data = substr($src, strpos($src, ',') + 1);
                 $data = base64_decode($data);
                 $image_name = time() . '.png';
                 $path = public_path('blog_image/') . $image_name;
                 file_put_contents($path, $data);
                 $img->removeAttribute('src');
                 $img->setAttribute('src', asset('blog_image/' . $image_name));
             }
         }

         return $dom->saveHTML();
     }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::where('is_deleted', 0)->get()->pluck('name', 'id');
        $Sub_categories = SubCategory::where('is_deleted', 0)->get()->pluck('name', 'id');

        return view('blogs.edit', compact('blog', 'categories', 'Sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blogs = Blog::find($id);
        $blogs->cat_id = $request->cat_id ?? $blogs->cat_id;
        $blogs->sub_cat_id = $request->sub_cat_id ?? $blogs->sub_cat_id;
        $blogs->title = $request->title ?? $blogs->title;
        $slug = Str::slug($request->title);

        // Ensure the slug is unique
        $count = Blog::where('title_slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1); // Append a number to make it unique
        }

        $blogs->title_slug = $slug ?? $blogs->title_slug;

        $blogs->headline = $request->headline ?? $blogs->headline;
        $blogs->description = $this->handleSummernoteImages($request->description);

        $imageBase64 = $request->image;
        if ($imageBase64 != null) {
            $upload_image = UploadImageFolder('blog_image/', $imageBase64);
            $blogs->image = $upload_image;
        }
        $blogs->save();

        return redirect()->action([BlogController::class, 'index'])->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog) {
            $blog->update(['is_deleted' => 1]);

            return response()->json(['status' => true, 'message' => 'Data deleted successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Blog Not Found']);
    }
}
