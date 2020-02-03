<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePassword extends FormRequest
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
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }

    /**
     * Throw message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'current_password.required' => 'Bạn chưa nhập mật khẩu cũ',
            'password.required' => 'Bạn chư nhập mật khẩu mới',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác',
            'password.regex' => "Mật khẩu mới phải chứa ít nhất 8 ký tự.",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}
