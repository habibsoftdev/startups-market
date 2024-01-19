<?php

namespace Startups\Market\Purchase;

use Modal\WCDataStore;
use Startups\Market\Purchase\Modal\WCProductDataRead;
use Startups\Market\Purchase\Modal\WCOrderItemProduct;
use Startups\Market\Purchase\Modal\WCDataStore as ModalWCDataStore;

/**
 * WooCommerce Customization Settings
 */
class Settings
{

    public function __construct()
    {
        
        add_filter('woocommerce_data_stores', [$this, 'stm_woo_data_stores'], 99);
        add_filter('woocommerce_product_get_price', [$this, 'stm_woo_product_get_price'], 15, 2);
        add_filter('woocommerce_get_order_item_classname', [$this, 'stm_get_order_item_classname'], 12, 3);
        add_filter('woocommerce_checkout_create_order_line_item_object', [$this, 'stm_checkout_create_order_line_item_object'], 12);
        add_filter('woocommerce_product_data_tabs', [$this, 'stm_product_data_tabs'], 20);
        add_filter('woocommerce_format_sale_price', [$this, 'stm_format_sale_price'], 20);
        add_filter('is_woocommerce', [$this, 'is_woocommerce'], 20);
        add_filter('woocommerce_product_get_sale_price', [$this, 'stm_product_get_sale_price'], 10, 2);
        add_filter('woocommerce_account_downloads_columns', [$this, 'account_downloads_columns'], 15);
        add_action('woocommerce_account_downloads_column_post-type', [$this, 'account_downloads_column'], 15);
        add_action('the_post', [$this, 'wc_setup_product_data'], 15);
        add_action('pre_get_posts', [$this, 'wc_setup_loop'], 5);
        add_action( 'wp_body_open', [ $this, 'wp_body_open' ], 5 );
        add_action( 'wp_footer', [ $this, 'wp_footer' ], 99 );
    }

    public function stm_woo_data_stores($stores) {
        $stores['product'] = ModalWCDataStore::class; // Assuming "business" is your post type slug.
        return $stores;
    }

    public function stm_woo_product_get_price($price, $product) {
        if ($product->is_type('business')) {
            $custom_price = get_post_meta($product->get_id(), 'stm_price', true);
            $price = ($custom_price) ? floatval($custom_price) : $price;
        }
        return $price;
    }

    public function stm_get_order_item_classname($classname, $item_type, $id)
    {

        if ('WC_Order_Item_Product' === $classname) {
            $classname = '\Startups\Market\Purchase\Modal\WCOrderItemProduct';
        }

        return $classname;
    }

    public function stm_checkout_create_order_line_item_object($obj_WC_Order_Item_Product)
    {
        $obj_WC_Order_Item_Product = new WCOrderItemProduct();

        return $obj_WC_Order_Item_Product;
    }

    public function stm_product_data_tabs($tabs)
    {
        unset(
            $tabs['marketplace-suggestions']
        );
        return $tabs;
    }

    public function stm_format_sale_price($price)
    {
        return '<span class="stm-price-wrapper">' . $price . '</span>';
    }

    public function is_woocommerce($is_woocommerce) {
        $post_type = 'business';
        return $is_woocommerce || $post_type;
    }

    public function stm_product_get_sale_price($sale_price, $product)
    {
        $custom_sale_price = get_post_meta($product->get_id(), 'stm_price', true);

        // If the custom sale price is set, use it; otherwise, use the original sale price
        $sale_price = ($custom_sale_price) ? floatval($custom_sale_price) : $sale_price;

        return $sale_price;
    }

    public function account_downloads_columns()
    {
        $column['post-type'] = apply_filters('stm_account_downloads_columns_type', esc_html__('Type', 'startups_market'));
        return $column;
    }

    public function account_downloads_column($download)
    {
        $post_type = get_post_type($download['product_id']);
        echo esc_html($post_type);
    }

    public function wc_setup_product_data($post)
    {
        if (is_int($post)) {
            $post = get_post($post);
        }
        $GLOBALS['product'] = wc_get_product($post->ID);
        return $GLOBALS['product'];
    }

    public function wc_setup_loop($query)
    {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }
    
        if (is_post_type_archive('business') || is_tax('business')) {
            $query->set('post_type', array('product', 'business'));
        }
    }

    public function wp_body_open() {
		?>
		<div class="product">
		<?php
	}

    public function wp_footer() {
		?>
		</div>
		<!-- End Product Class -->
		<?php
	}
}
