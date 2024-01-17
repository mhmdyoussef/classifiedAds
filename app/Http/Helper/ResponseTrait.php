<?php

namespace App\Http\Helper;

trait ResponseTrait
{
    public function successResponse(string $message = '', int $code = 200, string $token = '', array $customData = [])
    {
        $data = [
            'status' => true,
        ];

        if ($message) {
            $data = array_merge($data, ['message' => $message]);
        }

        if ($token) {
            $data['token'] = $token;
        }

        if ($customData) {
            $data = array_merge($data, $customData);
        }

        return response()->json($data, $code);
    }

    public function failureResponse(string $message, int $code = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $code);
    }

}
