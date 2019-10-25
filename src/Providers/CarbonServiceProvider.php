<?php
namespace App\Providers;

use App\Helpers\WP;
use Carbon_Fields\Carbon_Fields;

class CarbonServiceProvider
{
    public function __construct()
    {
        $this->boot();
    }
    
    public function boot(): void
    {
        $this->register_carbon_fields();
        $this->register_meta_fields();
    }
    
    private function register_meta_fields(): void
    {
        $fields = include WP::getStylesheetDir() . '/src/config/meta.php';
        
        foreach ($fields as $field) {
            add_action('carbon_fields_register_fields', [ new $field(), 'register']);
        }
    }
    
    private function register_carbon_fields(): void
    {
        
        add_action('after_setup_theme', static function () {
            if (!Carbon_Fields::is_booted()) {
                Carbon_Fields::boot();
            }
        });
    }
}
