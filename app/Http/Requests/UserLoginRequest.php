<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required',
            'code' => 'captcha'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '邮箱不能为空',
            'password.required' => '密码不能为空',
            'code.captcha' => '验证码错误',
        ];
    }
}
