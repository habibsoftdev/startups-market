<?php 

namespace Startups\Market\Ajax;
use Startups\Market\Trait\SingletonTrait;
use Startups\Market\Stm_Utils;

class LoadMore{
    use SingletonTrait;

    public function __construct(){

        add_action( 'wp_ajax_pb_load_more', [ $this, 'pb_load_more_callback' ] );
        add_action( 'wp_ajax_nopriv_pb_load_more', [ $this, 'pb_load_more_callback' ] );
    }

    public function pb_load_more_callback(){
        check_ajax_referer('pb_load_more_nonce', 'security');

        $page = $_POST['page'];


        wp_die();
    }
}