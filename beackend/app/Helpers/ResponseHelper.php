<?php

if (!function_exists('success')) {
    function success($data, $message = 'Success', $status = true)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }
}

if (!function_exists('error')) {
    function error($message = 'Something went wrong', $statusCode = 400,$error=null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'error' => $error
        ], $statusCode);
    }
}
