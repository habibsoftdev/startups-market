<?php 

namespace Startups\Market\Email;

use WP_User;

/**
 * Email Handler class
 */

 class EmailHandler{

    

    public function __construct(){
        include_once plugin_dir_path(__FILE__). '../../template/email.php';
        add_filter('wp_mail_from', array($this, 'custom_wp_mail_from'));
    }

    /**
     * Define a function to set the "From" email address for wp_mail
     *
     * @param string $from_email
     * @return string
     */
    public function custom_wp_mail_from($from_email){
        $stm_email = get_option('stm_primary_email');
        $admin_email = get_option( 'admin_email' );

        $custom_from_email = !empty($stm_email) ? $stm_email : $admin_email;

        return $custom_from_email;
    }


    /**
     * Sending Email
     *
     * @param string|array $to
     * @param string $subject
     * @param string $message
     * @param string $headers
     * @return bool
     */
    public function stm_send_email( $to, $subject, $message, $headers ){
        add_filter( 'wp_mail_content_type', [$this, 'html_content_type' ] );
        $sent = wp_mail( $to, html_entity_decode( $subject ), $message, $headers );
        remove_filter( 'wp_mail_content_type', [ $this, 'html_content_type' ] );

        return $sent;
    }

    /**
     * It returns Content type
     *
     * @return string
     */
    public function html_content_type(){
        return 'text/html';
    }

    /**
     * Sending email after registration
     *
     * @param WP_User $user
     * @param string $token_url
     * @return bool
     */
    public function send_user_register_confirmation(  $email, $firstname, $token_url){

        $title = __( 'Verify Your Email Address', 'startups-market' );
        $subject = sprintf( __( '[%s] Verify Your Email', 'startups-market' ), get_bloginfo( 'blogname', 'display' ) );
        $header = 'Confirm Your Verfication';
        $site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
        $body = sprintf( __( "Hi %s,
        Thank you for signing up at %s, to complete the registration, please verify your email address.

			To activate your account simply click on the link below and verify your email address within 24 hours. For your safety, you will not be able to access your account until verification of your email has been completed.

			%s <p align='center'>If you did not sign up for this account you can ignore this email.</p>", 'startups-market' ), $firstname, $site_name, $token_url );

        $body = stm_email_html( $title, $body);

        return $this->stm_send_email( $email, $subject, $body, $header );
    }
 }