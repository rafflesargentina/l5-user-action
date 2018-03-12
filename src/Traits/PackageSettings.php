<?php

namespace RafflesArgentina\UserAction\Traits;

trait PackageSettings
{
    /**
     * The alias for named routes.
     *
     * @var string|null
     */
    protected $alias;

    /**
     * The location for themed views.
     *
     * @var string|null
     */
    protected $theme;

    /**
     * The vendor views prefix.
     *
     * @var string|null
     */
    protected $module;

    /**
     * The prefix for named routes.
     *
     * @var string|null
     */
    protected $prefix;

    /**
     * The name of the package.
     *
     * @var string
     */
    protected $package = 'user-action';

    /**
     * The name of the resource.
     *
     * @var string $resourceName
     */
    protected $resourceName;

    /**
     * Get route name for the specified resource and action.
     *
     * @param string|null $resourceName The name of the resource.
     * @param string   $action The action.
     *
     * @return string
     */
    public function getRouteName($resourceName = null, $action)
    {
        $resourceName = $resourceName ?? $this->resourceName;
        return $this->alias.$resourceName.'.'.$action;
    }

    /**
     * Get views location for the specified resource.
     *
     * @param string $resourceName The name of the resource
     *
     * @return string
     */
    public function getViewsLocation($resourceName = null)
    {
        $resourceName = $resourceName ?? $this->resourceName;
        return $this->module.$this->theme.$resourceName;
    }

    /**
     * Get vendor views location for the specified resource.
     *
     * @param string $resourceName The name of the resource
     *
     * @return string
     */
    public function getVendorViewsLocation($resourceName = null)
    {
        $resourceName = $resourceName ?? $this->resourceName;

        if ($this->package) {
            $package = str_finish($this->package, '.');
        }

        return 'vendor.'.$package.$this->theme.$resourceName;
    }

    /**
     * Format route name and view path modifiers.
     *
     * @return void
     */
    public function formatRouteNameAndViewPathModifiers()
    {
        if ($this->alias) {
            $this->alias = str_finish($this->alias, '.');
        }

        if ($this->theme) {
            $this->theme = str_finish($this->theme, '.');
        }

        if ($this->prefix) {
            $this->prefix = str_finish($this->prefix, '.');
        }

        if ($this->module) {
            if (!ends_with($this->module, '::')) {
                $this->module .= '::';
            }
        }
    }
}
