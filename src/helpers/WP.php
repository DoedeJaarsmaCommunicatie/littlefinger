<?php
namespace App\Helpers;


use App\Exceptions\MultiSiteNotEnabledException;

class WP
{
    /**
     * Returns an array of all public sites.
     *
     * @return array|int
     */
    public static function getAllPublicSitesButCurrent()
    {
        if (function_exists('get_sites')) {
            return get_sites(
                [
                    'site__not_in'      => get_current_blog_id(),
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
}
