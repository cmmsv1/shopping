<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::tree();
        $products = Product::paginate(12);
        $product_popular = Product::orderBy('views', 'DESC')->take(4)->get();
        return view('shop.index')
            ->with(compact('products', 'categories', 'product_popular'));
    }
    public function getCategories()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        $listCategories = [];
        Category::recursive($categories, $parents = 0, $level = 1, $listCategories);
        return $listCategories;
    }

    public function read(Request $request)
    {
        if ($request->ajax()) {
            $pageSize = $request->pageSize;
            $sortName = $request->sortName;
            if ($sortName == 'default') {
                $products = Product::paginate($pageSize);
            } elseif ($sortName == 'date') {
                $products = Product::orderBy('created_at', 'DESC')->paginate($pageSize);
            } elseif ($sortName == 'price') {
                $products = Product::orderBy('regular_price', 'ASC')->paginate($pageSize);
            } elseif ($sortName == 'price-desc') {
                $products = Product::orderBy('regular_price', 'DESC')->paginate($pageSize);
            }
            return view('shop.read')
                ->with(compact('products'));
        }
    }
}
