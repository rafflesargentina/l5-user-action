<?php

namespace RafflesArgentina\UserAction\Observers;

use Log;

use RafflesArgentina\UserAction\Models\UserAction;

class BaseObserver
{
    /**
     * The name of the package.
     *
     * @var string $package
     */
    protected $package = 'user-action';

    /**
     * Get diff between dirty and fresh model attributes.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The Eloquent model.
     *
     * @return void
     */
    protected function getDiff($model)
    {
        $dirty = $model->getDirty();
        $fresh = $model->fresh() ? $model->fresh()->toArray() : []; 
        $after = json_encode($dirty);
        $before = json_encode(array_intersect_key($fresh, $dirty));

        return compact('before', 'after');
    }

    /**
     * Set slug.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The Eloquent model.
     *
     * @return void
     */
    protected function setSlug($model)
    {
        if ($this->isSluggable($model)) {
            $model->slug = str_slug($model->{$model::$slug['name']});

            try {
                $latestSlug = $model->whereRaw("slug RLIKE '^{$model->{$model::$slug['field']}}(-[0-9]*)?$'")
                    ->latest('id')
                    ->value('slug');
            } catch (\Illuminate\Database\QueryException $e) {
                $latestSlug = $model->whereRaw("slug LIKE '^{$model->{$model::$slug['field']}}(-[0-9]*)?$'")
                    ->latest('id')
                    ->value('slug');
            }

            if ($latestSlug) {
                $pieces = explode('-', $latestSlug);
                $number = intval(end($pieces));
                $model->{$model::$slug['field']} .= '-'.($number + 1);
            }
        }
    }

    /**
     * Checks if the model has slug property.
     *
     * @param $model The Eloquent model.
     *
     * @return bool
     */
    protected function isSluggable($model)
    {
        return property_exists($model, 'slug');
    }

    /**
     * Handle events logging.
     *
     * @param $model The Eloquent model.
     *
     * @return void
     */
    protected function handleEventsLogging($model)
    {
        if (config($this->package.'.log_events_to_file') === true) {
            $this->logEventsToFile($model);
        }

        if (config($this->package.'.log_events_to_db') === true) {
            $this->logEventsToDB($model);
        }
    }

    /**
     * Log Events to DB.
     *
     * @param $model The Eloquent model.
     *
     */
    private function logEventsToDB($model)
    {
        $user = auth()->user();
        $class = class_basename($model);
        $trace = debug_backtrace();
        $event = $trace[2] ? $trace[2]['function'] : "Unknown event";

        try {
            UserAction::create(
                array_merge($this->getDiff($model), [
                    'model' => $class,
                    'action' => $event,
                    'user_id' => $user ? $user->id : null,
                    'model_id' => $model->id,
                ])
            );
        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error("Could not record user action to db: '{$message}'");
        }
    }

    /**
     * Log Events to file.
     *
     * @param $model The Eloquent model.
     *
     */
    private function logEventsToFile($model)
    {
        $user = auth()->user();
        $class = class_basename($model);
        $trace = debug_backtrace();
        $event = $trace[2] ? $trace[2]['function'] : "Unknown event";

        if (auth()->check()) {
            Log::info("{$class} id {$model->id} {$event} by user id {$user->id} ({$user->email}).");
        } else {
            Log::info("{$class} id {$model->id} {$event} by unknown user.");
        }
    }
}
