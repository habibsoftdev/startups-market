<?php 

namespace Startups\Market;

/**
 * Assets Loading Class Handler
 */

class Assetsload{

    public function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'stm_frontend_asset_load' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'stm_admin_asset']);
    }

    public function stm_frontend_asset_load(){
        wp_enqueue_style( 'stm-register-form', STM_ASSETS. '/frontend/css/register.css', array(), time() );
        
        wp_enqueue_script( 'stm-login-handle', STM_ASSETS. '/frontend/js/login.js', array('jquery'), time(), true);
        wp_register_script('stm-login-handle', STM_ASSETS. '/frontend/js/login.js', array('jquery'), true );

        /**
         * Ajax localize login
         */
        wp_localize_script('stm-login-handle', 'stm_ajax_object', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'redirect_url' => home_url('/sample-page'),
            'loading_message' => esc_html__( 'Sending user info, please wait ...', 'startups-market' ),
            'login_error_message' => esc_html__( 'Wrong username or password.', 'startups-market' ),
        ]);
    }

    public function stm_admin_asset(){
        wp_enqueue_style( 'stm-admin', STM_ASSETS. '/admin/css/stm-admin.css', array(), time() );
    }


}