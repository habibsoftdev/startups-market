<?php 

namespace Startups\Market;


class Stm_Utils{

    

    public static function custom_icon($icon){
        
        $custom_icon =  STM_ASSETS. '/icons/' .$icon. '.svg';

        return '<i class="stm-icon-mask" aria-hidden="true" style="--stm-icon:url(' .$custom_icon. '});"></i>';
    }

    public static function get_edit_listing_page_link( $listing_id ){

        $link = home_url();

        $page = get_page_by_path('/stm-add-listing');

        $page_id = $page->ID;

        if( $page_id ){
            $link = get_permalink($page_id);

            if( '' != get_option( 'permalink_structure' ) ){
                $link = user_trailingslashit( trailingslashit( $link ) . 'edit/' . $listing_id );
            }else{
                $link = add_query_arg( array( 'stm_action' => 'edit', 'stm_listing_id' => $listing_id ), $link );
            }

            return apply_filters( 'stm_edit_listing_page_url', $link, $page_id, $listing_id );
        }

    }

    public static function edit_link(){
        $id = get_the_ID();
        
        $edit_link = self::get_edit_listing_page_link( $id );

        return $edit_link;

    }


}