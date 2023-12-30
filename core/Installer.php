<?php 

namespace Startups\Market;

/**
 * Handle all the class in core file
 */
class Installer{

    public function __construct(){
        if( is_admin() ){
            new Admin\Menu();
            new Admin\Business();
        }

        new Users\Extrafield();
        new Assetsload();
        new Users\Registration();
        new Users\Login();
        new Users\Dashboard\Dashboard();
        new Users\Dashboard\DashboardData();

        if( defined('DOING_AJAX') && DOING_AJAX ){
            new Ajax\Loginhandler();
        }
    }

}