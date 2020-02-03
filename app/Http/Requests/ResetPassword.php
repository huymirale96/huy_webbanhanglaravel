<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
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
            'password' => 'required|confirmed|min:5',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác',
            'password.min' => 'Độ dài mật khẩu tối thiểu là 5 ký tự, bao gồm chữ cái, số, và 1 ký tự đặc biệt'
        ];
    }
}
