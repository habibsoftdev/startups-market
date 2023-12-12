<?php 

namespace Startups\Market\Users;

class Extrafield{

    public function __construct(){
        add_filter( 'user_contactmethods', [ $this, 'add_user_contactmethod' ] );
        //add_action( 'show_user_profile', [ $this, 'add_phone_number_field' ] );
       // add_action( 'edit_user_profile', [ $this, 'add_phone_number_field' ] );
       // add_action( 'personal_options_update', [ $this, 'save_phone_number_field' ] );
       // add_action( 'edit_user_profile_update', [ $this, 'save_phone_number_field' ] );
    }

    /**
      * Adding Extra field for roles
      *
      * @return void
      */
      public function add_user_contactmethod( $extra_field ){
        $extra_field[ 'phone_number' ] ='Phone Number';
        $extra_field['country'] = 'Country';
        return $extra_field;

     }

     public function add_phone_number_field( $user ){
        ?>
        <table class="form-table">
            <tr>
                <th><label for="phone_number"><?php _e( 'Phone Number', 'startups-market' ); ?></label></th>
                <td>
                    <input type="text" name="phone_number" id="phone_number" value="<?php echo esc_attr(get_user_meta($user->ID, 'phone_number', true)); ?>" class="regular-text" />
                </td>
            </tr>
        </table>

        <?php
     }

     public function save_phone_number_field( $user_id ){
        /**
         * Check the Current user capability to edit this user info
         */

         if( current_user_can( 'edit_user', $user_id ) ){
            update_user_meta($user_id, 'phone_number', sanitize_text_field($_POST['phone_number']));
         }
     }
}