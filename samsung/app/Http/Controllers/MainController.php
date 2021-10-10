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
//        dd($products);

        return view('index', compact('products'));
//        return view('index', ['products' => $products]);
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

}
