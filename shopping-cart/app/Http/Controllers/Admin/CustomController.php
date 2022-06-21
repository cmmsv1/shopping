<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Custom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CustomController extends Controller
{
    public function index()
    {
        return view('admin.custom.index')
            ->with('', '');
    }

    public function info()
    {
        $custom = Custom::first();
        if ($custom) {
            $info = json_decode($custom->info);
        } else {
            $info = '';
        }
        return view('admin.custom.info')
            ->with(compact('info'));
    }
    public function updateInfo(Request $request)
    {
        $custom = Custom::first();
        if ($custom) {
            $address = $request->address;
            $phone1 = $request->phone1;
            $phone2 = $request->phone2;
            $data = [
                'address' => $address,
                'phone1' => $phone1,
                'phone2' => $phone2,
            ];
            $custom->info = json_encode($data);
            $custom->update();
            return response()->json([
                'message' => 'Cập nhật thành công'
            ]);
        } else {
            $address = $request->address;
            $phone1 = $request->phone1;
            $phone2 = $request->phone2;
            $data = [
                'address' => $address,
                'phone1' => $phone1,
                'phone2' => $phone2,
            ];
            $custom = new Custom();
            $custom->info = json_encode($data);
            $custom->save();
            return response()->json([
                'message' => 'Cập nhật thành công'
            ]);
        }
    }
    public function logo()
    {
        $custom = Custom::first();
        if ($custom) {
            $logo = $custom->logo;
        } else {
            $logo = '';
        }
        return view('admin.custom.logo')
            ->with(compact('logo'));
    }
    public function updateLogo(Request $request)
    {
        $custom = Custom::first();
        if ($custom) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('assets/images/');
                $image->move($path, $fileName);

                File::delete(public_path('assets/images/' . $custom->logo));
                $custom->logo = $fileName;
                $custom->update();
                return response()->json(['message' => 'Cập nhật thành công']);
            } else {
                $custom->logo = $custom->logo;
                $custom->update();
                return response()->json(['message' => 'Cập nhật thành công']);
            }
        } else {
            if ($request->hasFile('image')) {
                $custom = new Custom();
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('assets/images/');
                $image->move($path, $fileName);
                $custom->logo = $fileName;
                $custom->save();
                return response()->json(['message' => 'Cập nhật thành công']);
            } else {
                return response()->json(['message' => 'Bạn cần chọn file']);
            }
        }
    }

    public function social()
    {
        $custom = Custom::first();
        if ($custom) {
            $social = json_decode($custom->social);
        } else {
            $social = '';
        }
        return view('admin.custom.social')
            ->with(compact('social'));
    }
    public function updateSocial(Request $request)
    {
        $facebook = $request->facebook;
        $twitter = $request->twitter;
        $vimeo = $request->vimeo;
        $pinterest = $request->pinterest;
        $instagram = $request->instagram;
        $social = [
            'facebook' => $facebook,
            'twitter' => $twitter,
            'vimeo' => $vimeo,
            'pinterest' => $pinterest,
            'instagram' => $instagram,
        ];
        $custom = Custom::first();
        if ($custom) {
            $custom->social = json_encode($social);
            $custom->update();
            return response()->json(['message' => 'Cập nhật thành công']);
        } else {
            $social = new Custom();
            $social->social = json_encode($social);
            $social->save();
            return response()->json(['message' => 'Cập nhật thành công']);
        }
    }
}
