<?php
namespace App\Providers;

class AppServiceProvider
{
    protected $providers;
    protected $filters;
    protected $actions;
    protected $routes;

    public function __construct()
    {
        $providers = include get_stylesheet_directory() . '/src/config/app.php';
        $routes = include get_stylesheet_directory() . '/src/routes/routes.php';
        
        $this->providers = $providers['providers'];
        $this->filters = $providers['filters'];
        $this->actions = $providers['actions'];
        $this->routes = $routes;
        $this->boot();
    }
    
    public function boot(): void
    {
        foreach ($this->providers as $provider) {
            new $provider();
        }
        foreach ($this->filters as $filter) {
            new $filter();
        }
        foreach ($this->actions as $action) {
            new $action();
        }

        foreach ($this->routes as $route) {
            add_action('rest_api_init', [ new $route(), 'register_routes']);
        }
    }
}
