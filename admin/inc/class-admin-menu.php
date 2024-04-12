<?php
namespace RestroFoodLite;

/**
 * restrofoodlite admin class
 *
 * @package     Restrofood
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

if( !class_exists('Admin_Menu') ) {
	class Admin_Menu {

		private static $getPermission;
		private static $instance = null;

		function __construct() {
			add_action( 'admin_menu', array( __CLASS__, 'admin_menu_page' ) );
			add_action( 'admin_init', array( __CLASS__, 'page_settings_init' ) );
		}

		public static function getInstance() {
			if( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public static function admin_menu_page() {

			// add top level menu page
			add_menu_page(
				esc_html__( 'Restrofood Settings', 'restrofoodlite' ),
				esc_html__( 'Restrofood', 'restrofoodlite' ),
				'manage_options',
				'restrofoodlite',
				array( __CLASS__, 'admin_view' ),
				RESTROFOODLITE_DIR_ADMIN_ASSETS_URL.'menu-icon.png'
			);
			add_submenu_page( 'restrofoodlite', esc_html__( 'Restrofood Settings', 'restrofoodlite' ), esc_html__( 'Settings', 'restrofoodlite' ),'manage_options', 'restrofoodlite');
			do_action('restrofoodlite_admin_menu');
			add_submenu_page(
		        'restrofoodlite',
		        esc_html__( 'Order Manage', 'restrofoodlite' ), //page title
		        esc_html__( 'Orders', 'restrofoodlite' ), //menu title
		        'manage_options', //capability,
		        'restrofoodlite-branch-order',//menu slug
		        array( __CLASS__, 'branch_order_submenu_page' ) //callback function
		        
		    );
		    add_submenu_page(
            'restrofoodlite',
            esc_html__( 'Recommended Plugins', 'restrofoodlite' ), //page title
            esc_html__( 'Recommended Plugins', 'restrofoodlite' ), //menu title
            'manage_options', //capability,
            'restrofoodlite-recommended-plugin',//menu slug
            array( __CLASS__, 'recommended_plugin_submenu_page' ) //callback function
        	);
		}

		public static function recommended_plugin_submenu_page() {
	        echo '<div class="dl-main-wrapper" style="margin-top: 50px;">';
	            \RestroFoodLite\Orgaddons\Org_Addons::getOrgItems();
	        echo '</div>';
    	}
		public static function admin_view() {
			$Admin_Templates = new Admin_Templates_Map();
			$Admin_Templates->admin_page_init();
		}
		public static function page_settings_init() {
			register_setting(
	            'restrofoodlite_settings_option_group', // Option group
	            'restrofoodlite_options' // Option name
	        );  
		}

		public static function branch_order_submenu_page() {

			echo '<div class="admin-promo-wrapper"><div class="fbl-overlay"><div class="fbl-promo-inner"><h3>Order management system is a pro version features </h3><a href="'.esc_url( RESTROFOODLITE_PRO_URL ).'" class="button button-primary fbl-buy" target="_blank">Buy Now</a></div></div><img src="'.RESTROFOODLITE_DIR_ASSETS_URL.'/img/restrofood-order.png"></div>';


		}

	}

	Admin_Menu::getInstance();
}