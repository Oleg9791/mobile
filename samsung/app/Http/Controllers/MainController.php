<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function category()
    {
        $category = Category::get();
        return view('category', compact('category'));
    }

    public function categories($code)
    {
        $categories = Category::where('code', $code)->first();
        return view('categories', compact('categories'));
    }


    public function product($product = null)
    {
//        dd(request()); просмотр различных параметров
        return view('product', ['product' => $product]);
    }

}
