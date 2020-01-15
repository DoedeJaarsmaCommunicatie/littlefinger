<?php

namespace App\Helpers;

use App\Exceptions\MultiSiteNotEnabledException;

use function get_current_blog_id;

class WP
{
    protected static $sites_cache_but_key = [];
    protected static $stylesheet_dir_cache = null;
    protected static $current_blog_id = null;
    protected static $dequeue_cache = [];
    protected static $dequeue_cache_scripts = [];
    protected static $enqueue_cache = [];
    protected static $enqueue_cache_scripts = [];
    
    /**
     * Returns an array of all public sites.
     *
     * @return array|int
     */
    public static function getAllPublicSitesButCurrent()
    {
        if (function_exists('get_sites')) {
            if (isset(static::$sites_cache_but_key[static::getCurrentBlogId()])) {
                return static::$sites_cache_but_key[static::getCurrentBlogId()];
            }
            
            return static::$sites_cache_but_key[static::getCurrentBlogId()] =  get_sites(
                [
                    'site__not_in'      => static::getCurrentBlogId(),
                    'public'            => 1,
                    'archived'          => 0
                ]
            );
        }
        
        return [];
    }
    
    /**
     * Returns an array of all public sites. Or fails.
     *
     * @return array|int
     * @throws MultiSiteNotEnabledException
     */
    public static function getAllPublicSitesButCurrentOrFail()
    {
        if (!function_exists('get_sites')) {
            $error = new MultiSiteNotEnabledException();
            $error->throwWPError();
            
            if (Errors::isDebug()) {
                throw $error;
            }
        }
        
        return self::getAllPublicSitesButCurrent();
    }
    
    public static function getStylesheetDir()
    {
        if (null !== static::$stylesheet_dir_cache) {
            return static::$stylesheet_dir_cache;
        }
        
        return static::$stylesheet_dir_cache = get_stylesheet_directory();
    }
    
    public static function getCurrentBlogId()
    {
        if (null !== static::$current_blog_id) {
            return static::$current_blog_id;
        }
        
        return static::$current_blog_id = get_current_blog_id();
    }
    
    /**
     * Adds scripts to the cache and registers them.
     *
     * @param string $handle
     * @param bool   $src
     * @param array  $deps
     * @param bool   $ver
     * @param bool   $in_footer
     *
     * @return void
     */
    public static function addScript($handle, $src = false, $deps = [], $ver = false, $in_footer = true)
    {
        if (isset(static::$enqueue_cache_scripts[$handle])) {
            return;
        }
        
        \wp_register_script(
            $handle,
            $src,
            $deps,
            $ver,
            $in_footer
        );
        static::$enqueue_cache_scripts[$handle] = $handle;
    }
    
    /**
     * Adds handles to the cache and registers them in wordpress
     *
     * @param string $handle
     * @param bool   $src
     * @param array  $deps
     * @param bool   $ver
     * @param string $media
     *
     * @return void
     */
    public static function addStyle($handle, $src = false, $deps = [], $ver = false, $media = 'all')
    {
        if (isset(static::$enqueue_cache[$handle])) {
            return;
        }
        
        \wp_register_style($handle, $src, $deps, $ver, $media);
        static::$enqueue_cache[$handle] = $handle;
    }
    
    public static function enqueueScripts()
    {
        foreach (static::$enqueue_cache_scripts as $script) {
            wp_enqueue_script($script);
        }
    }
    
    /**
     * Enqueues all the cached style handles.
     *
     * @return void
     */
    public static function enqueueStyles()
    {
        foreach (static::$enqueue_cache as $item) {
            wp_enqueue_style($item);
        }
    }
    
    /**
     * Removes scripts from wp enqueue array
     *
     * @param $handle
     */
    public static function removeScript($handle)
    {
        if (!isset(static::$dequeue_cache_scripts[$handle])) {
            \wp_dequeue_script($handle);
            static::$dequeue_cache_scripts[$handle] = $handle;
        }
    }
    
    /**
     * Removes styles from wp enqueue array
     *
     * @param $handle
     */
    public static function removeStyle($handle)
    {
        if (isset(static::$dequeue_cache[$handle])) {
            return;
        }
        
        \wp_dequeue_style($handle);
        static::$dequeue_cache[$handle] = $handle;
    }
}
