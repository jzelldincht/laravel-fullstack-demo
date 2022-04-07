<?php

namespace Modules\Api\Http\Requests\Admin;

class ModuleIdRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mid' => ['required', 'is_positive_integer']
        ];
    }

    public function messages(){
        return [
            'id.required' 				=> '缺少参数！',
            'id.is_positive_integer' 	=> '（id）参数错误！',
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
