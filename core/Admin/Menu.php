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
        add_menu_page(
            __( 'Startups Market', 'startups-market' ),
            __( 'Startups Market', 'startups-market' ),
            'manage_options',
            'startups_market',
            [ $this, 'plugins_page' ],
            'dashicons-portfolio'
        );
    }

    public function plugins_page(){
        echo "hello";
    }
}