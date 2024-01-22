<?php 

namespace Startups\Market\Purchase\Modal;
use WC_Order_Item_Product;
use Startups\Market\Purchase\Helper\Stm_WC_Helper;
class CPTOrderItemProduct extends WC_Order_Item_Product{

    public $legacy_values;

    public $legacy_cart_item_key;

    public function set_product_id( $value ){
        $current_post_type = get_post_type( absint( $value ) );

        if( ! Stm_WC_Helper::is_supported( $current_post_type ) ){
            parent::set_product_id( absint( $value ) );
        }else{
            $this->set_prop( 'product_id', absint( $value ) );
        }
    }
}