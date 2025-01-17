<?php 

namespace Startups\Market\Users;
use Startups\Market\Singleton\SingletonTrait;

/**
 * User Extra Field Hanlder class
 */
class Extrafield{

    use SingletonTrait;
    public function __construct(){
        add_filter( 'user_contactmethods', [ $this, 'add_user_contactmethod' ] );
     
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

    /**
     * Adding phone number field
     *
     * @param mixed $user
     * @return void
     */
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

     /**
      * Save User Field
      *
      * @param int $user_id
      * @return void
      */
     public function save_phone_number_field( $user_id ){
        /**
         * Check the Current user capability to edit this user info
         */

         if( current_user_can( 'edit_user', $user_id ) ){
            update_user_meta($user_id, 'phone_number', sanitize_text_field($_POST['phone_number']));
         }
     }
}