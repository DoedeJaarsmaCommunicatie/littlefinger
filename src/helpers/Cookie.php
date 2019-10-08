<?php
namespace App\Helpers;

use App\Exceptions\CookieNotSetException;

class Cookie
{
    public const RECENTLY_VIEWED_KEY = 'recently_viewed';
    
    /**
     * @param int $ID
     *
     * @return void
     */
    public static function setViewCookie($ID): void
    {
        $cookie_name = self::RECENTLY_VIEWED_KEY;
        $cookie_value = $ID;
        if (!isset($_COOKIE[$cookie_name])) {
            setcookie($cookie_name, $cookie_value, time() + 604800, '/');
        }
    }
    
    /**
     * Checks if cookie is set, else throws CookieNotSetException.
     *
     * @return mixed
     * @throws CookieNotSetException
     */
    public static function getViewCookieOrFail()
    {
        $c = self::getViewCookieOrFalse();
        
        if (!$c) {
            $error = new CookieNotSetException('Recently viewed cookie not set');
            $error->throwWPError();
    
            if (Errors::isDebug()) {
                throw $error;
            }
        }
        
        return $c;
    }
    
    /**
     * Check if the cookie is set, or else returns false.
     *
     * @return bool|mixed
     */
    public static function getViewCookieOrFalse()
    {
        $cookie_name = self::RECENTLY_VIEWED_KEY;
    
        /** @noinspection ProperNullCoalescingOperatorUsageInspection */
        return $_COOKIE[ $cookie_name ] ?? false;
    }
    
    /**
     * Returns the cookie if it exists
     *
     * @return mixed
     */
    public static function getViewCookie()
    {
        $cookie_name = self::RECENTLY_VIEWED_KEY;
        
        if (isset($_COOKIE[$cookie_name])) {
            return $_COOKIE[$cookie_name];
        }
    }
}
