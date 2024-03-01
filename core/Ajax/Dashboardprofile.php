<?php

namespace Startups\Market\Ajax;
use Startups\Market\Singleton\SingletonTrait;

class Dashboardprofile
{
    use SingletonTrait;
    
    public function __construct()
    {
        add_action('wp_ajax_stm_profile', [$this, 'stm_profile_form_ajax']);
        add_action('wp_ajax_nopriv_stm_profile', [$this, 'stm_profile_form_ajax']);
    }

    public function stm_profile_form_ajax()
    {
        //Check nonce using check_ajax_referer
        check_ajax_referer('stm_user_prof', 'stm_user_prof_nonce');

        if (!is_user_logged_in()) {
            wp_send_json([
                'status' => 'error',
                'message' => __('You are not allowed to make changes.', 'startups-market'),
            ]);
        }

        $user_id = get_current_user_id();
        $phone_num = get_user_meta($user_id, 'phone_number', true);
        $website_url = get_the_author_meta('user_url', $user_id);
        $author_bio = get_the_author_meta('description', $user_id);
        $user_data = get_userdata($user_id);

        $first_name = sanitize_text_field($_POST['stm_first_name'] ?? $user_data->first_name);
        $last_name = sanitize_text_field($_POST['stm_last_name'] ?? $user_data->last_name);
        $phone = sanitize_text_field($_POST['stm_user_phone'] ?? $phone_num);
        $website = sanitize_text_field($_POST['stm_website'] ?? $website_url);
        $address = sanitize_text_field($_POST['stm_user_address'] ?? '');
        $new_pass = sanitize_text_field($_POST['stm_user_new_pass'] ?? '');
        $confirm_pass = sanitize_text_field($_POST['stm_user_con_pass'] ?? '');
        $author_description = sanitize_textarea_field($_POST['stm_user_bio'] ?? $author_bio);

        // Update user data
        $user_data->first_name = $first_name;
        $user_data->last_name = $last_name;
        $user_data->user_url = $website;
        $user_data->description = $author_description;

        wp_update_user($user_data);
        update_user_meta($user_id, 'phone_number', $phone);

        // Prepare the response array
        $response = ['status' => 'success', 'message' => __('Your changes have been saved successfully.', 'startups-market')];

        // Check if passwords match and are not empty
        if (!empty($new_pass) && $new_pass === $confirm_pass) {
            // Update password
            wp_set_password($new_pass, $user_id);
            $response['passwordsaved'] = true;
            $response['p_message'] = __('Password changed!', 'startups-market');
        } elseif (!empty($new_pass) || !empty($confirm_pass)) {
            // Passwords provided but do not match
            $response['passwordsaved'] = false;
            $response['p_message'] = __('Password mismatch!', 'startups-market');
        }

        // Send JSON response
        wp_send_json($response);
    }
}
