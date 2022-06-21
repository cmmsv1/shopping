<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function index($slug)
    {
        $categories = Category::all();
        $product = Product::where('slug', $slug)->first();
        $product_related = Product::where('id', '!=', $product->id)->where('category_id', $product->category_id)->take(8)->get();
        $product_popular = Product::where('id', '!=', $product->id)->orderBy('views', 'DESC')->take(4)->get();
        if (!empty($product)) {
            $product->views = $product->views + 1;
            $product->update();
            return view('detailproduct')
                ->with(compact('product', 'categories', 'product_related', 'product_popular'));
        } else {
            abort(404);
        }
    }
}
