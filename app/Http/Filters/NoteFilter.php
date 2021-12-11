<?php

namespace App\Http\Filters;

use App\Models\CategoryNotes;
use App\Models\User;

class NoteFilter extends QueryFilter
{
    use HasDateFilter, HasOrderFilter;

    /**
     * @param string $author
     */
    public function author(int $authorId)
    {
        $this->builder->where('author_id', $authorId);
    }

    /**
     * @param array $categoryIds
     */
    public function categories(array $categoriesId)
    {
        $this->builder->whereIn('category_notes_id', $categoriesId);
    }
    /**
     * @param string $search
     */
    public function query(string $search)
    {        
        $this->builder->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%$search%")
                  ->orWhere('text', 'LIKE', "%$search%")
                  ->orWhereIn('author_id', User::where('name', 'LIKE', "%$search%")->pluck('id'))
                  ->orWhereIn('category_notes_id', CategoryNotes::where('name', 'LIKE', "%$search%")->pluck('id'));                  
        });       
    }

}