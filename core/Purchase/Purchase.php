<?php

namespace Startups\Market\Purchase;


/**
 * Woocommerce Handler Class
 */

class Purchase{

    public function __construct(){
        add_filter( 'woocommerce_get_page_id', [ $this, 'prevent_woocommerce_page_creation' ] );
        add_filter('woocommerce_cart_redirect_after_error', '__return_false');
        add_filter('woocommerce_is_cart', '__return_false');
        add_filter('woocommerce_account_menu_items', '__return_empty_array');
        add_filter( 'woocommerce_is_sold_individually', [ $this, 'disable_quantity_field' ] );
        //add_action( 'admin_init', [ $this, 'wc_admin_init' ] );
        

       
    }

    /**
     * Prevent Woocommerce Default Page
     *
     * @param int $page_id
     * @return int
     */
    public function prevent_woocommerce_page_creation( $page_id ){
        $blocked_pages = array(
            'cart',
            'myaccount',
            'view_order',
            'terms'
            // Add more pages you want to block as needed
        );
    
        if (in_array($page_id, $blocked_pages)) {
            return -1;
        }
    
        return $page_id;
    }

    /**
     * Diasable Quantity
     *
     * @return bool
     */
    public function disable_quantity_field(){
        return true;
    }

  

}