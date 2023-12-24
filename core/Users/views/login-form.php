<?php

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="container login-form-container">
    <div class="login-form">
        <form id="stm-login-form" action="" method="post">
        <p class="status"></p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="login_email"><?php _e('Username/Email', 'startups-market'); ?> </label>
                    <input type="email" name="login_email" id="login_email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="login_pass"><?php _e('Password', 'startups-market'); ?></label>
                    <input type="password" name="login_pass" id="login_pass" required>
                </div>
                <?php wp_nonce_field('stm-ajax-login-nonce', 'security'); ?>
                 <input type="hidden" name="action" value="stm_ajax_login">
                <button type="submit" class="btn btn-primary" name="login_submit"><?php _e('Login', 'startups-market'); ?></button>
            </div>
        </form>
    </div>
</div>