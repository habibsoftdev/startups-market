<?php 
/**
 * Template Name: Single Business
 * 
 * @package Startups Market
 */
if (!is_user_logged_in()) {
    wp_redirect(home_url()); // Redirect non-logged-in users to the home page
    exit;
}

get_header();

while( have_posts() ) : the_post();
   $post_id = get_the_ID();

   $pricing = get_post_meta( $post_id, 'stm_price', true );
   $tagline = get_post_meta( $post_id, 'stm_tagline', true );
   $arr = get_post_meta( $post_id, 'stm_arr', true );
   $srr = get_post_meta( $post_id, 'stm_sarr', true );
   $categories = get_the_terms($post_id, 'business_category');
   $launched = get_post_meta( $post_id, 'stm_launched', true );
   $delivery = get_post_meta( $post_id, 'deliveryable_text', true );
   $image_urls = get_post_meta($post_id, 'stm_images_url', true);
   $product_id = get_the_ID();
   $product_price = get_post_meta($product_id, 'stm_price', true);
   $checkout_url = wc_get_checkout_url() . '?add-to-cart=' . $product_id . '&price=' . $product_price;

   ?>

   <!-- <main class="singlemain-container container-fluid"> -->

    <div class="full-container">

        <!-- page container -->
        <section class="container-fluid all-box-container">
            <!-- Page first box container -->
            <section class="container-fluid first-box-container border border-1 rounded">

                <!-- Box content -->
                <div class="box-header-content">
                    <h1><?php the_title(); ?></h1>
                    <h6 class="py-2"><?php echo esc_html( $tagline ); ?></h6>
                    <p class="pb-1"> <?php echo esc_html__( 'Published on ', 'startups-market'); the_date(); ?></p>
                </div>
                <!-- horizontal line -->
                <hr class=" my-2">

                <!-- premium lock box -->
                <div class="box-header-img-container">
                    <div class="ag-format-container">
                        <div class="stm-layout">
                            <ul class="stm-slider">
                                <?php 
                                if ($image_urls) {
                                    // Convert the semicolon-separated string to an array
                                    $image_urls_array = explode(';', $image_urls);
                                
                                    // Loop through each image URL and display it
                                    foreach ($image_urls_array as $image_url) {
                                        // Output the image tag
                                        echo '<li><img src="' . esc_url($image_url) . '" alt="Image" class="img-fluid" /></li>';
                                    }
                                }
                                ?>   
                            </ul>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                        <symbol id="ei-arrow-left-icon" viewBox="0 0 50 50">
                        <path d="M25 42c-9.4 0-17-7.6-17-17S15.6 8 25 8s17 7.6 17 17-7.6 17-17 17zm0-32c-8.3 0-15 6.7-15 15s6.7 15 15 15 15-6.7 15-15-6.7-15-15-15z"></path>
                        <path d="M25.3 34.7L15.6 25l9.7-9.7 1.4 1.4-8.3 8.3 8.3 8.3z"></path>
                        <path d="M17 24h17v2H17z"></path>
                        </symbol>

                        <symbol id="ei-arrow-right-icon" viewBox="0 0 50 50">
                        <path d="M25 42c-9.4 0-17-7.6-17-17S15.6 8 25 8s17 7.6 17 17-7.6 17-17 17zm0-32c-8.3 0-15 6.7-15 15s6.7 15 15 15 15-6.7 15-15-6.7-15-15-15z"></path>
                        <path d="M24.7 34.7l-1.4-1.4 8.3-8.3-8.3-8.3 1.4-1.4 9.7 9.7z"></path>
                        <path d="M16 24h17v2H16z"></path>
                        </symbol>
                    </svg>
                </div>

      </section>

      <!-- post sale support box -->
      <section class="container-fluid post-sale-support-box border border-1 rounded my-4">
        <p>✔️ <?php esc_html_e( '30 days of post-sale support included', 'startups-market' ); ?></p>
    </section>

    <!-- overview full box section -->
    <section class="overview-container container-fluid border border-1 rounded">

        <!-- overview content -->
        <div class="overview-content">
            <h3><?php esc_html_e( 'Overview 🔍', 'startups-market' ); ?></h3>
            <?php the_content(); ?>
        </div>

        

    </section>
</section>


<!-- card container -->
<section class="container-fluid border border-1 card-container rounded">

    <!-- card header content -->
    <div class="card-header-content">
        <h3>Asking Price:</h3>
        <h2>$<?php echo esc_html( $pricing ); ?></h2>
    </div>

    <!-- card horizontal line -->
    <hr class="card-horizontal">

    <!-- card button -->
    <a href="<?php echo esc_url($checkout_url); ?>"><button type="button" class="contact-founder-btn w-100 container-fluid mb-3"><span class="pe-2"> Buy This Business </span></button></a>
    <?php echo shortcode_exists('cptwooint_price') ? do_shortcode( "[cptwooint_price/]" ) : '' ; ?> 

        <button type="button" class="startup-btn w-100 container-fluid"><span class="pe-2">VISIT STARTUP
        WEBSITE</span></button>

            <!-- card horizontal line -->
            <hr class="card-horizontal">

            <!-- card bottom content -->
            <div class="card-bottom-content ">
                <p>💰 <span class="fw-semibold px-1"><?php echo esc_html__( 'Annual Recurring Revenue: ', 'startups-market' ); ?></span> <span class="text-secondary">$<?php echo esc_html( $arr ) ?></span></p>
                <p>💰 <span class="fw-semibold px-1"><?php echo esc_html__( 'Last Six Month Revenue: ', 'startups-market' ); ?></span> <span class="text-secondary">$ <?php echo esc_html( $srr ); ?></span></p>
                <p>🚚 <span class="fw-semibold px-1"><?php echo esc_html__( 'Deliverable Assets: ', 'startups-market' ); ?></span> <span class="text-secondary"><?php echo esc_html( $delivery ); ?></span></p>
                <p>🙌🏻 <span class="fw-semibold px-1"><?php echo esc_html__( 'Launched: ', 'startups-market' ); ?></span> <span class="text-secondary"><?php echo esc_html( $launched ); ?></span></p>
                <p>🔍 <span class="fw-semibold px-1"><?php echo esc_html__( 'Category: ', 'startups-market' ); ?></span> <span class="text-secondary"><?php if ($categories && !is_wp_error($categories)){ 
                  foreach ($categories as $category) {
                    echo '<a href="' . esc_url(get_term_link($category)) . '" class="stm-category">' . esc_html($category->name) . '</a>';}}  ?></span>
                </p>
            </div>
        </section>
    </div>
<!-- </main> -->

<?php
endwhile;

get_footer(); 
?>