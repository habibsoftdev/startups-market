<?php  

namespace Startups\Market\Users\Dashboard;

if( ! defined( 'ABSPATH' ) ){
    exit;
}

class Dashboard{

    public function __construct(){

    }

    public function user_dashboard(){
        
        ?>
            <div class="stm-user-dashboard">
                <div class="stm-container-fluid">
                    <h2> <?php esc_html_e( 'My Dashboard', 'startups-market'); ?></h2>
                    <div class="stm-user-dashboard__toggle">
                        <a href="#" class="stm-user-dashboard__toggle__link" >Icon placeholder</a>
                    </div>
                </div>
            </div>

        <?php 
    }
}