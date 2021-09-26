<?php
namespace App\Http\Response;

class ClientResponse
{
    public static function success(string $message, array $data = [])
    {
        return response()->json([
            'status_code' => 201,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public static function error($error, int $code = 400)
    {
        return response()->json([
            'status_code' => $code,
            'error'  => $error,
            'data'      => [],
        ]);
    }
}
