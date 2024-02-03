<?php 
namespace Startups\Market;
use Startups\Market\Singleton\SingletonTrait;

/**
 * Custom Permalink Handler
 */
class RewriteRule{

    use SingletonTrait;

    public function __construct(){
        add_action( 'init', [ $this, 'add_custom_rewrite_rule' ] );
    
    }

    public function add_custom_rewrite_rule(){
        add_rewrite_rule('^stm-add-listing/edit/([^/]*)/?', 'index.php?pagename=stm-add-listing&action=edit&listing_id=$matches[1]', 'top');
        
    }



}