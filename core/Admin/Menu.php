<?php  

namespace Startups\Market\Admin;
use Startups\Market\Trait\SingletonTrait;
/**
 * The Menu Handler Class
 */
class Menu{

    use SingletonTrait;

    /**
     * Class Constructor
     */
    function __construct(){
        add_action( 'admin_menu', [ $this, 'admin_menu_bar' ],);
        add_filter( 'in_admin_header', [ $this, 'admin_header' ] );
    
    }

    public function admin_menu_bar(){
        $parent_slug = 'startups_market';
        $capability = 'manage_options';
        $settings_slug = 'stm-settings';
        $business_slug = 'business';
        
        // Adding Main Menu
        add_menu_page(
            __( 'Startups Market', 'startups-market' ),
            __( 'Startups Market', 'startups-market' ),
            $capability,
            $parent_slug,
            [ $this, 'plugins_page' ],
            STM_ASSETS.'/main-icon/startupsm.png',
            20
        );

     // Manually add the taxonomy submenu to your custom admin menu
     add_submenu_page(
        'startups_market',
        __( 'Business Categories', 'startups-market' ),
        __( 'Business Categories', 'startups-market' ),
        'manage_options',
        'edit-tags.php?taxonomy=business_category&post_type=business'
    );

               //Adding Submenu
               add_submenu_page(
                $parent_slug,
                __( 'Buyers', 'startups-market' ),
                __( 'Buyers', 'startups-market' ),
                $capability,
                'stm-buyer-list',
                [ $this, 'buyer_list' ]
                
            );

        //Adding Submenu
        add_submenu_page(
            $parent_slug,
            __( 'Sellers', 'startups-market' ),
            __( 'Sellers', 'startups-market' ),
            $capability,
            'stm-seller-list',
            [ $this, 'seller_list' ]
            
        );

        //Adding Submenu
        add_submenu_page(
            $parent_slug,
            __( 'Payment List', 'startups-market' ),
            __( 'Payment List', 'startups-market' ),
            $capability,
            'stm-payment-list',
            [ $this, 'payment_list' ]
            
        );

        //Adding Submenu
        add_submenu_page(
            $parent_slug,
            __( 'Settings', 'startups-market' ),
            __( 'Settings', 'startups-market' ),
            $capability,
            'stm-settings',
            [ $this, 'settings' ]
            
        );

        //Adding Submenu
        add_submenu_page(
            $settings_slug,
            __( 'General', 'startups-market' ),
            __( 'General', 'startups-market'),
            $capability,
            $settings_slug. '&tab=general',
            [ $this, 'settings' ],
        );

        //Adding Submenu
        add_submenu_page(
            $settings_slug,
            __( 'Payment', 'startups-market' ),
            __( 'Payment', 'startups-market'),
            $capability,
            $settings_slug. '&tab=payment',
            [ $this, 'settings' ],
        );
    }



    /**
     * Admin menu Callback function
     *
     * @return void
     */
    public function plugins_page(){
      
    }

    /**
     * Submenu callback function
     *
     * @return void
     */
    public function payment_list(){

    }

    /**
     * Submenu callback function
     *
     * @return void
     */
    public function buyer_list(){
        Buyerview::instance();
    }

    /**
     * Submenu callback function
     *
     * @return void
     */
    public function seller_list(){
        Sellerview::instance();
    }

    /**
     * Submenu callback function
     *
     * @return void
     */
    public function settings(){
        ?>
        <div class="tab-content">
            <?php 
                $active_tab = isset( $_GET[ 'tab' ] ) ? sanitize_key( $_GET[ 'tab'] ) : '';

                switch( $active_tab ){
                    case 'general':
                        Tab\GeneralTab::init();
                        break;
                    
                    case 'payment':
                        Tab\PaymentTab::init();
                        break;

                    default:
                    Tab\GeneralTab::init();
                }
            ?>
        </div>

        <?php
    }

    /**
     * Settings Page Header and Menu
     *
     * @return void
     */
    public function admin_header(){

        $wp_startups_market = 'startups-market_page_stm-settings';

        $current_screen = get_current_screen();
        if( $current_screen->id !== $wp_startups_market ){
            return;
        }?>
        <div id="stm-page-header-temp"></div>
        <div id="stm-page-header">
            <div class="stm-page-title">
                <div class="stm-logo-image">
                    <?php printf( '<img src="%1$s" alt="%2$s" >', esc_url(STM_ASSETS. '/images/logo.png'), esc_html__( 'Startups Market Logo', 'startups-market' )); ?>
                </div>
                <div class="stm-logo-sep">
                    <img src="<?php echo esc_url(STM_ASSETS. '/images/sep.png'); ?>" alt="separator">
                </div>
                <a class="tab <?php echo empty( $_GET['tab'] ) || $_GET['tab'] === 'general' ? 'active' : ''; ?>" href="?page=stm-settings&tab=general"><?php esc_html_e( 'General', 'startups-market' ); ?></a>
                <a class="tab <?php echo isset( $_GET['tab'] ) && $_GET['tab'] === 'payment' ? 'active' : ''; ?>" href="?page=stm-settings&tab=payment"><?php esc_html_e( 'Payment', 'startups-market' ); ?></a>
            </div>
        </div>


        <?php 
    }
}