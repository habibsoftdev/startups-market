<?php

namespace Startups\Market\Users\AddListing;
use Startups\Market\Singleton\SingletonTrait;

use function wp_handle_upload;

/**
 * Listing Value Handler Class
 */
class ListingHandle {

	use SingletonTrait;

    /**
     * Class constructor
     */
	public function __construct() {
		add_action('init', [$this, 'handleListingForm']);
	}

	public function handleListingForm() {
		if (isset($_POST['stm_list_submit']) && wp_verify_nonce($_POST['stm_add_list_nonce'], 'stm_add_list')) {

			$title = isset($_POST['stm_list_title']) ? sanitize_text_field($_POST['stm_list_title']) : '';
			$category = isset( $_POST[ 'category' ] ) ? intval( $_POST[ 'category' ] ) : '';
            //Existing id retrive
			$edit_mode_id = isset($_GET[ 'listing_id' ] ) ? intval( $_GET[ 'listing_id' ] ) : 0;

            //Check if it's edit mode or not
			if( $edit_mode_id && isset( $_GET[ 'action' ] ) ){
                //get existing post status
				$status = get_post_status( $edit_mode_id );
                //Get existing post thumbnail
				$existing_thumb_id = get_post_thumbnail_id($edit_mode_id);

                //Getting the existing ids
				

				$existing_post = [
					'ID'		=> $edit_mode_id,
					'post_title' => $title,
					'post_content' => wp_kses_post($_POST['stm_list_content']),
					'post_status'  => $status,
					'post_type'    => 'business',
				];
				$updated_post_id = wp_update_post( $existing_post );
				wp_set_post_terms($edit_mode_id, $category, 'business_category');

				if (!is_wp_error($updated_post_id)) {
					//Getting the existing ids
					$existing_ids = isset( $_POST['stm_list_img_id']) ? sanitize_text_field( $_POST[ 'stm_list_img_id' ] ) : [];
                	//Getting the existing Urls
					$existing_urls = isset( $_POST['stm_list_img_url']) ? sanitize_text_field( $_POST[ 'stm_list_img_url' ] ) : [];

					

					if (! empty($_FILES['list_thumbnail_url']['tmp_name'] ) ) {
						$new_file_handler = isset($_FILES['list_thumbnail_url']) ? $_FILES['list_thumbnail_url'] : [];

						
						$new_attachment_ids = $this->handleImageUpload($new_file_handler, $edit_mode_id);
						
						$existing_id_separate = explode( ';', $existing_ids );
						
						$both_ids = array_merge( $existing_id_separate, $new_attachment_ids );
						
						

						if (! empty( $both_ids ) ) {
							update_post_meta($edit_mode_id, 'stm_images_id', implode(';', $both_ids));
							
							set_post_thumbnail($edit_mode_id, $both_ids[0]);
							

							$new_attachment_urls = array_map('wp_get_attachment_url', $both_ids);
							update_post_meta($edit_mode_id, 'stm_images_url', implode(';', $new_attachment_urls));

						}else {
							// If there are no images, remove the featured image
							delete_post_thumbnail($edit_mode_id);
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

					update_post_meta($edit_mode_id, 'stm_arr', $stm_list_arr);
					update_post_meta($edit_mode_id, 'stm_sarr', $stm_list_hrr);
					update_post_meta($edit_mode_id, 'stm_launched', $stm_list_launched);
					update_post_meta($edit_mode_id, 'deliveryable_text', $stm_list_asset);
					update_post_meta($edit_mode_id, 'stm_website', $stm_list_website);
					update_post_meta($edit_mode_id, 'stm_tagline', $stm_list_tagline);
					update_post_meta($edit_mode_id, 'stm_price', $stm_list_price);
					update_post_meta($edit_mode_id, 'stm_videourl', $stm_list_video);

					wp_redirect( get_permalink( get_page_by_path( 'stm-dashboard' ) ) );
				}	exit;
			}else{
				$new_post = array(
					'post_title'   => $title,
					'post_content' => wp_kses_post($_POST['stm_list_content']),
					'post_status'  => 'pending',
					'post_type'    => 'business',
				);
				
				$new_post_id = wp_insert_post($new_post);
				wp_set_post_terms( $new_post_id, $category, 'business_category' );

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

				wp_redirect( get_permalink( get_page_by_path( 'stm-dashboard' ) ) );
				exit;
			    }



		    
	    }
    }
	public function handleImageUpload($file_handler, $post_id)
	{
		if (empty($file_handler) || (empty($file_handler['tmp_name']) && empty($file_handler['name']))) {
			return [];
		}

		if (!is_array($file_handler['name'])) {
			$file_handler = [$file_handler]; // Convert to array for consistency
		}

	
		if (!empty($file_handler) && is_array($file_handler['name'])) {
			$attachment_ids = [];

			foreach ($file_handler['name'] as $key => $value) {
				$file = [
					'name'     => isset( $file_handler[ 'name' ] ) &&  isset( $file_handler[ 'name' ][ $key ]) ? $file_handler['name'][$key] : '',
					'type'     => isset( $file_handler[ 'type' ] ) &&  isset( $file_handler[ 'type' ][ $key ]) ? $file_handler['type'][$key] : '',
					'tmp_name' => isset( $file_handler[ 'tmp_name' ] ) &&  isset( $file_handler[ 'tmp_name' ][ $key ]) ? $file_handler[ 'tmp_name' ][ $key ] : '',
					'error'    => isset( $file_handler[ 'error' ] ) &&  isset( $file_handler[ 'error' ][ $key ]) ? $file_handler[ 'error' ][ $key ] : 0,
					'size'     => isset( $file_handler[ 'size' ] ) &&  isset( $file_handler[ 'size' ][ $key ]) ? $file_handler[ 'size' ][ $key ] : 0,
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

	private function handleSingleImageUpload($file_handler, $post_id){
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
	
		// Check if a file was actually uploaded
		if (empty($uploadedfile['tmp_name'])) {
			error_log('No file was uploaded.');
			return false;
		}
	
		// Check if the file upload had an error
		if ($uploadedfile['error'] !== UPLOAD_ERR_OK) {
			error_log('File upload error: ' . $uploadedfile['error']);
			return false;
		}
	
		$upload = wp_handle_upload($uploadedfile, $upload_overrides);
	
		if (is_array($upload) && isset($upload['error'])) {
			// Handle the case where wp_handle_upload returns an array with an error
			error_log('Error uploading file: ' . $upload['error']);
			return false;
		}
	
		$attachment_id = wp_insert_attachment(
			[
				'guid'           => isset($upload['url']) ? $upload['url'] : '',
				'post_mime_type' => isset($upload['type']) ? $upload['type'] : '',
				'post_title'     => basename(isset($upload['file']) ? $upload['file'] : ''),
				'post_content'   => '',
				'post_status'    => 'inherit',
			],
			$upload['file']
		);
	
		if (is_wp_error($attachment_id)) {
			error_log('Error inserting attachment: ' . $attachment_id->get_error_message());
			return false;
		}
	
		return $attachment_id;
	}
}