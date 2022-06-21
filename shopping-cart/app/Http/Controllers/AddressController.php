<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        $address = json_decode($user->address);
        return view('address.index')
            ->with(compact('address'));
    }
    public function updateAddress(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $province = $request->province;
        $district = $request->district;
        $ward = $request->ward;
        $house = $request->house;
        $address = [
            'house' => $house,
            'ward' => $ward,
            'district' => $district,
            'province' => $province,
        ];
        $user->address = json_encode($address);
        $user->update();
        return response()->json(['message' => 'Cập nhật thông tin thành công']);
    }
}
