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

        ?>
    <div class="stm-container-fluid snipcss-vxzKo">
    <h2><?php esc_html_e('My Dashboard', 'startups-market'); ?></h2>
        <div class="stm-user-dashboard__toggle">
        <a href="#" class="stm-user-dashboard__toggle__link">
        <?php echo Stm_Utils::custom_icon( 'bars-solid' ); ?>
        </a>
        </div>
  <div class="stm-user-dashboard__contents stm-tab stm-tab-content-grid-fix">
    <div class="stm-user-dashboard__nav stm-tab__nav">
      <span class="stm-dashboard__nav--close">
      <?php echo Stm_Utils::custom_icon( 'times-solid' ); ?>
      </span>
      <div class="stm-tab__nav__wrapper">
        <ul class="stm-tab__nav__items">
          <li class="stm-tab__nav__item">
            <a href="#" class="stm-booking-nav-link stm-tab__nav__link stm-tab__nav__active style-f7M3j" target="dashboard_my_listings" id="style-f7M3j" data-tab="dashboard_my_listings">
              <span class="directorist_menuItem-text">
                <span class="directorist_menuItem-icon">
                <?php echo Stm_Utils::custom_icon( 'list-solid' ); ?>
                </span>
                <?php esc_html_e( 'My Listing (0)', 'startups-market' ); ?>						
              </span>
            </a>
          </li>
          <li class="stm-tab__nav__item">
            <a href="#" class="stm-booking-nav-link stm-tab__nav__link style-YsJPr" target="dashboard_profile" id="style-YsJPr" data-tab="dashboard_profile">
              <span class="directorist_menuItem-text">
                <span class="directorist_menuItem-icon">
                <?php echo Stm_Utils::custom_icon( 'user-solid' ); ?>
                </span>
                <?php esc_html_e( 'My Profile', 'startups-market' ); ?>						
              </span>
            </a>
          </li>
          <li class="stm-tab__nav__item">
            <a href="#" class="stm-booking-nav-link stm-tab__nav__link style-UygxB" target="dashboard_fav_listings" id="style-UygxB" data-tab="dashboard_fav_listings">
              <span class="directorist_menuItem-text">
                <span class="directorist_menuItem-icon">
                <?php echo Stm_Utils::custom_icon( 'heart-solid' ); ?>
                </span>
                <?php esc_html_e( 'Favorite Listings', 'startups-market' ); ?>					
              </span>
            </a>
          </li>
          <li class="stm-tab__nav__item">
            <a href="#" class="stm-booking-nav-link stm-tab__nav__link style-bNv5c" data-tab="dashboard_announcement" target="dashboard_announcement" id="style-bNv5c">
              <span class="directorist_menuItem-text">
                <span class="directorist_menuItem-icon">
                <?php echo Stm_Utils::custom_icon( 'bullhorn-solid' ); ?>
                </span>
                <?php esc_html_e( 'Announcements', 'startups-market' ); ?>					
              </span>
            </a>
          </li>
        </ul>
      </div>
      <div class="stm-tab__nav__action">
        <a href="http://localhost/flippa/add-listing/" class="stm-btn stm-btn-dark stm-btn--add-listing">
          <?php esc_html_e( 'Submit Listing', 'startups-market' ); ?>
        </a>
        <a href="http://localhost/flippa/wp-login.php?action=logout&amp;redirect_to=http%3A%2F%2Flocalhost%2Fflippa&amp;_wpnonce=0e85da4fac" class="stm-btn stm-btn-secondary stm-btn--logout">
          <?php esc_html_e( 'Log Out', 'startups-market' ); ?>
        </a>
      </div>
    </div>
        <?php 
        
        include __DIR__. '/views/stm-dashboard-listing.php';
        include __DIR__. '/views/stm-dashboard-profile.php';
        include __DIR__. '/views/stm-fab-items.php';
        include __DIR__. '/views/stm-announce.php';
        
    }
}