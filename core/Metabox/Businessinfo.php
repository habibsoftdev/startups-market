<?php 

namespace Startups\Market\Metabox;
use Startups\Market\Singleton\SingletonTrait;

/**
 * Metabox Business Info Html Elements
 */
class Businessinfo{

    use SingletonTrait;

    public function __construct( $post ){
        $this->businessinfo_html_content( $post );
    }


    private function businessinfo_html_content( $post ){

        //Retrive the value 
        $arr = get_post_meta( $post->ID, 'stm_arr', true );
        $sarr = get_post_meta( $post->ID, 'stm_sarr', true );
        $launched = get_post_meta( $post->ID, 'stm_launched', true );
        $delivery = get_post_meta( $post->ID, 'deliveryable_text', true );
        $website = get_post_meta( $post->ID, 'stm_website', true );
        
        ?>
        <div class="stm-form-section stm-content-module snipcss-6E7lN">
  <div class="stm-content-module__title">
    <h4>
      <?php _e( 'Business Information', 'startups-market' ); ?>
    </h4>
  </div>
  <div class="stm-content-module__contents">
    <div class="stm-form-group stm-form-zip-field">
      <div class="stm-form-label">
        <?php _e( 'Annual Recurring Revenue', 'startups-market' ); ?>
      </div>
      <?php wp_nonce_field( 'stm_business_info', 'stm_business_info_nonce') ?>
      <input type="number" name="stm_arr" id="arr" class="stm-form-element" value="<?php esc_attr_e( $arr ); ?>" placeholder="<?php esc_attr_e( 'Example: $5000', 'startups-market'); ?>">
    </div>
    <div class="stm-form-group stm-form-phone-field">
      <div class="stm-form-label">
      <?php _e( 'Last 6 month Revenue', 'startups-market' ); ?>
      </div>
      <input type="number" name="stm_sarr" id="sarr" class="stm-form-element" value="<?php esc_attr_e( $sarr ); ?>" placeholder="<?php esc_attr_e( 'Last 6 month Revenue: $5000', 'startups-market'); ?>">
    </div>
    <div class="stm-form-group stm-form-launched-field">
      <div class="stm-form-label">
      <?php _e( 'Launched: ', 'startups-market' ); ?>
      </div>
      <input type="date" name="stm_launched" id="launched" class="stm-form-element" value="<?php esc_attr_e( $launched ); ?>" placeholder="">
    </div>
    <div class="stm-form-group stm-form-email-field">
      <div class="stm-form-label">
      <?php _e( 'Deliveryable Assets: ', 'startups-market' ); ?>
      </div>
      <input type="text" name="deliveryable_text" id="deliveryable_text" class="stm-form-element" value="<?php esc_attr_e( $delivery ); ?>" placeholder="<?php esc_attr_e( 'example: domain, websites, etc', 'startups-market'); ?>">
    </div>
    <div class="stm-form-group stm-form-website-field">
      <div class="stm-form-label">
        <?php _e( 'Website: ', 'startups-market' ); ?>
      </div>
      <input type="text" name="stm_website" id="website" class="stm-form-element" value="<?php esc_attr_e( $website ); ?>" placeholder="<?php esc_attr_e( 'www.example.com', 'startups-market'); ?>">
    </div>
  </div>
</div>


        <?php
    }
}