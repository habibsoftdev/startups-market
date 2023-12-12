
    
            <h1 id="title"><?php _e( 'Register As Buyer', 'startups-markets' ); ?></h1>
            <form>
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <input type="text" name="buyerfname"placeholder="<?php _e( 'First Name', 'startups-market' ); ?>" required>
                    </div>
                    <div class="input-field">
                        <input type="text" name="buyerlname"placeholder="<?php _e( 'Last Name', 'startups-market' ); ?>" required>
                    </div>
                    <div class="input-field">
                        <input type="email" name="buyeremail" placeholder="<?php _e( 'Email', 'startups-market' ); ?>" required>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="<?php _e( 'Phone Number', 'startups-market' ); ?>" required>
                    </div>
                </div>

            </form>

            <?php wp_nonce_field( 'register_buyer', 'register_buyer_nonce' ); ?>
        <div class="btn-register-submit">
            <button type="submit" class="submit-btn" name="buyer_submit"><?php _e( 'Register', 'startups-market' ); ?></button>
        </div>


