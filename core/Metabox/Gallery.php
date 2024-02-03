<?php 

namespace Startups\Market\Metabox;
use Startups\Market\Singleton\SingletonTrait;

class Gallery{

    use SingletonTrait;

    public function __construct( $post ){
      
        $this->stm_gallery_html( $post );
    }

    public function stm_gallery_html( $post ){

      //Retrive the value
      $image_ids = get_post_meta( $post->ID, 'stm_images_id', true );
      $image_urls = get_post_meta( $post->ID, 'stm_images_url', true );
      $video_url = get_post_meta( $post->ID, 'stm_videourl', true );
      
        ?>
    <div class="stm-form-section stm-content-module">
  <div class="stm-content-module__title">
    <h4>
      <?php _e( 'Images/Screenshots &amp; Video', 'startups-market') ?>
    </h4>
  </div>
  <div class="stm-content-module__contents">
    <div class="add_listing_form_wrapper" id="gallery_upload">
      <div class="form-group">
        <div class="listing-prv-img-container">
            <div id="stm_image_show">

            </div>
        </div>
      </div>
      <div class="form-group">
        <div class="listing-img-container">
          <?php wp_nonce_field( 'stm_gallery_field', 'stm_gallery_nonce'); ?>
          <input type="hidden" name="stm_images_id" id="stm_images_id" value="<?php esc_attr_e( $image_ids ); ?>">
          <input type="hidden" name="stm_images_url" id="stm_images_url" value="<?php esc_attr_e( $image_urls ); ?>">

          <small>
            <?php _e( '(allowed formats jpeg. png. gif)', 'startups-market' ); ?>
          </small>
        </div>
        <div class="justify-content-center">
          <button class="btn btn-primary" type="button" name="stm_gallery" id="stm_gallery_upload"><?php _e( 'Upload Slider Images', 'startups-market' ); ?>  </button>
       </div>
      </div>
    </div>
    <div class="stm-form-group stm-form-video-field">
      <div class="stm-form-label">
        <?php _e( 'Video:', 'startups-market' ); ?> 
      </div>
      <input type="url" name="videourl" id="videourl" class="stm-form-element" value="<?php esc_attr_e( $video_url ); ?>" placeholder="Only YouTube &amp; Vimeo URLs.">
    </div>
  </div>
</div>

        <?php 
    }
}