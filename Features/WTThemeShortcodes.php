<?php

/**
 * WT Theme Shortcodes
 *
 * @author Savio Resende <savio@savioresende.com.br>
 *
 */

namespace Features;

class WTThemeShortcodes
{

    public static function addWriterShortcode(){

        add_shortcode('wt-writer', function(){

//            if ( ! empty( $_GET ) ) {
//                var_dump($_GET);exit;
//            }

            require __DIR__ . "/../templates/writer.php";

        });

    }

}