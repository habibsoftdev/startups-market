<section>
        <form class="form-container" id="uploader-form">

            <!-- General Section -->
            <div class="smt-container-form border border-1 pb-3">
                <section>
                    <div class="border-bottom mb-4">
                        <p class="general-section-header fw-semibold ps-4">General Section</p>
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2">Title: <span class="text-danger">*</span></p>
                        <input type="text" class="form-input-field w-100 mb-4">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2">Description:</p>
                        <textarea class="description-box w-100" name="" id=""></textarea>
                        <?php
                $content = ''; // You can set a default value if needed
                $editor_id = 'description_editor';

                // Arguments for the wp_editor function
                $settings = array(
                    'textarea_name' => 'content', // This is the name attribute for the textarea, which will be used when submitting the form
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
                        <p class="general-section-header fw-semibold ps-4">Business Information</p>
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2">Annual Recurring Revenue</p>
                        <input type="number" class="form-input-field w-100 mb-4">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2">Last 6 month Revenue</p>
                        <input type="number" class="form-input-field w-100 mb-4"
                            placeholder="Last 6 month Revenue $5000">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2">Launched:</p>
                        <input type="date" class="form-input-field w-100 mb-4">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2">Deliveryable Assets:</p>
                        <input type="number" class="form-input-field w-100 mb-4"
                            placeholder="example: domain, websites, etc">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2">Website:</p>
                        <input type="url" class="form-input-field w-100 mb-4" placeholder="www.example.com">
                    </div>

                </section>
            </div>

            <!-- Pricing Section -->
            <div class="smt-container-form border border-1">
                <section>
                    <div class="border-bottom mb-4">
                        <p class="general-section-header fw-semibold ps-4">Pricing</p>
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2">Tagline:</p>
                        <input type="number" class="form-input-field w-100 mb-4">
                    </div>
                    <div class="px-4">
                        <p class="fw-semibold mb-2">Asking Price:</p>
                        <p class="text-secondary">Price [USD]</p>
                        <input type="number" class="form-input-field w-100 mb-4 py-2"
                            placeholder="Price of this listing. Eg. 100">
                    </div>

                </section>
            </div>

            <!-- Image and video Section -->
            <div class="smt-container-form border border-1">
                <section>
                    <div class="border-bottom mb-4">
                        <p class="general-section-header fw-semibold ps-4">Image & Video</p>
                    </div>
                    <div class="form-group px-4 py-2">
                        <div id="thumbnail-uploader" class="ez-media-uploader" data-type="images"
                            data-min-file-items="0" data-max-file-items="1" data-max-file-size="10"
                            data-max-total-file-size="0" data-allow-multiple="1" data-show-alerts="1"
                            data-show-file-size="1" data-featured="false" data-allow-sorting="1" data-show-info="1"
                            data-uploader-type="file">
                            <div class="ezmu__loading-section ezmu--show">
                                <span class="ezmu__loading-icon">
                                    <span class="ezmu__loading-icon-img-bg"></span>
                                </span>
                            </div>

                            <div class="ezmu__old-files">
                                <span class="ezmu__old-files-meta" data-attachment-id="1"
                                    data-url="https://images.unsplash.com/photo-1501183007986-d0d080b147f9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80"
                                    data-size="5" data-type="image"></span>
                                <span class="ezmu__old-files-meta" data-attachment-id="2"
                                    data-url="https://images.unsplash.com/photo-1575761410364-8a3eb7e4edfc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80"
                                    data-size="200" data-type="image"></span>
                                <span class="ezmu__old-files-meta" data-attachment-id="3"
                                    data-url="https://images.unsplash.com/photo-1447752875215-b2761acb3c5d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjF9&auto=format&fit=crop&w=750&q=80"
                                    data-size="200" data-type="image"></span>
                            </div>

                            <div class="ezmu-dictionary">
                                <!-- Label Texts -->
                                <span class="ezmu-dictionary-label-featured">Featured</span>
                                <span class="ezmu-dictionary-label-drag-n-drop">Drag & Drop</span>
                                <span class="ezmu-dictionary-label-drop-here">Drag Files Here</span>
                                <span class="ezmu-dictionary-label-or">or</span>
                                <span class="ezmu-dictionary-label-select-files">Choose</span>
                                <span class="ezmu-dictionary-label-add-more">Add More</span>
                                <span class="ezmu-dictionary-label-change">Change</span>

                                <!-- Alert Texts -->
                                <span class="ezmu-dictionary-alert-max-file-size">
                                    The maximum limit for a file is __DT__
                                </span>
                                <span class="ezmu-dictionary-alert-max-total-file-size">
                                    The maximum limit for total file size is __DT__
                                </span>
                                <span class="ezmu-dictionary-alert-min-file-items">
                                    The minimum limit for total file is __DT__
                                </span>
                                <span class="ezmu-dictionary-alert-max-file-items">
                                    The maximum limit for total file is __DT__
                                </span>

                                <!-- Info Text -->
                                <span class="ezmu-dictionary-info-max-file-size" data-show='1'>
                                    The maximum allowed file size is __DT__
                                </span>
                                <span class="ezmu-dictionary-info-max-total-file-size" data-show='1'>
                                    The maximum total allowed file size is __DT__
                                </span>
                                <span class="ezmu-dictionary-info-min-file-items" data-show='1'>
                                    The minimum __DT__ files are required
                                </span>
                                <span class="ezmu-dictionary-info-max-file-items" data-show='1' data-featured="1"
                                    data-pin="1">
                                    Unlimited files are allowed
                                </span>
                                <span class="ezmu-dictionary-info-type" data-show='1'>
                                    Allowed file types are __DT__
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="px-4">
                        <p class="fw-semibold mb-2">Video:</p>
                        <input type="url" class="form-input-field w-100 mb-4 py-2"
                            placeholder="Only YouTube & Video URLs.">
                    </div>
                </section>
            </div>

            <div class="d-flex justify-content-center">
                <button class="form-submit-btn" type="submit" name="submit">Submit</button>
            </div>

        </form>
    </section>