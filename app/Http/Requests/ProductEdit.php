<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEdit extends FormRequest
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
        $id = $this->product ? ',' . $this->product->id : '';
        return [
            'name' => 'required|max:50|unique:products,name' . $id,
            'stock_price' => 'nullable|numeric|min:0',
            'promotion_price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|numeric|min:0',
            'image' => 'nullable|mimes:png,jpg,jpeg,svg,gif',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được bỏ trống',
            'name.max' => 'Tên sản phẩm tối đa là 50 ký tự',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'stock_price.numeric' => 'Giá bán phải là số',
            'stock_price.min' => 'Giá bán phải lớn hơn 0',
            'promotion_price' => 'Giá khuyến mãi phải là số',
            'promotion' => 'Giá khuyến mãi phải lớn hơn 0',
            'image.mimes' => 'Chỉ hỗ trợ ảnh .jpg, .jpeg, .png, .svg và .gif',
        ];
    }
}
