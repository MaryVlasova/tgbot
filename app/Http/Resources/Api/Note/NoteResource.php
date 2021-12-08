<?php

namespace App\Http\Resources\Api\Note;

use App\Http\Resources\Api\CategoryNotes\CategoryNotesResource;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
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
            'title' => $this->title,
            'text' => $this->text,
            'img' => $this->img, 
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,            
            'category' => new CategoryNotesResource($this->categoryNotes),
            'author' => new UserResource($this->author),           
            'links' => [
                'self' => [
                    'href' => route('api.notes.show',$this->id)
            ]]            
        ];

    }
}
