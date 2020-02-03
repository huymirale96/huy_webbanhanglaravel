<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandEdit extends FormRequest
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
        $id = $this->brand ? ',' . $this->brand->id : '';
        return [
            'name' => 'required|max:50|unique:brands,name' . $id,
            'description' => 'nullable',
            'logo' => 'nullable|mimes:svg,png,jpg,jpeg,gif',
        ];
    }

    public function messages()
    {
        return [
            'name..required' => 'Tên thương hiệu không được bỏ trống',
            'name.max' => 'Tên thương hiệu không được vượt quá 50 ký tự',
            'name.unique' => 'Tên thương hiệu này đã tồn tại',
            'logo' => 'Logo phải là ảnh .png, .jpg, .jpeg, .gif hoặc .svg',
        ];
    }
}
