<?php 

namespace Startups\Market\Admin\Tab;

/**
 * Admin Settings Page Tab Content Class
 */
class PaymentTab{

    /**
     * Create instance for once
     *
     * @return bool
     */
    public static function init(){
        static $instance = false;

        if( ! $instance ){
            $instance = new self();
        }

        return $instance;
    }
}