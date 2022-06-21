<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'image' => ['mimes:png,jpg,jpeg,csv,txt,pdf|max:5048', Rule::requiredIf(empty($this->id))],
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'name' => 'required|min:5',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required|exists:categories,id'

        ];
    }
    public function messages()
    {
        return [
            'image.mimes' => 'Bắt buộc phải là ảnh',
            'images.mimes' => 'Bắt buộc phải là ảnh',
            'image.required' => 'Bạn cần tải ảnh lên',
            'name.required' => 'Bạn cần nhập tên sản phẩm',
            'name.min' => 'Tên sản phẩm phải lớn hơn 4 kí tự',
            'short_description.required' => 'Bạn cần nhập mô tả ngắn',
            'description.required' => 'Bạn cần nhập mô tả chi tiết',
            'regular_price.required' => 'Bạn cần nhập giá bán',
            'quantity.required' => 'Bạn cần nhập số lượng',
            'category_id.exists' => 'Bạn ơi bỏ đi mà làm người',
            'category_id.required' => 'Bạn cần chọn danh mục',
        ];
    }
}
