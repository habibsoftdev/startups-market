<?php 

namespace Startups\Market\Admin;

if ( !class_exists('WP_List_Table')){
    require_once ABSPATH. 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * List table class
 */

class Sellerlist extends \WP_List_Table{
    public function __construct(){
        parent::__construct([
            'singular' => 'Seller',
            'plural'   => 'Sellers',
            'ajax'     => false,
        ]);
    }

    public function get_columns(){
        return [
            'cb'            => '<input type="checkbox" />',
            'display_name'  => __( 'Name', 'startups-market' ),
            'user_email'    => __( 'Email Address', 'startups-market' ),
            'phone_number'  => __( 'Phone', 'startups-market' ),
            'country'       => __( 'Country', 'startups-market' ),

        ];
    }

    public function prepare_items(){
        $columns = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();

        $data = $this->get_buyers_data();

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
            'display_name' => [ 'display_name', false ],
            'user_email'   => [ 'user_email', false ],
            'phone_number' => [ 'phone_number', false ],
            'country'      => [ 'country', false ],
        ];
    }

    public function column_default( $item, $column_name ){
        return isset( $item[ $column_name ] ) ? $item[ $column_name ] : '';
    }

    public function column_cb( $item ){
        return sprintf(
            '<input type="checkbox" name="seller[]" value="%s" />',
            $item[ 'ID' ]
        );
    }

    public function get_buyers_data(){
        $seller_data = [];

        $args = [
            'role'      => 'seller',
            'orderby'  => 'ID',
            'order'     => 'ASC',
        ];
    
        $sellers = get_users($args);
    
        foreach( $sellers as $seller ){
            $seller_data[] = [
                'ID' => $seller->ID,
                'display_name' => $seller->display_name,
                'user_email' =>$seller->user_email,
                'phone_number' => get_user_meta( $seller->ID, 'phone_number', true ),
                'country' => get_user_meta( $seller->ID, 'country', true ),
            ];
        }
    
        return $seller_data;
    }

    public function column_display_name( $item ) {

        if ( isset( $item[ 'ID' ], $item[ 'display_name' ] ) ) {
            $edit_url = get_edit_user_link( $item[ 'ID' ] );
            $delete_url = add_query_arg( [ 'action' => 'delete', 'user' => $item[ 'ID' ] ] );
    
            $actions = [
                'edit'   => sprintf( '<a href="%s">Edit</a>', $edit_url ),
                'delete' => sprintf( '<a href="%s" onclick="return confirm(\'Are you sure you want to delete this seller?\')">Delete</a>', $delete_url ),
            ];
    
            return sprintf( '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url('user-edit.php?user_id='. $item[ 'ID' ] ), $item[ 'display_name' ], $this->row_actions( $actions ) );
        }
    
        return '';
    }
}