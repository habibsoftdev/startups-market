<?php 

namespace Startups\Market\Ajax;
use Startups\Market\Trait\SingletonTrait;


class ConfirmOrder{

    use SingletonTrait;
    
    public function __construct(){
        add_action('wp_ajax_update_order_confirmation', [$this, 'update_order_confirmation_callback']);
        add_action('wp_ajax_nopriv_update_order_confirmation', [$this, 'update_order_confirmation_callback']);
    }

    public function update_order_confirmation_callback(){
        $nonce = isset($_POST['nonce']) ? $_POST['nonce'] : '';
        if (!wp_verify_nonce($nonce, 'confirm_order_nonce')) {
            wp_send_json_error('Invalid nonce.');
        }

        $order_id = isset($_POST['order_id']) ? absint($_POST['order_id']) : 0;

        $order = wc_get_order($order_id);

        foreach ($order->get_items() as $item_id => $item) {
            // Your logic to update order item meta
            wc_update_order_item_meta($item_id, 'approval_status', 1);
        }

        $order->update_status('completed');

        wp_send_json([
            'success' => true,
            'message' => __('Order Completed.', 'startups-market'),
        ]);
    }


}