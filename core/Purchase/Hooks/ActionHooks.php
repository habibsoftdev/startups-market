<?php 

namespace Startups\Market\Purchase\Hooks;
use Startups\Market\Purchase\Helper\Stm_WC_Helper;
use Startups\Market\Singleton\SingletonTrait;

/**
 * Main Action Hooks Class
 */
class ActionHooks{

	use SingletonTrait;
    
	/**
	 * Init Hooks.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'save_post', [ $this, 'update_product_price' ], 15 );
		add_action( 'the_post', [ $this, 'wc_setup_product_data' ], 15 );
	}

	/**
	 * When the_post is called, put product data into a global.
	 *
	 * @param mixed $post Post Object.
	 * @return mixed
	 */
	public function wc_setup_product_data( $post ) {
		if ( is_int( $post ) ) {
			$post = get_post( $post );
		}
		if ( ! Stm_WC_Helper::is_supported( $post->post_type ) ) {
			return;
		}
		$GLOBALS['product'] = wc_get_product( $post );
		return $GLOBALS['product'];
	}

	/**
	 * @param int $post_id post id.
	 *
	 * @return void
	 */
	public function update_product_price( $post_id ) {
		$post_type = get_post_type( $post_id );
		if ( ! Stm_WC_Helper::is_supported( $post_type ) ) {
			return;
		}
		$regular = Stm_WC_Helper::price_meta_key( $post_type, 'regular_price_field' );
		$sale    = Stm_WC_Helper::price_meta_key( $post_type, 'sale_price_field' );

		if ( isset( $_POST[ $regular ] ) ) {
			$regular_price = sanitize_text_field( $_POST[ $regular ] ?? '' );
			update_post_meta( $post_id, '_regular_price', $regular_price );
		}
		if ( isset( $_POST[ $sale ] ) ) {
			$sale_price = sanitize_text_field( $_POST[ $sale ] ?? '' );
			update_post_meta( $post_id, '_sale_price', $sale_price );
		}
	}
}