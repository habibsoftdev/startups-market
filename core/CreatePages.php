<?php 

namespace Startups\Market;
use Startups\Market\Singleton\SingletonTrait;

/**
 * Create Pages upon the plugin Active
 */
class CreatePages{

    use SingletonTrait;

    public function __construct(){

        $this->create_pages();
    }

    /**
     * Existing pages query
     *
     * @param [string] $title Page Title
     * @return bool Whether the page already exists.
     */
    private function existing_page_query( $title ){

        $args = [
            'post_type' => 'page',
            'post_status' => 'any',
            'name' => sanitize_title($title), 
        ];

        $query = new \WP_Query($args);

        return $query->have_posts();

    }

    /**
     * Create pages if they don't already exist.
     *
     * @return
     */
    public function create_pages(){
        $pages = [
            [
                'title' => 'STM Registration',
                'content' => '[registration_form]',
            ],

            [
                'title' => 'STM Login',
                'content' => '[login_form]',
            ],

            [
                'title' => 'Verify',
                'content' => ''
            ],

            [
                'title' => 'STM Dashboard',
                'content' => '[stm_user_dashboard]',
            ],
            [
                'title' => 'Stm Add Listing',
                'content' => '[stm_add_listing]',
            ],
            [
                'title' => 'Stm Message',
                'content' => '[front-end-pm]', 
            ]
         ];

        foreach( $pages as $page ){
            $page_title = $page[ 'title' ];
            $page_content = $page[ 'content' ];

            if( ! $this->existing_page_query( $page_title ) ){

                $page_data = [
                    'post_title' => $page_title,
                    'post_content' => $page_content,
                    'post_status' => 'publish',
                    'post_type' => 'page',
                ];

                //insert the pages into the database
                $page_id = wp_insert_post( $page_data );

                if (is_wp_error($page_id)) {
                    error_log('Error creating page: ' . $page_id->get_error_message());
                }

            }
        }
    }

}