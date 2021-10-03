<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/category', function () {
    return view('category');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/mobiles/iphone_x_64', function () {
    return view('product');
});
