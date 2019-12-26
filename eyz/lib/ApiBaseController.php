<?php
/**
 * eyz
 * Author: 忆云竹 （eyunzhu.com）
 * GitHub: https://github.com/eyunzhu/eyz
 */
namespace eyz\lib;
class ApiBaseController
{
    public function success($msg = '', $data = '', array $header = [])
    {
        $msg = $msg != '' ? $msg : 'success';
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: X-Requested-With,Content-Type,XX-Device-Type,XX-Token,XX-Api-Version,XX-Wxapp-AppId');

        $result = [
            "code" => 1,
            "msg" => $msg,
            "data" => $data
        ];
        throw new \Exception(json_encode($result,JSON_UNESCAPED_UNICODE),'1000');
    }

    public function error($msg = '', $data = '', array $header = [])
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: X-Requested-With,Content-Type,XX-Device-Type,XX-Token,XX-Api-Version,XX-Wxapp-AppId');

        $code = 0;
        if (is_array($msg)) {
            $code = $msg["code"];
            $msg  = $msg["msg"];
        }
        $result = [
            "code" => $code,
            "msg"  => $msg,
            "data" => $data,
        ];
        throw new \Exception(json_encode($result,JSON_UNESCAPED_UNICODE),'1000');
    }
}