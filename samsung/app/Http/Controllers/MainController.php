<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('index', compact('products'));
    }

    public function category()
    {
        $category = Category::get();
        return view('category', compact('category'));
    }

    public function categories($code)
    {
        $categories = Category::where('code', $code)->first();
//        dd($categories);
//        $products = Product::where('category_id', $categories->id)->get();
        return view('categories', compact('categories'));
    }


    public function product($categories, $product = null)
    {
//        dd(request()); просмотр различных параметров
        return view('product', ['product' => $product]);
    }

    public function basket()
    {
        return view('basket');
    }

    public function basketPlace()
    {
        return view('order');
    }

}
