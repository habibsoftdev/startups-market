<?php 

namespace Startups\Market\Users\Buyers;

/**
 * Buyer Registration class Handler
 */
class BuyerRegister{
    
    public function __construct(){
        add_shortcode( 'buyer_registration_form', [ $this, 'buyer_registration_form_shortcode' ] );
    }

    public function buyer_registration_form_shortcode(){
        ob_start();
        include(plugin_dir_path(__FILE__). 'views/registration-form.php');
        return ob_get_clean();
    }


}