<?php
/**
 * StringUtils
 *
 */

namespace OpenEMR\Common\Utils;

class StringUtils
{
    public static function trimExcessWhitespace($string)
    {
        return trim(preg_replace('/\s+/', ' ', $string));
    }
}
