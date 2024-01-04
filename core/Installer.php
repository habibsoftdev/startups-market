<?php 

namespace Startups\Market;

/**
 * Handle all the class in core file
 */
class Installer{

    public function __construct(){
        if( is_admin() ){
            new Admin\Menu();
           
        }

        new Users\Extrafield();
        new Assetsload();
        new Users\Registration();
        new Users\Login();
        new Users\Dashboard\Dashboard();
        new Users\Dashboard\DashboardData();
        new Admin\Businesslist();
        new Metabox\Metabox();
        new Users\AddListing\AddListing();


        if( defined('DOING_AJAX') && DOING_AJAX ){
            new Ajax\Loginhandler();
        }
    }

}