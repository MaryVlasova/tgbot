<?php

namespace App\Http\Resources\Api\Note;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NoteCollection extends ResourceCollection
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
            'notes' => $this->collection,
        ];
    }

}
