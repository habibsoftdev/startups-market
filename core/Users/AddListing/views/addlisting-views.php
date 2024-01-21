<?php 
 $taxonomy = 'business_category';
 $categories = get_terms( array(
     'taxonomy' => $taxonomy,
     'hide_empty' => false,
 ) );

 $listing_id = isset( $_GET[ 'listing_id' ] ) ? intval( $_GET[ 'listing_id' ] ) : 0;
 $mode = isset( $_GET[ 'action' ] ) ? $_GET[ 'action'] : '';

 $is_edit_mode = $listing_id > 0;
 $post_title = '';
 $content = '';
 $arr = '';
 $hrr = '';
 $launched_date = '';
 $deliver = '';
 $web = '';
 $tag = '';
 $price = '';
 $video_url = '';
 $img_id = '';
 $img_url = '';
 $selected_categories = array();

 if( $is_edit_mode && $mode === 'edit' ){
    $post_title = get_the_title( $listing_id );
    $content = get_post_field( 'post_content', $listing_id );
    $arr = get_post_meta( $listing_id, 'stm_arr', true );
    $hrr = get_post_meta( $listing_id, 'stm_sarr', true );
    $launched_date = get_post_meta( $listing_id, 'stm_launched', true );
    $deliver = get_post_meta( $listing_id, 'deliveryable_text', true );
    $web = get_post_meta( $listing_id, 'stm_website', true );
    $tag = get_post_meta( $listing_id, 'stm_tagline', true );
    $price = get_post_meta( $listing_id, 'stm_price', true );
    $video_url = get_post_meta( $listing_id, 'stm_videourl', true );
    $img_id = get_post_meta( $listing_id, 'stm_images_id', true );
    $img_url = get_post_meta( $listing_id, 'stm_images_url', true );
    $selected_categories = wp_get_post_terms( $listing_id, 'business_category', array( 'fields' => 'ids' ) );
    

   echo $img_id;
   echo $img_url; 
    
 }

?>

