<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Auth;

class CustomerChangeProfile extends FormRequest
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
        $id = Auth::guard('customers')->user()->id;
        return [
            'name' => 'required|max:50',
            'phone' => 'required|regex:/^[03\09\05\08]\d{8,10}$/|unique:customers,phone,' . $id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được bỏ trống',
            'name.max' => 'Độ dài họ tên tối đa là 50 ký tự',
            'phone.required' => 'Số điện thoại không được bỏ trống',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'phone.unique' => 'Số điện này đã được sử dụng',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}
