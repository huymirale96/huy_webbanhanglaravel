<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangeProfile extends FormRequest
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
            'name' => 'required|min:10|max:50',
            'avatar' => 'nullable|mimes:png,jpg,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được bỏ trống',
            'name.min' => 'Độ dài họ tên tối thiểu là 10 ký tự',
            'name.max' => 'Độ dài họ tên tối thiểu là 50 ký tự',
            'avatar.mimes' => 'Ảnh đại diện phải là ảnh có đuôi .png, .jpg, .jpeg',
        ];
    }
}
