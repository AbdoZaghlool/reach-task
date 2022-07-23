<?php

namespace App\Helpers;

class ApiResponder
{
    public static function handleResources($data, $resource)
    {
        $count = is_array($data) ? count($data) : $data->count();
        if ($count == 0) {
            return self::error(message: 'No Data Found', error: []);
        }

        if ($count == 1) {
            $data = new $resource($data);
        } else {
            $data = $resource::collection($data);
        }

        return self::success($resource::collection($data));
    }

    public static function success($data = null, $code = 200, $message = '')
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function error($error = null, $code = 500, $message = '')
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'error' => $error,
        ], $code);
    }
}
