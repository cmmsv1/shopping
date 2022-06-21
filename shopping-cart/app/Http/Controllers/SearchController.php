<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Global_;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if (!empty($search)) {
            $categories = Category::all();
            $products = Product::where('name', 'like', '%' . $search . '%')->paginate(12);
            return view('search.index')
                ->with(compact('products', 'categories', 'search'));
        } else {
            return redirect()->route('shop');
        }
    }
    public function read(Request $request)
    {
        if ($request->ajax()) {
            $pageSize = $request->pageSize;
            $sortName = $request->sortName;
            $search = $request->search;
            if ($sortName == 'default') {
                $products = Product::where('name', 'like', '%' . $search . '%')->paginate($pageSize);
            } elseif ($sortName == 'date') {
                $products = Product::where('name', 'like', '%' . $search . '%')->orderBy('created_at', 'DESC')->paginate($pageSize);
            } elseif ($sortName == 'price') {
                $products = Product::where('name', 'like', '%' . $search . '%')->orderBy('regular_price', 'ASC')->paginate($pageSize);
            } elseif ($sortName == 'price-desc') {
                $products = Product::where('name', 'like', '%' . $search . '%')->orderBy('regular_price', 'DESC')->paginate($pageSize);
            }
            return view('search.read')
                ->with(compact('products'));
        }
    }
    public function searchParentCategories($slug)
    {
        $categories = Category::tree();
        $category = Category::where('slug', $slug)->first();
        if (!empty($category)) {
            $category_id = $category->id;
            $category_name = $category->name;
            $category_chidren_id = Category::getArrayChildren($category_id);
            $products = Product::whereIn('category_id', $category_chidren_id)->paginate(12);
            return view('search.categories')
                ->with(compact('products', 'categories', 'category_name', 'category_id'));
        } else {
            abort(404);
        }
    }
    public function searchCategories($slug)
    {
        $categories = Category::tree();
        $category = Category::where('slug', $slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;
        if (!empty($category)) {
            if ($category->parent_id == 0) {
                $category_chidren_id = Category::getArrayChildren($category_id);
                $products = Product::whereIn('category_id', $category_chidren_id)->paginate(12);
                return view('search.categories')
                    ->with(compact('products', 'categories', 'category_name', 'category_id'));
            } else {
                $products = Product::where('category_id', $category_id)->paginate(12);
                return view('search.categories')
                    ->with(compact('products', 'categories', 'category_name', 'category_id'));
            }
        } else {
            abort(404);
        }
    }
    public function readCategories(Request $request)
    {
        if ($request->ajax()) {
            $pageSize = $request->pageSize;
            $sortName = $request->sortName;
            $category_id = $request->category_id;
            $category = Category::find($category_id);
            if ($category->parent_id == 0) {
                $category_chidren_id = Category::getArrayChildren($category_id);
                if ($sortName == 'default') {
                    $products = Product::whereIn('category_id', $category_chidren_id)->orderBy('created_at', 'DESC')->paginate($pageSize);
                } elseif ($sortName == 'date') {
                    $products = Product::whereIn('category_id', $category_chidren_id)->orderBy('created_at', 'DESC')->paginate($pageSize);
                } elseif ($sortName == 'price') {
                    $products = Product::whereIn('category_id', $category_chidren_id)->orderBy('regular_price', 'ASC')->paginate($pageSize);
                } elseif ($sortName == 'price-desc') {
                    $products = Product::whereIn('category_id', $category_chidren_id)->orderBy('regular_price', 'DESC')->paginate($pageSize);
                }
                return view('search.readCategories')
                    ->with(compact('products'));
            } else {
                if ($sortName == 'default') {
                    $products = Product::where('category_id', $category_id)->orderBy('created_at', 'DESC')->paginate($pageSize);
                } elseif ($sortName == 'date') {
                    $products = Product::where('category_id', $category_id)->orderBy('created_at', 'DESC')->paginate($pageSize);
                } elseif ($sortName == 'price') {
                    $products = Product::where('category_id', $category_id)->orderBy('regular_price', 'ASC')->paginate($pageSize);
                } elseif ($sortName == 'price-desc') {
                    $products = Product::where('category_id', $category_id)->orderBy('regular_price', 'DESC')->paginate($pageSize);
                }
                return view('search.readCategories')
                    ->with(compact('products'));
            }
        }
    }
}
