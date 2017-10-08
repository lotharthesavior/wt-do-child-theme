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

    }

    /**
     * @internal hook: register_deactivation_hook
     * @return void
     */
    public static function uninstall()
    {

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
     * Register Filters
     */
    public static function addFilters()
    {

        add_filter('ocean_blog_meta_choices', ['WTThemePlugin', 'addBooksMeta']);
        add_filter('woocommerce_account_menu_items', ['WTThemePlugin', 'wtDoRemoveMyAccountLinks']);

    }

    /**
     * Register Actions
     */
    public static function addActions()
    {

        add_action('wp_enqueue_scripts', ['WTThemePlugin', 'oceanwpChildEnqueueParentStyle']);
        add_action('init', ['WTThemePlugin', 'registerWtMenuForExtraLinks']);
        add_action('init', ['WTThemePlugin', 'addWtMenuForExtraLinksEndpoint']);

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

        foreach (self::$menu_items_to_be_registered as $menu_item) {
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
                WTThemePlugin::addContentToEndpoint($menu_item_endpoint);
            });
        }

    }

    /**
     * Populate the content of custom page. This is used to populate the
     * page created for Woocommerce MyAccount.
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
            echo $my_posts[0]->post_content;
        }
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

        // Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
        $theme = wp_get_theme('OceanWP');
        $version = $theme->get('Version');

        // Load the stylesheet
        wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('oceanwp-style'), $version);

    }

    /**
     * Add your own meta
     * By default, this new meta will be disabled, so you need to enable it in the customizer.
     *
     * @internal registered with: add_filter
     * @internal hook: ocean_blog_meta_choices
     * @param $return
     * @return mixed
     */
    public static function addBooksMeta($return)
    {

        // Add your meta name
        $return['books'] = esc_html__('Books', 'oceanwp');

        // Return
        return $return;

    }

    /**
     * Manage the items in the Woocommerce menu
     *
     * @internal registered with: add_filter
     * @internal hook: woocommerce_account_menu_items
     * @param $menu_links
     * @return mixed
     */
    public static function wtDoRemoveMyAccountLinks($menu_links)
    {
//        Default items ---
        unset($menu_links['edit-address']); // Addresses
//        unset( $menu_links['dashboard'] ); // Dashboard
//        unset( $menu_links['payment-methods'] ); // Payment Methods
//        unset( $menu_links['orders'] ); // Orders
//        unset( $menu_links['downloads'] ); // Downloads
//        unset( $menu_links['edit-account'] ); // Account details
//        unset( $menu_links['customer-logout'] ); // Logout

        $menu_items = wp_get_nav_menu_items("My Account extra items");
        foreach ($menu_items as $key => $menu_item) {
            $menu_links = self::addMenuItemToMyAccount($menu_item, $menu_links);
        }

//        wc_print_r($menu_links);exit;

        return $menu_links;

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

}