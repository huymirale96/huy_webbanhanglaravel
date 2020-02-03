<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Register extends FormRequest
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
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|regex:/^[03\09\05\08]\d{8,10}$/|unique:customers',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được bỏ trống',
            'name.min' => 'Độ dài họ tên tối thiểu là 3, tối đa là 50 ký tự',
            'name.max' => 'Độ dài họ tên tối thiểu là 3, tối đa là 50 ký tự',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Địa chỉ email không đúng định dạng',
            'email.unique' => 'Địa chỉ email này đã được sử dụng',
            'phone.required' => 'Số điện thoại không được bỏ trống',
            'phone.unique' => 'Số điện thoại này đã được sử dụng',
            'password.confirmed' => 'Xác nhận mật khẩu chính xác',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu tối thiểu phải 8 ký tự',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}
