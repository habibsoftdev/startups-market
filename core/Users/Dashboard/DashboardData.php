<?php 

namespace Startups\Market\Users\Dashboard;

class DashboardData{

    public function __construct(){
       $this->process_dashboard_profile_data();
    }

    public function process_dashboard_profile_data(){
        if ( isset($_POST['dashboard_profile_save'])) {
        
          // Verify nonce
          if (isset($_POST['stm_user_profile_wpnonce']) && wp_verify_nonce($_POST['stm_user_profile_wpnonce'], 'stm_user_profile_nonce')) {
        
            // Get the current user ID
            $user_id = get_current_user_id();
        
            // Handle profile picture upload
            if (!empty($_FILES['profile_picture']['tmp_name'])) {
              // File upload configuration
              $file = $_FILES['profile_picture'];
              $overrides = array('test_form' => false);
        
              // Handle the file upload
              $file_info = wp_handle_upload($file, $overrides);
        
              // Check for errors
              if (!empty($file_info['error'])) {
                echo '<div class="error-message">' . esc_html($file_info['error']) . '</div>';
              } else {
                // Update user meta with the attachment ID
                update_user_meta($user_id, 'profile_picture', $file_info['url']);
              }
            }
        
            // Update user information
            update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['first_name_pr']));
            update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['last_name_pr']));
            update_user_meta($user_id, 'phone_number', sanitize_text_field($_POST['phone_pr']));
            update_user_meta($user_id, 'user_url', esc_url_raw($_POST['user_website_pr']));
            update_user_meta($user_id, 'user_address', sanitize_text_field($_POST['user_address_pr']));
            update_user_meta($user_id, 'description', wp_kses_post($_POST['user_bio_pr']));
// Assuming bio is stored as description
        
            // Update user password if provided
            if (!empty($_POST['new_pass_pr']) && !empty($_POST['confirm_pass_pr']) && $_POST['new_pass_pr'] === $_POST['confirm_pass_pr']) {
              wp_set_password($_POST['new_pass_pr'], $user_id);
            }
        
            // Redirect or add a success message as needed
            // header('Location: success-page-url'); // Redirect to a success page
        
            echo '<div class="success-message">Changes saved successfully!</div>';
        
          } else {
            echo '<div class="error-message">Invalid nonce. Form submission failed.</div>';
          }
        }
        
    }


}