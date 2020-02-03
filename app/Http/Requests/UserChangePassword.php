<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangePassword extends FormRequest
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
            'cur_password' => 'required',
            'password' =>'required|confirmed|min:6',
        ];
    }

    public function messages()
    {
        return [
            'cur_password.required' => 'Mật khẩu cũ không được bỏ trống',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác',
            'password.required' => 'Mật khẩu mới không được bỏ trống',
            'password.min' => 'Độ dài mật khẩu tối thiểu là 6 ký tự',
        ];
    }
}
