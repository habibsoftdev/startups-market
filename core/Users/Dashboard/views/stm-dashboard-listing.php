<section class="container-fluid   smt-main-section px-0" id="allMenu">

    <!-- My Listing Area -->
    <section class="container-fluid menuItem px-0" id="my-listing-page">
        <nav class="navbar navbar-expand-lg shadow-sm rounded-2">
            <div class="container-fluid">
                <!-- My listing response toggle button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <!-- My listing menubar -->
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
                        href="#My_Listing/Pending"> Pending </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="clickExpired()" class="nav-link" aria-current="page"
                        href="#My_Listing/Expired">Expired</a>
                    </li>

                </ul>

                <!-- My listing search place -->
                <form class="d-flex" role="search">
                    <input class="search-listing-input  me-2 rounded-5" type="text"
                    placeholder="Search Listings" aria-label="Search">
</form>
            </div>
        </nav>

        <!-- all listing table -->
        <table class="table table-striped mt-3 all-listing shadow-sm rounded-1">

            <!-- table head -->
            <thead>
                <tr class="table-head-content">
                  <th class="py-4 text-secondary ps-4" scope="col">LISTING</th>
                  <th class="py-4 text-secondary" scope="col">EXPIRATION</th>
                  <th class="py-4 text-secondary" scope="col">STATUS</th>
              </tr>
          </thead>

          <!-- table body -->
          <tbody>
            <tr class="table-data-content "  scope="row">
                <td colspan="1" class="my-listing-table-content col-1"><img class="listing-table-img" src="<?php echo STM_ASSETS ?>/dashboard/listing.png" alt=""><span>  list</span></td>
                <td colspan="1" class="my-listing-table-content col-1 "><p> January 5, 2024</p></td>
                <td colspan="1" class="my-listing-table-content col-1 mb-4"> <span class="pending-content fw-semibold">pending</span> </td>
                <td colspan="1" class="my-listing-table-content col-1"><div class="my-listing-edit"><a class="text-decoration-none text-black fw-semibold" href=""><img class="edit-icon me-2" src="<?php echo STM_ASSETS ?>/dashboard/edit-icon.png" alt="">Edit</a> <p class="delete-list ">Delete</p> </div></td>
            </tr>
            <tr class="table-data-content"  scope="row">
                <td colspan="3" class="my-listing-table-third-row"></td>
            </tr>
        </tbody>
    </table>

    <!-- Publish table -->
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

<!-- Pending table -->
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

<!-- Expired table -->
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
</section>