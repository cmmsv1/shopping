<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'phone' => 'required|min:10',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'house' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập họ tên',
            'name.min' => 'Họ tên phải lớn hơn 4 kí tự',
            'phone.required' => 'Bạn cần nhập số điện thoại',
            'phone.min' => 'Số điện thoại phải từ 10 số trở lên',
            'province.required' => 'Bạn cần nhập Tỉnh/Thành phố',
            'district.required' => 'Bạn cần nhập Quận/Huyện',
            'ward.required' => 'Bạn cần nhập Xã/Phường',
            'house.required' => 'Bạn cần nhập Tên đường/Toà nhà/Số nhà',
        ];
    }
}
