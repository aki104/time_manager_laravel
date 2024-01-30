<?php

namespace App\Logics\common;


class ReturnFormat
{
    public static function success($data, $code, $msg)
    {
        $array = [
            'status' => 'success', 
            'data' => $data, 
            'code' => $code, 
            'message' => $msg
        ];

        return $array;
    }

    public static function failure($code, $msg)
    {
        $array = [
            'status' => 'failure', 
            'data' => null, 
            'code' => $code, 
            'message' => $msg
        ];

        return $array;
    }

    public static function systemFailure($code, $msg)
    {
        return [                  
            'code' => $code,
            'msg' => $msg,
        ];
    }
}
