<form method=”post” action=”#” class=”acf-form form-horizontal ” id=”post” enctype=”multipart/form-data”>
<?php
$args = array(
‘post_id’ => ‘new’,
‘field_groups’ => array(1), //use wrong ID of your custom field Form so form fields will not get shown
‘form’ => false
);
acf_form($args);
?>
//file upload button
<div data-field_type=”file” data-field_key=”field_5343d9b2586f0file” data-field_name=”email” class=”field field_type-text field_key-field_5343d9b2586f0file” id=”acf-file”>
<p class=”label”><label for=”acf-field-file”>Image</label></p>
<div class=”acf-input-wrap”>
<input type=”file” id=”my_image_upload” name=”my_image_upload”>
</div>
<input id=”submit_my_image_upload” name=”submit_my_image_upload” type=”submit” value=”Submit” />
<?php 
// in function .php write following code
//Here we gather the files which sent by the HTML forms. and send it to //another function called kv_handle_attachement(). This is a simple function //this will help you to store the files to your wp uploads directory. Add //the following code into your Theme “ functions.php”
//img upload//
function kv_handle_attachment($file_handler,$post_id,$set_thu=false) {
// check to make sure its a successful upload
if ($_FILES[$file_handler][‘error’] !== UPLOAD_ERR_OK) __return_false();

require_once(ABSPATH . “wp-admin” . ‘/includes/image.php’);
require_once(ABSPATH . “wp-admin” . ‘/includes/file.php’);
require_once(ABSPATH . “wp-admin” . ‘/includes/media.php’);

$attach_id = media_handle_upload( $file_handler, $post_id );

// If you want to set a featured image from your uploads.
if ($set_thu) set_post_thumbnail($post_id, $attach_id);
return $attach_id;
}
//New File Upload

