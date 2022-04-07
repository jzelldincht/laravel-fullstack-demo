<?php

namespace Modules\Api\Http\Requests\Admin;

class TestRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:2,20',
            'age' => 'required|integer|between:18,120',
            'hans' => 'required|chs',
        ];
    }

    public function messages(){
        return [
            'name.required' => '请输入姓名',
            'name.between' => '姓名最少2个字符，最多20个字符',
            'age.required' => '请输入年龄',
            'age.integer' => '年龄只能是数字',
            'age.between' => '年龄不正常',
            'hans.required' => '请输入中文',
            'hans.chs' => '中文字符应该全是中文',
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

    // // 以下方法不要处理，异常处理统一处理于 modules/Api/Exceptions/Handler.php
    // public function failedValidation(Validator $validator)
    // {
    //
    // }
}
