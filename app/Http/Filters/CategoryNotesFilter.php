<?php

namespace App\Http\Filters;

use App\Models\CategoryNotes;
use App\Models\User;
use Carbon\Carbon;

class NoteFilter extends QueryFilter
{
    use HasDateFilter, HasOrderFilter;

    /**
     * @param string $search
     */
    public function query(string $search)
    {        
        $this->builder->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%$search%");                  
        });       
    }

}