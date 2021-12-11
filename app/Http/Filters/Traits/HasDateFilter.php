<?php

namespace App\Http\Filters;

use Carbon\Carbon;

trait HasDateFilter
{
    /**
     * @param string $start
     */
    public function dateStart(string $start)
    {
        $this->builder->where('created_at', '>=', $start);
    }

    /**
     * @param string $end
     */
    public function dateEnd(string $end)
    {
        $this->builder->where('created_at', '<', Carbon::parse($end)->addDays(1));
    }

}