<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('parent_id', 'asc')->paginate(8);
        return view('admin.categories.index')
            ->with('categories', $categories);
    }
    protected function checkSlug($slug)
    {
        if (Category::where('slug', $slug)->count() > 0) {
            $slug = $slug . '-' . Carbon::now()->timestamp;
        }
        return $slug;
    }
    protected function checkName($name)
    {
        if (Category::where('name', $name)->count() > 0) {
            $name = $name . '-' . Carbon::now()->timestamp;
        }
        return $name;
    }

    public function read(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->search;
            $search = str_replace(" ", "%", $search);
            $categories = Category::where('name', 'like', '%' . $search . '%')->orderBy('parent_id', 'asc')->paginate(8);
            return view('admin.categories.read')
                ->with('categories', $categories)->render();
        }
    }
    public function create()
    {
        $categories = Category::tree();
        return view('admin.categories.create')
            ->with(compact('categories'));
    }
    public function store(CategoryRequest $request)
    {
        $category_id = $request->id;
        if ($category_id) {
            $category = Category::find($category_id);
            $category->name = $this->checkName($request->name);
            $category->parent_id = $request->parent_id;
            $category->slug = $this->checkSlug(Str::slug($category->name));
            $category->update();
            return response()->json(['message' => 'Cập nhật danh mục thành công']);
        } else {
            $category = new Category();
            $category->name = $this->checkName($request->name);
            $category->parent_id = $request->parent_id;
            $category->slug = $this->checkSlug(Str::slug($category->name));
            $category->save();
            return response()->json(['message' => 'Thêm danh mục thành công']);
        }
    }
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::tree();
        return view('admin.categories.edit')
            ->with(compact('category', 'categories'));
    }
    public function remove($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json([
            'message' => 'Xoá danh mục thành công'
        ]);
    }
}
