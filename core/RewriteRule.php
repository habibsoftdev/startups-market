<?php 

namespace Startups\Market;

class RewriteRule{

    public function __construct(){
        add_action( 'init', [ $this, 'add_custom_rewrite_rule' ] );
        
    }

    public function add_custom_rewrite_rule(){
        add_rewrite_rule('^stm-add-listing/edit/([^/]*)/?', 'index.php?pagename=stm-add-listing&action=edit&listing_id=$matches[1]', 'top');
    }

}