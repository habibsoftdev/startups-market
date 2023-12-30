<?php 

namespace Startups\Market\Admin;

class Business{

    public function __construct(){
        add_action( 'init', [ $this, 'register_business_post_type' ] );
       
    }

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
            'show_in_menu'       => 'startups_market', // Add this line to assign it to your menu
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'business' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );
    
        register_post_type( 'business', $args );


    }

    public function register_business_taxonomy(){
          // Register Custom Taxonomy
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
            'rewrite'           => array( 'slug' => 'business-category' ),
        );
    
        register_taxonomy( 'business_category', 'business', $taxonomy_args );
    }

 

}