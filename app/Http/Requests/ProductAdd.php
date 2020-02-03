<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAdd extends FormRequest
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
            'name' => "required|max:50",
            'slug' => 'unique:products',
            'stock_price' => 'nullable|numeric|min:0',
            'promotion_price' => 'nullable|numeric|min:0',
            'brand_id' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'content' => 'nullable',
            'description' => 'nullable',
            'stock' => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa điền tên sản phẩm',
            'name.max' => 'Tên sản phẩm không được vượt quá 50 ký tự',
            'slug.unique' => 'Đường dẫn sản phẩm phải là duy nhất',
            'stock_price' => 'Giá sản phẩm phải là số',
            'stock_price.min' => 'Giá bán phải lớn hơn 0',
            'promotion_price' => 'Giá khuyến mãi phải là số',
            'promotion_price.min' => 'Giá khuyến mãi phải lớn hơn 0',
            'brand_id.required' => 'Bạn chưa chọn thương hiệu',
            'image.mimes' => 'Ảnh sản phẩm phải là ảnh .jpg, .jpeg, .png, .gif, .svg',
            'stock.numeric' => 'Số lượng hàng phải là số',
            'stock.min' => 'Số lượng hàng phải lớn hơn 0',
        ];
    }
}
