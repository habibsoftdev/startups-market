<?php 

namespace Startups\Market\Admin;
use Startups\Market\Trait\SingletonTrait;

/**
 * Custom Post Registration Handler Class
 */
class RegisterBusinessCPT{

    use SingletonTrait;
    /**
     * init method
     */
    public function __construct(){
        add_action( 'init', [ $this, 'register_business_post_type' ] );
        add_filter( 'parent_file', [ $this, 'highlight_custom_taxonomy_menu_item' ] );
        add_action('save_post', [ $this, 'save_custom_status_value' ], 10, 2);
        add_filter('display_post_states', [ $this, 'add_custom_post_status_to_post_list' ], 10, 2);
        //add_action('post_submitbox_misc_actions', [ $this, 'add_custom_post_status_dropdown' ] );

       add_action('admin_footer', [ $this, 'add_custom_post_status_dropdown' ]);

           
    }

    /**
     * Register Post Type
     *
     * @return void
     */
    public function register_business_post_type(){
        $labels = array(
            'name'               => _x( 'Businesses', 'post type general name', 'startups-market' ),
            'singular_name'      => _x( 'Business', 'post type singular name', 'startups-market' ),
            'menu_name'          => _x( 'Businesses', 'admin menu', 'startups-market' ),
            'name_admin_bar'     => _x( 'Business', 'add new on admin bar', 'startups-market' ),
            'add_new'            => _x( 'Add New', 'business', 'startups-market' ),
            'add_new_item'       => __( 'Add New Business', 'startups-market' ),
            'new_item'           => __( 'New Business', 'startups-market' ),
            'edit_item'          => __( 'Edit Business', 'startups-market' ),
            'view_item'          => __( 'View Business', 'startups-market' ),
            'all_items'          => __( 'Businesses List', 'startups-market' ),
            'search_items'       => __( 'Search Businesses', 'startups-market' ),
            'parent_item_colon'  => __( 'Parent Businesses:', 'startups-market' ),
            'not_found'          => __( 'No businesses found.', 'startups-market' ),
            'not_found_in_trash' => __( 'No businesses found in Trash.', 'startups-market' ),
        );


    
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'business'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'show_in_menu'       => 'startups_market',
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
        );
    
        register_post_type( 'business', $args );

        /**
         * Register Taxonomy
         */
        $taxonomy_labels = array(
            'name'                       => _x( 'Business Categories', 'taxonomy general name', 'startups-market' ),
            'singular_name'              => _x( 'Business Category', 'taxonomy singular name', 'startups-market' ),
            'search_items'               => __( 'Search Business Categories', 'startups-market' ),
            'popular_items'              => __( 'Popular Business Categories', 'startups-market' ),
            'all_items'                  => __( 'All Business Categories', 'startups-market' ),
            'parent_item'                => __( 'Parent Business category', 'startups-market' ),
            'parent_item_colon'          => __( 'Parent Business category:', 'startups-market' ),
            'edit_item'                  => __( 'Edit Business Category', 'startups-market' ),
            'update_item'                => __( 'Update Business Category', 'startups-market' ),
            'add_new_item'               => __( 'Add New Business Category', 'startups-market' ),
            'new_item_name'              => __( 'New Business Category Name', 'startups-market' ),
            'separate_items_with_commas' => __( 'Separate business categories with commas', 'startups-market' ),
            'add_or_remove_items'        => __( 'Add or remove business categories', 'startups-market' ),
            'choose_from_most_used'      => __( 'Choose from the most used business categories', 'startups-market' ),
            'not_found'                  => __( 'No business categories found.', 'startups-market' ),
            'menu_name'                  => __( 'Business Categories', 'startups-market' ),
        );
    
        $taxonomy_args = array(
            'hierarchical'      => true,
            'labels'            => $taxonomy_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'public'            => true,
            'show_in_nav_menus' => true,
            'rewrite'           => array( 'slug' => 'business_category' ),
        );
    
        register_taxonomy( 'business_category', 'business', $taxonomy_args );

        /**
         * Register Custom Status
         */

         register_post_status( 'sold_out', [
            'label' => _x( 'Sold Out', 'business' ),
            'public' => true,
            'exclude_from_search' => false,
            'show_in_admin_all_list' => true,
            'show_in_admin_status_list' => true,
            'label_count' => _n_noop( 'Sold Out (%s)', 'Sold Out (%s)' ),
         ]);
        

    }

    /**
     * Add Custom Post at Plugin admin menu
     *
     * @param mixed $parent_file
     * @return void
     */
    public function highlight_custom_taxonomy_menu_item($parent_file){
        global $current_screen, $pagenow;
    
        // Check if $current_screen is an object and has the 'taxonomy' property
        if ($current_screen && property_exists($current_screen, 'taxonomy') && $current_screen->taxonomy === 'business_category' && $pagenow === 'edit-tags.php') {
            // Set the parent menu file to your custom admin menu slug
            $parent_file = 'startups_market';
        }
    
        return $parent_file;
    }

    public function save_custom_status_value( $post_id, $post ){
        // Check if the post type is 'business' and the request has the 'post_status' parameter
    if ($post->post_type === 'business' && isset($_REQUEST['post_status'])) {
        $new_status = $_REQUEST['post_status'];

        // Check if the new status is 'sold_out' and it's different from the current status
        if ($new_status === 'sold_out' && $post->post_status !== 'sold_out') {
            // Update the post status to 'sold_out'
            wp_update_post(array('ID' => $post_id, 'post_status' => 'sold_out'));
        }
    }
    }



    public function add_custom_post_status_to_post_list($post_states, $post) {
        // Check if it's the 'business' post type
        if ('business' === $post->post_type && $post->post_status === 'sold_out') {
            // Add "Sold Out" to the post states
            $post_states[] = _x('Sold Out', 'business');
        }
    
        return $post_states;
    }

    // Hook into the 'post_submitbox_misc_actions' action to display the custom post status dropdown
    public function add_custom_post_status_dropdown() {
        global $post;
        if ('business' === $post->post_type) {
            $complete = '';
            if ($post->post_status == 'sold_out') {
                $complete = ' selected="selected"';
            }
            ?>
            <script>
                jQuery(document).ready(function(){
                jQuery('#post_status').append('<option value="sold_out" <?php echo $complete; ?>>Sold Out</option>');
    });
            </script>
            <?php
        }
    }
 

}