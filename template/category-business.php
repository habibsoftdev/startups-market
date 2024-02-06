<?php
/**
 * Template Name: Category Business Archive
 */

 echo '<!-- This is category-business.php -->';
 get_header();
 $paged = get_query_var('paged') ? get_query_var('paged') : 1;
 
 $category_id = get_queried_object_id();  // Get the current category ID
 
 $args = [
     'post_type'      => 'business',
     'posts_per_page' => 9,
     'paged'          => $paged,
     'orderby'        => 'menu_order',
     'tax_query'      => [
         [
             'taxonomy' => 'business_category',
             'field'    => 'term_id',
             'terms'    => $category_id,
         ],
     ],
 ];
 
 $archive_query = new WP_Query($args);
 ?>
<section class="arc-card-container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-start" >
     <?php  if ($archive_query->have_posts()) : 
        while( $archive_query->have_posts() ) :
            $archive_query->the_post();
            $post_id = get_the_ID();
            $categories = get_the_terms( $post_id, 'business_category');
            $post_status = get_post_status( $post_id );
            $status = ($post_status === 'sold_out' ) ? 'close-btn' : 'open-btn';
            $openclose = ($post_status === 'sold_out' ) ? __( 'Sold Out', 'startups-market' ) : __( 'Open Now', 'startups-market' );
            $price = get_post_meta( $post_id, 'stm_price', true );
            $arr = get_post_meta( $post_id, 'stm_arr', true );
            $srr = get_post_meta( $post_id, 'stm_sarr', true );
            $launched = get_post_meta( $post_id, 'stm_launched', true );
            $loggedin = is_user_logged_in() ? 1 : 'listing-stm-img';
            $permalink = get_the_permalink();


            ?>
            <!-- First Card -->
            <div class="col container-fluid my-3 mx-">
                <div class="card single-card-container">

                    <!-- card image -->
                    <a href="<?php echo esc_url( $permalink ); ?>">
                        <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'stm-list-thumbnail' ) ); ?>" class="card-img-top single-card-img <?php esc_attr_e($loggedin); ?>" alt="listing thumbnail"></a>

                        <!-- image over content -->
                        <div class="img-over-content">
                            <div class="img-content d-flex flex-column">
                                <a class="card-featured" href=""><?php esc_html_e( 'Featured', 'startups-market' ); ?></a>
                                <a class="card-popular" href=""><?php esc_html_e( 'Popular', 'startups-market' ); ?></a>
                            </div>
                        </div>
                        <!-- image over heart icon -->
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-heart img-heart-icon" viewBox="0 0 16 16">
                            <path
                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                        </svg>
                    </div>

                    <!-- card body -->
                    <div class="card-body">

                        <!-- card body title -->
                        <a href="<?php echo esc_url( $permalink ); ?>">
                            <h5 class="card-title py-2"><?php the_title(); ?></h5>
                        </a>
                        <!-- card button group -->
                        <div class="card-btn-group">
                            
                            <span  class="card-btn price-btn">$<?php echo number_format(esc_html( $price ), 0, '.', ',' ); ?></span>
                            <span class="card-btn <?php esc_attr_e($status); ?>" href=""><?php esc_attr_e( $openclose ); ?></span>
                        </div>

                        <!-- card info -->
                        <div class="card-info">
                            <div class="card-info-inner-container">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin info-icon" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                  <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                  <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                  <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                              </svg>
                          </span>
                          <span><strong><?php echo esc_html__( 'ARR:', 'startups-market'); ?> </strong>
                            <span>$<?php echo esc_html( $arr ); ?></span>
                            
                        </div>
                        <div class="card-info-inner-container">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-exchange info-icon" viewBox="0 0 16 16">
                                <path d="M0 5a5 5 0 0 0 4.027 4.905 6.5 6.5 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05q-.001-.07.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.5 3.5 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98q-.004.07-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5m16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0m-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674z"/>
                            </svg>
                        </span>
                        <span><strong><?php echo esc_html__( 'SARR: ', 'startups-market'); ?> </strong>
                            <span>$<?php echo esc_html( $srr ); ?></span>
                        </div>
                        <div class="card-info-inner-container">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3 info-icon" viewBox="0 0 16 16">
                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                            </svg>
                        </span>
                        <span><strong><?php echo esc_html__( 'Launched: ', 'startups-market'); ?> </strong>
                            <span><?php echo esc_html( $launched ); ?></span>
                        </div>
                    </div>
                </div>

                <!-- card footer -->
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a class=" d-flex align-items-center" href="">
                        <div class="footer-icon-container">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags-fill footer-icon" viewBox="0 0 16 16">
                                <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z"/>
                            </svg>
                        </div> 
                        <span class="footer-content"><?php 
                        if ($categories && !is_wp_error($categories)){
                            foreach( $categories as $category ){
                                echo esc_html( $category->name );
                            }
                        } ?>
                    </span>
                </a>

            </div>
        </div>
    </div>
    <?php 

endwhile;
endif;


?>


</div>
<?php 

$big = 999999999; // need an unlikely integer

$pagination = paginate_links(array(
    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format'    => '?paged=%#%',
    'current'   => max(1, get_query_var('paged')),
    'total'     => $archive_query->max_num_pages,
    'prev_text' => '&laquo; Previous',
    'next_text' => 'Next &raquo;',
    'type'      => 'array',
));

if ($pagination && is_array($pagination)) {
    echo '<div class="archive-pagination d-flex justify-content-center mt-5">';
    echo '<nav aria-label="Archive Pagination">';
    echo '<ul class="pagination">';
    foreach ($pagination as $link) {
        echo '<li class="page-item">' . $link . '</li>';
    }
    echo '</ul>';
    echo '</nav>';
    echo '</div>';
}
wp_reset_postdata();
?>

</section>

<?php 
get_footer();
?>