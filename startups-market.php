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

/**
 * Plugin Main Class
 */
class Startups_Market{

    /**
     * Class Constructor
     */
    private function __construct(){

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