<?php
namespace App\Helpers;

class Errors
{
    public static function isDebug(): bool
    {
        return defined('WP_DEBUG') && WP_DEBUG;
    }
}
