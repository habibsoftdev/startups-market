<?php  

namespace Startups\Market\Metabox;
use Startups\Market\Trait\SingletonTrait;

class Pricing{

  use SingletonTrait;

  private static $option_name = 'stm_pricing_instance';

  public function __construct($post){
        $this->pricing_html_content($post);
    }


  private function pricing_html_content( $post ){
    $tagline = get_post_meta( $post->ID, 'stm_tagline', true );
    $pricing = get_post_meta( $post->ID, 'stm_price', true );
    ?>

      <div class="stm-form-section stm-content-module ">
        <div class="stm-content-module__title ">
          <h4>
            <?php _e( 'Pricing', 'startups-market' ); ?>
          </h4>
        </div>
        <div class="stm-content-module__contents tether-element-attached-top tether-element-attached-center tether-target-attached-top tether-target-attached-center">
          <div class="stm-form-group stm-form-tagline-field  ">
            <div class="stm-form-label">
              <?php _e( 'Tagline:', 'startups-market' ); ?>
            </div>
            <?php wp_nonce_field( 'stm_pricing', 'stm_pricing_nonce'); ?>
            <input type="text" name="stm_tagline" id="tagline" class="stm-form-element" value="<?php esc_attr_e( $tagline ); ?>" placeholder="">
          </div>
          <div class="stm-form-group stm-form-pricing-field price-type-both">
            <div class="stm-form-label">
              <?php _e( 'Asking Price:', 'startups-market' ); ?>
            </div>
            <input type="hidden" id="atbd_listing_pricing" value="" >
            <div class="stm-form-pricing-field__options">
              <div class="stm-checkbox directorist_pricing_options">
                <label for="price_selected" class="stm-checkbox__label" data-option="price">
                <?php _e( 'Price [USD]', 'startups-market' ); ?>
                </label>
              </div>
            </div>
            <input type="number" step="any" id="price" name="stm_price" value="<?php esc_attr_e( $pricing ); ?>" class="stm-form-element directory_field directory_pricing_field" placeholder="<?php esc_attr_e( 'Price of this listing. Eg. 100', 'startups-marekt'); ?>">
        </div>
    </div>
  </div>

<?php

    }
}
