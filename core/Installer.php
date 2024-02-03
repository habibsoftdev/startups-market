<?php 

namespace Startups\Market;
use Startups\Market\Singleton\SingletonTrait;
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
use Startups\Market\Ajax\ConfirmOrder;
use Startups\Market\Ajax\PaymentMethod;
use Startups\Market\Ajax\InitiateWidthraw;
use Startups\Market\Ajax\WithdrawAaction;
use Startups\Market\Email\SendEmail;
use Startups\Market\Shortcodes\Shortcodes;
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
        if (is_plugin_active('woocommerce/woocommerce.php')) {
            Purchase::instance();
        }
        
        $this->CreateWidthrawalTable();
        SendEmail::instance();
        Shortcodes::instance();


        if( defined('DOING_AJAX') && DOING_AJAX ){
            Loginhandler::instance();
            Dashboardprofile::instance();
            DeleteListing::instance();
            ConfirmOrder::instance();
            PaymentMethod::instance();
            InitiateWidthraw::instance();
            WithdrawAaction::instance();

        }
    }

    public function CreateWidthrawalTable(){

        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'stm_withdrawals';

        $schema = "CREATE TABLE IF NOT EXISTS $table_name (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` mediumint(9) NOT NULL,
            `amount` decimal(10,2) NOT NULL,
            `status` varchar(20) NOT NULL,
            `admin_action` tinyint(1) NOT NULL DEFAULT 0,
            `withdrawal_date` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );

    }


}