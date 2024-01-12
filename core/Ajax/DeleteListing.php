<?php

namespace Startups\Market\Ajax;

class DeleteListing {

    public function __construct() {
        add_action('wp_ajax_delete_listing', [$this, 'stm_delete_listing']);
        add_action('wp_ajax_nopriv_delete_listing', [$this, 'stm_delete_listing']);
    }

    public function stm_delete_listing() {
        $nonce = isset($_POST['nonce']) ? $_POST['nonce'] : '';

        if (!wp_verify_nonce($nonce, 'delete_listing_nonce')) {
            wp_send_json_error('Invalid nonce.');
        }

        $listing_id = isset($_POST['listing_id']) ? intval($_POST['listing_id']) : 0;

        if (! current_user_can('delete_post', $listing_id)) {
            wp_send_json([
                'success' => false,
                'message' => __('You do not have permission to delete this listing.', 'startups-market'),
            ]);
        }

        if (wp_delete_post($listing_id, true)) {
            wp_send_json([
                'success' => true,
                'message' => __('Listing permanently deleted.', 'startups-market'),
            ]);
        } else {
            wp_send_json([
                'success' => false,
                'message' => __('Failed to permanently delete the listing.', 'startups-market'),
            ]);
        }
    }
}
