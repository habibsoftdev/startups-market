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
 <?php 
// // Add this code to your theme's functions.php file or a custom plugin

// // Step 1: Modify Metabox to Include Product ID
// add_action('add_meta_boxes', 'add_custom_metabox');

// function add_custom_metabox() {
//     add_meta_box(
//         'custom_pricing_metabox',
//         'Pricing Information',
//         'render_custom_metabox',
//         'your_custom_post_type',
//         'normal',
//         'high'
//     );
// }

// function render_custom_metabox($post) {
//     $product_id = get_post_meta($post->ID, '_your_custom_metabox_product_id', true);
//     $price = get_post_meta($post->ID, '_your_custom_metabox_price', true);

//     echo '<label for="custom_product_id">WooCommerce Product ID:</label>';
//     echo '<input type="text" id="custom_product_id" name="custom_product_id" value="' . esc_attr($product_id) . '" /><br>';

//     echo '<label for="custom_price">Price:</label>';
//     echo '<input type="text" id="custom_price" name="custom_price" value="' . esc_attr($price) . '" />';
// }

// // Step 2: Save Metabox Data
// add_action('save_post', 'save_custom_metabox');

// function save_custom_metabox($post_id) {
//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
//         return;
//     }

//     if (isset($_POST['custom_product_id'])) {
//         update_post_meta($post_id, '_your_custom_metabox_product_id', sanitize_text_field($_POST['custom_product_id']));
//     }

//     if (isset($_POST['custom_price'])) {
//         update_post_meta($post_id, '_your_custom_metabox_price', sanitize_text_field($_POST['custom_price']));
//     }
// }

// // Step 3: Create WooCommerce Product for Each Post
// add_action('save_post', 'create_woocommerce_product');

// function create_woocommerce_product($post_id) {
//     // Check if the post type is your custom post type
//     if (get_post_type($post_id) !== 'your_custom_post_type') {
//         return;
//     }

//     $product_id = get_post_meta($post_id, '_your_custom_metabox_product_id', true);

//     // If product ID is not set, create a new product
//     if (empty($product_id)) {
//         $product = wc_get_product();

//         // Create a virtual product
//         $product->set_name(get_the_title($post_id));
//         $product->set_type('virtual');
//         $product->set_regular_price(get_post_meta($post_id, '_your_custom_metabox_price', true));

//         // Set other product details as needed

//         // Save the product and get its ID
//         $product_id = $product->save();

//         // Update the post meta with the WooCommerce product ID
//         update_post_meta($post_id, '_your_custom_metabox_product_id', $product_id);
//     }
// }

// // Step 4: Display Purchase Button on Single Post Page
// add_action('wp', 'display_purchase_button');

// function display_purchase_button() {
//     if (is_single() && get_post_type() === 'your_custom_post_type') {
//         $product_id = get_post_meta(get_the_ID(), '_your_custom_metabox_product_id', true);

//         if ($product_id) {
//             echo '<a href="' . esc_url(get_permalink($product_id)) . '" class="button">Purchase</a>';
//         }
//     }
// }

// // Step 5: Optional - Redirect After Purchase
// add_filter('woocommerce_payment_complete_order_status', 'custom_update_order_status', 10, 3);

// function custom_update_order_status($status, $order_id, $order) {
//     $post_id = wc_get_order($order_id)->get_items()[0]->get_meta('_your_custom_metabox_post_id', true);

//     // Update post status or perform other actions as needed

//     return $status;
// }

// ?>

// <?php 
// // Add this code to your theme's functions.php file or a custom plugin

// // Step 1: Modify Metabox to Include Product ID
// add_action('add_meta_boxes', 'add_custom_metabox');

// function add_custom_metabox() {
//     add_meta_box(
//         'custom_pricing_metabox',
//         'Pricing Information',
//         'render_custom_metabox',
//         'your_custom_post_type',
//         'normal',
//         'high'
//     );
// }

// function render_custom_metabox($post) {
//     $price = get_post_meta($post->ID, '_your_custom_metabox_price', true);

//     echo '<label for="custom_price">Price:</label>';
//     echo '<input type="text" id="custom_price" name="custom_price" value="' . esc_attr($price) . '" />';
// }

// // Step 2: Save Metabox Data
// add_action('save_post', 'save_custom_metabox');

// function save_custom_metabox($post_id) {
//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
//         return;
//     }

//     if (isset($_POST['custom_price'])) {
//         update_post_meta($post_id, '_your_custom_metabox_price', sanitize_text_field($_POST['custom_price']));
//     }
// }

// // Step 3: Display Purchase Button on Single Post Page
// add_action('wp', 'display_purchase_button');

// function display_purchase_button() {
//     if (is_single() && get_post_type() === 'your_custom_post_type') {
//         $price = get_post_meta(get_the_ID(), '_your_custom_metabox_price', true);

//         if ($price) {
//             echo '<form action="' . esc_url(wc_get_checkout_url()) . '" method="post">
//                   <input type="hidden" name="add-to-cart" value="' . esc_attr(get_the_ID()) . '">
//                   <input type="hidden" name="price" value="' . esc_attr($price) . '">
//                   <button type="submit" class="button">Purchase</button>
//                   </form>';
//         }
//     }
// }

?> -->