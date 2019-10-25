<?php
namespace App\Providers;

use App\Helpers\WP;

class AppServiceProvider
{
    protected $providers;
    protected $filters;
    protected $actions;
    protected $routes;

    public function __construct()
    {
        $providers = include WP::getStylesheetDir() . '/src/config/app.php';
        $routes = include WP::getStylesheetDir() . '/src/routes/routes.php';
        
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
