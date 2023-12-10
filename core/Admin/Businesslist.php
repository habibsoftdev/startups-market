<?php 

namespace Startups\Market\Admin;

/**
 * Business Page Class
 */
class Businesslist{

    /**
     * plugin page handler
     */

     public function plugin_page(){
        $action = isset( $_GET['action'] ) ? $_GET['action']: 'list';

        switch ( $action ){
            case 'new':
                $template = __DIR__ . '/business-view/business-new.php';
                break;
            
            case 'edit':
                $template = __DIR__ . '/business-view/business-edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/business-view/business-list.php';
                break;
            
            default:
                $template = __DIR__ . '/business-view/business-list.php';
                break;

        }

        if( file_exists($template) ){
            include $template;
        }

     }

}