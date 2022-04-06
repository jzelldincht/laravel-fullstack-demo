<?php

namespace Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\FileHelpers;
use Illuminate\Support\Facades\File;

/**
 * 图片验证规则文档：
 */
class ImageRequest extends FormRequest
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
            'image' => [
                'required',
                // 'image',// 仅支持图片
                'mimetypes:image/jpeg,image/png',// mime types 列表：https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
                'mimes:jpeg,png',
                'max:500',//500kb
            ],
        ];
    }

    public function messages(){
        return [
            'image.required' => '请选择图片！',
            'image.mimes' => '仅支持.jpg或.png的格式！',
            'image.mimetypes' => '仅支持.jpg或.png的图片！',
            'image.max' => '图片大小在500kb以内！',
        ];
    }

    /**
     * 验证通过后上传文件
     */
    public function passedValidation()
    {
        // 从请求中获取图片数据,name为image
        $image = request()->file('image');

        $filename = date('is').'_'.microtime(1).'.'.$image->getClientOriginalExtension();

        // storeAs 调用 config/filesystems.php 中 disk -> local，假如目标目录不存在，则自动创建
        // 返回路径为：/images/gallery/2022/04/06/12/5245_1649249565.4426.png
        $this->uploaded_path = '/'.request()->file('image')->storeAs('images/gallery'.'/'.date('Y/m/d/H'), $filename);
    }
}
