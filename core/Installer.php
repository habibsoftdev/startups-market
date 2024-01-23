<?php 

namespace Startups\Market;
use Startups\Market\Trait\SingletonTrait;
use Startups\Market\Users\Extrafield;
use Startups\Market\Users\Registration;
use Startups\Market\Users\Login;
use Startups\Market\Users\Dashboard\Dashboard;
use Startups\Market\Assetsload;
use Startups\Market\Admin\RegisterBusinessCPT;
use Startups\Market\Metabox\Metabox;
use Startups\Market\Users\AddListing\AddListing;
use Startups\Market\Users\AddListing\ListingHandle;
use Startups\Market\RewriteRule;
use Startups\Market\Purchase\Purchase;
use Startups\Market\Ajax\DashboardProfile;
use Startups\Market\Ajax\DeleteListing;
use Startups\Market\Ajax\Loginhandler;
/**
 * Handle all the class in core file
 */
class Installer{

    use SingletonTrait;

    public function __construct(){
        if( is_admin() ){
            new Admin\Menu();
           
        }

        Extrafield::instance();
        Assetsload::instance();
        Registration::instance();
        Login::instance();
        Dashboard::instance();
        RegisterBusinessCPT::instance();
        Metabox::instance();
        AddListing::instance();
        ListingHandle::instance();
        RewriteRule::instance();
        Purchase::instance();



        if( defined('DOING_AJAX') && DOING_AJAX ){
            Loginhandler::instance();
            Dashboardprofile::instance();
            DeleteListing::instance();
        }
    }

}