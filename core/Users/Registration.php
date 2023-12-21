<?php 

namespace Startups\Market\Users;

/**
 *  Registration class Handler
 */
class Registration{
    
    public function __construct(){
        add_shortcode( 'registration_form', [ $this, 'registration_form_shortcode' ] );
    }

    public function registration_form_shortcode(){
        ob_start();
        include(plugin_dir_path(__FILE__). 'views/registration-form.php');
        return ob_get_clean();
    }


}