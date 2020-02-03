<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BannerAdd extends FormRequest
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
            'name' => 'required|max:255',
            'image' => 'mimes:jpg,png,gif,jpeg',
            'content' => 'required',
        ];
    }

    //Cái ảnh đó // ok
    public function messages()
    {
        return [
            'name.required' => 'Tiêu đề không được bỏ trống',
            'name.max' => 'Độ dài tiêu đề tối đa là 255 ký tự',
            'image.mimes' => 'Chỉ hỗ trợ file có đuôi .png, .jpg, .jpeg, .gif',
            'content.required' => 'Nội dung không được bỏ trống',
        ];
    }
}
