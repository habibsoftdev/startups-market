<?php 

namespace Startups\Market\Users\Dashboard;
use Startups\Market\Notice\Notice_Handler;

class DashboardData{

    public function __construct(){
       $this->process_dashboard_profile_data();
    }

    public function process_dashboard_profile_data(){
        
      if( isset( $_POST[ 'stm_user_save_changes'] ) && wp_verify_nonce( $_POST[ 'stm_user_prof_nonce' ], 'stm_user_prof' ) ){

        $curernt_user = wp_get_current_user();
        $user_id = get_current_user_id();
        $phone_num = get_user_meta( $user_id, 'phone_number', true);
        $website_url = get_the_author_meta( 'user_url', $user_id );
        $author_bio = get_the_author_meta( 'description', $user_id );
        $user_data = get_userdata( $user_id );

        $first_name = isset( $_POST[ 'stm_first_name' ] ) ? sanitize_text_field( $_POST[ 'stm_first_name' ] ) : $curernt_user->first_name;

        $last_name = isset( $_POST[ 'stm_last_name' ] ) ? sanitize_text_field( $_POST[ 'stm_last_name' ] ) : $curernt_user->last_name;

        $phone = isset( $_POST[ 'stm_user_phone' ] ) ? sanitize_text_field( $_POST[ 'stm_user_phone' ] ) : $phone_num;

        $website = isset( $_POST[ 'stm_website' ] ) ? sanitize_text_field( $_POST[ 'stm_website' ] ) : $website_url;

        $address = isset( $_POST[ 'stm_user_address' ] ) ? sanitize_text_field( $_POST[ 'stm_user_address' ] ) : '';

        $new_pass = isset( $_POST[ 'stm_user_new_pass' ] ) ? sanitize_text_field( $_POST[ 'stm_user_new_pass' ] ) : '';

        $confirm_pass = isset( $_POST[ 'stm_user_con_pass' ] ) ? sanitize_text_field( $_POST[ 'stm_user_con_pass' ] ) : '';

        $author_description = isset( $_POST[ 'stm_user_bio' ] ) ? sanitize_textarea_field( $_POST[ 'stm_user_bio' ] ) : $author_bio;

        $user_data->first_name = $first_name;
        $user_data->last_name = $last_name;
        $user_data->user_url = $website;
        $user_data->description = $author_description;
         
        wp_update_user( $user_data );
        update_user_meta($user_id, 'phone_number', $phone);

        if( ! empty( $new_pass ) && ! empty( $confirm_pass ) && $new_pass === $confirm_pass ) {

          wp_set_password( $new_pass, $user_id );
        }




      }
        
    }


}