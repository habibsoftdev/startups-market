<?php 

namespace Startups\Market\Purchase\Hooks;
use Startups\Market\Purchase\Modal\CPTOrderItemProduct;
use Startups\Market\Purchase\Modal\CPTProductDataStore;
use Startups\Market\Purchase\Helper\Stm_WC_Helper;
use Startups\Market\Singleton\SingletonTrait;

class FilterHooks{

	use SingletonTrait;

    public function __construct() {
		// Plugins Setting Page.
		add_filter( 'woocommerce_data_stores', [ $this, 'cptwoo_data_stores' ], 99 );
		add_filter( 'woocommerce_product_get_price', [ $this, 'cptwoo_product_get_price' ], 15, 2 );
		// Show meta value after post content This will be shortcode.

		// Order Product Class.
		add_filter( 'woocommerce_get_order_item_classname', [ $this, 'get_order_item_classname' ], 12 );
		// Checkout Page issue. Plugin Support.
		add_filter( 'woocommerce_checkout_create_order_line_item_object', [ $this, 'checkout_create_order_line_item_object' ], 12 );
	}
	
	/**
	 * Price
	 *
	 * @param string $price price.
	 * @param object $product Product.
	 *
	 * @return mixed
	 */
	public function cptwoo_product_get_price( $price, $product ) {

		$post_type = get_post_type( $product->get_id() );
		if ( ! Stm_WC_Helper::is_supported( $post_type ) ) {
			return $price;
		}

		if ( is_null( $price ) || '' === $price ) {
			$price = get_post_meta( $product->get_id(), '_sale_price', true );
		}
		if ( is_null( $price ) || '' === $price ) {
			$price = get_post_meta( $product->get_id(), '_regular_price', true );
		}

		return $price;
	}

	/**
	 * @param array $stores storelist.
	 *
	 * @return mixed
	 */
	public function cptwoo_data_stores( $stores ) {
		$stores['product'] = CPTProductDataStore::class;

		return $stores;
	}

	/**
	 * Order Item Class
	 *
	 * @param string $classname Clasname.
	 * @return string
	 */
	public function get_order_item_classname( $classname ) {
		if ( 'WC_Order_Item_Product' === $classname ) {
			$classname = 'Startups\Market\Purchase\Modal\CPTOrderItemProduct';
		}

		return $classname;
	}

	/**
	 * Order item class.
	 *
	 * @param object $obj_WC_Order_Item_Product object.
	 * @return CPTOrderItemProduct
	 */
	public function checkout_create_order_line_item_object( $obj_WC_Order_Item_Product ) {
		$obj_WC_Order_Item_Product = CPTOrderItemProduct::instance();

		return $obj_WC_Order_Item_Product;
	}
}