<section>
        <form method="post" action="" enctype="multipart/form-data" class="form-container">

            <!-- General Section -->
            <div class="smt-container-form border border-1 pb-3">
                <section>
                    <div class="border-bottom mb-4">
                        <p class="general-section-header fw-semibold ps-4"><?php esc_html_e( 'General Section', 'startups-market'); ?></p>
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Title:', 'startups-market'); ?> <span class="text-danger">*</span></p>
                        <?php wp_nonce_field( 'stm_add_list', 'stm_add_list_nonce'); ?>
                        <input type="text" class="form-input-field w-100 mb-4 py-2" name="stm_list_title" value="<?php esc_attr_e( $post_title ); ?>" >
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Description:', 'startups-market'); ?></p>
                        <?php
                            $editor_content = isset($content) ? $content : ''; // You can set a default value if needed
                            $editor_id = 'description_editor';

                            // Arguments for the wp_editor function
                            $settings = array(
                                'textarea_name' => 'stm_list_content', // This is the name attribute for the textarea, which will be used when submitting the form
                                'media_buttons' => true,
                                'textarea_rows' => 10,
                                'tinymce' => array(
                                    'resize' => false,
                                    ),
                                'value' => $content,
                            );

                            // Display the WordPress editor
                            wp_editor($editor_content, $editor_id, $settings);
                            ?>
                    </div>

                    <div class="px-4">
                        <label for="category" class="form-label"><?php _e( 'Category:', 'startups-market' ); ?></label>
                        <select name="category" id="category"  class="form-select">
                            <option value="" disabled selected class="form-label"><?php _e( 'Select Your Category', 'startups-market'); ?></option>
                            <?php 
                            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                                foreach ( $categories as $category ) {
                                    if( $is_edit_mode && $mode === 'edit' ){
                                        $selected = in_array( $category->term_id, $selected_categories ) ? 'selected' : '';
                                    } 
                                    echo '<option value="' . esc_attr( $category->term_id ) . '" ' . $selected . '>' . esc_html( $category->name ) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                </section>
            </div>

            <!-- Business Information Section -->
            <div class="smt-container-form border border-1">
                <section>
                    <div class="border-bottom mb-4">
                        <p class="general-section-header fw-semibold ps-4"><?php esc_html_e( 'Business Information', 'startups-market'); ?></p>
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Annual Recurring Revenue', 'startups-market'); ?></p>
                        <input type="number" class="form-input-field w-100 mb-4 py-2" name="stm_list_arr" value="<?php esc_attr_e( $arr ); ?>" >
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Last 6 month Revenue', 'startups-market'); ?></p>
                        <input type="number" class="form-input-field w-100 mb-4 py-2"
                            placeholder="Last 6 month Revenue $5000" name="stm_list_hrr" value="<?php esc_attr_e( $hrr ); ?>" >
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Launched:', 'startups-market'); ?></p>
                        <input type="date" class="form-input-field w-100 mb-4 py-2" name="stm_list_launched" value="<?php esc_attr_e( $launched_date ); ?>" >
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Deliveryable Assets:', 'startups-market'); ?></p>
                        <input type="text" class="form-input-field w-100 mb-4 py-2"
                            placeholder="example: domain, websites, etc" name="stm_list_asset" value="<?php esc_attr_e( $deliver ); ?>" >
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Website:', 'startups-market'); ?></p>
                        <input type="text" class="form-input-field w-100 mb-4 py-2" placeholder="www.example.com" name="stm_list_website" value="<?php esc_attr_e( $web ); ?>" >
                    </div>

                </section>
            </div>

            <!-- Pricing Section -->
            <div class="smt-container-form border border-1">
                <section>
                    <div class="border-bottom mb-4">
                        <p class="general-section-header fw-semibold ps-4"><?php esc_html_e( 'Pricing', 'startups-market'); ?></p>
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Tagline:', 'startups-market'); ?></p>
                        <input type="text" class="form-input-field w-100 mb-4 py-2" name="stm_list_tagline" value="<?php esc_attr_e( $tag ); ?>" >
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Asking Price:', 'startups-market'); ?></p>
                        <p class="text-secondary"><?php esc_html_e( 'Price [USD]', 'startups-market'); ?></p>
                        <input type="number" class="form-input-field w-100 mb-4 py-2"
                            placeholder="Price of this listing. Eg. 100" name="stm_list_price" value="<?php esc_attr_e( $price ); ?>" >
                    </div>

                </section>
            </div>

               <!-- Image and video Section -->
               <div class="smt-container-img-video border border-1" style="margin: 0;">
                <section>
                    <div class="border-bottom mb-4">
                        <p class="img-video-section-header fw-semibold ps-4 py-2"><?php esc_html_e( 'Image & Video', 'startups-market'); ?></p>
                        <p class="px-4"><i><?php
                            $img_reup = $is_edit_mode ? __( 'If you want to change images. Reupload all again', 'startups-market' ) : '';
                            echo $img_reup; ?>
                            </i></p> 
                    </div>

                    <!-- thumbnail -->
                    <div class="form-group px-4 py-2 container-fluid">
                        <!--  -->
                            <!-- file image container -->
                           <div class="img-file-preview-container container-fluid">
                           </div>
                           <div class="error-message"></div>

                        <!-- file input -->
                        <div class="d-flex justify-content-center mt-4">
                            <input type="hidden" name="stm_list_img_id" id="stm_list_img_id" value="<?php esc_attr_e( $img_id ); ?>">
                            <input type="hidden" name="stm_list_img_url" id="stm_list_img_url" value="<?php esc_attr_e( $img_url ); ?>">
                            <input type="file" id="list_thumbnail_url" name="list_thumbnail_url[]" multiple  accept="image/*">
                        </div>
                    </div>
                    <!-- video input -->
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Video:', 'startups-market'); ?></p>
                        <input type="url" class="form-input-field w-100 mb-4 py-2"
                            placeholder="Only YouTube & Video URLs." name="stm_list_video" value="<?php esc_attr_e( $video_url ); ?>" >
                    </div>
                </section>
            
            </div>
                <?php $submit = $is_edit_mode ? __('Save Changes', 'startups-market') : __('Submit Listing', 'startups-market'); ?>
            <div class="d-flex justify-content-center">
                <button class="form-submit-btn" type="submit" name="stm_list_submit"><?php esc_html_e( $submit ); ?></button>
            </div>

        </form>

</section>
