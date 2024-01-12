<?php  

namespace Startups\Market\Users\Dashboard;
use Startups\Market\Stm_Utils;
use Startups\Market\Notice\Notice_Handler;

if( ! defined( 'ABSPATH' ) ){
    exit;
}

class Dashboard{

    public function __construct(){
        add_shortcode( 'stm_user_dashboard', [ $this, 'stm_render_dashboard' ]);
    }

    public function stm_render_dashboard(){
      if( is_user_logged_in() ){
        $this->user_dashboard();
      }else{ 

        $errors = __( 'You need to log in to view your dashboard', 'startups-market' );
        
        Notice_Handler::show_for_nonloggedin_user( apply_filters( 'stm_message_for_nonloggedin_users', $errors ) );
      }
    }

    public function user_dashboard(){
        $current_user = get_current_user_id();
        ?>
<main class="main-container d-flex">

<!-- side navbar -->
<nav class="navbar container-fluid navbar-expand-lg  navbar-container me-3 rounded-2">
    <div class=" side-nav-icon px-0">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbar-list-container" id="navbarTogglerDemo01">
        <ul class="container-fluid navbar-nav-side nav-lists  mb-2 mb-lg-0 d-flex flex-column text-start">
            <li onclick="clickMyListing()" class="nav-item active-route nav-links ">
                <a  class=" " aria-current="page"
                href="#My_Listing"><span class="pe-2">
                    <!-- svg icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                    class="bi bi-card-list" viewBox="0 0 16 16">
                    <path
                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                    <path
                    d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                </svg>
            </span>My Listing <span class="listing-count fw-semibold">(<?php echo Stm_Utils::post_count($current_user); ?>)</span></a>
        </li>
        <li  onclick="clickMyProfile()" class="nav-item nav-links">
            <a class="" aria-current="page" href="/#My_Profile">
                <span class="pe-2">
                    <!-- svg icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
            </span>
        My Profile</a>
    </li>
    <li onclick="clickMyFavorite()" class="nav-item nav-links">
        <a class="" aria-current="page" href="/#My_Favorite"><span
            class="pe-2">
            <!-- svg icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
            class="bi bi-heart-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
        </svg>
    </span>Favorite</a>
</li>
<li onclick="clickMyAnnouncement()" class="nav-item nav-links">
    <a class=" d-flex" aria-current="page" href="/#My_Announcement"><span
        class="pe-2">
        <!-- svg icon -->
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
        class="bi bi-megaphone-fill" viewBox="0 0 16 16">
        <path
        d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0zm-1 .724c-2.067.95-4.539 1.481-7 1.656v6.237a25.222 25.222 0 0 1 1.088.085c2.053.204 4.038.668 5.912 1.56zm-8 7.841V4.934c-.68.027-1.399.043-2.008.053A2.02 2.02 0 0 0 0 7v2c0 1.106.896 1.996 1.994 2.009a68.14 68.14 0 0 1 .496.008 64 64 0 0 1 1.51.048zm1.39 1.081c.285.021.569.047.85.078l.253 1.69a1 1 0 0 1-.983 1.187h-.548a1 1 0 0 1-.916-.599l-1.314-2.48a65.81 65.81 0 0 1 1.692.064c.327.017.65.037.966.06z" />
    </svg>
</span>Announcements</a>
</li>
<div class="mt-4">
<a class="listing-submit-btn w-100 mb-4 py-1 d-block" href="">Submit Listing</a>
<a class="dashboard-log-out-btn w-100 mb-3 py-1 d-block" href="">Log Out</a>
</div>
</ul>

</div>
</div>
</nav>
        <?php 
        
        include __DIR__. '/views/stm-dashboard-listing.php';
        include __DIR__. '/views/stm-dashboard-profile.php';
        include __DIR__. '/views/stm-fab-items.php';
        include __DIR__. '/views/stm-announce.php';
        
    }
}