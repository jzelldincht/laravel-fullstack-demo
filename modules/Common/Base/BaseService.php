<?php

namespace Modules\Common\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Modules\Api\Exceptions\ApiException;
use Modules\Common\Variables\HttpStatus;
use Modules\Common\Variables\ResponseMessage;
use Modules\Common\Variables\ResponseStatus;

/**
 * 公共的模块服务基类
 */
class BaseService
{
    public static $instance = null;

    public function __construct()
    {

    }

    /**
     * 查询条件
     * @param object $model Model 模型
     * @param array $params Array 查询参数
     * @param $key String 模糊查询参数
     * @return Object
     * @method  GET
     */
    function queryCondition(object $model, array $params, string $key = "username"): object
    {
        if (!empty($params['created_at'])) {
            $model = $model->whereBetween('created_at', $params['created_at']);
        }

        if (!empty($params['updated_at'])) {
            $model = $model->whereBetween('updated_at', $params['updated_at']);
        }

        if (!empty($params[$key])) {
            $model = $model->where($key, 'like', '%' . $params[$key] . '%');
        }

        if (isset($params['status']) && $params['status'] != '') {
            $model = $model->where('status', $params['status']);
        }

        return $model;
    }

    /**
     * 成功返回
     * 用于所有的接口返回
     * @param $message String 提示信息
     * @param array $data Array 返回信息
     * @param $status Int 自定义状态码
     * @return JsonResponse
     */
    public function apiSuccess(string $message = '', array $data = array(), int $status = ResponseStatus::OK): JsonResponse
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
    public function apiError(string $message = ResponseMessage::API_ERROR_EXCEPTION, int $status = ResponseStatus::BAD_REQUEST)
    {
        throw new ApiException([
            'status' => $status,
            'message' => $message
        ]);
    }

    /**
     * 添加公共方法
     * @param $model Model  当前模型
     * @param $data array 添加数据
     * @param $successMessage string 成功返回数据
     * @param $errorMessage string 失败返回数据
     * @return JsonResponse|void
     * @throws ApiException
     */
    public function commonCreate(Model $model, array $data = [], string $successMessage = ResponseMessage::ADD_API_SUCCESS, string $errorMessage = ResponseMessage::ADD_API_ERROR)
    {
        $data['created_at'] = date('Y-m-d H:i:s');

        if ($model->insert($data)) {
            return $this->apiSuccess($successMessage);
        }

        $this->apiError($errorMessage);
    }

    /**
     * 编辑公共方法
     * @param $model Model  当前模型
     * @param $id   Int  修改id
     * @param $data array 添加数据
     * @param $successMessage string 成功返回数据
     * @param $errorMessage string 失败返回数据
     * @return JsonResponse|void
     * @throws ApiException
     */
    public function commonUpdate(Model $model, $id, array $data = [], string $successMessage = ResponseMessage::UPDATE_API_SUCCESS, string $errorMessage = ResponseMessage::UPDATE_API_ERROR)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');

        if ($model->where('id', $id)->update($data)) {
            return $this->apiSuccess($successMessage);
        }

