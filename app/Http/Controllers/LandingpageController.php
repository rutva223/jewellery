<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Egulias\EmailValidator\Parser\IDLeftPart;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function index()
    {
        $products = Product::where('is_deleted',0)->take(4)->get();
        $body = 'home';

        $categories = Category::where('is_deleted',0)->get();
        return view('front_end.home',compact('products','body', 'categories'));
    }

    public function CatWiseProduct($slug = null)
    {
        if($slug)
        {
            $category = Category::where('name', $slug)->where('is_deleted',0)->first();
        }

        $all_products = Product::where('is_deleted', 0);
        if(isset($category))
        {

            $all_products = $all_products->where('cat_id', $category->id);
        }
        $page = 1;
        $per_page_limit = config('global.per_api_limit') ?? 6;
        $total_record =  0;
        $start_index = ($page - 1) * $per_page_limit;
        $end = $start_index + $per_page_limit;
        if ($total_record <= $end) {
            $text_for_pagination = "Showing " . ($start_index + 1) . " to {$total_record} of {$total_record} entries";
        } else {
            $text_for_pagination = "Showing " . ($start_index + 1) . " to {$end} of {$total_record} entries";
        }

            $products = $all_products->paginate($per_page_limit);

            $body = 'shop';
            $cat_name = !empty($category) ? $category->name : 'All Products';
            $cat_id = !empty($category) ? $category->id : null;


        return view('front_end.product',compact('products','body','cat_name', 'text_for_pagination','cat_id'));

    }

    public function TermsCondition() {
        $body = 'shop';
        return view('front_end.terms_condition', compact('body'));
    }

    public function PrivacyPolicy()
    {
        $body = 'shop';
        return view('front_end.privacy_policy', compact('body'));
    }

    public function product_detail($id)
    {
        $body = 'shop';
        $product = Product::find($id);

        return view('front_end.product_detail', compact('product','body'));
    }
}
