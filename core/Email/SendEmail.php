<?php 

namespace Startups\Market\Email;
use Startups\Market\Singleton\SingletonTrait;


class SendEmail{

    use SingletonTrait;

    public function __construct(){
        add_action('transition_post_status', [ $this, 'send_email_on_publish' ], 10, 3);
        add_action('transition_post_status', [ $this, 'send_email_sold_out' ], 10, 3);
    }

    public function send_email_on_publish( $new_status, $old_status, $post){

        if( $post->post_type === 'business' && $old_status === 'pending' && $new_status === 'published'){

            $post_title = $post->post_title;
            $author_id = $post->post_author;
            $author_email = get_the_author_meta('user_email', $author_id);
            $author_firstname = get_the_author_meta('first_name', $author_id);

            $email = EmailHandler::instance();

            $email->send_seller_listing_published_confirmation( $author_email, $author_firstname, $post_title );

        }

        
    }

    public function send_email_sold_out( $new_status, $old_status, $post){

        if( $post->post_type === 'business' && $old_status === 'published' && $new_status === 'sold_out'){

            $post_title = $post->post_title;
            $author_id = $post->post_author;
            $author_email = get_the_author_meta('user_email', $author_id);
            $author_firstname = get_the_author_meta('first_name', $author_id);

            $email = EmailHandler::instance();

            $email->send_seller_listing_soldout_confirmation( $author_email, $author_firstname, $post_title );

        }

        
    }

}