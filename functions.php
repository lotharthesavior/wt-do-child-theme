<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

if (!session_id()) @session_start();

$current_user = wp_get_current_user();
if( !in_array("administrator", $current_user->roles) ) {
    show_admin_bar(false);
}

$wt_theme_dir = plugin_dir_path( __FILE__ );

require $wt_theme_dir . 'WTThemePlugin.php';

require $wt_theme_dir . 'vendor/autoload.php';

\WTThemePlugin::handleRegistration();
\Features\WTThemeFilters::start();
\Features\WTThemeActions::start();

\Features\WTThemeShortcodes::addWriterShortcode();
