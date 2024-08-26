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
        $categories = Category::where('is_deleted',0)->get();
        $products = Product::where('is_deleted',0)->take(4)->get();
        $body = 'home';
        return view('front_end.home',compact('categories','products','body'));
    }

    public function CatWiseProduct($slug)
    {
        $category = Category::where('name',$slug)->where('is_deleted',0)->first();
        $products = Product::where('is_deleted',0)->where('cat_id',$category->id)->get();
        $body = 'shop';
        $cat_name = $category->name;

        return view('front_end.product',compact('products','body','cat_name'));
    }
}
