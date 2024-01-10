<?php 
    $current_user = wp_get_current_user();
    $user_id = get_current_user_id();

    $phone = get_user_meta( $user_id, 'phone_number', true);
    $website = get_the_author_meta( 'user_url', $user_id );
    $author_bio = get_the_author_meta( 'description', $user_id );


    
?>

<!-- My Profile Area -->
<section class=" smt-my-profile-area mb-4 menuItem" id="my-profile-page">
    <p class="pr-notice"></p>

    <div class=" smt-my-profile row">

        <!-- form box area -->
        <div class="form-box col-7 border border-1 rounded-1 shadow-sm mb-3">
        <form action="" method="POST" id="stm_profile_form" >
        


                <!-- My profile Heading -->
                <div class="profile-header py-2 px-3 border-bottom mx-0">
                    <h3> <?php esc_html_e( 'My Profile', 'startups-market'); ?></h3>
                </div>

                <!-- Form Inputs -->
                <?php wp_nonce_field( 'stm_user_prof', 'stm_user_prof_nonce'); ?>
                <div class="mb-3 mx-4 mt-4">
                    <label for="stm_display_name" class="form-label my-profile-label"> <?php esc_html_e( 'Display Name', 'startups-market'); ?></label>
                    <input type="text" class="form-control my-profile-input" id="stm_display_name"
                     placeholder="Display Name" name="stm_display_name" value="<?php esc_attr_e( $current_user->first_name ); ?>" readonly>
                </div>
                <div class="mb-3 mx-4 mt-4">
                    <label for="stm_first_name" class="form-label my-profile-label"><?php esc_html_e( 'First Name', 'startups-market'); ?></label>
                    <input type="text" class="form-control my-profile-input" id="stm_first_name"
                     placeholder="First Name" name="stm_first_name" value="<?php esc_attr_e( $current_user->first_name ); ?>">
                </div>
                <div class="mb-3 mx-4 mt-4">
                    <label for="stm_last_name" class="form-label my-profile-label"><?php esc_html_e( 'Last Name', 'startups-market'); ?></label>
                    <input type="text" class="form-control my-profile-input" id="stm_last_name"
                     placeholder="Last Name" name="stm_last_name" value="<?php esc_attr_e( $current_user->last_name ); ?>">
                </div>
                <div class="mb-3 mx-4 mt-4">
                    <label for="stm_user_mail" class="form-label my-profile-label"> <?php esc_html_e( 'Email', 'startups-market'); ?></label>
                    <input type="email" class="form-control my-profile-input" id="stm_user_mail"
                     placeholder="Email Address" name="stm_user_mail" value="<?php esc_attr_e( $current_user->user_email ); ?>" disabled>
                </div>
                <div class="mb-3 mx-4 mt-4">
                    <label for="stm_user_phone" class="form-label my-profile-label"><?php esc_html_e( 'Phone', 'startups-market'); ?></label>
                    <input type="text" class="form-control my-profile-input" id="stm_user_phone" placeholder="Phone" name="stm_user_phone" value="<?php esc_attr_e( $phone ); ?>" >
                </div>
                <div class="mb-3 mx-4 mt-4">
                    <label for="stm_website"
                    class="form-label my-profile-label"><?php esc_html_e( 'Website', 'startups-market'); ?></label>
                    <input type="url" class="form-control my-profile-input" id="stm_website"
                    placeholder="Website" name="stm_website" value="<?php esc_attr_e( $website ); ?>" >
                </div>
                <div class="mb-3 mx-4 mt-4">
                    <label for="stm_user_address"
                    class="form-label my-profile-label"><?php esc_html_e( 'Address', 'startups-market'); ?></label>
                    <input type="text" class="form-control my-profile-input" id="stm_user_address"
                     placeholder="Address" name="stm_user_address" >
                </div>
                <div class="mb-3 mx-4 mt-4">
                    <label for="stm_user_new_pass" class="form-label my-profile-label"><?php esc_html_e( 'New Password', 'startups-market'); ?></label>
                    <input type="password" class="form-control my-profile-input"
                    id="stm_user_new_pass"  placeholder="New Password" name="stm_user_new_pass" >
                </div>
                <div class="mb-3 mx-4 mt-4">
                    <label for="stm_user_con_pass" class="form-label my-profile-label"><?php esc_html_e( 'Confirm New Password', 'startups-market'); ?></label>
                    <input type="password" class="form-control my-profile-input"
                    id="stm_user_con_pass" placeholder="Confirm New Password" name="stm_user_con_pass" >
                </div>
                <div class="mb-3 mx-4 mt-4 d-flex flex-column">
                    <label for="stm_user_bio" class="form-label my-profile-label"><?php esc_html_e( 'About Me', 'startups-market'); ?></label>
                    <textarea name="" id="stm_user_bio" cols="100" rows="10" name="stm_user_bio" ><?php esc_attr_e( $author_bio ) ?></textarea>
                </div>

                <!-- form save button -->
                <div class="container-fluid px-4">
                    <button class="form-dashboard-button py-2 mb-3 mt-2 fw-semibold" type="submit" name="stm_user_save_changes" ><?php esc_html_e( 'Save Changes', 'startups-market'); ?></button>
                </div>
            </form>
        </div>

        <!-- select photo -->
      
    </div>
</section>