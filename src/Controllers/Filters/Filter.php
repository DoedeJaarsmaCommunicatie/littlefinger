<?php
namespace App\Controllers\Filters;

abstract class Filter
{
    public function __construct()
    {
        $this->boot();
    }
    
    abstract public function boot();
    
    /**
     * Hook a function or method to a specific filter action.
     *
     * @param string   $filter
     * @param callable $function
     * @param int      $priority
     * @param int      $accepted_args
     *
     * @return void
     */
    protected function add_filter($filter, $function, $priority = 10, $accepted_args = 1) : void
    {
        \add_filter($filter, $function, $priority, $accepted_args);
    }
}
