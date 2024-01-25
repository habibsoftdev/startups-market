<?php 

namespace Startups\Market;
use Startups\Market\Trait\SingletonTrait;

/**
 * Assets Loading Class Handler
 */

class Assetsload{

    use SingletonTrait;
    
    public function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'stm_frontend_asset_load' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'stm_admin_asset']);
    }
    
    public function stm_frontend_asset_load(){
        //Styles
        wp_enqueue_style('bootstrap-stm-ds', '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), time(), 'all');
        wp_enqueue_style('slick-css', '//raw.githack.com/SochavaAG/example-mycode/master/pens/slick-slider/plugins/slick/slick.css', array(), time(), 'all');
        wp_enqueue_style( 'stm-register-form', STM_ASSETS. '/frontend/css/register.css', array(), time(), 'all' );
        wp_enqueue_style( 'stm-dashboard', STM_ASSETS. '/frontend/css/dashboard.css', array('bootstrap-stm-ds'), time(), 'all' );
        wp_enqueue_style( 'stm-listing-form', STM_ASSETS . '/frontend/css/stm-listing.css', array(), time(), 'all' );
        wp_enqueue_style( 'stm-single-business', STM_ASSETS . '/frontend/css/stm-single.css', array(), time(), 'all' );
        wp_enqueue_style( 'stm-single-slider', STM_ASSETS . '/frontend/css/stm-slider.css', array(), time(), 'all' );
        wp_enqueue_style( 'stm-archive', STM_ASSETS . '/frontend/css/archive.css', array(), time(), 'all' );

        //Scripts
        wp_enqueue_script( 'stm-login-handle', STM_ASSETS. '/frontend/js/login.js', array('jquery'), time(), true);
        wp_enqueue_script( 'stm-listing-main', STM_ASSETS. '/frontend/js/main.js', array('jquery'), time(), true);
        wp_enqueue_script( 'stm-dashboard', STM_ASSETS. '/frontend/js/dashboard.js', array('jquery'), time(), true);
        wp_enqueue_script( 'stm-bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), time(), true);
        wp_enqueue_script('stm-profile', STM_ASSETS. '/frontend/js/profile.js', array('jquery'), time(), true );
        wp_enqueue_script('stm-delete', STM_ASSETS. '/frontend/js/delete.js', array('jquery'), time(), true );
        wp_enqueue_script('stm-retriveImage', STM_ASSETS. '/frontend/js/retriveImage.js', array('jquery'), time(), true );
        wp_enqueue_script('stm-slider', STM_ASSETS. '/frontend/js/stm-slider.js', array('jquery', 'stm-slick'), time(), true );
        
        wp_enqueue_script('stm-slick', '//raw.githack.com/SochavaAG/example-mycode/master/pens/slick-slider/plugins/slick/slick.min.js', array('jquery'), true );


        
       

        

        /**
         * Ajax localize login
         */
        wp_localize_script('stm-login-handle', 'stm_ajax_object', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'redirect_url' => home_url('/stm-dashboard'),
            'loading_message' => esc_html__( 'Sending user info, please wait ...', 'startups-market' ),
            'login_error_message' => esc_html__( 'Wrong username or password.', 'startups-market' ),
        ]);

        /**
         * Ajax profile
         */

         wp_localize_script( 'stm-profile','stm_profile_object', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'loading_message' => esc_html__( 'Saving User Info, please wait ....', 'startups-market'),
            'login_error_message' => esc_html__( 'We have a internal Problem. Please try again after sometime', 'startups-market' ),
         ] );

         /**
          * Ajax Delete
          */
          $delete_nonce = wp_create_nonce('delete_listing_nonce');
          wp_localize_script( 'stm-delete', 'stm_delete_object', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'confirm_message' => __( 'Are you sure you want to delete this listing?', 'startups-market' ),
            'delete_nonce' => $delete_nonce,
          ]);

    }

    public function stm_admin_asset(){
        wp_enqueue_style( 'stm-admin', STM_ASSETS. '/admin/css/stm-admin.css', array(), time(), 'all' );
        wp_enqueue_style( 'stm-metabox', STM_ASSETS. '/admin/css/metabox.css', array(), time(), 'all' );
        wp_enqueue_script( 'stm-admin-query', STM_ASSETS. '/admin/js/admin.js', array( 'jquery' ), time(), true );
        wp_enqueue_script( 'stm-metabox-query', STM_ASSETS. '/admin/js/metabox.js', array( 'jquery' ), time(), true );
    }


}