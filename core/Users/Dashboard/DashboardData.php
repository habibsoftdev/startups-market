<?php 

namespace Startups\Market\Users\Dashboard;

class DashboardData{

    public function __construct(){
       
    }

    public function process_dashboard_profile_data(){
      if( isset( $_POST[ 'dashboard_profile_save' ] ) ){

        $nonce = isset($_POST['stm_user_profile_wpnonce']) ? sanitize_text_field($_POST['stm_user_profile_wpnonce']) : '';

        if( ! wp_verify_nonce( $nonce, 'stm_user_profile_nonce' ) ){
            return;
        }

        $user_id = get_current_user_id();
        
      }
    }


}