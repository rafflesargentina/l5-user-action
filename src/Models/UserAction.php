<?php

namespace RafflesArgentina\UserAction\Models;

use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;
use RafflesArgentina\FilterableSortable\FilterableSortableTrait;

use RafflesArgentina\UserAction\Filters\UserActionFilters;
use RafflesArgentina\UserAction\Sorters\UserActionSorters;
use RafflesArgentina\UserAction\Presenters\UserActionPresenter;

class UserAction extends Model
{
    use PresentableTrait, FilterableSortableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The QueryFilters class associated to the model.
     *
     * @var mixed $filters
     */
    protected $filters;

    /**
     * The name of the package.
     *
     * @var string $package
     */
    protected $package = 'user-action';

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage;

    /**
     * The QuerySorters class associated to the model.
     *
     * @var mixed $sorters
     */
    protected $sorters;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'after',
        'model',
        'action',
        'before',
        'user_id',
        'model_id',
    ];

    /**
     * The Presenter class associated to the model.
     *
     * @var mixed $presenter
     */
    protected $presenter;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection;

    /**
     * The related User model.
     *
     * @var mixed $model
     */
    protected $user_model;

    /**
     * The date format to use in presenter methods.
     *
     * @var string
     */
    public $date_format;

    /**
     * Create a new UserAction instance.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->table = config($this->package.'.user-action.table_name') ?: 'user_actions';
        $this->filters = config($this->package.'.user-action.filters') ?: UserActionFilters::class;
        $this->perPage = config($this->package.'.per_page') ?: '25';
        $this->sorters = config($this->package.'.user-action.sorters') ?: UserActionSorters::class;
        $this->presenter = config($this->package.'.user-action.presenter') ?: UserActionPresenter::class;
        $this->connection = config($this->package.'.user-action.connection');
        $this->user_model = config($this->package.'.user_model');
        $this->date_format = config($this->package.'.user-action.date_format');

        parent::__construct($attributes);
    }

    public function getRouteKeyName()
    {
        return config($this->package.'.user-action.route_key_name') ?: 'id';
    }

    public function user()
    {
        return $this->belongsTo($this->user_model, 'user_id');
    }
}
