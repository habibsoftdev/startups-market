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
        new Users\Buyers\BuyerRegister();
    }
}