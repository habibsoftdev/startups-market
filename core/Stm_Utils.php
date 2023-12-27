<?php 

namespace Startups\Market;


class Stm_Utils{

    

    public static function custom_icon($icon){
        
        $custom_icon =  STM_ASSETS. '/icons/' .$icon. '.svg';

        return '<i class="stm-icon-mask" aria-hidden="true" style="--stm-icon:url(' .$custom_icon. '});"></i>';
    }


}