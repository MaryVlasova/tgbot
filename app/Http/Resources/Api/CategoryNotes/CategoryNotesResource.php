<?php

namespace App\Http\Resources\Api\CategoryNotes;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryNotesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'img' => $this->img,         
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,            
            'color' => $this->color,
            'links' => [
                'self' => [
                    'href' => route('api.categories.show',$this->id)
            ]]             
        ];
    }
}
