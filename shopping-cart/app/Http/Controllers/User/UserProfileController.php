<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        return view('user.profile.index')
            ->with(compact('user'));
    }
    public function changePass(Request $request)
    {
        if ($request->json()) {
            $current_pass = $request->current_password;
            $pass = $request->password;
            $comfirm_pass = $request->confirm_password;
            if (Hash::check($current_pass, Auth::user()->getAuthPassword())) {
                if (Hash::check($pass, Auth::user()->getAuthPassword())) {
                    return response()->json(['pass' => 'Mật khẩu mới không được trùng mật khẩu cũ']);
                } else {
                    if ($pass == $comfirm_pass) {
                        $user = User::where('id', Auth::id())->first();
                        $user->password = Hash::make($pass);
                        $user->update();
                        return response()->json(['message' => 'Thay đổi mật khẩu thành công']);
                    } else {
                        return response()->json(['confirm_pass' => 'Confirm password not match']);
                    }
                }
            } else {
                return response()->json(['current_pass' => 'Current password not right !']);
            }
        }
    }
    public function updateProfile(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        if (!empty($name) && !empty($email)) {
            $user = User::where('id', Auth::id())->first();
            $user->name = $name;
            $user->email = $email;
            $user->phone = $phone;
            $user->update();
            return response()->json(['message' => 'Cập nhật thành công']);
        }
    }
}
