<?php

/**
 *
 * WT Theme Actions
 *
 * This Class works as a central place for Actions for this theme.
 *
 * @author Savio Resende <savio@savioresende.com.br>
 *
 */

namespace Features;

class WTThemeActions
{

    /**
     * Register Actions
     */
    public static function start()
    {
        add_action('wp_enqueue_scripts', ['\\Features\\WTThemeActions', 'oceanwpChildEnqueueParentStyle']);

        add_action('init', ['\\Features\\WTThemeActions', 'registerWtMenuForExtraLinks']);

        add_action('init', ['\\Features\\WTThemeActions', 'addWtMenuForExtraLinksEndpoint']);

        add_action('init', ['\\Features\\WTThemeActions', 'blockusers_init'] );

        self::registerWtActions();
    }

    /**
     * Block access to wp-admin without administrator user_type
     */
    public static function blockusers_init() {
        if ( is_admin() && ! current_user_can( 'administrator' ) &&
            ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
            wp_redirect( home_url() );
            exit;
        }
    }

    /**
     * For eventual actions for this theme
     */
    public static function registerWtActions()
    {
//        add_action( 'wt_owp_', ['', ''], 10, 3 );
    }

    /**
     * Load the parent style.css file
     *
     * @internal registered with: add_action
     * @internal hook: wp_enqueue_scripts
     * @link http://codex.wordpress.org/Child_Themes
     */
    public static function oceanwpChildEnqueueParentStyle()
    {
        $version = \WTThemePlugin::getOceanWPVersion();

        // Load the stylesheet
        wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('oceanwp-style'), $version);
    }

    /**
     * Code hidden to register menus
     *
     * @internal registered with: add_action
     * @internal hook: init
     * @return void
     */
    public static function registerWtMenuForExtraLinks()
    {
        foreach (\WTThemePlugin::$menu_items_to_be_registered as $menu_item) {
            register_nav_menu($menu_item['location'], __($menu_item['description'][0], $menu_item['description'][1]));
        }
    }

    /**
     * Add Endpoint to registered pages on woocommerce myaccount menu
     *
     * @internal registered with: add_action
     * @internal hook: init
     * @return void
     */
    public static function addWtMenuForExtraLinksEndpoint()
    {
        $menu_items = wp_get_nav_menu_items("My Account extra items");
        foreach ($menu_items as $key => $menu_item) {
            $menu_item_endpoint = \Helpers\WtHelpers::slugFromString($menu_item->title);

            add_rewrite_endpoint($menu_item_endpoint, EP_PAGES);

            add_action('woocommerce_account_' . $menu_item_endpoint . '_endpoint', function () use ($menu_item_endpoint) {
                \WTThemePlugin::addContentToEndpoint($menu_item_endpoint);
            });
        }
    }

}