        $this->apiError($errorMessage);
    }

    /**
     * 调整公共方法
     * @param Model $model Model  当前模型
     * @param int $id Int  修改id
     * @param array $data array 添加数据
     * @param $successMessage string 成功返回数据
     * @param $errorMessage string 失败返回数据
     * @return JsonResponse|void
     * @throws ApiException
     */
    public function commonStatusUpdate($model, $id, array $data = [], string $successMessage = ResponseMessage::STATUS_API_SUCCESS, string $errorMessage = ResponseMessage::STATUS_API_ERROR)
    {
        if ($model->where('id', $id)->update($data)) {
            return $this->apiSuccess($successMessage);
        }

        $this->apiError($errorMessage);
    }

    /**
     * 排序公共方法
     * @param Model $model Model  当前模型
     * @param int $id Int  修改id
     * @param array $data array 添加数据
     * @param $successMessage string 成功返回数据
     * @param $errorMessage string 失败返回数据
     * @return JsonResponse|void
     * @throws ApiException
     */
    public function commonSortsUpdate(Model $model, $id, array $data = [], string $successMessage = ResponseMessage::STATUS_API_SUCCESS, string $errorMessage = ResponseMessage::STATUS_API_ERROR)
    {
        if ($model->where('id', $id)->update($data) !== false) {
            return $this->apiSuccess($successMessage);
        }

        $this->apiError($errorMessage);
    }

    /**
     * 真删除公共方法
     * @param Model $model Model  当前模型
     * @param array $ArrId
     * @param $successMessage string 成功返回数据
     * @param $errorMessage string 失败返回数据
     * @return JsonResponse|void
     * @throws ApiException
     */
    public function commonDestroy(Model $model, array $ArrId, string $successMessage = ResponseMessage::DELETE_API_SUCCESS, string $errorMessage = ResponseMessage::DELETE_API_ERROR)
    {
        if ($model->whereIn('id', $ArrId)->delete()) {
            return $this->apiSuccess($successMessage);
        }

        $this->apiError($errorMessage);
    }

    /**
     * 假删除公共方法
     * @param Model $model Model  当前模型
     * @param array $idArr Array  删除id
     * @param $successMessage string 成功返回数据
     * @param $errorMessage string 失败返回数据
     * @return JsonResponse|void
     * @throws ApiException
     */
    public function commonIsDelete($model, array $idArr, string $successMessage = ResponseMessage::DELETE_API_SUCCESS, string $errorMessage = ResponseMessage::DELETE_API_ERROR)
    {
        if ($model->whereIn('id', $idArr)->update(['is_delete' => 1, 'deleted_at' => date('Y-m-d H:i:s')])) {
            return $this->apiSuccess($successMessage);
        }

        $this->apiError($errorMessage);
    }

    /**
     * 假删除恢复公共方法
     * @param Model $model Model  当前模型
     * @param array $idArr Array  删除id
     * @param $successMessage string 成功返回数据
     * @param $errorMessage string 失败返回数据
     * @return JsonResponse|void
     * @throws ApiException
     */
    public function commonRecycleIsDelete($model, array $idArr, string $successMessage = ResponseMessage::DELETE_RECYCLE_API_SUCCESS, string $errorMessage = ResponseMessage::DELETE_RECYCLE_API_ERROR)
    {
        if ($model->whereIn('id', $idArr)->update(['is_delete' => 0])) {
            return $this->apiSuccess($successMessage);
        }

        $this->apiError($errorMessage);
    }

    /**
     * 获取当前域名
     * @return string
     */
    public function getServerName(): string
    {
        $http = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        return $http . $_SERVER['HTTP_HOST'];
    }

    /**
     * 将编辑器的content的图片转换为相对路径
     * @param string $content String 内容
     * @return string
     */
    public function getRemovePicUrl(string $content = ''): string
    {
        $con = $this->getHttp();
        if ($content) {
            //提取图片路径的src的正则表达式 并把结果存入$matches中
            preg_match_all("/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))['|\"].*?[\/]?>/i", $content, $matches);

            $img = "";
            if (!empty($matches)) {
                //注意，上面的正则表达式说明src的值是放在数组的第三个中
                $img = $matches[1];
            }

            if (!empty($img)) {
                $patterns = array();
                $replacements = array();
                //$default = config('filesystems.disks.qiniu.domains.default');
                foreach ($img as $imgItem) {
                    //if (strpos($imgItem, $default) !== false) {
                    //    $final_imgUrl = $imgItem;
                    // } else {
                    $final_imgUrl = str_replace($con, "", $imgItem);
                    //}
                    $replacements[] = $final_imgUrl;
                    $img_new = "/" . preg_replace("/\//i", "\/", $imgItem) . "/";
                    $patterns[] = $img_new;
                }
                //让数组按照key来排序
                ksort($patterns);
                ksort($replacements);
                //替换内容
                $content = preg_replace($patterns, $replacements, $content);
            }
        }
        return $content;
    }

    /**
     * 将编辑器的content的图片转换为绝对路径
     * @param string $content string 内容
     * @return string
     */
    public function getReplacePicUrl(string $content = ''): string
    {
        $con = $this->getHttp();
        if ($content) {
            //提取图片路径的src的正则表达式 并把结果存入$matches中
            preg_match_all("/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/i", $content, $matches);
            $img = "";
            if (!empty($matches)) {
                //注意，上面的正则表达式说明src的值是放在数组的第三个中
                $img = $matches[1];
            }
            if (!empty($img)) {
                $patterns = array();
                $replacements = array();
                //$default = config('filesystems.disks.qiniu.domains.default');
                foreach ($img as $imgItem) {
                    //if (strpos($imgItem, $default) !== false) {
                    //    $final_imgUrl = $imgItem;
                    //} else {
                    $final_imgUrl = $con . $imgItem;
                    //}
                    $replacements[] = $final_imgUrl;
                    $img_new = "/" . preg_replace("/\//i", "\/", $imgItem) . "/";
                    $patterns[] = $img_new;
                }
                //让数组按照key来排序
                ksort($patterns);
                ksort($replacements);
                //替换内容
                $content = preg_replace($patterns, $replacements, $content);
            }
        }
        return $content;
    }

    /**
     * 生成随机字符串
     * @param int length Int 生成字符串长度
     * @return string
     */
    public function randomString(int $length = 11): string
    {
        //字符组合
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str) - 1;
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randstr .= $str[$num];
        }
        return $randstr;
    }

    /**
     * 处理二维数组转为json字符串乱码问题
     * @description
     * @param array $data Array 需要转为json字符串的数组
     * @return string
     */
    public function setJsonEncodes(array $data): string
    {
        $count = count($data);
        for ($k = 0; $k < $count; $k++) {
            foreach ($data[$k] as $key => $value) {
                $data[$k][$key] = urlencode($value);
            }
        }
        return urldecode(json_encode($data));
    }

    /**
     * 传入时间戳,计算距离现在的时间
     * @description
     * @param $theTime Int 时间戳
     * @return string
     */
    public function formatTime(int $theTime = 0): string
    {
        $nowTime = time();
        $dur = $nowTime - $theTime;
        if ($dur < 0) {
            return $theTime;
        } else {
            if ($dur < 60) {
                return $dur . '秒前';
            } else {
                if ($dur < 3600) {
                    return floor($dur / 60) . '分钟前';
                } else {
                    if ($dur < 86400) {
                        return floor($dur / 3600) . '小时前';
                    } else {//昨天
                        //获取今天凌晨的时间戳
                        $day = strtotime(date('Y-m-d', time()));
                        //获取昨天凌晨的时间戳
                        $pday = strtotime(date('Y-m-d', strtotime('-1 day')));
                        if ($theTime > $pday && $theTime < $day) {//是否昨天
                            return '昨天 ' . date('H:i', $theTime);
                        } else {
                            if ($dur < 172800) {
                                return floor($dur / 86400) . '天前';
                            } else {
                                return date('Y-m-d H:i', $theTime);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * 处理递归数据
     * @description
     * @param array $array Array 总数据
     * @param $pid Int 父级id
     * @return array
     */
    public function tree(array $array, int $pid = 0): array
    {
        $tree = array();
        foreach ($array as $key => $value) {
            if ($value['pid'] == $pid) {
                $value['children'] = $this->tree($array, $value['id']);
                if (!$value['children']) {
                    unset($value['children']);
                }
                $tree[] = $value;
            }
        }
        return $tree;
    }

    /**
     * 获取用户真实IP
     * @return array|false|mixed|string
     */
    public function getClientIp()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        if (getenv('HTTP_X_REAL_IP')) {
            $ip = getenv('HTTP_X_REAL_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
            $ips = explode(',', $ip);
            $ip = $ips[0];
        } elseif (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = '0.0.0.0';
        }
        if (!$ip) {
            return '';
        }
        return $ip;
    }

    /**
     * PHP格式化字节大小
     * @param $size Int  字节数
     * @param $delimiter string  数字和单位分隔符
     * @return String 格式化后的带单位的大小
     **/
    public function formatBytes(int $size, string $delimiter = ''): string
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }

    /**
     * 单例模式获取调用类
     * @param null $params
     * @return mixed|null
     */
    public static function getInstance($params = null)
    {
        // 获取当前 调用类

        $class = get_called_class();

        if (!self::$instance instanceof $class) {
            self::$instance = new $class($params);
        }

        return self::$instance;
    }
}
