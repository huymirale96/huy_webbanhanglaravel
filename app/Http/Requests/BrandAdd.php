<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandAdd extends FormRequest
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
            'name' => 'required|max:50|unique:brands',
            'logo' => 'nullable|mimes:png,jpg,jpeg,svg,gif',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên thương hiệu không được bỏ trống',
            'name.max' => 'Độ dài tên thương hiệu tối đa là 50 ký tự',
            'name.unique' => 'Tên thương hiệu này đã tồn tại',
            'logo.mimes' => 'Logo phải là ảnh có đuôi dạng .png, .jpg, .jpeg, .gif hoặc .svg',
        ];
    }
}
