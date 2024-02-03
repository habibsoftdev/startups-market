<?php 

namespace Startups\Market\Admin;
use Startups\Market\Singleton\SingletonTrait;

/**
 * List of Buyer in Admin Area class
 */
class Buyerview{

    use SingletonTrait;

    public function __construct(){
        $this->buyer_view_table();
    }

    public function buyer_view_table(){

        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php _e( 'All Buyers', 'startups-market' ); ?> </h1>
            <a href="<?php echo admin_url( 'user-new.php' ); ?>" class="page-title-action"><?php _e( 'Add New Buyer', 'startups-business' ); ?></a>

            <form action="" method="post">
                <?php 
                    $table = Buyerlist::instance();
                    $table->prepare_items();
                    $table->display();
                ?>
            </form>
        </div>


        <?php 

    }
}

