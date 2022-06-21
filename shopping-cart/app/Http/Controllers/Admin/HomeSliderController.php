<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeSliderController extends Controller
{
    public function index(Request $request)
    {
        $sliders = HomeSlider::paginate(4);
        return view('admin.sliders.index')
            ->with('sliders', $sliders);
    }
    public function read(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->search;
            $search = str_replace(" ", "%", $search);
            $sliders = HomeSlider::where('title', 'like', '%' . $search . '%')->paginate(4);
            return view('admin.sliders.read')
                ->with('sliders', $sliders)->render();
        }
    }
    public function create()
    {
        return view('admin.sliders.create')
            ->with('', '');
    }
    public function store(Request $request)
    {
        $slider_id = $request->id;
        if ($slider_id) {
            $slider = HomeSlider::find($slider_id);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('assets/images/sliders/');
                $image->move($path, $fileName);
                File::delete(public_path('assets/images/sliders/' . $slider->image));
                $image = $fileName;
            } else {
                $image = $slider->image;
            }
            $slider->title = $request->title;
            $slider->subtitle = $request->subtitle;
            $slider->price = $request->price;
            if ($request->status == 1 || $request->status == 0) {
                $slider->status = $request->status;
            } else {
                return response()->json(['message' => 'Lỗi']);
            }
            $slider->image = $image;
            $slider->update();
            return response()->json(['message' => 'Cập nhật slider thành công']);
        } else {
            $slider = new HomeSlider();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('assets/images/sliders/');
                $image->move($path, $fileName);
                $image = $fileName;
                $slider->title = $request->title;
                $slider->subtitle = $request->subtitle;
                $slider->price = $request->price;
                if ($request->status == 1 || $request->status == 0) {
                    $slider->status = $request->status;
                } else {
                    return response()->json(['message' => 'Lỗi']);
                    die();
                }
                $slider->image = $image;
                $slider->save();
                return response()->json(['message' => 'Thêm slider thành công']);
            }
        }
    }
    public function edit($id)
    {
        $slider = HomeSlider::find($id);
        return view('admin.sliders.edit')
            ->with('slider', $slider);
    }
    public function remove($id)
    {
        $slider = HomeSlider::find($id);
        $slider->delete();
        return response()->json([
            'message' => 'Xoá slider thành công'
        ]);
    }
}
