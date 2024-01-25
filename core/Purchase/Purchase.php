<?php

namespace Startups\Market\Purchase;
use Startups\Market\Purchase\Hooks\ActionHooks;
use Startups\Market\Purchase\Hooks\FilterHooks;
use Startups\Market\Trait\SingletonTrait;
use Startups\Market\Purchase\Helper\OneTimePurchase;


/**
 * Woocommerce Handler Class
 */

class Purchase{

    use SingletonTrait;

    public function __construct(){
        
        ActionHooks::instance();
        FilterHooks:: instance();
        add_filter( 'woocommerce_get_page_id', [ $this, 'prevent_woocommerce_page_creation' ] );
        add_filter('woocommerce_cart_redirect_after_error', '__return_false');
        add_filter('woocommerce_is_cart', '__return_false');
        add_filter('woocommerce_account_menu_items', '__return_empty_array');
        add_filter( 'woocommerce_is_sold_individually', [ $this, 'disable_quantity_field' ] );
        //add_action( 'admin_init', [ $this, 'wc_admin_init' ] );
        add_action('wp_head', [ $this, 'hide_woocommerce_notices_on_checkout' ]);
        add_filter('woocommerce_quantity_input_args', [ $this, 'customize_woocommerce_quantity_input_min_max_step' ], 10, 2);
        add_action('template_redirect', [ $this, 'remove_quantity_field_from_product_page' ] );
        add_filter('woocommerce_add_to_cart_validation', [ $this, 'validate_cart_item_quantity' ], 10, 3);
        add_filter('woocommerce_add_cart_item_data', [ $this, 'custom_clear_cart_on_add_to_cart' ], 10, 2);
        add_filter('woocommerce_cart_item_quantity', [ $this,'custom_set_cart_item_quantity' ], 10, 2);
        add_filter('woocommerce_checkout_cart_item_quantity', [ $this, 'custom_set_cart_item_quantity' ], 10, 2);
        add_action('woocommerce_before_cart', [ $this, 'custom_set_cart_item_quantity_on_cart_load' ], 10 );
        add_action('woocommerce_before_checkout_form', [ $this, 'custom_set_cart_item_quantity_on_cart_load' ], 10 );
        add_action( 'woocommerce_new_order', [ $this, 'update_custom_post_status_on_order_placement'], 10, 2 );
        add_action('woocommerce_admin_order_item_values', [ $this, 'display_product_id_in_order' ], 10, 3);
        add_action('woocommerce_before_checkout_form', [ $this,'check_product_sold_out_before_checkout' ] );
        
         

       
    }

    /**
     * Prevent Woocommerce Default Page
     *
     * @param int $page_id
     * @return int
     */
    public function prevent_woocommerce_page_creation( $page_id ){
        $blocked_pages = array(
            'cart',
            'myaccount',
            'view_order',
            'terms'
            // Add more pages you want to block as needed
        );
    
        if (in_array($page_id, $blocked_pages)) {
            return -1;
        }
    
        return $page_id;
    }

    /**
     * Diasable Quantity
     *
     * @return bool
     */
    public function disable_quantity_field(){
        return true;
    }

  
    public function hide_woocommerce_notices_on_checkout(){
         // Check if it's the checkout page
        if (is_checkout()) {
        // Output custom CSS to hide the WooCommerce notices wrapper
            echo '<style>.woocommerce-notices-wrapper { display: none !important; }</style>';
        }
    }

    public function customize_woocommerce_quantity_input_min_max_step($args, $product) {
        $args['input_value'] = 1;
        $args['min_value'] = 1;
        $args['max_value'] = 1;
        $args['step'] = 1;
        return $args;
    }

    // Remove quantity field from product page
    public function remove_quantity_field_from_product_page() {
        remove_action('woocommerce_before_single_product', 'woocommerce_quantity_input', 5);
    }

    // Validate cart item quantity before adding to cart
    public function validate_cart_item_quantity($passed, $product_id, $quantity) {
        if ($quantity > 1) {
            wc_add_notice(__('You can only buy one item at a time.'), 'error');
            return false;
        }
        return $passed;
    }

    // Remove existing products from the cart when a new product is added
    public function custom_clear_cart_on_add_to_cart($cart_item_data, $product_id) {
        // Clear the cart before adding the new product
        WC()->cart->empty_cart();
    
        return $cart_item_data;
    }
    
    // Update cart item quantity to 1 when a product is added
    public function custom_set_cart_item_quantity($cart_item_key, $quantity) {
        return 1;
    }
    
    // Update cart item quantity to 1 on cart load
    public function custom_set_cart_item_quantity_on_cart_load() {
        $cart = WC()->cart;
    
        foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            $cart_item['quantity'] = 1;
            $cart->cart_contents[$cart_item_key] = $cart_item;
        }
    }

    // Method to display product ID in order table
    public function display_product_id_in_order($product_id, $item, $order) {
        echo '<div class="product-id">';
        echo '<strong>Product ID:</strong> ' . $item->get_product_id();
        echo '</div>';
    }

    // Method to update custom post status on order placement
    public function update_custom_post_status_on_order_placement($order_id, $order) {
        // Loop through order items
        foreach ($order->get_items() as $item_id => $item) {
            // Get the product ID
            $product_id = $item->get_product_id();
            $product_type = get_post_type($product_id);
    
            if ($product_type === 'business') {
                // Update the post status to 'sold_out'
                wp_update_post(array('ID' => $product_id, 'post_status' => 'sold_out'));
            }
        }
    }

    public function check_product_sold_out_before_checkout() {
        // Check if WooCommerce is active
        if (class_exists('WooCommerce')) {
            global $woocommerce;
    
            // Get the cart contents
            $cart_items = $woocommerce->cart->get_cart();
    
            foreach ($cart_items as $cart_item_key => $cart_item) {
                $product_id = $cart_item['product_id'];
    
                // Check if the product is marked as "Sold Out"
                if (get_post_status($product_id) === 'sold_out') {
                    wc_add_notice(__('Sorry, the product is sold out and cannot be purchased.', 'your-textdomain'), 'error');
                    // Remove the sold-out product from the cart
                    $woocommerce->cart->remove_cart_item($cart_item_key);
                    // Redirect to the cart page
                    wp_redirect(home_url());
                    exit;
                }
            }
        }
    }
}