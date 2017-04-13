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
<<<<<<< HEAD
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' =>'required',
        ];
=======
           return [
               'username' => 'required|min:3',
               'email' => 'required|email|unique:users,email',
               'password' => 'required|confirmed',
               'password_confirmation' =>'required',
           ];
>>>>>>> 5964fb85cb1ce335a5a7fe11919afe7dea6c4bd5
    }

    public function messages()
    {
        return [
<<<<<<< HEAD
            'name.required' => '用户名不能为空',
=======
            'username.required' => '用户名不能为空',
            'username.min:3' =>'用户名最少3位',
>>>>>>> 5964fb85cb1ce335a5a7fe11919afe7dea6c4bd5
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'password.required' => '密码不能为空',
            'password.confirmed' => '两次密码不一致',
            'password_confirmation.required' => '确认密码不能为空',
            'email.unique'=>'邮箱已经被占用'
        ];
    }
}
<<<<<<< HEAD
=======


>>>>>>> 5964fb85cb1ce335a5a7fe11919afe7dea6c4bd5
