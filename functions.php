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

require __DIR__ . '/WTThemePlugin.php';

require __DIR__ . '/vendor/autoload.php';

\WTThemePlugin::addFilters();
\WTThemePlugin::handleRegistration();
\WTThemePlugin::addActions();