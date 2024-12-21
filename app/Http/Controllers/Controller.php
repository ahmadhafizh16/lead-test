<?php

namespace App\Http\Controllers;

use App\Transformers\ParentTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

abstract class Controller
{
    protected function transform(mixed $data, ParentTransformer $transformer, int $code = 200): JsonResponse
    {
        if (!($transformer instanceof ParentTransformer)) {
            throw new \Exception('Invalid transformer class', 500);
        }

        $response = $transformer->transform($data);
        
        return response()->json($response, $code);
    }
}
