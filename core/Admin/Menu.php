<?php  

namespace Startups\Market\Admin;

/**
 * The Menu Handler Class
 */
class Menu{

    /**
     * Class Constructor
     */
    function __construct(){
        add_action( 'admin_menu', [ $this, 'admin_menu_bar' ] );
    }

    public function admin_menu_bar(){
        $parent_slug = 'startups_market';
        $capability = 'manage_options';

        add_menu_page(
            __( 'Startups Market', 'startups-market' ),
            __( 'Startups Market', 'startups-market' ),
            $capability,
            $parent_slug,
            [ $this, 'plugins_page' ],
            'dashicons-portfolio',
            20
        );

        add_submenu_page(
            $parent_slug,
            __( 'Businesses List', 'startups-market' ),
            __( 'Businesses List', 'startups-market' ),
            $capability,
            $parent_slug,
            [ $this, 'plugins_page' ]
            
        );

        add_submenu_page(
            $parent_slug,
            __( 'Buyers', 'startups-market' ),
            __( 'Buyers', 'startups-market' ),
            $capability,
            'stm-buyer-list',
            [ $this, 'buyer_list' ]
            
        );

        add_submenu_page(
            $parent_slug,
            __( 'Sellers', 'startups-market' ),
            __( 'Sellers', 'startups-market' ),
            $capability,
            'stm-seller-list',
            [ $this, 'seller_list' ]
            
        );

        add_submenu_page(
            $parent_slug,
            __( 'Payment List', 'startups-market' ),
            __( 'Payment List', 'startups-market' ),
            $capability,
            'stm-payment-list',
            [ $this, 'payment_list' ]
            
        );

        add_submenu_page(
            $parent_slug,
            __( 'Settings', 'startups-market' ),
            __( 'Settings', 'startups-market' ),
            $capability,
            'stm-settings',
            [ $this, 'settings' ]
            
        );
    }

    public function plugins_page(){
        echo "hello";
    }


    public function payment_list(){

    }

    public function buyer_list(){

    }

    public function seller_list(){

    }

    public function settings(){

    }
}