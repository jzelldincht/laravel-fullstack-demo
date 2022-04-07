<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Common\Base\BaseController;

/**
 * Api模块的控制器基类
 */
class ApiController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

}
