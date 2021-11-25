<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryNotesCollection extends ResourceCollection
{
    
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'embedded';    
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {  
        return [
            'categories' => $this->collection,
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'status' => 'success',
                'message' => 'ok',
                'code' => 200,
            ],
        ];
    }  

}
