<?php 

namespace Startups\Market\Admin;
use Startups\Market\Trait\SingletonTrait;

/**
 * Withdrawal Request List Table Class
 */

 if ( !class_exists('WP_List_Table')){
    require_once ABSPATH. 'wp-admin/includes/class-wp-list-table.php';
}
 class WithdrawTable extends \WP_List_Table{
    use SingletonTrait;

    public function __construct(){
        parent::__construct([
            'singular' => 'Withdrawal Request',
            'plural'   => 'Withdrawal Requests',
            'ajax'     => false,
        ]);
    }

    public function get_columns(){
        return [
            'cb'            => '<input type="checkbox" />',
            'display_name'  => __( 'Seller Name', 'startups-market' ),
            'seller_account'    => __( 'Account Information', 'startups-market' ),
            'withdraw_amount'  => __( 'Withdraw Amount', 'startups-market' ),
            'status'       => __( 'Status', 'startups-market' ),
            'admin_action' => __( 'Action', 'startups-market' ),

        ];
    }

    public function prepare_items(){
        $columns = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();
        $data = $this->get_withdrawal_data();
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
            'withdraw_amount' => [ 'withdraw_amount', false ],
            'status'   => [ 'status', false ],
        ];
    }

    public function column_default($item, $column_name) {
        if ($column_name === 'admin_action' && isset($item['ID'], $item['status']) && $item['status'] === 'pending') {
            // Assuming $item['ID'] is the withdrawal ID
            $approve_url = add_query_arg(
                array(
                    'action' => 'approve_withdrawal',
                    'withdrawal_id' => $item['ID'],
                ),
                admin_url('admin.php?page=stm-withdraw-request')
            );
    
            return '<button type="button" class="button button-primary approve-btn ' . ($item['action'] ? 'approved' : '') . '" data-withdrawal-id="' . $item['ID'] . '" data-admin-action="' . $item['action'] . '">Approve</button>';
        }
    
        return isset($item[$column_name]) ? $item[$column_name] : '';
    }

    public function column_cb( $item ){
        return sprintf(
            '<input type="checkbox" name="withdrawal[]" value="%s" />',
            $item[ 'ID' ]
        );
    }

    public function get_withdrawal_data(){

        $withdraw_data = [];

        $all_data = get_all_withdrawal_data();

        foreach( $all_data as $data ){
            $user_id = $data['user_id'];
            $userinfo = get_userdata( $user_id );
            $bank_name = get_user_meta( $user_id, 'stm_bank_name', true );
            $account = get_user_meta( $user_id, 'stm_bank_account', true );
            $account_type = get_user_meta( $user_id, 'stm_account_type', true );
            $routing = get_user_meta( $user_id, 'stm_bank_routing', true );

            $withdraw_data[] = [
                'ID' => $data[ 'id' ],
                'display_name' => $userinfo->display_name,
                'seller_account' => $bank_name.' | '.$account.' | '. $account_type.' | '.$routing,
                'withdraw_amount' => $data['amount'],
                'status' => $data[ 'status' ],
                'action' => $data['admin_action'],
            ];
        }

        return $withdraw_data;
    }

    public function column_display_name($item) {
        if (isset($item['ID'], $item['display_name'])) {
            $delete_url = add_query_arg(
                array(
                    'action' => 'delete_withdrawal',
                    'withdrawal_id' => $item['ID'],
                ),
                admin_url('admin.php?page=stm-withdraw-request') 
            );
    
            $actions = array(
                'delete' => sprintf(
                    '<a href="%s" onclick="return confirm(\'Are you sure you want to delete this withdrawal request?\')">Delete</a>',
                    esc_url($delete_url)
                ),
            );
    
            return sprintf(
                '<a href="%1$s"><strong>%2$s</strong></a> %3$s',
                '#',
                $item['display_name'],
                $this->row_actions($actions)
            );
        }
    
        return '';
    }




 }