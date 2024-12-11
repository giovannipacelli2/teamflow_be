<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseJson extends Controller
{
    public static function out($data, $code, $msg=''){

        $result = [
            'data' => $data,
            'message' => $msg
        ];

        //header('Access-Control-Allow-Origin : *');
        http_response_code((int)$code);
        header('Content-type: application/json');
        echo json_encode($result);

        exit();
    }
    public static function response($data, $code=200, $msg=''){

        $result = [
            'data' => $data,
            'message' => $msg
        ];

        return response()->json($result, $code);
    }

    public static function format($data, $msg=''){

        $result = [
            'data' => $data,
            'message' => $msg
        ];

        return $result;
    }
}
