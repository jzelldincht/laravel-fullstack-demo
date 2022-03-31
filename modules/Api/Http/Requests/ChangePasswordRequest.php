<?php

namespace Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|regex:/^.{6,20}$/',
            'new_password' => 'required|confirmed|regex:/^.{6,20}$/',
        ];
    }

    public function messages(){
        return [
            'old_password.required' => '请输入原密码',
            'old_password.regex' => '密码为4到20个长度的字符',
            'new_password.required' => '请输入新密码',
            'new_password.regex' => '密码为4到20个长度的字符',
            'new_password.confirmed' => '两次密码输入不一致',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
