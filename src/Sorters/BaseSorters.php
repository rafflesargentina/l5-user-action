<?php

namespace RafflesArgentina\UserAction\Sorters;

use RafflesArgentina\FilterableSortable\QuerySorters;

class BaseSorters extends QuerySorters
{
    protected static $defaultOrder = "desc";

    protected static $defaultOrderBy = "Creacion";

    public function Creacion()
    {
        return $this->builder->orderBy('created_at', $this->order());
    }

    public function Eliminacion()
    {
        return $this->builder->orderBy('deleted_at', $this->order());
    }

    public function Actualizacion()
    {
        return $this->builder->orderBy('updated_at', $this->order());
    }
}
