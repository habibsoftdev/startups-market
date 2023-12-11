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

     public function create_user_roles(){
        add_role( 'seller', __( 'Seller', 'startups-market' ), [
            'read'               => true,
            'upload_project'     => true,
            'manage_own_project' => true, ]
        );

        add_role( 'buyer', __( 'Buyer', 'startups-market' ), [
         'read' => true,]

     );

     }

     
 }