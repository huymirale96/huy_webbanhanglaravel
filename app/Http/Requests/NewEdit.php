<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewEdit extends FormRequest
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
        $id = $this->new ? ',' . $this->new->id : '';
        return [
            'name' => 'required|max:255',
            'slug' => 'unique:news,slug' . $id,
            'image' => 'nullable|mimes:png,jpg,jpeg,svg,gif',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên tin tức không được bỏ trống',
            'name.max' => 'Độ dài tên tin tức tối đa là 255 ký tự',
            'slug.unique' => 'Trường slug phải là duy nhất',
            'image.mimes' => 'Ảnh tải lên phải có đuôi .png, .jpg, .jpeg, .svg hoặc .gif',
        ];
    }
}
