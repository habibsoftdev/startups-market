<?php  

namespace Startups\Market\Ajax;

class Dashboardprofile{
    
    public function __construct(){
        add_action('wp_ajax_stm_profile', 'stm_profile_form_ajax');
        add_action('wp_ajax_nopriv_stm_profile', 'stm_profile_form_ajax');
    }

    public function stm_profile_form_ajax(){
    
      $received_nonce = isset( $_POST[ 'stm_user_prof_nonce' ] ) ? sanitize_text_field( $_POST[ 'stm_user_prof_nonce' ] ) : '';


      if( ! wp_verify_nonce( $received_nonce, 'stm_user_prof' ) ){
        wp_send_json([
            'saved' => false,
            'message' => __( 'Something went wrong, please reload the page', 'startups-market' ),
            'nonce_failed' => true,
        ]); 
      }

      if( ! is_user_logged_in() ){
        wp_send_json([
          'saved' => false,
          'message' => __( 'You are not allowed to do changes', 'startups-market' ),
          
        ]);
      }else{

        $curernt_user = wp_get_current_user();
        $user_id = get_current_user_id();
        $phone_num = get_user_meta( $user_id, 'phone_number', true);
        $website_url = get_the_author_meta( 'user_url', $user_id );
        $author_bio = get_the_author_meta( 'description', $user_id );
        $user_data = get_userdata( $user_id );

        $first_name = isset( $_POST[ 'stm_first_name' ] ) ? sanitize_text_field( $_POST[ 'stm_first_name' ] ) : $curernt_user->first_name;

        $last_name = isset( $_POST[ 'stm_last_name' ] ) ? sanitize_text_field( $_POST[ 'stm_last_name' ] ) : $curernt_user->last_name;

        $phone = isset( $_POST[ 'stm_user_phone' ] ) ? sanitize_text_field( $_POST[ 'stm_user_phone' ] ) : $phone_num;

        $website = isset( $_POST[ 'stm_website' ] ) ? sanitize_text_field( $_POST[ 'stm_website' ] ) : $website_url;

        $address = isset( $_POST[ 'stm_user_address' ] ) ? sanitize_text_field( $_POST[ 'stm_user_address' ] ) : '';

        $new_pass = isset( $_POST[ 'stm_user_new_pass' ] ) ? sanitize_text_field( $_POST[ 'stm_user_new_pass' ] ) : '';

        $confirm_pass = isset( $_POST[ 'stm_user_con_pass' ] ) ? sanitize_text_field( $_POST[ 'stm_user_con_pass' ] ) : '';

        $author_description = isset( $_POST[ 'stm_user_bio' ] ) ? sanitize_textarea_field( $_POST[ 'stm_user_bio' ] ) : $author_bio;

        $user_data->first_name = $first_name;
        $user_data->last_name = $last_name;
        $user_data->user_url = $website;
        $user_data->description = $author_description;

        wp_update_user( $user_data );
        update_user_meta($user_id, 'phone_number', $phone);

        wp_send_json([
          'saved' => true,
          'message' => __( 'Your Changes Saved Succesfully', 'startups-market' ),
          
        ]);

        if( ! empty( $new_pass ) && ! empty( $confirm_pass ) && $new_pass === $confirm_pass ){
          wp_set_password( $new_pass, $user_id );
          wp_send_json([
            'saved' => true,
            'passwordsaved' => true,
            'message' => __( 'Your Changes Saved Succesfully', 'startups-market' ),
            'p_message' => __( 'Password Changed!', 'startups-market' ),
            
          ]);
        }else{
          wp_send_json([
            'saved' => true,
            'passwordsaved' =>false,
            'p_message' => __( 'Password not mached!', 'startups-market' ),
            
          ]);
        }
      } 

    }

}


///?>

// Side nav route
const clickMyListing = () => {
  showPage('#my-listing-page');
  showListingPage('all-listing'); // Add this line to show the default listing page
};

const clickMyProfile = () => {
  showPage('#my-profile-page');
};

const clickMyFavorite = () => {
  showPage('#my-favorite-page');
};

const clickMyAnnouncement = () => {
  showPage('#my-announcement-page');
};

// Side nav active route
const sideNavLinks = document.querySelectorAll('.nav-links');
sideNavLinks.forEach(sideNavLink => {
  sideNavLink.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.active-route')?.classList.remove('active-route');
    this.classList.add('active-route');
  });
});

// My Listing active route
const navLinkEls = document.querySelectorAll('.nav-link');
navLinkEls.forEach(navLinkEl => {
  navLinkEl.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('.active')?.classList.remove('active');
    this.classList.add('active');
  });
});

// My listing nav route
const showListingPage = (listingId) => {
  const listingTables = document.querySelectorAll('.listing-table');
  listingTables.forEach(table => {
    table.style.display = 'none';
  });

  const selectedTable = document.querySelector(`.${listingId}`);
  if (selectedTable) {
    selectedTable.style.display = 'block';
  }
};

// Handlers for All Listing, Publish, Pending, Expired
const listingLinkEls = document.querySelectorAll('.nav-link[data-target]');
listingLinkEls.forEach(link => {
  link.addEventListener('click', function (e) {
    e.preventDefault();
    const target = this.getAttribute('data-target');
    showListingPage(target);
  });
});

// Function to show/hide main content pages
const showPage = (pageId) => {
  const pages = document.querySelectorAll('.menuItem');
  pages.forEach(page => {
    page.style.display = 'none';
  });

  const selectedPage = document.querySelector(pageId);
  if (selectedPage) {
    selectedPage.style.display = 'block';
  }
};
