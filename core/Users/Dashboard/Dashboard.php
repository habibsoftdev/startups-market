<?php  

namespace Startups\Market\Users\Dashboard;
use Startups\Market\Stm_Utils;

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
            <a href="#" class="stm-booking-nav-link stm-tab__nav__link stm-tab__nav__active style-f7M3j" target="my_listings" id="style-f7M3j" data-tab="my_listings">
              <span class="directorist_menuItem-text">
                <span class="directorist_menuItem-icon">
                <?php echo Stm_Utils::custom_icon( 'list-solid' ); ?>
                </span>
                My Listing (0)						
              </span>
            </a>
          </li>
          <li class="stm-tab__nav__item">
            <a href="#" class="stm-booking-nav-link stm-tab__nav__link style-YsJPr" target="dashboard_profile" id="style-YsJPr" data-tab="dashboard_profile">
              <span class="directorist_menuItem-text">
                <span class="directorist_menuItem-icon">
                <?php echo Stm_Utils::custom_icon( 'user-solid' ); ?>
                </span>
                My Profile						
              </span>
            </a>
          </li>
          <li class="stm-tab__nav__item">
            <a href="#" class="stm-booking-nav-link stm-tab__nav__link style-UygxB" target="dashboard_fav_listings" id="style-UygxB" data-tab="dashboard_fav_listings">
              <span class="directorist_menuItem-text">
                <span class="directorist_menuItem-icon">
                <?php echo Stm_Utils::custom_icon( 'heart-solid' ); ?>
                </span>
                Favorite Listings						
              </span>
            </a>
          </li>
          <li class="stm-tab__nav__item">
            <a href="#" class="stm-booking-nav-link stm-tab__nav__link style-bNv5c" data-tab="dashboard_announcement" target="dashboard_announcement" id="style-bNv5c">
              <span class="directorist_menuItem-text">
                <span class="directorist_menuItem-icon">
                <?php echo Stm_Utils::custom_icon( 'bullhorn-solid' ); ?>
                </span>
                Announcements						
              </span>
            </a>
          </li>
        </ul>
      </div>
      <div class="stm-tab__nav__action">
        <a href="http://localhost/flippa/add-listing/" class="stm-btn stm-btn-dark stm-btn--add-listing">
          Submit Listing
        </a>
        <a href="http://localhost/flippa/wp-login.php?action=logout&amp;redirect_to=http%3A%2F%2Flocalhost%2Fflippa&amp;_wpnonce=0e85da4fac" class="stm-btn stm-btn-secondary stm-btn--logout">
          Log Out
        </a>
      </div>
    </div>
        <?php 
        
        include __DIR__. '/views/stm-dashboard-listing.php';
        include __DIR__. '/views/stm-dashboard-profile.php';
        include __DIR__. '/views/stm-fab-items.php';
        include __DIR__. '/views/stm-announce.php';
        ob_end_flush();
    }
}