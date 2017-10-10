<?php

/**
 *
 * WT Theme Shortcodes
 *
 * This Class works as a router for Shortcodes.
 *
 * Each Shortcode has it's own workflow.
 *
 * @author Savio Resende <savio@savioresende.com.br>
 *
 */

namespace Features;

class WTThemeShortcodes
{

    public static function addWriterShortcode()
    {
        add_shortcode('wt-writer', function () {
            $wt_writer_shortcode = new Shortcodes\WTWriterShortcode();
            $wt_writer_shortcode->run();

        });
    }

}