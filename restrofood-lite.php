<?php
/**
 * Plugin Name:       Restrofood Lite
 * Plugin URI:        https://www.themelooks.com/blog/
 * Description:       Restrofood is an online food ordering and delivery system for WordPress. You can manage your restaurant & other food ordering stuff with Restrofood. It has plenty of amazing features. That helps you to build a successful online business.
 * Version:           1.0.2
 * Author:            ThemeLooks
 * Author URI:        https://themelooks.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       restrofoodlite
 * Domain Path:       /languages
 * 
 */

/**
 * Define all constant
 *
 */

// Version constant
if( !defined( 'RESTROFOODLITE_VERSION' ) ) {
	define( 'RESTROFOODLITE_VERSION', '1.0.2' );
}

// Plugin dir path constant
if( !defined( 'RESTROFOODLITE_DIR_PATH' ) ) {
	define( 'RESTROFOODLITE_DIR_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}
// Plugin dir url constant
if( !defined( 'RESTROFOODLITE_DIR_URL' ) ) {
	define( 'RESTROFOODLITE_DIR_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
}
// Plugin dir url constant
if( !defined( 'RESTROFOODLITE_DIR_ASSETS_URL' ) ) {
	define( 'RESTROFOODLITE_DIR_ASSETS_URL', trailingslashit( RESTROFOODLITE_DIR_URL.'assets' ) );
}
// Plugin dir admin assets url constant
if( !defined( 'RESTROFOODLITE_DIR_ADMIN_ASSETS_URL' ) ) {
	define( 'RESTROFOODLITE_DIR_ADMIN_ASSETS_URL', trailingslashit( RESTROFOODLITE_DIR_URL . 'admin/assets' ) );
}
// Admin dir path
if( !defined( 'RESTROFOODLITE_DIR_ADMIN' ) ) {
	define( 'RESTROFOODLITE_DIR_ADMIN', trailingslashit( RESTROFOODLITE_DIR_PATH.'admin' ) );
}
// Inc dir path
if( !defined( 'RESTROFOODLITE_DIR_INC' ) ) {
	define( 'RESTROFOODLITE_DIR_INC', trailingslashit( RESTROFOODLITE_DIR_PATH.'inc' ) );
}

// Inc dir path
if( !defined( 'RESTROFOODLITE_PRO_URL' ) ) {
	define( 'RESTROFOODLITE_PRO_URL', 'https://enteraddon.com/restrofood/pricing/' );
}


final class RestroFoodLite {

	private static $instance = null;

	function __construct() {

		add_action( 'init', [ $this, 'restrofoodlite_load_textdomain' ] );
		register_deactivation_hook( __FILE__, [ $this, 'restrofoodlite_plugin_deactivate' ] );
		register_activation_hook( __FILE__, [ $this, 'restrofoodlite_plugin_activate' ] );
		add_action( 'plugins_loaded', [ $this, 'restrofoodlite_is_woocommerce_activated'] );
		
	}
		
	public static function getInstance() {
		
		if( is_null( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Load plugin textdomain.
	 */
	public function restrofoodlite_load_textdomain() {
	    load_plugin_textdomain( 'restrofoodlite', false, RESTROFOODLITE_DIR_PATH . 'languages' ); 
	}

	/**
	 * Check WooCommerce is activated or not
	 * 
	 */
	public function restrofoodlite_is_woocommerce_activated() {

		if ( class_exists( 'woocommerce' ) ) {
			require_once( RESTROFOODLITE_DIR_PATH.'restrofood-lite-init.php' );
		} else {
			add_action( 'admin_notices', [ $this, 'restrofoodlite_activation_admin_notice' ] );
		}

	}

	/**
	 * restrofoodlite_activation_admin_notice description
	 * 
	 * If wooocommerce plugin not active 
	 * show the admin notification to active woocommerce plugin 
	 * 
	 * @return 
	 */
	public function restrofoodlite_activation_admin_notice() {
	    $url = "https://wordpress.org/plugins/woocommerce/";
	    ?>
	    <div class="notice notice-error is-dismissible">
	        <h4><?php echo sprintf( esc_html__( 'RestroFoodLite requires the WooCommerce plugin to be installed and active. You can download %s woocommerce %s here. Thanks.', 'restrofoodlite' ), '<a href="'.esc_url( $url ).'" target="_blank">','</a>' ); ?></h4>
	    </div>
	    <?php
	}

	/**
	 * restrofoodlite_default_pages_list 
	 * @return array
	 */
	public function restrofoodlite_default_pages_list() {

	  return [
	    "restrofoodlite"  => "RestroFoodLite",
	    "branch-manager"  => "Branch Manager",
	    "kitchen-manager" => "Kitchen Manager",
	    "delivery"        => "Delivery",
	    "admin"           => "Admin"
	  ];

	}

	/**
	 * restrofoodlite_insert_page 
	 * Add plugin default page
	 * @return 
	 * 
	 */
	public function restrofoodlite_insert_page() {

	  $getPages = $this->restrofoodlite_default_pages_list();

	  foreach( $getPages as $page_title ) {

		  // Create page object
		  $page = array(
		    'post_type'     => 'page',
		    'post_title'    => wp_strip_all_tags( $page_title ),
		    'post_status'   => 'publish'
		  );
		   
		  // Insert the post into the database
		  wp_insert_post( $page );
	  
	  }

	}

	/**
	 * restrofoodlite_delete_page description
	 * @return 
	 */
	public function restrofoodlite_delete_page() {

	    // Pages
	   $getPages = $this->restrofoodlite_default_pages_list();
	    
	    //
	    foreach( $getPages as $key => $page ){
	      $page_data  = get_page_by_path( $key );
	      if( !empty( $page_data->ID ) ) {
	      	wp_delete_post( $page_data->ID );
	      }
	      
	    }

	}

	/**
	 * restrofoodlite_plugin_activate
	 * @return 
	 */
	public function restrofoodlite_plugin_activate() {

		// Insert default pages
		$this->restrofoodlite_insert_page();

		// Default options set
		$defaultOption = array(
			"product-limit" 	=> 6,
			"search-section" 	=> 'yes',
			"show-cart-button" 	=> 'yes',
			"shop-page" 		=> 'restrofoodlite',
			"branch-manager" 	=> 'branch-manager',
			"kitchen-manager" 	=> 'kitchen-manager',
			"checkout-delivery-option" => 'yes',
			"popup-location-active"	   => 'yes',
			"modal-close-btn-show"	   => 'yes',
			"cart-modal-style"		   => 'canvas',
			"delivery-options" 	 => 'all',
			"product-column" 	 => '4',
			"pickup-time-switch" => 'yes',
			"delivery" 			 => 'delivery',
			"admin" 			 => 'admin'
		);

		update_option( 'restrofoodlite_options', $defaultOption );

	}
	
	/**
	 * restrofoodlite_plugin_deactivate 
	 * @return 
	 */
	public function restrofoodlite_plugin_deactivate() {

		// Delete default pages
		$this->restrofoodlite_delete_page();

		//
		delete_option('restrofoodlite_options');

	}

}

// Init RestroFoodLite class
RestroFoodLite::getInstance();
