<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Banner::paginate(4);
        return view('admin.banners.index')
            ->with('sliders', $sliders);
    }
    public function read(Request $request)
    {
        if ($request->ajax()) {
            $sliders = Banner::paginate(4);
            return view('admin.banners.read')
                ->with('sliders', $sliders)->render();
        }
    }
    public function create()
    {
        return view('admin.banners.create')
            ->with('', '');
    }
    public function store(Request $request)
    {
        $slider_id = $request->id;
        if ($slider_id) {
            $slider = Banner::find($slider_id);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('assets/images/banners/');
                $image->move($path, $fileName);
                File::delete(public_path('assets/images/banners/' . $slider->image));
                $image = $fileName;
            } else {
                $image = $slider->image;
            }
            $slider->image = $image;
            $slider->update();
            return response()->json(['message' => 'Cập nhật slider thành công']);
        } else {
            $slider = new Banner();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('assets/images/banners/');
                $image->move($path, $fileName);
                $image = $fileName;
                $slider->image = $image;
                $slider->save();
                return response()->json(['message' => 'Thêm slider thành công']);
            }
        }
    }
    public function edit($id)
    {
        $slider = Banner::find($id);
        return view('admin.banners.edit')
            ->with('slider', $slider);
    }
    public function remove($id)
    {
        $slider = Banner::find($id);
        $slider->delete();
        return response()->json([
            'message' => 'Xoá slider thành công'
        ]);
    }
}
