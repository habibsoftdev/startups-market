<?php 

namespace Startups\Market\Admin;
use Startups\Market\Singleton\SingletonTrait;

/**
 * List of Seller Handler class
 */
class Sellerview{

    use SingletonTrait;
    public function __construct(){
        $this->seller_view_table();
    }

    public function seller_view_table(){

        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php _e( 'All Sellers', 'startups-market' ); ?> </h1>
            <a href="<?php echo admin_url( 'user-new.php' ); ?>" class="page-title-action"><?php _e( 'Add New Seller', 'startups-business' ); ?></a>

            <form action="" method="post">
                <?php 
                    $table = Sellerlist::instance();
                    $table->prepare_items();
                    $table->display();
                ?>
            </form>
        </div>


        <?php 

    }
}

