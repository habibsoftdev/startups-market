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

/**
 * Plugin Main Class
 */
class Startups_Market{

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
        define( 'STM_ASSETS',STM_URL. '/assets' );
    }

    /**
     * Initialize plugin
     *
     * @return void
     */
    public function init_plugin(){
        new Startups\Market\Admin\Menu();
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate(){
        update_option( 'startup_market_installation', time() );
        update_option( 'startups_market_version', STM_VERSION );

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