<?php 
namespace Startups\Market\Users;

/**
 * User role handler Class
 */
class Roles{

    /**
     * Class Constructor
     */
    public function __construct(){

        $this->create_user_roles();
    }

    /**
     * Create User Role for Buyer and Sellers
     */
    public function create_user_roles() {
        $existing_roles = wp_roles()->get_names();

        if( ! isset( $existing_roles[ 'seller' ] ) ){
            add_role( 'seller', __( 'Seller', 'startups-market' ), [
                'read'               => true,
                'edit_posts'         => true,  // Example capability, modify as needed
                'upload_files'       => true,  // Example capability, modify as needed
                'manage_own_project' => true,
                'delete_posts'       => true,
                'publish_posts'      => true,
                'delete_private_posts' => true, 
            ]);
            
            
        }

        if( ! isset( $existing_roles[ 'buyer' ] ) ){
            add_role( 'buyer', __( 'Buyer', 'startups-market' ), [
                'read' => true,
            ]);
        }
    }


}
