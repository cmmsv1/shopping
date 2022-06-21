<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products_latest = Product::latest()->take(8)->get();
        $products_sale = Product::where('sale_price', '>', 0)->inRandomOrder()->take(8)->get();
        $categories_parent = Category::where('parent_id', 0)->take(4)->get();
        return view('home.index')
            ->with(compact('categories_parent', 'products_latest', 'products_sale'));
    }
}
