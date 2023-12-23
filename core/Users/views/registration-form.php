<?php 

if( ! defined( 'ABSPATH' ) ){
    exit;
}

require_once plugin_dir_path(__FILE__). '../../functions.php';
require_once plugin_dir_path(__FILE__). 'country-list.php';


?>

<div class="container registration-form-container">
            <div class="registration-form">
                <form method="post" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name"><?php _e( 'First Name', 'startups-market' ); ?></label>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name"><?php _e( 'Last Name', 'startups-market' ); ?></label>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"><?php _e( 'Email', 'startups-market' ); ?></label>
                        <input type="email" class="form-control" name="reg_email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number"><?php _e( 'Phone Number', 'startups-market' ); ?></label>
                        <input type="tel" class="form-control" name="phone_number" placeholder="Phone Number" required>
                    </div>

                    <div class="form-group">
                        <label for="country"><?php _e( 'Country:', 'startups-market' ); ?></label>
                        <select name="country" id="country" required>
                            <option value="" disabled selected><?php _e( 'Select Your Country', 'startups-market'); ?></option>
                            <?php 
                                foreach( $countries as $code => $name ){
                                    echo "<option value='" . esc_attr($code) . "'>" . esc_html($name) . "</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="checkbox-options">
                        <label>
                            <input type="radio" name="buy_sell_option" value="buy">
                            <?php _e( 'I want to buy', 'startups-market' ); ?>
                        </label>
                        <label>
                            <input type="radio" name="buy_sell_option" value="sell">
                            <?php _e( 'I want to sell', 'startups-market' ); ?>
                        </label>
                    </div>

                    <div class="password">
                        <label for="password"><?php _e( 'Password', 'startups-market' ); ?></label>
                        <input type="password" name="password" id="password" minlength="8" required>
                    </div>
                    <?php wp_nonce_field('registration_nonce_field', 'registration_nonce'); ?>
                    <button type="submit" class="btn btn-primary" name="submit_registration"> <?php _e( 'Register', 'startups-market' ); ?> </button>
                </form>
            </div>
</div>