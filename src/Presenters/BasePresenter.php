<?php

namespace RafflesArgentina\UserAction\Presenters;

use Laracasts\Presenter\Presenter;

class BasePresenter extends Presenter
{
    public function created_at()
    {
        return $this->entity->created_at->format($this->entity->date_format);
    }

    public function deleted_at()
    {
        return $this->entity->deleted_at ? $this->entity->deleted_at->format($this->entity->date_format) : null;
    }

    public function updated_at()
    {
        return $this->entity->updated_at->format($this->entity->date_format);
    }
}
