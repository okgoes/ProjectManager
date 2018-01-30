<?php

class Result {
    //参数不可用
    const INVALID_PARAM_CODE = 500;
    const INVALID_PARAM = '参数不可用';
    const EMPTY_PARAM_CODE = 404;
    const EMPTY_PARAM = '参数不能为空';
    const SUCCESS_CODE = 200;
    const SUCCESS = '请求成功';
    const FAILURE_CODE = 100;
    const FAILURE = '请求失败';
    public function __construct() 
    {

    }

    public static function result($code, $data, $msg) 
    {
        return json_encode(array(
            "code" => $code,
            "data" => $data,
            "msg" => $msg
        ));
    }
}