<?php 

    $args = array(
        'author' => get_current_user_id(),
        'post_type' => 'business',
        'posts_per_page' => -1,
        'post_status' => 'any'
    );

?>

<section class="container-fluid   smt-main-section px-0" id="allMenu">

    <!-- My Listing Area -->
    <section class="container-fluid menuItem px-0" id="my-listing-page">
    <nav class="navbar my-listing-menubar navbar-expand-lg shadow-sm rounded-2">

<!-- My listing menubar -->
<div>

    <ul class="smt-nav-listing nav-list navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item`">
            <a onclick="clickAllListing()" class="nav-link active" aria-current="page"
                href="#My_Listing/All_Listing">All Listings</a>
        </li>

        <li class="nav-item">
            <a onclick="clickPublish()" class="nav-link" aria-current="page"
                href="#My_Listing/Publish">Published</a>
        </li>

        <li class="nav-item">
            <a onclick="clickPending()" class="nav-link" aria-current="page"
                href="#My_Listing/Pending">Pending</a>
        </li>
        <li class="nav-item">
            <a onclick="clickExpired()" class="nav-link" aria-current="page"
                href="#My_Listing/Expired">Expired</a>
        </li>

    </ul>
</div>

<!-- new class added search-input-container -->
<div class="search-input-container">
    <!-- My listing search place -->
    <form class="d-flex ms-1" role="search">
        <input class="search-listing-input  me-2 rounded-5" type="search"
            placeholder="Search Listings" aria-label="Search">
    </form>
</div>

</nav>
        <div class="all-listing-container">
        <!-- all listing table -->
        <table class="table table-striped mt-3 all-listing shadow-sm rounded-1">

            <!-- table head -->
            <thead>
                <tr class="table-head-content">
                  <th class="py-4 text-secondary ps-4" scope="col"><?php esc_html_e('LISTING', 'startups-market'); ?></th>
                  <th class="py-4 text-secondary" scope="col"><?php esc_html_e('EXPIRATION', 'startups-market'); ?></th>
                  <th class="py-4 text-secondary" scope="col"><?php esc_html_e('STATUS', 'startups-market'); ?></th>
                  <th class="py-4 text-secondary" scope="col"><?php esc_html_e('ACTION', 'startups-market'); ?></th>
              </tr>
          </thead>

          <!-- table body -->
          <tbody>
            <?php 
                $seller_query = new WP_Query($args);
                $post_count = $seller_query->post_count;

                if( $seller_query->have_posts()):
                    while( $seller_query->have_posts()):
                        $seller_query->the_post();

                        $post_status = get_post_status();
                        $date = get_the_date();
                        $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail');
            ?>
            <tr class="table-data-content "  scope="row">
                <td colspan="1" class="my-listing-table-content col-1">
                <?php if( $featured_image ): ?>
                    <img class="listing-table-img" src="<?php echo esc_url($featured_image); ?>" alt=""> 
                <?php else: ?>   
                <img class="listing-table-img" src="<?php echo STM_ASSETS ?>/dashboard/listing.png" alt="">
                <?php endif; ?>
                <span class="stm_list-t"> <?php the_title(); ?></span></td>
                <td colspan="1" class="my-listing-table-content col-1 "><p> <?php echo esc_html( $date ); ?></p></td>
                <td colspan="1" class="my-listing-table-content col-1 mb-4"> 
                    <span class="<?php echo ($post_status === 'pending') ? 'pending-content' : 'published-content'; ?> fw-semibold"><?php echo esc_html( $post_status ); ?></span> </td>
                <td colspan="1" class="my-listing-table-content col-1">
                    <div class="my-listing-edit"><a class="text-decoration-none text-black fw-semibold" href="">
                        <img class="edit-icon me-2" src="<?php echo STM_ASSETS ?>/dashboard/edit-icon.png" alt="">Edit</a> 
                <a href="#"  data-list-id="<?php the_ID(); ?>">
                    <p class="delete-list">Delete</p>
                </a> 
            </div>
        </td>
            </tr>
            <?php 
            endwhile;?>
            <?php  

            wp_reset_query();
                else:
            ?>

            <tr class="table-data-content"  scope="row">
                <td colspan="3" class="my-listing-table-third-row">
                    <p> No post Found</p>
                </td>
            </tr>

            <?php 
            endif;
            ?>
        </tbody>
    </table>
