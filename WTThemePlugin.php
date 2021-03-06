<?php
/**
 * WT Theme Structure
 *
 * @author Savio Resende <savio@savioresende.com.br>
 *
 */

class WTThemePlugin
{

    public static $menu_items_to_be_registered = [
        [
            'location' => 'wt_myaccount_menu',
            'description' => [
                'Words Tree My Account Menu',
                'wt-myaccount-menu'
            ]
        ]
    ];

    /**
     * @internal hook: register_activation_hook
     * @return void
     */
    public static function install()
    {
        // TODO: check OceanWP installation
        // TODO: check Woocommerce installation
        // TODO: check other dependencies installation
        // TODO: create book taxonomy
    }

    /**
     * @internal hook: register_deactivation_hook
     * @return void
     */
    public static function uninstall()
    {
        // TODO: offer options to keep the data somewhere
    }

    /**
     *
     */
    public static function handleRegistration()
    {
        register_activation_hook(__FILE__, ['WTThemePlugin', 'install']);
        register_deactivation_hook(__FILE__, ['WTThemePlugin', 'uninstall']);
    }

    /**
     * Populate the content of custom page.
     *
     * @param string $menu_item_endpoint
     * @return void
     */
    public static function addContentToEndpoint(string $menu_item_endpoint)
    {
        $args = array(
            'name'        => $menu_item_endpoint,
            'post_type'   => 'page',
            'post_status' => 'publish',
            'numberposts' => 1
        );
        $my_posts = get_posts($args);

        if( count($my_posts) > 0 ){
            echo do_shortcode($my_posts[0]->post_content);
        }
    }

    /**
     * Add item to My Account's page
     *
     * @internal called by wt_do_remove_my_account_links
     * @param WP_Post $menu_item
     * @param array $menu_links
     */
    public static function addMenuItemToMyAccount(WP_Post $menu_item, array $menu_links)
    {
        $extra_page = [\Helpers\WtHelpers::slugFromString($menu_item->title) => $menu_item->title];

        $key = array_keys($extra_page)[0];

        $menu_links[$key] = $extra_page[$key];

        return $menu_links;
    }

    /**
     * Retrieve the ocean WT version
     *
     * @internal Dynamically get version number of the
     *           parent stylesheet (lets browsers re-cache
     *           your stylesheet when you update your theme)
     * @return false|string
     */
    public static function getOceanWPVersion()
    {
        $theme = wp_get_theme('OceanWP');
        return $theme->get('Version');
    }

}