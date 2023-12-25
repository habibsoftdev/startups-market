<?php

namespace Startups\Market;


/**
 * Ajax Handler Class
 */
class Ajaxhandler{

    public function __construct()
    {
    add_action('wp_ajax_nopriv_stm_ajax_login', [$this, 'handle_ajax_login']);
    add_action('wp_ajax_stm_ajax_login', [$this, 'handle_ajax_login']);

    }

    public function handle_ajax_login()
    {
        $received_nonce = isset( $_POST[ 'security' ] ) ? sanitize_text_field( $_POST[ 'security' ] ) : '';
        if( ! wp_verify_nonce( $received_nonce, 'stm-ajax-login-nonce' ) ){
            wp_send_json([
                'loggedin' => false,
                'message' => __( 'Something went wrong, please reload the page', 'startups-market' ),
                'nonce_failed' => true,
            ]);    
            
        }

        if ( is_user_logged_in() ) {
            wp_send_json([
                'loggedin' => true,
                'message' => __( 'You are already logged in.', 'startups-market' ),
            ]);
            
        }

        $user_email = ( ! empty( $_POST[ 'login_email' ] ) ) ? sanitize_email( $_POST[ 'login_email' ] ) : '';

        if (empty($user_email)) {
            wp_send_json([
            'loggedin' => false,
            'message' => __( 'Username/Email field is empty.', 'startups-market' ),
            ]);
        }
       
        $user_password = ( ! empty( $_POST[ 'login_pass' ] ) ) ? $_POST[ 'login_pass' ] : '';

        $user = get_user_by( 'email', $user_email );
        if ( !$user || is_wp_error( $user ) ) {
            wp_send_json([
                'loggedin' => false,
                'message' => __( 'Invalid user or user not found.', 'startups-market' ),
            ]);
        }

        $verification = get_user_meta( $user->ID, 'email_verified', true) ;

        if ( ! $verification ) {
            wp_send_json([
                'loggedin' => false,
                'message' => __( 'You must verify your email before logging in.', 'startups-market' ),

            ]);
            
        }

        $logged_in_user = wp_signon([
            'user_login'    => $user_email,
            'user_password' => $user_password,
            
        ]);

        if ( is_wp_error( $logged_in_user ) ) {
            wp_send_json([
                'loggedin' => false,
                'message' => $logged_in_user->get_error_message(),
            ]);
            
        } else {
            wp_set_current_user( $logged_in_user->ID );
            wp_send_json([
                'loggedin' => true,
                'message' => __( 'Login successful, Redirecting..', 'startups-market' ),
                
            ]);
            
        }
        
    }


   
}
