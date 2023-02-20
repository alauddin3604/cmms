<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{
    protected function successResponse($message = null, $data, $code = null)
    {
        if ($code == null)
            $code = 200;

        return response()->json([
            'success' => true, 
            'message' => $message, 
            'data'    => $data
        ], $code);
    }

    protected function errorResponse($message = null, $data = null, $code)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data
        ], $code);
    }
}