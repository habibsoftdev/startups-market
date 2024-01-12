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
        add_action('init', [$this, 'hide_admin_bar']);
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
                'manage_own_project' => true,
                'delete_posts'       => true, ]
            );

        }
        if( ! isset( $existing_roles[ 'buyer' ] ) ){
            add_role( 'buyer', __( 'Buyer', 'startups-market' ), [
                'read' => true,]

            );
        }

    }


        
 }