</div>

    <!-- Publish table -->
    <div class="publish-container">
    <table class="table table-striped mt-3 publish shadow-sm rounded-1">

        <!-- table head -->
        <thead class="table-head-content">
            <tr>
              <th class="py-4 text-secondary ps-4" scope="col">PUBLISH</th>
              <th class="py-4 text-secondary" scope="col">EXPIRATION</th>
              <th class="py-4 text-secondary" scope="col">PENDING</th>
          </tr>
      </thead>

      <!-- table body -->
      <tbody>
        <tr class="table-data-content "  scope="row">
            <td colspan="1" class="my-listing-table-content col-1"><img class="listing-table-img" src="images/listing.png" alt=""><span>list</span></td>
            <td colspan="1" class="my-listing-table-content col-1 "><p>January 4, 2024</p></td>
            <td colspan="1" class="my-listing-table-content col-1 mb-4"> <span class="pending-content fw-semibold">pending</span> </td>
            <td colspan="1" class="my-listing-table-content col-1"><div class="my-listing-edit"><a class="text-decoration-none text-black fw-semibold" href=""><img class="edit-icon me-2" src="images/edit-icon.png" alt="">Edit</a> <p class="delete-list ">Delete</p> </div></td>
        </tr>
        <tr class="table-data-content"  scope="row">
            <td colspan="3" class="my-listing-table-third-row"></td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Pending table -->
<div class="pending-container">
<table class="table table-striped mt-3 pending shadow-sm rounded-1">

    <!-- table head -->
    <thead class="table-head-content">
        <tr>
          <th class="py-4 text-secondary ps-4" scope="col">PENDING</th>
          <th class="py-4 text-secondary" scope="col">EXPIRATION</th>
          <th class="py-4 text-secondary" scope="col">PENDING</th>
      </tr>
  </thead>

  <!-- table body -->
  <tbody>
    <tr class="table-data-content "  scope="row">
        <td colspan="1" class="my-listing-table-content col-1">
            <img class="listing-table-img" src="<?php echo STM_ASSETS; ?>/dashboard/listing.png" alt="featured image" /><span>list bal</span></td>
        <td colspan="1" class="my-listing-table-content col-1 "><p>January 5, 2024</p></td>
        <td colspan="1" class="my-listing-table-content col-1 mb-4"> <span class="pending-content fw-semibold">pending</span> </td>
        <td colspan="1" class="my-listing-table-content col-1"><div class="my-listing-edit"><a class="text-decoration-none text-black fw-semibold" href=""><img class="edit-icon me-2" src="images/edit-icon.png" alt="">Edit</a> <p class="delete-list ">Delete</p> </div></td>
    </tr>
    <tr class="table-data-content"  scope="row">
        <td colspan="3" class="my-listing-table-third-row"></td>
    </tr>
</tbody>
</table>
</div>

<!-- Expired table -->
<div class="expired-container">
<table class="table table-striped mt-3 expired shadow-sm rounded-1">

    <!-- table head -->
    <thead class="table-head-content">
        <tr class="table-data-content" >
          <th class="py-4 text-secondary ps-4" scope="col">EXPIRED</th>
          <th class="py-4 text-secondary" scope="col">EXPIRATION</th>
          <th class="py-4 text-secondary" scope="col">PENDING</th>
      </tr>
  </thead>

  <!-- table body -->
  <tbody>
    <tr class="table-data-content "  scope="row">
        <td colspan="1" class="my-listing-table-content col-1"><img class="listing-table-img" src="" alt=""><span>list</span></td>
        <td colspan="1" class="my-listing-table-content col-1 "><p>January 4, 2024</p></td>
        <td colspan="1" class="my-listing-table-content col-1 mb-4"> <span class="pending-content fw-semibold">pending</span> </td>
        <td colspan="1" class="my-listing-table-content col-1"><div class="my-listing-edit"><a class="text-decoration-none text-black fw-semibold" href=""><img class="edit-icon me-2" src="images/edit-icon.png" alt="">Edit</a> <p class="delete-list ">Delete</p> </div></td>
    </tr>
    <tr class="table-data-content" scope="row">
        <td colspan="3" class="my-listing-table-third-row"></td>
    </tr>
</tbody>
</table>
</div>
</section>