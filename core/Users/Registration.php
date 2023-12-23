<?php 

namespace Startups\Market\Users;

/**
 *  Registration class Handler
 */


use Startups\Market\Notice\Notice_Handler;
use Startups\Market\Email\EmailHandler;

class Registration{
    
    public function __construct(){
        add_shortcode( 'registration_form', [ $this, 'registration_form_shortcode' ] );
        add_action( 'init', [ $this, 'registration_form_process' ]);
        add_action( 'init', [ $this, 'verification_token_handling' ] );
    }


    /**
     * Registration Form Shortcode
     *
     * @return
     */
    public function registration_form_shortcode(){

        if( ! is_user_logged_in() ){
            ob_start();
            if( isset( $_SESSION[ 'registration_notice' ]) ){
                Notice_Handler::show_register_confirmation( apply_filters( 'stm_message_for_registration_confirmation', $_SESSION['registration_notice'] ) );
            }
            include( plugin_dir_path( __FILE__ ). 'views/registration-form.php');
            return ob_get_clean();
        }

        $error_message = __( 'Registration page is only for unregistered users', 'startups-market' );

        ob_start();
        Notice_Handler::show_logged_in_message( apply_filters( 'stm_message_for_loggedin_users', $error_message) );
        return ob_get_clean();  
        
    }

    /**
     * User Creation process
     */

     private function create_user($email, $first_name, $last_name, $phone, $country, $buy_sell_option, $password){

        //Determine Role
        $role = ( $buy_sell_option === 'sell') ? 'seller' : 'buyer';

        //User data array
        $user_data = [
            'user_login' => $email,
            'user_email' => $email,
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'user_pass'  => $password,
            'role'       => $role,
        ];

        $user_id = wp_insert_user( $user_data );

        if (is_wp_error($user_id)) {
            return $user_id;
        }

        wp_set_password( $password, $user_id );


        return $user_id;

     }

    /**
     * Processing the Registration Form
     *
     * @return
     */
    public function registration_form_process(){
        if( isset( $_POST[ 'submit_registration' ] ) && wp_verify_nonce( $_POST[ 'registration_nonce' ], 'registration_nonce_field' ) ){

            $first_name = sanitize_text_field( $_POST[ 'first_name' ] );
            $last_name = sanitize_text_field( $_POST[ 'last_name' ] );
            $email = sanitize_email( $_POST[ 'reg_email' ] );
            $phone = sanitize_text_field( $_POST[ 'phone_number' ] );
            $country = sanitize_text_field( $_POST[ 'country' ] );
            $buy_sell_option = sanitize_text_field( $_POST[ 'buy_sell_option' ] );
            $password = sanitize_text_field( $_POST[ 'password' ] );

            // Email validation
            if( ! is_email( $email ) ){
                wp_die( __( 'Invalid Email Address', 'startups-market' ), __( 'Error', 'startups-market' ), array( 'response' => 400 ) );
            }

            //Create user
            $user_id = $this->create_user( $email, $first_name, $last_name, $phone, $country, $buy_sell_option, $password );

            //User creation Error Handling
            if( is_wp_error( $user_id ) ){
                wp_die( implode( '<br />', $user_id->get_error_messages() ), __( 'Error', 'startups-market' ), array( 'response' => 400 ) );
            }else{
            //adding extra field user meta
                update_user_meta( $user_id, 'phone_number', $phone );
                update_user_meta( $user_id, 'country', $country );

                $this->send_verification_email($user_id, $email, $first_name);

                wp_redirect( site_url('/stm-login') );

            }

            //User registration successful flag
            $registration_success = true;

            //adding a notice message
            $_SESSION[ 'registration_notice' ] = __('Thank you for Registering. Please check your email and verify the email address.', 'startups-market' );

        }
  
    }


    private function send_verification_email($user_id, $email, $first_name ){

        //Generate Verification Token
        $verification_token = wp_generate_password( 32, false );

        update_user_meta( $user_id, 'verification_token', $verification_token );

        $verification_link = esc_url(add_query_arg(['token' => $verification_token], site_url('/verify')));

        $email_handler = new EmailHandler();
         $email_handler->send_user_register_confirmation( $email, $first_name, $verification_link );
    }

    public function verification_token_handling(){

        if( isset( $_GET[ 'token' ] ) ){
            $token = sanitize_text_field($_GET['token']);
            $user_id = $this->get_user_by_verification_token($token);

            if( $user_id ){
                update_user_meta( $user_id, 'email_verified', true);
                wp_redirect(site_url( '/stm-login' ));
                exit;
            }
        }

    }

    private function get_user_by_verification_token( $token){
        global $wpdb;

        $user_id = $wpdb->get_var( $wpdb->prepare(
            "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = 'verification_token' AND meta_value = %s", $token
        ));

        return $user_id;
    }

}
