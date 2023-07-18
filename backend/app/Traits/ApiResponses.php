<?php

namespace App\Traits;

trait ApiResponses
{
    public function successEntityResponse($data)
    {
        return response()->json([
            'result' => 'ok',
            'type' => 'entity',
            'data' => $data
        ]);
    }
    public function successCollectionResponse($data)
    {
        return response()->json([
            'result' => 'ok',
            'type' => 'collection',
            'data' => $data
        ]);
    }
    public function errorResponse($error, $statusCode = 403)
    {
        return response()->json([
            'result' => 'fail',
            'error' => $error
        ], $statusCode);
    }
}
