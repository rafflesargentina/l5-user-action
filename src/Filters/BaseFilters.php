<?php

namespace RafflesArgentina\UserAction\Filters;

use Carbon\Carbon;

use RafflesArgentina\FilterableSortable\QueryFilters;

class BaseFilters extends QueryFilters
{
    public function created_after($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('created_at', '>=', $date->toDateString());
    }

    public function created_before($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('created_at', '<=', $date->toDateString());
    }

    public function deleted_after($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('deleted_at', '>=', $date->toDateString());
    }

    public function deleted_before($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('deleted_at', '<=', $date->toDateString());
    }

    public function updated_after($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('updated_at', '>=', $date->toDateString());
    }

    public function updated_before($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('updated_at', '<=', $date->toDateString());
    }
}