add_filter(‘acf/pre_save_post’ , ‘my_pre_save_post’ );
function my_pre_save_post( $post_id ) {
// check if this is to be a new post
if( $post_id != ‘new’ ) {
return $post_id;
}

$field = $_POST[‘fields’];
$post_title = $_POST[‘fullname’];
$post_content = $field[‘edit_test2’];

// Create a new post
require_once(ABSPATH . “wp-admin” . ‘/includes/image.php’);
require_once(ABSPATH . “wp-admin” . ‘/includes/file.php’);
require_once(ABSPATH . “wp-admin” . ‘/includes/media.php’);
$attachment_id = media_handle_upload( ‘my_image_upload’, $post_id );
$post = array(
‘post_status’ => ‘draft’ ,
‘post_title’ => $post_title,
‘post_content’ => $post_content,
‘post_type’ => ‘page’

);
$newpost_id=wp_insert_post($post);
if($newpost_id!=0)
{

add_post_meta($newpost_id, ‘picture’, $attachment_id );

}
}`



/////////////////////////////////////////////////////////////////


<?php
namespace Startups\Market\Users\AddListing;

class ListingHandle {

    public function __construct() {
        $this->handleListingForm();
    }

    public function handleListingForm() {
        if (isset($_POST['stm_list_submit']) && wp_verify_nonce( $_POST['stm_add_list_nonce'], 'stm_add_list')){

            $title = isset($_POST['stm_list_title']) ? sanitize_text_field($_POST['stm_list_title']) : '';

            $new_post = array(
                'post_title'   => $title,
                'post_content' => wp_kses_post($_POST['stm_list_content']),
                'post_status'  => 'draft',
                'post_type'    => 'business',
            );

            $new_post_id = wp_insert_post($new_post);

            if ( ! is_wp_error( $new_post_id ) ) {

                if( ! empty( $_FILES[ 'list_thumbnail_url' ][ 'tmp_name' ] ) ){

                    var_dump($_FILES['list_thumbnail_url']);
                    $file_handler = 'list_thumbnail_url';

                    $file_type = wp_check_filetype( basename( $_FILES[ $file_handler ][ 'name' ] ), null );
                    $allowed_types = [ 'jpg', 'jpeg', 'png', 'webp' ];

                    if( in_array( $file_type[ 'ext' ], $allowed_types ) ){
                        $attachment_id = $this->handleImageUpload( $file_handler, $new_post_id );
                      

                        if( $attachment_id !== false ){
                            // $gallery_images = get_post_meta( $new_post_id, 'stm_images_id', true );
                            // if (!is_array($gallery_images)) {
                            //     $gallery_images = array();
                            // }
                            
                            // $gallery_images[] = $attachment_id;
                            $override = array(
                                'test_form' => false,
                            );
                            
                            update_post_meta( $new_post_id, 'stm_images_id', $attachment_id );

                            $image_url = wp_get_attachment_image_url($attachment_id, 'medium');
                            update_post_meta($new_post_id, 'stm_images_url', $image_url);

                            if (empty(get_post_thumbnail_id($new_post_id))) {
                                set_post_thumbnail($new_post_id, $attachment_id);
                            }
                        }
                    }else{
                        wp_die( __( 'File Type Not Allowed', 'startups-market' ) );
                    }

                }
            }

            $stm_list_arr = isset( $_POST[ 'stm_list_arr' ] ) ? sanitize_text_field( $_POST[ 'stm_list_arr' ] ) : '';

            $stm_list_hrr = isset( $_POST[ 'stm_list_hrr' ] ) ? sanitize_text_field( $_POST[ 'stm_list_hrr' ] ) : '';

            $stm_list_launched = isset( $_POST[ 'stm_list_launched' ] ) ? sanitize_text_field( $_POST[ 'stm_list_launched' ] ) : '';

            $stm_list_asset = isset( $_POST[ 'stm_list_asset' ] ) ? sanitize_text_field( $_POST[ 'stm_list_asset' ] ) : '';

            $stm_list_website = isset( $_POST[ 'stm_list_website' ] ) ? sanitize_text_field( $_POST[ 'stm_list_website' ] ) : '';

            $stm_list_tagline = isset( $_POST[ 'stm_list_tagline' ] ) ? sanitize_text_field( $_POST[ 'stm_list_tagline' ] ) : '';

            $stm_list_price = isset( $_POST[ 'stm_list_price' ] ) ? sanitize_text_field( $_POST[ 'stm_list_price' ] ) : '';

            $stm_list_video = isset( $_POST[ 'stm_list_video' ] ) ? sanitize_text_field( $_POST[ 'stm_list_video' ] ) : '';


            update_post_meta( $new_post_id, 'stm_arr', $stm_list_arr );
            update_post_meta( $new_post_id, 'stm_sarr', $stm_list_hrr );
            update_post_meta( $new_post_id, 'stm_launched', $stm_list_launched );
            update_post_meta( $new_post_id, 'deliveryable_text', $stm_list_asset );
            update_post_meta( $new_post_id, 'stm_website', $stm_list_website );
            update_post_meta( $new_post_id, 'stm_tagline', $stm_list_tagline );
            update_post_meta( $new_post_id, 'stm_price', $stm_list_price );
            update_post_meta( $new_post_id, 'stm_videourl', $stm_list_video );

            
        }
       
    }

    public function handleImageUpload( $file_handler, $post_id ){
        require_once( ABSPATH. 'wp-admin/includes/image.php' );
        require_once( ABSPATH. 'wp-admin/includes/file.php' );
        require_once( ABSPATH. 'wp-admin/includes/media.php' );
    
        $attachment_id = media_handle_upload( $file_handler, $post_id );
    
        if( is_wp_error( $attachment_id ) ){
            $errors = $attachment_id->get_error_messages();
            foreach ( $errors as $error ) {
                wp_die( esc_html( $error ) );
            }
            return false;
        }
    
        return $attachment_id;
    }
}
