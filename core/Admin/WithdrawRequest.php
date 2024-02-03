<?php 

namespace Startups\Market\Admin;
use Startups\Market\Singleton\SingletonTrait;

/**
 * Widthrawal Request class
 */

class WithdrawRequest{

    use SingletonTrait;

    public function __construct(){
        $this->show_widthrawal_list_table();
    }

    public function show_widthrawal_list_table(){
        if (isset($_GET['action']) && $_GET['action'] === 'delete_withdrawal') {
            $withdrawal_id = absint($_GET['withdrawal_id']);
            delete_withdrawal_data($withdrawal_id);
        }
        ?>
            <div class="wrap">
            <h1 class="wp-heading-inline"><?php _e( 'All Withdrawal Request', 'startups-market' ); ?> </h1>

            <form action="" method="post">
                <?php 
                    $table = WithdrawTable::instance();
                    $table->prepare_items();
                    $table->display();
                ?>
            </form>
        </div>

        <?php 
    }
}