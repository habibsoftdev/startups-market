<?php 

namespace Startups\Market\Metabox;

/**
 * Metabox Meta Value Save Class
 */
class SaveMetabox{

    public static function save_pricing_metabox( $post_id ){
        
        $tagline = isset( $_POST[ 'stm_tagline' ] ) ? sanitize_text_field( $_POST[ 'stm_tagline'] ) : '';
        $pricing = isset( $_POST[ 'stm_price' ] ) ? sanitize_text_field( $_POST[ 'stm_price'] ) : '';

        update_post_meta( $post_id, 'stm_tagline', $tagline );
        update_post_meta( $post_id, 'stm_price', $pricing );

    }

    public static function save_businessinfo_metabox( $post_id ){

        $arr = isset( $_POST[ 'stm_arr' ] ) ? sanitize_text_field( $_POST[ 'stm_arr'] ) : '';
        $sarr = isset( $_POST[ 'stm_sarr' ] ) ? sanitize_text_field( $_POST[ 'stm_sarr'] ) : '';
        $launched = isset( $_POST[ 'stm_launched' ] ) ? sanitize_text_field( $_POST[ 'stm_launched'] ) : '';
        $deliverasset = isset( $_POST[ 'deliveryable_text' ] ) ? sanitize_text_field( $_POST[ 'deliveryable_text'] ) : '';
        $website = isset( $_POST[ 'stm_website' ] ) ? sanitize_text_field( $_POST[ 'stm_website'] ) : '';


        update_post_meta( $post_id, 'stm_arr', $arr );
        update_post_meta( $post_id, 'stm_sarr', $sarr );
        update_post_meta( $post_id, 'stm_launched', $launched );
        update_post_meta( $post_id, 'deliveryable_text', $deliverasset );
        update_post_meta( $post_id, 'stm_website', $website );

    }

    public static function save_gallery_images( $post_id ){

        $image_id = isset( $_POST['stm_images_id'] ) ? sanitize_text_field( $_POST[ 'stm_images_id' ] ) : '';
        $image_url = isset( $_POST[ 'stm_images_url'] ) ? esc_url( $_POST[ 'stm_images_url' ] ) : '';

        $video_url = isset( $_POST[ 'videourl'] ) ? esc_url( $_POST[ 'videourl' ] ) : '';

        update_post_meta( $post_id, 'stm_images_id', $image_id );
        update_post_meta( $post_id, 'stm_images_url', $image_url );
        update_post_meta( $post_id, 'stm_videourl', $video_url );
    }
}