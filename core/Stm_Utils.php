<?php 

namespace Startups\Market;


class Stm_Utils{

    

    public static function custom_icon($icon){
        
        $custom_icon =  STM_ASSETS. '/icons/' .$icon. '.svg';

        return '<i class="stm-icon-mask" aria-hidden="true" style="--stm-icon:url(' .$custom_icon. '});"></i>';
    }

    public static function get_edit_listing_page_link($listing_id) {
        $link = home_url();
        $page = get_page_by_path('/stm-add-listing');
        $page_id = $page->ID;
    
        if ($page_id) {
            $link = get_permalink($page_id);
            return add_query_arg(array('action' => 'edit', 'listing_id' => $listing_id), $link);
        }
    }

    public static function edit_link( $id ){
    
        
        $edit_link = self::get_edit_listing_page_link( $id );

        return $edit_link;

    }

    public static function post_count($current_user_id){

        $args = array(
        'author'         => $current_user_id,
        'post_type'      => 'business', // Change this to your custom post type if needed
        'posts_per_page' => -1, // Retrieve all posts
        'post_status'    => 'any',
        );

        $query = new \WP_Query($args);

        $post_count = $query->post_count;

        return $post_count;
    }

    public static function calculateEarningsAndFee($orderTotal, $feePercentage = 0.07) {
        // Calculate fee
        $fee = $orderTotal * $feePercentage;
    
        // Calculate earnings
        $earnings = $orderTotal - $fee;
    
        return [
            'fee' => $fee,
            'earnings' => $earnings,
        ];
    }

   public static function get_post_status_last_modified_date($post_id) {
    global $wpdb;

    $query = $wpdb->prepare("
        SELECT post_modified
        FROM $wpdb->posts
        WHERE ID = %d
        AND post_status = %s
    ", $post_id, 'sold_out');

    $date = $wpdb->get_var($query);

    return $date ? date('F j, Y', strtotime($date)) : false;
    }



}