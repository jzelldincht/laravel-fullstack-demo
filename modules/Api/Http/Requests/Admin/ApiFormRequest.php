<?php

namespace Modules\Api\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Api Form Request 基类
 */
class ApiFormRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }
}
