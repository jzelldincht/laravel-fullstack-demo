<?php

namespace Modules\Common\Exceptions;

use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Modules\Api\Exceptions\ApiException;
use Modules\Common\Variables\HttpStatus;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;
use ParseError;
use PDOException;
use ReflectionException;
use RuntimeException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $exceptionStatus;
    protected $exceptionMessage;

    /**
     * 允许检测异常的异常类
     * 索引1为异常类
     * 索引2为异常错误码
     * 索引3为异常错误信息
     * @var string[]
     */
    protected $exceptionClasses = [
        [
            'class' => ParseError::class,
            'status' => ResponseStatus::PARSE_ERROR,
            'message' => ResponseMessage::PARSE_ERROR,
            'code' => HttpStatus::INTERNAL_SERVER_ERROR,
        ],
        [
            'class' => InvalidArgumentException::class,
            'status' => ResponseStatus::INVALID_ARGUMENT_EXCEPTION,
            'message' => ResponseMessage::INVALID_ARGUMENT_EXCEPTION,
            'code' => HttpStatus::INTERNAL_SERVER_ERROR,
        ],
        [
            'class' => ModelNotFoundException::class,
            'status' => ResponseStatus::MODEL_NOT_FOUND_EXCEPTION,
            'message' => ResponseMessage::MODEL_NOT_FOUND_EXCEPTION,
            'code' => HttpStatus::INTERNAL_SERVER_ERROR,
        ],
        [
            'class' => QueryException::class,
            'status' => ResponseStatus::QUERY_EXCEPTION,
            'message' => ResponseMessage::QUERY_EXCEPTION,
            'code' => HttpStatus::INTERNAL_SERVER_ERROR,
        ],
        [
            'class' => ReflectionException::class,
            'status' => ResponseStatus::REFLECTION_EXCEPTION,
            'message' => ResponseMessage::REFLECTION_EXCEPTION,
            'code' => HttpStatus::INTERNAL_SERVER_ERROR,
        ],
        [
            'class' => RuntimeException::class,
            'status' => ResponseStatus::RUNTIME_EXCEPTION,
            'message' => ResponseMessage::RUNTIME_EXCEPTION,
            'code' => HttpStatus::INTERNAL_SERVER_ERROR,
        ],
        [
            'class' => ErrorException::class,
            'status' => ResponseStatus::ERROR_EXCEPTION,
            'message' => ResponseMessage::ERROR_EXCEPTION,
            'code' => HttpStatus::INTERNAL_SERVER_ERROR,
        ],
        [
            'class' => ApiException::class,
            'status' => ResponseStatus::BAD_REQUEST,
            'message' => null,
            'code' => HttpStatus::BAD_REQUEST,
        ],
        [
            'class' => ValidationException::class,
            'status' => ResponseStatus::BAD_REQUEST,
            'message' => null,
            'code' => HttpStatus::BAD_REQUEST,
        ],

    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * 判断是否存在于抛出异常处理的类，并根据相应的类返回对应的错误码和错误信息
     * @param Throwable $e
     * @return false|JsonResponse
     */
    protected function errorException(Throwable $e)
    {
        foreach ($this->exceptionClasses as $index => $exception_class) {

            if ($e instanceof $exception_class['class']) {
                // 错误的具体信息，保存于 data 中
                $exception_data = [];

                // 初始化错误信息为通用错误信息
                $message = ResponseMessage::COMMON_EXCEPTION;
                $status = ResponseStatus::COMMON_EXCEPTION;

                // 如果app.debug为真，则显示详细的信息，否则返回通用的错误提示
                if (config('app.debug') == true) {

                    // 优先判断有没有 getModel() 方法
                    // getModel() 会覆盖 getMessage()
                    if (method_exists($e, 'getModel') && $e->getModel()) {
                        $message = $e->getModel();
                    } else if (method_exists($e, 'getMessage') && $e->getMessage()) {
                        $message = $e->getMessage();
                    } else if (method_exists($e,'apiMessage') && $e->apiMessage()) {
                        // ApiException 时返回$e->message;
                        $message = $e->apiMessage();
                    }

                    // 是否存在 getSql() 方法
                    if (method_exists($e, 'getSql')) {
                        $exception_data['sql'] = $e->getSql();
                    }

                    if($e->getCode() && $e->getCode()) {
                        $exception_data['code'] = $e->getCode();// ApiException 时返回$e->code;
                    }

                    $exception_data['file'] = $e->getFile();
                    $exception_data['line'] = $e->getLine();
                    $exception_data['message'] = $message;
                }

                if (method_exists($e, 'apiStatus') && $e->apiStatus()) {
                    $exception_class['status'] = $e->apiStatus();// ApiException 时返回$e->code;
                    $exception_data = [];// 如果为 ApiException，不传递 data
                }

                // 如果监测到是 validator 属性则获取其 errors 内容为错误信息
                if(property_exists($e, 'validator')) {
                    $message = $e->validator->errors()->first();
                    $exception_data = [];// 如果为 ValidatorException，不传递 data
                }

                return response()->json(array_merge([
                    'status' => $exception_class['status'],
                    'message' => $message,
                ], empty($exception_data) || App::environment(['production']) ? [] : ['data' => $exception_data,]), $exception_class['code']);

            }
        }

        return false;
    }

    public function render($request, Throwable $e)
    {
        // 判断是否是 api/xx/xx  的路由
        if ($request->is('api/*')) {

            $result = $this->errorException($e);
            if ($result) {
                return $result;
            }
        }


        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }
}
