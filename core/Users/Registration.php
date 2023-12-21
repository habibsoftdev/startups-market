<?php 

namespace Startups\Market\Users;

/**
 *  Registration class Handler
 */


use Startups\Market\Notice_Handler;

class Registration{
    
    public function __construct(){
        add_shortcode( 'registration_form', [ $this, 'registration_form_shortcode' ] );
        add_action( 'init', [ $this, 'registration_form_process' ]);
    }


    /**
     * Registration Form Shortcode
     *
     * @return
     */
    public function registration_form_shortcode(){

        if( ! is_user_logged_in() ){
            ob_start();
            include(plugin_dir_path(__FILE__). 'views/registration-form.php');
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

            // //Form Field Validation
            // $required_fields = [ $first_name, $last_name, $email, $phone, $country, $buy_sell_option, $password ];

            // foreach($required_fields as $field){
            //     if( empty( $field ) ){
            //         wp_die( __( 'All Fields are Required', 'startups-market' ) );
            //     }
            // }

            // Email validation
            if( ! is_email( $email ) ){
                wp_die( __( 'Invalid Email Address', 'startups-market' ) );
            }

            //Create user
            $user_id = $this->create_user( $email, $first_name, $last_name, $phone, $country, $buy_sell_option, $password );

            //User creation Error Handling
            if( is_wp_error( $user_id ) ){
                wp_die( $user_id->get_error_messages() );
            }else{
                //adding extra field user meta
                update_user_meta( $user_id, 'phone_number', $phone );
                update_user_meta( $user_id, 'country', $country );
            }

        }
  
    }

}
