<?php 

namespace Startups\Market\Ajax;
use Startups\Market\Singleton\SingletonTrait;

class WithdrawAaction{

    use SingletonTrait;
    public function __construct(){
        add_action( 'wp_ajax_approve_withdrawal', [ $this, 'approve_withdrawal_callback' ] );
        add_action( 'wp_ajax_nopriv_approve_withdrawal', [ $this, 'approve_withdrawal_callback' ] );
    }

    public function approve_withdrawal_callback(){
        check_ajax_referer('action_withdrawal_nonce', 'nonce');

        $withdrawal_id = isset($_POST['withdrawal_id']) ? intval($_POST['withdrawal_id']) : 0;
    
        if ($withdrawal_id > 0) {
            // Update the database
            update_admin_action($withdrawal_id, 1); // Assuming 1 means approved
            wp_send_json_success(array('message' => 'Withdrawal approved successfully!'));
        } else {
            wp_send_json_error(array('message' => 'Invalid withdrawal ID.'));
        }
    
        wp_die();
    }
}