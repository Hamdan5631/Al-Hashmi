<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function jsonResponse($message = '', $data = '', $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => $message, 'data' => $data], $status);
    }

    public function error($message, $errors, $status): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ];

        return response()->json($response, $status);
    }
}
