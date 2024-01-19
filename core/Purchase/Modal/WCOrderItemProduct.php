<?php

namespace Startups\Market\Purchase\Modal;

use WC_Order_Item_Product;

class WCOrderItemProduct extends WC_Order_Item_Product {

    /**
     * @var array|null Holds legacy values.
     */
    protected $legacy_values;

    /**
     * @var string|null Holds legacy cart item key.
     */
    protected $legacy_cart_item_key;

    /**
     * Constructor.
     *
     * You can add any initialization logic here if needed.
     */
    public function __construct() {
        // Add initialization logic if needed.
    }

    /**
     * Set Product ID.
     *
     * @param int $value Product ID.
     */
    public function set_product_id($value){
        $this->set_prop('product_id', absint($value));
    }
}
