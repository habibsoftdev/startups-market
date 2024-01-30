<?php 

namespace Startups\Market\Admin;
use Startups\Market\Trait\SingletonTrait;

/**
 * Withdrawal Request List Table Class
 */

 if ( !class_exists('WP_List_Table')){
    require_once ABSPATH. 'wp-admin/includes/class-wp-list-table.php';
}
class PaymentTable extends \WP_List_Table{
    use SingletonTrait;

    public function __construct(){
        parent::__construct([
            'singular' => 'Payment List',
            'plural'   => 'Payment Lists',
            'ajax'     => false,
        ]);
    }

    public function get_columns(){
        return [
            'cb'            => '<input type="checkbox" />',
            'order_id'  => __( 'Order Id', 'startups-market' ),
            'payment_amount'    => __( 'Payment Amount', 'startups-market' ),
            'buyer_name'  => __( 'Buyer Name', 'startups-market' ),
            'seller_name'       => __( 'Seller Name', 'startups-market' ),
            'status' => __( 'Status', 'startups-market' ),

        ];
    }

    public function prepare_items(){
        $columns = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();
        $data = $this->get_order_data();
        $perpage = 20;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args([
            'total_items' => $totalItems,
            'per_page'    => $perpage,
        ]);

        $data = array_slice( $data, (( $currentPage - 1 ) * $perpage ), $perpage );

        $this->_column_headers = [ $columns, $hidden, $sortable ];
        $this->items = $data;

    }

    public function get_sortable_columns(){
        return [
            'payment_amount' => [ 'payment_amount', false ],
            'status'   => [ 'status', false ],
        ];
    }

    public function column_default($item, $column_name) {
    
        return isset($item[$column_name]) ? $item[$column_name] : '';
    }

    public function column_cb( $item ){
        return sprintf(
            '<input type="checkbox" name="withdrawal[]" value="%s" />',
            $item[ 'ID' ]
        );
    }
// phpcs:disable
    public function get_order_data() {
        $order_data = [];
        $orders = wc_get_orders(['limit' => -1]);
    
        foreach ($orders as $order) {
            $order_id = $order->get_id();
            $payment_amount = $order->get_total();
            $buyer_name = $order->get_user() ? $order->get_user()->display_name : '';
            $order_status = $order->get_status();
    
            // Check if there are items in the order
            $items = $order->get_items();
            if (!empty($items)) {
                // Get the first item
                $item = reset($items);
                
                $product_id = $item->get_product_id();
        
                // Use wc_get_product to get the product object
                $product = wc_get_product($product_id);
    
                $author_id  = get_post_field('post_author', $product_id);
                $author_info = get_userdata($author_id);
        
                $order_data[] = [
                    'ID'            => $order_id,
                    'order_id'       => $order_id,
                    'payment_amount' => $payment_amount,
                    'buyer_name'     => $buyer_name,
                    'seller_name'    => $author_info->display_name,
                    'status'         => $order_status,
                ];
            }
        }
    
        return $order_data;
    }
// phpcs:enable
    public function column_display_name($item) {
        return isset($item['display_name']) ? $item['display_name'] : '';
    }



}