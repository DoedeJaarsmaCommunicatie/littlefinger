<?php
/**
 * Registers customizer functions
 *
 * @author Mitch Hijlkema <mail@mitchhijlkema.nl>
 * @version 1.0.0
 * @package App\Providers
 * @since 1.0.0
 */

namespace App\Providers;

use App\Controllers\Customizer\General\FooterCustomizerController;
use App\Controllers\Customizer\General\FooterListsCustomizerController;
use App\Controllers\Customizer\General\GeneralCustomizerController;
use App\Controllers\Customizer\General\GeneralLayoutCustomizerController;
use App\Controllers\Customizer\General\GeneralWoocommerceCustomizerController;
use App\Controllers\Customizer\General\SeoCustomizerController;
use App\Controllers\Customizer\General\StoreCustomizerController;
use App\Controllers\Customizer\General\UspCustomizerController;
use App\Controllers\Customizer\Product\GeneralProductCustomizerController;
use Kirki;
use App\Controllers\Customizer\General\ScriptsCustomizerController;
use Symfony\Component\Finder\Finder;

/**
 * Class CustomizerServiceProvider
 *
 * @package App\Providers
 */
class CustomizerServiceProvider
{

    const CONFIG_ID = 'itww';

    /**
     * CustomizerServiceProvider constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * The boot function.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->register_namespace();

        $this->register();
    }

    /**
     * Registers the customizer controllers
     */
    public function register(): void
    {
    	new UspCustomizerController();
        new SeoCustomizerController();
        new FooterCustomizerController();
        new FooterListsCustomizerController();
        new StoreCustomizerController();
        new GeneralCustomizerController();
        new GeneralWoocommerceCustomizerController();
        new ScriptsCustomizerController();
        new GeneralLayoutCustomizerController();
        
        new GeneralProductCustomizerController();
    }

    /**
     * Registers \Kirki::class.
     *
     * @return void
     */
    private function register_namespace(): void
    {
        Kirki::add_config(
            self::CONFIG_ID,
            [
                'capability'  => 'edit_theme_options',
                'option_type' => 'theme_mod',
            ]
        );
    }
}
