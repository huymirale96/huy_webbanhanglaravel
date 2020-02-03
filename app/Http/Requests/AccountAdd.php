<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountAdd extends FormRequest
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
            'email' => 'required|email|max:50|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được bỏ trống',
            'name.min' => 'Họ tên phải có độ dài tối thiểu 10 ký tự',
            'name.max' => 'Độ dài họ tên là 50 ký tự',
            'email.email' => 'Địa chỉ email không đúng định dạng',
            'email.required' => 'Địa chỉ email không được bỏ trống',
            'email.max' => 'Độ dài địa chỉ email tối đa là 50 ký tự',
            'email.unique' => 'Địa chỉ email này đã được sử dụng',
        ];
    }
}
