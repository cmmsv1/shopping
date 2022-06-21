<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(4);
        return view('admin.products.index')
            ->with(compact('products'));
    }

    protected function checkSlug($slug)
    {
        if (Product::where('slug', $slug)->count() > 0) {
            $slug = $slug . '-' . Carbon::now()->timestamp;
        }
        return $slug;
    }

    public function read(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->search;
            $search = str_replace(" ", "%", $search);
            $products = Product::where('name', 'like', '%' . $search . '%')->latest()->paginate(4);
            return view('admin.products.read')
                ->with('products', $products)->render();
        }
    }
    public function create()
    {
        $categories = Category::tree();
        return view('admin.products.create')
            ->with(compact('categories'));
    }
    public function store(ProductRequest $request)
    {
        $product_id = $request->id;
        if ($product_id) {
            $product = Product::find($product_id);
            $this->updateProduct($request, $product);
            return response()->json(['message' => 'Cập nhật sản phẩm thành công']);
        } else {
            $this->addProduct($request);
            return response()->json(['message' => 'Thêm sản phẩm thành công']);
        }
    }

    public function addProduct($request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('assets/images/products/');
            $image->move($path, $fileName);
        }
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $key => $img) {
                $img_name = time() . $key . '.' . $img->getClientOriginalExtension();
                $path = public_path('assets/images/products/products_slider');
                $img->move($path, $img_name);
                $data[] = $img_name;
            }
        }
        $product = new Product();
        $product->name = $request->name;
        $product->slug = $this->checkSlug(Str::slug($product->name));
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->stock_status = $request->stock_status;
        $product->quantity = $request->quantity;
        $product->image = $fileName;
        $product->images = json_encode($data);
        $product->category_id = $request->category_id;
        $product->save();
    }
    public function updateProduct($request, $product)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('assets/images/products/');
            $image->move($path, $fileName);
            File::delete(public_path('assets/images/products/' . $product->image));
            $image = $fileName;
        } else {
            $image = $product->image;
        }
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $key => $img) {
                $img_name = time() . $key . '.' . $img->getClientOriginalExtension();
                $path = public_path('assets/images/products/products_slider');
                $img->move($path, $img_name);
                $data[] = $img_name;
            }
            $images_new = json_encode($data);
            $images_old = json_decode($product->images);
            if (!empty($images_old)) {
                foreach ($images_old as $img) {
                    File::delete(public_path('assets/images/products/products_slider' . $img));
                }
            }
        } else {
            $images_new = $product->images;
        }
        $product->name = $request->name;
        $product->slug = $this->checkSlug(Str::slug($product->name));
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->stock_status = $request->stock_status;
        $product->quantity = $request->quantity;
        $product->image = $image;
        $product->images = $images_new;
        $product->category_id = $request->category_id;
        $product->update();
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.products.edit')
            ->with([
                'categories' => $categories,
                'product' => $product
            ]);
    }
    public function remove($id)
    {
        $product = Product::find($id);
        File::delete(public_path('assets/images/products/' . $product->image));
        $images_old = json_decode($product->images);
        if (!empty($images_old)) {
            foreach ($images_old as $img) {
                File::delete(public_path('assets/images/products/products_slider' . $img));
            }
        }
        $product->delete();
        return response()->json([
            'message' => 'Xoá sản phẩm thành công'
        ]);
    }
}
