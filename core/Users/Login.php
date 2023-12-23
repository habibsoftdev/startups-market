<?php 

namespace Startups\Market\Users;

use Startups\Market\Notice\Notice_Handler;

/**
 * Login Class Handler
 */
class Login{

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

            if( isset($_POST[ 'login_submit' ]) && wp_verify_nonce( $_POST[ 'login_nonce' ], 'login_nonce_field' ) ){
                $this->process_login();
            }else{
                ob_start();
                include(plugin_dir_path(__FILE__). 'views/login-form.php');
                return ob_get_clean();
             }
        }
            

        $error_message = __( 'Login page is not for logged-in user', 'startups-market' );

        Notice_Handler::show_logged_in_message( apply_filters( 'stm_message_for_loggedin_users', $error_message ) );
    }

    /**
     * Login Attempt Process
     *
     * @return void
     */
    private function process_login(){
        
        $user_email = sanitize_email( $_POST[ 'login_email'] );
        $user_password = sanitize_text_field( $_POST[ 'login_pass' ] );

        //validate user input

        if( empty( $user_email ) || empty( $user_password ) ) {
            $error = __('Username and password are required.', 'startups-market');
            Notice_Handler::show_login_error( apply_filters( 'stm_login_error_message', $error ) );
            return;
        }

        // check if user is verified
        $user = get_user_by( 'login', $user_email);
        if ( !$user || get_user_meta( $user->ID, 'email_verified', true ) ){
            $error = __('You must verify your email before logging in.', 'startups-market');
            Notice_Handler::show_login_error( apply_filters( 'stm_login_error_message', $error ) );

            return;
        }

        $credentials = [
            'user_login' => $user_email,
            'user_password' => $user_password,
        ];

        $login_result = wp_signon( $credentials, false );

        if( is_wp_error( $login_result ) ){
            Notice_Handler::show_login_error( apply_filters( 'stm_login_error_message', $login_result->get_error_message() ) );

            return;
        }else{
            wp_redirect(home_url());
        }
    }

}