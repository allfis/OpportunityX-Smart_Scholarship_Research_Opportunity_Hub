<?php

namespace App\Traits;

trait ApiResponse
{
    protected function success($data = [], $message = null, $code = 200)
    {
        $res = ['success' => true, 'data' => $data];
        if ($message) {
            $res['message'] = $message;
        }
        return response()->json($res, $code);
    }

    protected function error($message, $code = 400, $errors = null)
    {
        $res = ['success' => false, 'error' => $message];
        if ($errors) {
            $res['errors'] = $errors;
        }
        return response()->json($res, $code);
    }
}