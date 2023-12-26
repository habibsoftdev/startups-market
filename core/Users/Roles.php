<?php 

namespace Startups\Market\Users;

/**
 * User role handler Class
 */

 class Roles{

    /**
     * class Constructor
     */

     public function __construct(){
        add_action( 'after_setup_theme', [ $this, 'hide_admin_bar']);
        $this->create_user_roles();
      
     }

     /**
      * Create User Role for Buyer and Sellers
      */
     public function create_user_roles(){
        $existing_roles = wp_roles()->get_names();

        if( ! isset( $existing_roles[ 'seller' ] ) ){

            add_role( 'seller', __( 'Seller', 'startups-market' ), [
                'read'               => false,
                'upload_project'     => true,
                'manage_own_project' => true, ]
            );

        }
        if( ! isset( $existing_roles[ 'buyer' ] ) ){
            add_role( 'buyer', __( 'Buyer', 'startups-market' ), [
                'read' => true,]

            );
        }

    }

    /**
    * Hide admin Bar
    */
    public function hide_admin_bar(){

        $current_user = get_current_user();

        if( $current_user == 'buyer' || $current_user == 'seller' ) {
            add_action('init', function () {
                add_filter('show_admin_bar', '__return_false');
            });
        }
    }

        
 }