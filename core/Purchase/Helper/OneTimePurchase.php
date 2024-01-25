<?php 

namespace Startups\Market\Purchase\Helper;
class OneTimePurchase extends \WC_Order_Item_Product {

    public function get_business_listing_product_id() {
        return $this->get_product_id();
    }

    // Add any additional methods or customization you may need

}