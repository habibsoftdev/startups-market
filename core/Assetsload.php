<?php 

namespace Startups\Market;

/**
 * Assets Loading Class Handler
 */

class Assetsload{

    public function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'stm_frontend_asset_load' ] );
    }

    public function stm_frontend_asset_load(){
        wp_enqueue_style( 'stm-register-form', plugin_dir_url( dirname(__FILE__) ) . 'assets/frontend/css/register.css', array('bootstrap'), time() );
    }
}