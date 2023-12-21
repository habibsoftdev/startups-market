<?php 

namespace Startups\Market\Admin;

class Sellerview{

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
                    $table = new Sellerlist();
                    $table->prepare_items();
                    $table->display();
                ?>
            </form>
        </div>


        <?php 

    }
}
