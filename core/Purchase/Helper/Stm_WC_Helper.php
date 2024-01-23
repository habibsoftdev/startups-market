<?php 

namespace Startups\Market\Purchase\Helper;
use Startups\Market\Trait\SingletonTrait;

/**
 * Woocommerce Support Helper Class
 */

 if( ! defined( 'ABSPATH' ) ){
    exit( 'This script cannot be accessed directly' );
 }

class Stm_WC_Helper{

    use SingletonTrait;

    /**
     *
     * @param string $post_type Current post type
     * @param string $key
     * @return mixed/string
     */
    public static function price_meta_key( $post_type, $key = 'regular_price_field' ){
        return ! empty( STM_WC_SUPPORT[ $post_type ][ $key ] ) ? STM_WC_SUPPORT[ $post_type ][ $key ] : '_regular_price';
    }

    /**
     * Get pricing Meta Value
     *
     * @param int $product_id
     * @param string $key
     * @return mixed
     */
    public static function stm_get_price_meta_value( $product_id, $key='regular_price_field' ){
        $price = '';
        if( ! $product_id ){
            return $price;
        }

        $current_post_type = get_post_type( $product_id );

        if( ! self::is_supported( $current_post_type ) ){
            return $price;
        }

        $meta_key = self::price_meta_key( $current_post_type, $key );

        if( $meta_key ){
            $price = get_post_meta( $product_id, $meta_key, true );
        }

        return $price;
    }

    /**
     * Get Price
     *
     * @param int $product_id
     * @param string $key
     * @return mixed/void
     */
    public static function stm_get_price( $product_id, $key = 'regular_price_field' ){
        return self::stm_get_price_meta_value( $product_id, $key );
    }

    /**
     * Supported Post Type
     *
     * @return array
     */
    public static function supported_post_types(){
        return ! empty( STM_WC_SUPPORT ) ? array_keys( STM_WC_SUPPORT ) : [];
    }

    /**
     * Check post if supported
     *
     * @param string $post_type
     * @return boolean
     */
    public static function is_supported( $post_type ){
        return in_array( $post_type, self::supported_post_types(), true );
    }

}