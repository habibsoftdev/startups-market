<?php 

namespace Startups\Market\Shortcodes;
use Startups\Market\Trait\SingletonTrait;


class Shortcodes{

    use SingletonTrait;

    public function __construct(){
        add_shortcode( 'stm_business_published_post', [ $this, 'stm_business_published_post_callback' ] );
        add_shortcode( 'stm_business_sold_post', [ $this, 'stm_business_sold_post_callback' ] );
    }

    public function stm_business_published_post_callback(){
        ob_start();
        include( plugin_dir_path( __FILE__ ). 'views/published-post.php');
        return ob_get_clean();
    }

    public function stm_business_sold_post_callback(){
        ob_start();
        include( plugin_dir_path( __FILE__ ). 'views/sold-out-post.php');
        return ob_get_clean();
    }
}