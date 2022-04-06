<?php

namespace Modules\Common\Libraries;

use Illuminate\Http\JsonResponse;
use Modules\Api\Exceptions\ApiException;
use Modules\Common\Variables\HttpStatus;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;

trait ApiResponse
{
    /**
     * 成功返回
     * 用于所有的接口返回
     * @param $message String 提示信息
     * @param array $data Array 返回信息
     * @param $status Int 自定义状态码
     * @return JsonResponse
     */
    public function success(string $message = '', array $data = array(), int $status = ResponseStatus::OK): JsonResponse
    {
        if ($message == '') {
            $message = ResponseMessage::OK;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], HttpStatus::OK);
    }

    /**
     * 失败返回
     * 用于所有的接口返回
     * @param $status Int 自定义状态码
     * @param $message String 提示信息
     * @throws ApiException
     */
    public function fail(string $message = ResponseMessage::API_ERROR_EXCEPTION, int $status = ResponseStatus::BAD_REQUEST)
    {
        throw new ApiException([
            'status' => $status,
            'message' => $message
        ]);
    }
}
