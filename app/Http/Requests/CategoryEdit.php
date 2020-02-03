<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryEdit extends FormRequest
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
        $id = $this->category ? ',' . $this->category->id : '';
        return [
            'name' => 'required|max:30|unique:categories,name' . $id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được bỏ trống',
            'name.max' => 'Độ dài tên danh mục tối đa là 30 ký tự',
            'name.unique' => 'Tên danh mục này đã tồn tại',
        ];
    }
}
