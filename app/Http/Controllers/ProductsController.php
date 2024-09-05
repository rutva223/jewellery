<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductsController extends Controller
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
            return view('products.index', compact('per_page_limit', 'get_data', 'text_for_pagination', 'total_record'));
        } else {
            return redirect()->route('login');
        }
    }

    public function AllProductTableData(Request $request)
    {
        $page = $request->input('page', Session::get('page', 1));
        Session::put('page', $page);
        $per_page_limit = $request->input('per_page_option', 10);
        $searchTerm = $request->input_value;

        $get_data = Product::where('is_deleted', 0)->with(['category']);

        if (!empty($searchTerm)) {
            $get_data->where(function ($q) use ($searchTerm) {
                $q->orWhere('product_name', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%")
                    ->orWhere('product_price', 'like', "%$searchTerm%")
                    ->orWhere('sell_price', 'like', "%$searchTerm%")
                    ->orWhere('discount', 'like', "%$searchTerm%")
                    ->orWhere('quantity', 'like', "%$searchTerm%")
                    ->orWhere('id', $searchTerm)
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

        return view('products.indexTable', compact('get_data', 'text_for_pagination', 'per_page_limit', 'start_index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_deleted', 0)->get()->pluck('name', 'id');

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->cat_id = $request->input('cat_id');
        $product->product_name = $request->input('product_name');
        $product->quantity = $request->input('quantity');
        $product->product_price = $request->input('product_price');
        $product->sell_price = $request->input('sell_price');
        $product->discount = $request->input('discount');
        $product->description = $this->handleSummernoteImages($request->description);;

        $baseSlug = Str::slug($request->product_name);
        $slug = $baseSlug;

        // Check for uniqueness
        $count = 1;
        while (Product::where('product_slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        $product->product_slug = $slug;

        $imagePaths = []; // Array to hold paths of uploaded images
        $imageBase64 = $request->image;
        if ($imageBase64 != null) {
            foreach ($request->file('image') as $image) {
                $upload_image = UploadImageFolder('product_image/', $image);
                $imagePaths[] = $upload_image;
                $product->images = json_encode($imagePaths);
            }
        }
        $product->save();

        return redirect()->action([ProductsController::class, 'index'])->with('success', 'Data saved successfully');
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
    public function edit(Product $product)
    {
        $categories = Category::where('is_deleted', 0)->get()->pluck('name', 'id');

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->cat_id = $request->cat_id ?? $product->cat_id;
        $product->product_name = $request->product_name ?? $product->product_name;
        $product->quantity = $request->quantity ?? $product->quantity;
        $product->product_price = $request->product_price ?? $product->product_price;
        $product->sell_price = $request->sell_price ?? $product->sell_price;
        $product->discount = $request->discount ?? $product->discount;
        $product->description = $this->handleSummernoteImages($request->description) ?? $product->description;
        $slug = Str::slug($request->product_name);

        $count = Product::where('product_slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1); // Append a number to make it unique
        }

        $product->product_slug = $slug ?? $product->product_slug;

        $imageBase64 = $request->image;
        if ($imageBase64 != null) {
            foreach ($request->file('image') as $image) {
                $upload_image = UploadImageFolder('product_image/', $image);
                $imagePaths[] = $upload_image;
                $product->images = json_encode($imagePaths);
            }
        }
        $product->save();

        return redirect()->action([ProductsController::class, 'index'])->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product) {
            $product->update(['is_deleted' => 1]);

            return response()->json(['status' => true, 'message' => 'Data deleted successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Blog Not Found']);
    }

    public function ChangeProductStatus(Request $request)
    {
        $type = $request->input('type');
        $category = Product::find($request->id);

        if ($category) {
            // Update the status based on the type provided in the request
            $category->status = $type;
            $category->save();

            return response()->json(['status' => true, 'message' => 'Status updated successfully']);
        }

        return response()->json(['status' => true, 'message' => 'Data updated successfully']);
    }

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

    public function getGridView(Request $request)
    {
        $query = Product::query();

        // Apply price filter
        $price_range = $request->price_range;
        if ($price_range) {
            [$min_price, $max_price] = explode(';', $price_range);
            $query->whereBetween('price', [(float)$min_price, (float)$max_price]);
        }

        // Pagination
        $perPage = 6; // Number of items per page
        $page = $request->page ?: 1;
        $products = $query->paginate($perPage, ['*'], 'page', $page);
        $text_for_pagination = "Showing " . $products->firstItem() . " to " . $products->lastItem() . " of " . $products->total() . " results";

        if ($request->ajax()) {
            if ($request->view_type == 'layout-grid') {
                return response()->json([
                    'html' => view('front_end.grid-view', compact('products', 'text_for_pagination'))->render(),
                    'pagination' => view('front_end.pagination', compact('products'))->render()
                ]);
            } else {
                return response()->json([
                    'html' => view('front_end.list-view', compact('products', 'text_for_pagination'))->render(),
                    'pagination' => view('front_end.pagination', compact('products'))->render()
                ]);
            }
        }
    }


}
