<?php 
/*
Plugin Name: Startups Market 
Plugin URI: https://giantwpsolutions.com
Description: Empower your entrepreneurial journey with Startups Market – the ultimate platform for buying and selling innovative startups. Connect with visionary founders, explore cutting-edge businesses, and facilitate secure transactions. Monetize your success with a streamlined certain percentage of transaction fee. Build the future of business, one startup at a time.
Version: 1.0
Author: Habib Rahman
Author URI: https://habibr.me 
License: GPLv2 or later
Text Domain: startups-market
Domain Path: /languages/
*/

/**
 * Direct access not allowed
 */

if( ! Defined( 'ABSPATH' )){
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__  . '/core/functions.php';
use Startups\Market\Installer;
use Startups\Market\CreatePages;
use Startups\Market\Users\Roles;

/**
 * Plugin Main Class
 */
final class Startups_Market{

    /**
     * Constant
     */

    const version = '1.0';

    /**
     * Class Constructor
     */
    private function __construct(){
        $this->define_constants();

        register_activation_hook( __FILE__, [$this, 'activate'] );

        add_action( 'plugins_loaded', [$this, 'init_plugin'] );
        add_action('init', [$this, 'hide_admin_bar']);
        add_action('init', [$this, 'add_seller_capabilities']);
        add_filter('template_include', [ $this, 'include_custom_template' ] );
        
    }

    /**
     * Initialize a singleton instance
     *
     * @return \Startups_Market
     */
    public static function init(){
        static $instance = false;

        if( ! $instance ){
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define required plugin constants
     *
     * @return void
     */
    public function define_constants(){
        define( 'STM_VERSION', self::version );
        define( 'STM_FILE', __FILE__ );
        define( 'STM_PATH', __DIR__ );
        define( 'STM_URL', plugins_url('', STM_FILE ) );
        define( 'STM_ASSETS', STM_URL. '/assets' );
        define( 'STM_TEMPLATE', STM_URL. '/template' );

        $supported = [
            'business'   => [
                'regular_price_field' => 'stm_price',
                //'sale_price_field'    => 'stm_price',
            ],
        ];

        define( 'STM_WC_SUPPORT', $supported );

    }

    /**
     * Initialize plugin
     *
     * @return void
     */
    public function init_plugin(){
        load_plugin_textdomain( 'startups-market', false, STM_URL. '/languages' );
        Installer::instance();
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate(){
        add_image_size( 'stm-thumbnail', 100, 100, true ); 
        add_image_size( 'stm-list-thumbnail', 350, 250, true );

        $version = get_option( 'startups_market_version', true );
        update_option( 'startup_market_installation', time() );
        
        if ( empty( $version ) ){
            update_option( 'startups_market_version', STM_VERSION );
        }

        Roles::instance();
        CreatePages::instance();

    }

        /**
    * Hide admin Bar
    */
    public function hide_admin_bar() {
        add_post_type_support('business', 'woocommerce');
        if (is_user_logged_in() && current_user_can('buyer') || current_user_can('seller') ) {
            add_filter('show_admin_bar', '__return_false');
            
        }
    }

    /**
     * add seller caps
     */

    public function add_seller_capabilities(){
        $seller_role = get_role('seller');
        $seller_role->add_cap('edit_posts');
        $seller_role->add_cap('delete_posts');
        $seller_role->add_cap('delete_own_pending_posts');

    }

    public function include_custom_template( $template ) {
        // Check if it's a single 'business' post type
        if ( is_singular( 'business' ) ) {
            $single_template = STM_PATH . '/template/single-business.php';

            if ( file_exists( $single_template ) ) {
                return $single_template;
            }
        }

        // Check if it's an archive page for 'business' post type
        if ( is_post_type_archive( 'business' ) ) {
            $archive_template = STM_PATH . '/template/archive-business.php';

            if ( file_exists( $archive_template ) ) {
                return $archive_template;
            }
        }

            return $template;
    }


}

/**
 * Initializes the main plugin
 *
 * @return \Startups_Market
 */
function startups_market(){
    return Startups_Market::init();
}

/**
 * Kick start the plguin 
 */
startups_market();