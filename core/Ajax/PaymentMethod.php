<?php 

namespace Startups\Market\Ajax;
use Startups\Market\Trait\SingletonTrait;

/**
 * Payment Info Save Handler Class
 */
class PaymentMethod{

    use SingletonTrait;

    public function __construct(){
        add_action( 'wp_ajax_paymentmethod_save', [ $this, 'paymentMethod_save' ] );
        add_action( 'wp_ajax_nopriv_paymentmethod_save', [ $this, 'paymentMethod_save' ] );
    }

    public function paymentMethod_save(){

        $nonce = isset( $_POST[ 'nonce' ] ) ? $_POST[ 'nonce' ] : '';
        if ( ! wp_verify_nonce( $nonce, 'stm_payment_nonce' ) ) {
             wp_send_json([
                'status' => 'error',
                'message' => __( 'Something Wrong.', 'startups-market' ),
            ]);
        }

        if ( ! is_user_logged_in()) {
            wp_send_json([
                'status' => 'error',
                'message' => __( 'You are not allowed to make changes.', 'startups-market' ),
            ]);
        }

        $user_id = get_current_user_id();

        $bank_name = isset( $_POST[ 'wdt_bank_name' ] ) ? sanitize_text_field( $_POST[ 'wdt_bank_name' ] ) : '';
        $account_number = isset( $_POST[ 'wdt_account_number' ] ) ? sanitize_text_field( $_POST[ 'wdt_account_number' ] ) : '';
        $account_type = isset( $_POST[ 'wdt_account_type' ] ) ? sanitize_text_field( $_POST[ 'wdt_account_type' ] ) : '';
        $routing = isset( $_POST[ 'wdt_routing_number' ] ) ? sanitize_text_field( $_POST[ 'wdt_routing_number' ] ) : '';

        // Update User Meta

        update_user_meta( $user_id, 'stm_bank_name', $bank_name );
        update_user_meta( $user_id, 'stm_bank_account', $account_number );
        update_user_meta( $user_id, 'stm_account_type', $account_type );
        update_user_meta( $user_id, 'stm_bank_routing', $routing );

        $response = ['status' => 'success', 'message' => __('Your changes have been saved successfully.', 'startups-market')];

        wp_send_json($response);

    }
}