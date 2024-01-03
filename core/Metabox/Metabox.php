<?php 

namespace Startups\Market\Metabox;
use Startups\Market\Metabox\Pricing;
use Startups\Market\Metabox\SaveMetabox;
use Startups\Market\Metabox\Businessinfo;
use Startups\Market\Metabox\Gallery;

/**
 * Metabox class
 */
class Metabox{
   
    public function __construct(){
        add_action( 'add_meta_boxes', [ $this, 'stm_pricing_metabox' ] );
        add_action( 'save_post', [ $this, 'save_metabox_content' ] );

    }

    /**
     * Nonce and Security Verfication
     *
     * @param string $nonce
     * @param string $action
     * @param int $post_id
     * @return bool
     */
    public function nonce_verification( $nonce, $action, $post_id){

        if( ! wp_verify_nonce( $_POST[ $nonce], $action ) ){
            return false;
        }

        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
            return false;
        }

        if( ! current_user_can( 'edit_post', $post_id ) ){
            return false;
        }
        
        return true;
    }

    /**
     * Metabox action method
     *
     * @return void
     */
    public function stm_pricing_metabox(){
        add_meta_box(
            'pricing_metabox',
            __( 'Pricing', 'startups-metabox' ),
            [ $this, 'render_pricing_metabox' ],
            'business',
            'normal',
            'high'
        );

        add_meta_box(
            'business_info',
            __( 'Business Informations', 'startups-metabox' ),
            [ $this, 'render_business_info' ],
            'business',
            'normal',
            'high'
        );

        add_meta_box(
            'gallery_info',
            __( 'Screenshots/Gallery', 'startups-metabox' ),
            [ $this, 'render_gallery' ],
            'business',
            'normal',
            'high'
        );
    }

    //Callback function
    public function render_pricing_metabox( $post ){
        new Pricing($post);
    }

    //Callback function
    public function render_business_info( $post ){
        new Businessinfo( $post );
    }

    //Callback function
    public function render_gallery( $post ){
        new Gallery( $post );
    }

    /**
     * Save Post Meta
     *
     * @param int $post_id
     * @return int
     */
    public function save_metabox_content( $post_id ){

        if( $this->nonce_verification( 'stm_pricing_nonce', 'stm_pricing', $post_id ) ){

            SaveMetabox::save_pricing_metabox( $post_id );
        }

        if( $this->nonce_verification( 'stm_business_info_nonce', 'stm_business_info', $post_id ) ){

            SaveMetabox::save_businessinfo_metabox( $post_id );
        }

        if( $this->nonce_verification( 'stm_gallery_nonce', 'stm_gallery_field', $post_id ) ){

            SaveMetabox::save_gallery_images( $post_id );
        }

        return $post_id;
       
    }


}