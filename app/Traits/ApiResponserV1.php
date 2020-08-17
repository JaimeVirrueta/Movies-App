<?php

namespace App\Traits;

trait ApiResponserV1
{
    protected function errorResponse($message, $code)
    {
        return response()->json([
            'error' => $message,
            'code' => $code
        ], $code);
    }
}
