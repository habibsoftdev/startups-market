<?php

namespace Startups\Market\Purchase\Modal;

use Exception;

if (!defined('ABSPATH')) {
    exit('Direct Access Not Allowed');
}

/**
 * Trait for reading WooCommerce product data.
 */
trait WCProductDataRead
{
    /**
     * Read product data.
     *
     * @param WC_Product $product The product object.
     *
     * @throws Exception If the product is invalid.
     */
    public function read(&$product)
    {
        $product->set_defaults();

        if (!$product->get_id() || !($post_object = get_post($product->get_id())) || 'product' !== $post_object->post_type) {
            throw new Exception(__('Invalid product.', 'woocommerce'));
        }
        $id = $product->get_id();
        $product->set_props([
                'name'              => $post_object->post_title,
				'slug'              => $post_object->post_name,
				'date_created'      => 0 < $post_object->post_date_gmt ? wc_string_to_timestamp( $post_object->post_date_gmt ) : null,
				'date_modified'     => 0 < $post_object->post_modified_gmt ? wc_string_to_timestamp( $post_object->post_modified_gmt ) : null,
				'status'            => $post_object->post_status,
				'description'       => $post_object->post_content,
				'short_description' => $post_object->post_excerpt,
				'parent_id'         => $post_object->post_parent,
				'menu_order'        => $post_object->menu_order,
				'reviews_allowed'   => 'open' === $post_object->comment_status,
        ]);

        $this->read_attributes($product);
        $this->read_downloads($product);
        $this->read_visibility($product);
        $this->read_product_data($product);
        $this->read_extra_data($product);
        $product->set_object_read(true);

        do_action('woocommerce_product_read', $id);
    }
}
