<?php 

namespace Startups\Market\Users\AddListing;
use Startups\Market\Notice\Notice_Handler;
use Startups\Market\Stm_Utils;


class AddListing{

    public function __construct(){

        add_shortcode( 'stm_add_listing', [ $this, 'stm_add_listing_callback' ] );
    }

    public function stm_add_listing_callback(){

        if( is_user_logged_in() ){

            ob_start();
            include(plugin_dir_path(__FILE__). 'views/addlisting-views.php');
            echo Stm_Utils::edit_link();
            return ob_get_clean();
        }else{
            $errors = __( 'You need to log in to add your business', 'startups-market' );
        
        Notice_Handler::show_for_nonloggedin_user( apply_filters( 'stm_message_for_nonloggedin_users', $errors ) );
        }
    }
}