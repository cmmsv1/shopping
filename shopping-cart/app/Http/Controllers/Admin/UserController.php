<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(4);
        return view('admin.users.index')
            ->with(compact('users'));
    }
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->search;
            $search = str_replace(" ", "%", $search);
            $users = User::where('name', 'like', '%' . $search . '%')->paginate(4);
            return view('admin.users.userdata')
                ->with('users', $users)->render();
        }
    }
    public function store(Request $request)
    {
        $user_id = $request->id;
        if ($user_id) {
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->type = $request->type;
            $user->update();
            return response()->json(['message' => 'Cập nhật người dùng thành công']);
        }
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit')
            ->with('user', $user);
    }
    public function remove($id)
    {
        $user = User::find($id);
        if ($user->type = 'ADMIN') {
            return response()->json([
                'warning' => 'Không thể xoá admin'
            ]);
        } else {
            $user->delete();
            return response()->json([
                'message' => 'Xoá người dùng thành công'
            ]);
        }
    }
}
