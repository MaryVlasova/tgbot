<?php

namespace App\Http\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

trait ApiResponseHelpers
{


    protected function withError(int $code, string $message = '')
    {        
        return response()->json([
            'meta' => [
                'status' => 'error',
                'message'=> $message,               
                'code' => $code    
            ]        
        ], $code);
    }

    protected function withSuccess(int $code = 200, string $message = '', array $addArray = [])
    {
        
        return response()->json(
            Arr::collapse([$addArray, [ 
                'meta' => [
                'status' => 'success',
                'message'=> $message ,               
                'code' => $code    
            ]        
        ]]), $code);
    }


}