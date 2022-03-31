<?php

namespace Modules\Api\Http\Requests;

class LoginRequest extends ApiFormRequest
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
            'username' => ['required',],
            'password' => ['required',],
        ];
    }


    public function messages(){
        return [
            'username.required' => '请输入管理员用户名',
            'password.required' => '请输入管理员密码',
        ];
    }
}
