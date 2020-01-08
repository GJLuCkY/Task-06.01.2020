<?php

namespace App\Http\Controllers\Api;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }

    protected function sendError($message = '', $error = 500)
    {
        return response()->json([
            'message' => $message,
            'code' => $error
        ], 500);
    }

    protected function sendSuccess($message = '')
    {
        return response()->json([
            'message' => $message
        ], 200);
    }

    protected function sendValidatorError($errors)
    {
        $result = [
            'message' => 'Валидационная ошибка',
            'errors'  => $errors,
        ];

        return response()->json($result, 422);
    }
}
