<?php 

namespace Startups\Market\Ajax;
use Startups\Market\Singleton\SingletonTrait;
use Startups\Market\Stm_Utils;

/**
 * Widthrawal Handler Class
 */
class InitiateWidthraw{

    use SingletonTrait;

    public function __construct(){

        add_action( 'wp_ajax_initiate_widthraw', [ $this, 'initiate_widthraw' ] );
        add_action( 'wp_ajax_nopriv_initiate_widthraw', [ $this, 'initiate_widthraw' ] );
    }

    public function initiate_widthraw(){
        $nonce = isset($_POST['nonce']) ? $_POST['nonce'] : '';

        if (!wp_verify_nonce($nonce, 'stm_widthraw_nonce')) {
            wp_send_json_error('Invalid nonce.');
        }

        if( ! is_user_logged_in() ){
            wp_send_json([
                'success' => false,
                'message' => __('You do not have permission to Widthraw this Money.', 'startups-market'),
            ]);
        }

        $user_id = get_current_user_id();

        $available_balance = get_user_meta( $user_id, 'available_balance', true);
        $available_balance = floatval( $available_balance );

        $widthraw_amount = Stm_Utils::calculateEarningsAndFee( $available_balance );

        insert_widthrawal_data( $user_id, $widthraw_amount['earnings'] );

        update_user_meta( $user_id, 'available_balance', '0');

        wp_send_json([
            'success' => true,
            'message' => __('We have got your Widthrawal Request. Please wait for the Admin review', 'startups-market'),
        ]);
    }

}