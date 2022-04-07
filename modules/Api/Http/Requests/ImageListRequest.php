<?php
/**
 * + ------------------------------------------------------ +
 * | Project Name: Study Laravel Fullstack Developement     |
 * + ------------------------------------------------------ +
 * | Copyright: (c) 2022-2022 http://fullstack.test/     |
 * + ------------------------------------------------------ +
 * | License: MIT                                           |
 * + ------------------------------------------------------ +
 * | Author: Zell <jzell@qq.com>                            |
 * + ------------------------------------------------------ +
 * | Version: v1.0.0                                        |
 * + ------------------------------------------------------ +
 * @date 2022/4/7 11:08
 * @author Zell <jzell@qq.com>
 * @description
 */

namespace Modules\Api\Http\Requests;

class ImageListRequest extends ApiFormRequest
{
    // 成功上传后的文件 url 路径
    public $uploaded_path = '';

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
            'page' => [
                'required',
                'is_positive_integer',
            ],
            'limit' => [
                'required',
                'is_positive_integer',
            ],
        ];
    }

    public function messages(){
        return [
            'page.required' => '缺少参数！',
            'page.is_positive_integer' => '参数格式错误！',
            'limit.required' => '缺少参数！',
            'limit.is_positive_integer' => '参数格式错误！',
        ];
    }
}
