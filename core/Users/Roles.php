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
        $this->create_user_roles();
      
     }

     /**
      * Create User Role for Buyer and Sellers
      */
     public function create_user_roles(){
        $existing_roles = wp_roles()->get_names();

        if( ! isset( $existing_roles[ 'seller' ] ) ){

            add_role( 'seller', __( 'Seller', 'startups-market' ), [
                'read'               => true,
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

        
 }