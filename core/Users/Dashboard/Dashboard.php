<?php  

namespace Startups\Market\Users\Dashboard;
use Startups\Market\Stm_Utils;

if( ! defined( 'ABSPATH' ) ){
    exit;
}

class Dashboard{

    public function __construct(){
        add_shortcode( 'stm_user_dashboard', [ $this, 'stm_render_dashboard' ]);
    }

    public function stm_render_dashboard(){
        if( is_user_logged_in() ){

            
            $this->user_dashboard();
            

        }
    }

    public function user_dashboard(){

        ?>
    <div class="stm-container-fluid snipcss-vxzKo">
        <div class="stm-user-dashboard__toggle">
        <a href="#" class="stm-user-dashboard__toggle__link">
        <?php echo Stm_Utils::custom_icon( 'bars-solid' ); ?>
        </a>
        </div>
  <div class="stm-user-dashboard__contents stm-tab stm-tab-content-grid-fix">
    <div class="stm-user-dashboard__nav stm-tab__nav">
      <span class="stm-dashboard__nav--close">
      <?php echo Stm_Utils::custom_icon( 'times-solid' ); ?>
      </span>
      


    


     



        <?php 
    }
}