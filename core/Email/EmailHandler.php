<?php 

namespace Startups\Market\Email;
use Startups\Market\Singleton\SingletonTrait;

use WP_User;

/**
 * Email Handler class
 */

 class EmailHandler{

    use SingletonTrait;

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

    public function send_seller_listing_published_confirmation(  $email, $firstname, $title){

        $title = __( ' Congratulations! Your Business Listing is Now Live!', 'startups-market' );
        $subject = sprintf( __( 'In [%s] Your Listing Live Now !', 'startups-market' ), get_bloginfo( 'blogname', 'display' ) );
        $header = 'Listing is Live now!';
        $site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
        $body = sprintf( __( "Hi %s,
        We are thrilled to inform you that your Business Listing %s on %s has been approved and is now live to discover. Congratulations!

        We believe that your unique offerings will be a valuable addition to our platform, and we look forward to seeing your business sold out within our community.
        

        Thanks,
        Operation Team.

			 ", 'startups-market' ), $firstname, $site_name, $title);

        $body = stm_email_html( $title, $body);

        return $this->stm_send_email( $email, $subject, $body, $header );
    }

    public function send_seller_listing_soldout_confirmation(  $email, $firstname, $title){

        $title = __( 'Congratulations! Your Business Listing Has Been Sold!', 'startups-market' );
        $subject = sprintf( __( 'In [%s] Business Listing Has Been Sold!', 'startups-market' ), get_bloginfo( 'blogname', 'display' ) );
        $header = 'Your Listing Has been Sold Out!';
        $site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
        $body = sprintf( __( "Hi %s,
        We are thrilled to inform you that your business listing %s on %s has been successfully sold! 🎉 This is a significant achievement, and we want to extend our warmest congratulations to you.

        We understand the hard work and dedication you put into creating and maintaining your business, and we're delighted to see it find a new owner. This success is a testament to the value of your offering.

        Please Provide All the deliveryable Assets to the client.

        Note: Once Client Approve the Order You will get option to withdraw the money.
        

        Thanks,
        Operation Team.

			 ", 'startups-market' ), $firstname, $site_name, $title);

        $body = stm_email_html( $title, $body);

        return $this->stm_send_email( $email, $subject, $body, $header );
    }
 }