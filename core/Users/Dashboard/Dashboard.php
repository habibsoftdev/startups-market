<?php  

namespace Startups\Market\Users\Dashboard;
use Startups\Market\Stm_Utils;
use Startups\Market\Notice\Notice_Handler;
use Startups\Market\Trait\SingletonTrait;

if( ! defined( 'ABSPATH' ) ){
    exit;
}

class Dashboard{

    use SingletonTrait;
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
    $submit_list = get_permalink( get_page_by_path( 'stm-add-listing' ) );
    $logout_url = wp_logout_url( get_permalink( get_page_by_path( 'stm-login' ) ) );
    $seller = current_user_can( 'seller' ) || current_user_can( 'manage_options' );
    $buyer = current_user_can( 'buyer' ) || current_user_can( 'manage_options' );
    $navheight = current_user_can( 'buyer' ) ? 'buyer-cont' :( current_user_can( 'seller') ? 'seller-cont' : 'admin-cont');

    ?>
    <main class="main-container d-flex">

        <!-- side navbar -->
        <nav class="navbar container-fluid navbar-expand-lg  navbar-container <?php esc_attr_e( $navheight ); ?> me-3 rounded-2">
            <div class=" side-nav-icon px-0">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-list-container" id="navbarTogglerDemo01">
                <ul class="container-fluid navbar-nav-side nav-lists  mb-2 mb-lg-0 d-flex flex-column text-start">
                    <?php if( $seller ): ?>
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
                    </span><?php echo esc_html__( 'My Listing', 'startups-market' ); ?> <span class="listing-count fw-semibold">(<?php echo Stm_Utils::post_count($current_user); ?>)</span></a>
                </li>
                <?php endif; ?>
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
                    <?php echo esc_html__( 'My Profile', 'startups-market' ); ?></a>
            </li>
            <?php if( $buyer ) : ?>
            <li onclick="clickMyHistory()" class="nav-item nav-links">
                <a class=" d-flex" aria-current="page" href="/#My_Order_History"><span class="pe-3">
                    <!-- svg icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                    class="bi bi-clock-history" viewBox="0 0 16 16">
                    <path
                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
                    <path
                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
                </svg>
            </span><?php echo esc_html__( 'Order History', 'startups-market' ); ?></a>
        </li>
        <?php endif;?>
        <?php if( $seller ) : ?>
        <!-- Wallet (li) Nav Link added-second -->
        <li onclick="clickMyWallet()" class="nav-item nav-links">
            <a class=" d-flex" aria-current="page" href="/#My_Wallet"><span class="pe-3">
                <!-- svg icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                class="bi bi-wallet" viewBox="0 0 16 16">
                <path
                d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a2 2 0 0 1-1-.268M1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1" />
            </svg>
        </span><?php echo esc_html__( 'Wallet', 'startups-market' ); ?>
    </a>
</li>
<?php endif; ?>
<li onclick="clickMyFavorite()" class="nav-item nav-links">
    <a class="" aria-current="page" href="/#My_Favorite"><span
        class="pe-2">
        <!-- svg icon -->
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
</svg>
</span><?php echo esc_html__( 'Message', 'startups-market' ); ?></a>
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
</span><?php echo esc_html__( 'Announcements', 'startups-market' ); ?></a>
</li>
<div class="mt-4">
    <?php if( $seller ) : ?>
    <a class="listing-submit-btn w-100 mb-4 py-1 d-block" href="<?php echo esc_url( $submit_list ); ?>"><?php esc_html_e(' Add Business'); ?></a>
    <?php endif; ?>
    <a class="dashboard-log-out-btn w-100 mb-3 py-1 d-block" href="<?php echo esc_url( $logout_url ); ?>"><?php echo esc_html__( 'Log Out', 'startups-market' ); ?></a>
</div>
</ul>

</div>
</div>
</nav>
<?php 

include __DIR__. '/views/stm-dashboard-listing.php';
include __DIR__. '/views/stm-dashboard-profile.php';
include __DIR__. '/views/stm-order-history.php';
include __DIR__. '/views/stm-wallet.php';
include __DIR__. '/views/stm-fab-items.php';
include __DIR__. '/views/stm-announce.php';

}
}