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
        //Styles
        wp_enqueue_style('bootstrap-stm', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), '4.4.1', 'all');
        wp_enqueue_style('bootstrap-stm-ds', '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), time(), 'all');
        wp_enqueue_style( 'stm-register-form', STM_ASSETS. '/frontend/css/register.css', array(), time(), 'all' );
        wp_enqueue_style( 'stm-dashboard', STM_ASSETS. '/frontend/css/dashboard.css', array('bootstrap-stm-ds'), time(), 'all' );
        wp_enqueue_style( 'stm-listing-form', STM_ASSETS . '/frontend/css/stm-listing.css', array(), time(), 'all' );

        //Scripts
        wp_enqueue_script( 'stm-login-handle', STM_ASSETS. '/frontend/js/login.js', array('jquery'), time(), true);
        wp_enqueue_script( 'stm-listing-main', STM_ASSETS. '/frontend/js/main.js', array('jquery'), time(), true);
        wp_enqueue_script( 'stm-dashboard', STM_ASSETS. '/frontend/js/dashboard.js', array(), time(), true);
        wp_enqueue_script( 'stm-bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), time(), true);
        wp_enqueue_script('stm-profile', STM_ASSETS. '/frontend/js/profile.js', array('jquery'), time(), true );
        

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

        /**
         * Ajax profile
         */

         wp_localize_script( 'stm-profile','stm_profile_object', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'loading_message' => esc_html__( 'Saving User Info, please wait ....', 'startups-market'),
            'login_error_message' => esc_html__( 'We have a internal Problem. Please try again after sometime', 'startups-market' ),
         ] );

    }

    public function stm_admin_asset(){
        wp_enqueue_style( 'stm-admin', STM_ASSETS. '/admin/css/stm-admin.css', array(), time(), 'all' );
        wp_enqueue_style( 'stm-metabox', STM_ASSETS. '/admin/css/metabox.css', array(), time(), 'all' );
        wp_enqueue_script( 'stm-admin-query', STM_ASSETS. '/admin/js/admin.js', array( 'jquery' ), time(), true );
        wp_enqueue_script( 'stm-metabox-query', STM_ASSETS. '/admin/js/metabox.js', array( 'jquery' ), time(), true );
    }


}