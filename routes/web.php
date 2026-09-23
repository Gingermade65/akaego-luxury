<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::where('is_active', true)->take(4)->get();
    
    $featuredProducts = Product::with(['primaryImage', 'category'])
        ->where('is_active', true)
        ->where('is_featured', true)
        ->take(4)
        ->get();

    return view('welcome', compact('categories', 'featuredProducts'));
});