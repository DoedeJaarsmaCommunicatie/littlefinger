<?php
namespace App\Providers;

use App\Models\Menu\Menu;
use function register_nav_menus;

/**
 * Class MenuServiceProvider
 *
 * @package App\Providers
 */
class MenuServiceProvider
{
    /**
     * The registered menus
     *
     * @var array
     */
    protected static $menus = [
        'top-menu'     => 'Topmenu',
        'primary-menu' => 'Primary',
        'footer-menu'  => 'Footer menu',
    ];

    /**
     * MenuServiceProvider constructor.
     */
    public function __construct()
    {
         $this->boot();
    }

    /**
     * Register nav menus in timber
     *
     * @return void
     */
    public function boot(): void
    {
        register_nav_menus(static::$menus);

        add_filter('timber/context', [ $this, 'registerContent' ]);
    }

    /**
     * Register nav menu's in twig.
     *
     * @param array $content
     *
     * @return mixed
     */
    public function registerContent($content)
    {
        foreach (static::$menus as $key => $name) {
            $content[ \App\Helpers\Str::camel($key) ] = new Menu($key);
        }
        return $content;
    }
}
