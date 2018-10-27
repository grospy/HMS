<?php

namespace OpenEMR\Common;

/**
 * Check if the server's PHP version is compatible with OpenEMR.
 *
 */
class Checker
{
    private static $minimumPhpVersion = "5.6.0";

    private static function xlDelegate($value)
    {
        if (function_exists("xl")) {
            return xl($value);
        }

        return $value;
    }

    /**
     * Checks to see if minimum PHP version is met.
     *
     * @return bool | warning string
     */
    public static function checkPhpVersion()
    {
        $phpCheck = self::isPhpSupported();
        $response = "";

        if (!$phpCheck) {
            $response .= self::xlDelegate("PHP version needs to be at least") . " " . self::$minimumPhpVersion . ".";
        } else {
            $response = true;
        }

        return $response;
    }

    /**
     * Checks to see if minimum PHP version is met.
     *
     * @return bool
     */
    private static function isPhpSupported()
    {
        return version_compare(phpversion(), self::$minimumPhpVersion, ">=");
    }
}
