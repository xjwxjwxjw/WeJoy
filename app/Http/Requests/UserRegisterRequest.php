<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'password.required' => '密码不能为空',
            'password.confirmed' => '两次密码不一致',
            'password_confirmation.required' => '确认密码不能为空',
            'email.unique'=>'邮箱已经被占用'
        ];
    }
}
