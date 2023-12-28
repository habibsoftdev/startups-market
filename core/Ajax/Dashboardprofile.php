<?php  

namespace Startups\Market\Ajax;

class Dashboardprofile{
    
    public function __construct(){
        add_action('wp_ajax_upload_user_image', 'upload_user_image');
        add_action('wp_ajax_nopriv_upload_user_image', 'upload_user_image');
    }

    public function upload_user_image(){
      if( isset( $_POST[ 'dashboard_profile_save' ] ) ){

        $nonce = isset($_POST['stm_user_profile_wpnonce']) ? sanitize_text_field($_POST['stm_user_profile_wpnonce']) : '';

        if( ! wp_verify_nonce( $nonce, 'stm_user_profile_nonce' ) ){
            return;
        }

        $user_id = get_current_user_id();
        
      }
    }

}