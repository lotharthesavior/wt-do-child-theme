<?php
/**
 * Words Tree Helpers
 *
 * @author Savio Resende <savio@savioresende.com.br>
 *
 */

namespace Helpers;

class WtHelpers
{

    /**
     * @param string $string
     * @return string
     */
    public static function slugFromString( string $string ) : string{
        $string = str_replace(" ", "-", strtolower($string));
        return $string;
    }

}