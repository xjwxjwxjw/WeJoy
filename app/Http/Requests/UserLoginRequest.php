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
<<<<<<< HEAD
=======
            //
>>>>>>> 5964fb85cb1ce335a5a7fe11919afe7dea6c4bd5
            'email' => 'required',
            'password' => 'required',
            'code' => 'captcha'
        ];
    }
<<<<<<< HEAD

=======
>>>>>>> 5964fb85cb1ce335a5a7fe11919afe7dea6c4bd5
    public function messages()
    {
        return [
            'email.required' => '邮箱不能为空',
            'password.required' => '密码不能为空',
            'code.captcha' => '验证码错误',
        ];
    }
}
