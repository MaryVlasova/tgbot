<?php

namespace App\Http\Filters;

trait HasOrderFilter
{

    /**
     * @param array $values
     */
    public function order(array $values)
    {
       foreach($values as $key => $value) {            
            $this->builder->orderBy($key, $value);
       }
        
    }

}