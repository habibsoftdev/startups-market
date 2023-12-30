<?php 


  $avatardefault = STM_ASSETS. '/images/avatar.png';
  $current_user = wp_get_current_user();

  $first_name = get_user_meta( $current_user->ID, 'first_name', true);
  $last_name = get_user_meta( $current_user->ID, 'last_name', true);
  $email = $current_user->user_email;
  $phone = get_user_meta( $current_user->ID, 'phone_number', true);
  $profile_picture_url = get_user_meta($current_user->ID, 'profile_picture', true);
  $user_bio = get_user_meta($current_user->ID, 'description', true);
?>

<div class="stm-tab__pane" id="dashboard_profile">
  <form action="#" id="user_profile_form" method="post" enctype="multipart/form-data">
    <?php wp_nonce_field( 'stm_user_profile_nonce', 'stm_user_profile_wpnonce') ?>
    <div class="stm-row">
      <div class="stm-col-lg-3">
        <div class="stm-image-profile-wrap">
          <div class="ez-media-uploader stm-profile-uploader">
            <div class="ezmu__drop-zone-section">
              <h2>Drop Here</h2>
            </div>
            <div class="ezmu__loading-section">
              <span class="ezmu__loading-icon">
                <span class="ezmu__loading-icon-img-bg"> </span>
              </span>
            </div>
            <div class="ezmu__media-picker-section ezmu--show">
              <div class="ezmu__media-picker-controls">
              <img src="<?php echo esc_url($profile_picture_url ? $profile_picture_url : $avatardefault); ?>" alt="preview">
                <div class="ezmu__media-picker-buttons">
                  <div class="ezmu__upload-button-wrap">
                    <input type="file" id="ezmu__file-input" class="ezmu__file-input" accept=".jpg, .jpeg, .png, .gif" />
                    <label for="ezmu__file-input" class="ezmu__btn ezmu__input-label" >
                      <?php esc_html_e( 'Select', 'startups-market'); ?>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="ezmu__preview-section">
              <div class="ezmu__thumbnail-area"></div>
              <div class="ezmu__media-picker-buttons">
                <div class="ezmu__upload-button-wrap">
                  <label
                    class="ezmu__btn ezmu__input-label ezmu__update-file-btn" for="ezmu__file-input" >
                    <?php esc_html_e( 'Select', 'startups-market'); ?>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="stm-col-lg-9">
        <div class="stm-user-profile-edit">
          <div class="stm-card stm-user-profile-box">
            <div class="stm-card__header">
              <h4 class="stm-card__header--title"><?php esc_html_e( 'My Profile', 'startups-market' ); ?></h4>
            </div>
            <div class="stm-card__body">
              <div class="stm-user-info-wrap">
                <input type="hidden" name="ID" value="1" />
              </div>
                <div class="stm-user-first-name">
                  <div class="stm-form-group">
                    <label for="first_name"> <?php esc_html_e( 'First Name', 'startups-market'); ?> </label>
                    <input
                      class="stm-form-element"
                      id="first_name"
                      type="text"
                      name="first_name_pr"
                      value="<?php esc_html_e( $first_name );?>"
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="last_name"> <?php esc_html_e( 'Last Name', 'startups-market'); ?> </label>
                    <input
                      class="stm-form-element"
                      id="last_name"
                      type="text"
                      name="last_name_pr"
                      value="<?php esc_html_e( $last_name );?>"
                    />
                  </div>
                </div>
                <div class="stm-user-email">
                  <div class="stm-form-group">
                    <label for="req_email"> <?php esc_html_e( 'Email (can not be changed)', 'startups-market'); ?> </label>
                    <input
                      class="stm-form-element"
                      id="req_email"
                      type="text"
                      name="user_email_pr"
                      value="<?php esc_html_e( $email );?>"
                      disabled="disabled"
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="phone"> <?php esc_html_e( 'Phone', 'startups-market'); ?> </label>
                    <input
                      class="stm-form-element"
                      type="tel"
                      id="phone"
                      name="phone_pr"
                      value="<?php esc_html_e( $phone );?>"
                      placeholder="Enter your phone number"
                    />
                  </div>
                </div>
                <div class="stm-user-site-url">
                  <div class="stm-form-group">
                    <label for="website"> <?php esc_html_e( 'Website', 'startups-market'); ?> </label>
                    <input
                      class="stm-form-element"
                      id="website"
                      type="text"
                      name="user_website_pr"
                      value="http://localhost/flippa"
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="address"> <?php esc_html_e( 'Address', 'startups-market'); ?> </label>
                    <input
                      class="stm-form-element"
                      id="address"
                      type="text"
                      name="user_address_pr"
                      value=""
                    />
                  </div>

                </div>
                <div class="stm-user-password">
                  <div class="stm-form-group">
                    <label for="new_pass"> <?php esc_html_e( 'New Password', 'startups-market'); ?> </label>
                    <input
                      id="new_pass"
                      class="stm-form-element"
                      type="password"
                      name="new_pass_pr"
                      placeholder="Enter a new password"
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="confirm_pass"> <?php esc_html_e( 'Confirm New Password', 'startups-market'); ?> </label>
                    <input
                      id="confirm_pass"
                      class="stm-form-element"
                      type="password"
                      name="confirm_pass_pr"
                      placeholder="Confirm your new password"
                    />
                  </div>
                  <div class="stm-form-group">
                    <label for="bio">  <?php esc_html_e( 'About Author', 'startups-market'); ?></label>
                    <textarea
                      class="wp-editor-area stm-form-element"
                      style="height: 200px"
                      autocomplete="off"
                      cols="40"
                      name="user_bio_pr"
                      id="bio"
                      value="<?php esc_html_e( $user_bio ); ?>"
                    >
                    </textarea>
                  </div>
                </div>
                <button
                  type="submit"
                  class="stm-btn stm-btn-lg stm-btn-dark stm-btn-profile-save"
                  id="update_user_profile" name="dashboard_profile_save"
                >
                <?php esc_html_e( 'Save Changes', 'startups-market'); ?>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>