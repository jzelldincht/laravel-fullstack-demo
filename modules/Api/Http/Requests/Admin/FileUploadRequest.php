<?php

namespace Modules\Api\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class FileUploadRequest extends ApiFormRequest
{
    public $uploadedPath = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => [
                'required',
                'mimes:jpeg,png',
                'max:128',
                Rule::dimensions()->maxWidth(320)
                    // ->ratio(3/2),
            ],
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

    public function messages()
    {
        return [
            'photo.required' => '请选择图片',
            'photo.mimes' => '只允许上传jpg或png的图片',
            'photo.max' => '图片最大为0.125M',
            'photo.dimensions' => '仅支持最大宽320px，比例为3/2的图片',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->messages();
        dd($errors);
    }

    public function passedValidation()
    {
        // storeAs 调用 config/filesystems.php 中 disk -> local
        $this->uploadedPath = request()->file('photo')->storeAs('images/avatars', 'alert.png');
    }
}
