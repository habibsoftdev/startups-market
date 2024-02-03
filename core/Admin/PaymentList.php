<?php 

namespace Startups\Market\Admin;
use Startups\Market\Singleton\SingletonTrait;

class PaymentList{

    use SingletonTrait;
    public function __construct(){

        $this->show_payment_list();
    }

    public function show_payment_list(){
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php _e( 'All Payments List', 'startups-market' ); ?> </h1>

            <form action="" method="post">
                <?php 
                    $table = PaymentTable::instance();
                    $table->prepare_items();
                    $table->display();
                ?>
            </form>
        </div>

        <?php 
    }
}