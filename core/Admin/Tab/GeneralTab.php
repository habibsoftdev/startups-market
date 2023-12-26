<?php 

namespace Startups\Market\Admin\Tab;

/**
 * Admin Settings Page Tab Content Class
 */
class GeneralTab{

    public function __construct(){
        
        $this->render();
    }

     /**
     * Create instance for once
     *
     * @return bool
     */
    public static function init(){
        static $instance = false;

        if( ! $instance ){
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Render the General Tab Content
     *
     * @return void
     */
    public function render(){
        $this->handle_form_submission();
        $stm_email = get_option('stm_primary_email');
        ?>
        <div id="startups-market" class="wrap">
            <div class="stm-page-content">
                <form action="" id="stm-setting-tab-form" method="POST">
                    <?php wp_nonce_field( 'stm_setting_general_tab', 'stm_setting_general_nonce' ); ?>
                    <div id="stm-setting-row-heading-general-settings">
                        <h2> <?php _e( 'General Settings', 'startups-market' ); ?> </h2>
                        <p><?php _e( 'Change your Startups Market settings.', 'startups-market' ); ?></p>
                    </div>
                    <div class="stm-settings-row">
                        <div class="stm-settings-label">
                            <label for="primary_email"> <?php _e( 'Email Address', 'startups-market'); ?></label>
                        </div>
                        <div class="stm-settings-field">
                            <input type="email" name="stm_primary_email" id="primary_email" placeholder="example@example.com" value="<?php echo esc_attr( $stm_email ); ?>">
                            <p><i><?php _e( 'Put down your Email Address to sending Email', 'startups-market'); ?></i></p>
                        </div>
                        
                    </div>
                    
                    <?php submit_button( __( 'Save Changes', 'startups-market' ), 'primary', 'stm_save_changes' ); ?>
                </form>
            </div>
        </div>

        <?php 
    }


    /**
     * save settings 
     *
     * @return void
     */
    public function handle_form_submission(){
        
        if( isset( $_POST[ 'stm_save_changes' ]) && wp_verify_nonce( $_POST[ 'stm_setting_general_nonce'], 'stm_setting_general_tab') ){
            $stm_primary_email = sanitize_email( $_POST[ 'stm_primary_email' ] );
            update_option( 'stm_primary_email', $stm_primary_email );
        }

    }
}