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
                        <input type="text" class="form-input-field w-100 mb-4" name="stm_list_title">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Description:', 'startups-market'); ?></p>
                        <?php
                            $content = ''; // You can set a default value if needed
                            $editor_id = 'description_editor';

                            // Arguments for the wp_editor function
                            $settings = array(
                                'textarea_name' => 'stm_list_content', // This is the name attribute for the textarea, which will be used when submitting the form
                                'media_buttons' => true,
                                'textarea_rows' => 10,
                                'tinymce' => array(
                                    'resize' => false,
                                    ),
                            );

                            // Display the WordPress editor
                            wp_editor($content, $editor_id, $settings);
                            ?>
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
                        <input type="number" class="form-input-field w-100 mb-4" name="stm_list_arr">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Last 6 month Revenue', 'startups-market'); ?></p>
                        <input type="number" class="form-input-field w-100 mb-4"
                            placeholder="Last 6 month Revenue $5000" name="stm_list_hrr">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Launched:', 'startups-market'); ?></p>
                        <input type="date" class="form-input-field w-100 mb-4" name="stm_list_launched">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Deliveryable Assets:', 'startups-market'); ?></p>
                        <input type="text" class="form-input-field w-100 mb-4"
                            placeholder="example: domain, websites, etc" name="stm_list_asset">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Website:', 'startups-market'); ?></p>
                        <input type="url" class="form-input-field w-100 mb-4" placeholder="www.example.com" name="stm_list_website">
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
                        <input type="text" class="form-input-field w-100 mb-4" name="stm_list_tagline">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Asking Price:', 'startups-market'); ?></p>
                        <p class="text-secondary"><?php esc_html_e( 'Price [USD]', 'startups-market'); ?></p>
                        <input type="number" class="form-input-field w-100 mb-4 py-2"
                            placeholder="Price of this listing. Eg. 100" name="stm_list_price">
                    </div>

                </section>
            </div>

               <!-- Image and video Section -->
               <div class="smt-container-img-video border border-1">
                <section>
                    <div class="border-bottom mb-4">
                        <p class="img-video-section-header fw-semibold ps-4"><?php esc_html_e( 'Image & Video', 'startups-market'); ?></p>
                    </div>

                    <!-- thumbnail -->
                    <div class="form-group px-4 py-2 container-fluid">
                        <!--  -->
                            <!-- file image container -->
                           <div class="img-file-preview-container container-fluid">
                            <img class="img-fluid" src="<?php STM_ASSETS.'/images/upload.png'; ?>" alt="">
                            <!-- <img class="img-fluid" src="images/file-img (2).jpg" alt="">
                            <img class="img-fluid" src="images/file-img (3).jpg" alt="">
                            <img class="img-fluid" src="images/file-img (4).jpg" alt="">
                            <img class="img-fluid" src="images/file-img (5).jpg" alt=""> -->
                           </div>
                           <div class="error-message"></div>

                        <!-- file input -->
                        <div class="d-flex justify-content-center mt-4">
                            <input type="hidden" name="stm_list_img_id" value="">
                            <input type="hidden" name="stm_list_img_url" value="">
                            <input type="file" id="list_thumbnail_url" name="list_thumbnail_url[]" multiple >
                        </div>
                    </div>
                    <!-- video input -->
                    <div class="px-4">
                        <p class="fw-semibold mb-2"><?php esc_html_e( 'Video:', 'startups-market'); ?></p>
                        <input type="url" class="form-input-field w-100 mb-4 py-2"
                            placeholder="Only YouTube & Video URLs." name="stm_list_video">
                    </div>
                </section>
            
            </div>

            <div class="d-flex justify-content-center">
                <button class="form-submit-btn" type="submit" name="stm_list_submit"><?php esc_html_e( 'Submit', 'startups-market'); ?></button>
            </div>

        </form>

</section>