<?php
namespace Startups\Market\Users\AddListing;

use function wp_handle_upload;

class ListingHandle {

    public function __construct() {
        add_action('init', [$this, 'handleListingForm']);
    }

    public function handleListingForm() {
        if (isset($_POST['stm_list_submit']) && wp_verify_nonce($_POST['stm_add_list_nonce'], 'stm_add_list')) {
            $title = isset($_POST['stm_list_title']) ? sanitize_text_field($_POST['stm_list_title']) : '';

            $new_post = array(
                'post_title'   => $title,
                'post_content' => wp_kses_post($_POST['stm_list_content']),
                'post_status'  => 'pending',
                'post_type'    => 'business',
            );

            $new_post_id = wp_insert_post($new_post);

            if (!is_wp_error($new_post_id)) {
                if (!empty($_FILES['list_thumbnail_url']['tmp_name'])) {
                    $file_handler = isset($_FILES['list_thumbnail_url']) ? $_FILES['list_thumbnail_url'] : [];
                    $attachment_ids = $this->handleImageUpload($file_handler, $new_post_id);

                    if (!empty($attachment_ids)) {
                        update_post_meta($new_post_id, 'stm_images_id', implode(';', $attachment_ids));
                        set_post_thumbnail($new_post_id, $attachment_ids[0]);

                        $attachment_urls = array_map('wp_get_attachment_url', $attachment_ids);
                        update_post_meta($new_post_id, 'stm_images_url', implode(';', $attachment_urls));
                        
                    }
                }
            }

            $stm_list_arr = isset($_POST['stm_list_arr']) ? sanitize_text_field($_POST['stm_list_arr']) : '';
            $stm_list_hrr = isset($_POST['stm_list_hrr']) ? sanitize_text_field($_POST['stm_list_hrr']) : '';
            $stm_list_launched = isset($_POST['stm_list_launched']) ? sanitize_text_field($_POST['stm_list_launched']) : '';
            $stm_list_asset = isset($_POST['stm_list_asset']) ? sanitize_text_field($_POST['stm_list_asset']) : '';
            $stm_list_website = isset($_POST['stm_list_website']) ? sanitize_text_field($_POST['stm_list_website']) : '';
            $stm_list_tagline = isset($_POST['stm_list_tagline']) ? sanitize_text_field($_POST['stm_list_tagline']) : '';
            $stm_list_price = isset($_POST['stm_list_price']) ? sanitize_text_field($_POST['stm_list_price']) : '';
            $stm_list_video = isset($_POST['stm_list_video']) ? sanitize_text_field($_POST['stm_list_video']) : '';

            update_post_meta($new_post_id, 'stm_arr', $stm_list_arr);
            update_post_meta($new_post_id, 'stm_sarr', $stm_list_hrr);
            update_post_meta($new_post_id, 'stm_launched', $stm_list_launched);
            update_post_meta($new_post_id, 'deliveryable_text', $stm_list_asset);
            update_post_meta($new_post_id, 'stm_website', $stm_list_website);
            update_post_meta($new_post_id, 'stm_tagline', $stm_list_tagline);
            update_post_meta($new_post_id, 'stm_price', $stm_list_price);
            update_post_meta($new_post_id, 'stm_videourl', $stm_list_video);
        }
    }

    public function handleImageUpload($file_handler, $post_id)
    {
        if (!empty($file_handler) && is_array($file_handler['name'])) {
            $attachment_ids = [];

            foreach ($file_handler['name'] as $key => $value) {
                $file = [
                    'name'     => $file_handler['name'][$key],
                    'type'     => $file_handler['type'][$key],
                    'tmp_name' => $file_handler['tmp_name'][$key],
                    'error'    => $file_handler['error'][$key],
                    'size'     => $file_handler['size'][$key],
                ];

                $attachment_id = $this->handleSingleImageUpload($file, $post_id);

                if (!is_wp_error($attachment_id)) {
                    $attachment_ids[] = $attachment_id;
                }
            }

            return $attachment_ids;
        } elseif (!empty($file_handler['tmp_name'])) {
            $attachment_id = $this->handleSingleImageUpload($file_handler, $post_id);
            return $attachment_id ? [$attachment_id] : [];
        }

        return [];
    }

    private function handleSingleImageUpload($file_handler, $post_id)
    {
        // Include necessary WordPress files
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/post.php';

        $upload_overrides = ['test_form' => false];
        $uploadedfile = [
            'name'     => isset($file_handler['name']) ? $file_handler['name'] : '',
            'type'     => isset($file_handler['type']) ? $file_handler['type'] : '',
            'tmp_name' => isset($file_handler['tmp_name']) ? $file_handler['tmp_name'] : '',
            'error'    => isset($file_handler['error']) ? $file_handler['error'] : 0,
            'size'     => isset($file_handler['size']) ? $file_handler['size'] : 0,
        ];

        $upload = wp_handle_upload($uploadedfile, $upload_overrides);

        if (!is_wp_error($upload)) {
            $attachment_id = wp_insert_attachment(
                [
                    'guid'           => isset($upload['url']) ? $upload['url'] : '',
                    'post_mime_type' => isset($upload['type']) ? $upload['type'] : '',
                    'post_title'     => basename($upload['file']),
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                ],
                $upload['file']
            );

            return is_wp_error($attachment_id) ? false : $attachment_id;
        }

        return false;
    }
}