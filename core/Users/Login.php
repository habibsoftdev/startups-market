<?php 

namespace Startups\Market\Users;

use Startups\Market\Notice\Notice_Handler;
use Startups\Market\Ajax;
use Startups\Market\Trait\SingletonTrait;


/**
 * Login Class Handler
 */
class Login{

    use SingletonTrait;
    public function __construct(){
        add_shortcode( 'login_form', [ $this, 'stm_login_form_for_user' ] );
    }

    /**
     * Login 
     *
     * @return mixed
     */
    public function stm_login_form_for_user(){
        
        if( ! is_user_logged_in() ){

                ob_start();
                include(plugin_dir_path(__FILE__). 'views/login-form.php');
                return ob_get_clean();
            
             
        }else{
            $error_message = __( 'Login page is not for logged-in user', 'startups-market' );
            
            Notice_Handler::show_logged_in_message( apply_filters( 'stm_message_for_loggedin_users', $error_message ) );
            
        }

    }

}