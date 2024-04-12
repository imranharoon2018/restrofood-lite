<?php
namespace RestroFoodLite;
/**
 *
 * @package     Restrofood
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

class Components_Ajax {

	function __construct() {
    
    add_action( 'wp_ajax_woo_search_product', [$this, 'search_product'] );
    add_action( 'wp_ajax_nopriv_woo_search_product', [$this, 'search_product'] );

    add_action( 'wp_ajax_update_order_review_action', [$this, 'update_order_review'] );
    add_action( 'wp_ajax_nopriv_update_order_review_action', [$this, 'update_order_review'] );

    add_action( 'wp_ajax_order_time_lists_action', [$this, 'order_time_lists'] );
    add_action( 'wp_ajax_nopriv_order_time_lists_action', [$this, 'order_time_lists'] );
    
    add_action( 'wp_ajax_woo_update_fixed_cart_subtotal', [__CLASS__, 'update_fixed_cart_subtotal'] );
    add_action( 'wp_ajax_nopriv_woo_update_fixed_cart_subtotal', [__CLASS__, 'update_fixed_cart_subtotal'] );

	}

  public function search_product() {
 
    global $wpdb, $woocommerce;
 
    if ( isset( $_POST['keyword'] ) && !empty( $_POST['keyword'] ) ) {
      
        $keyword = sanitize_text_field( $_POST['keyword'] );
        $getLayout = sanitize_text_field( $_POST['layout'] );
        $col = sanitize_text_field( $_POST['col'] );
        
        // Check multibranch
        if( restrofoodlite_is_multi_branch() ) {
        $branchId  = isset( $_POST['branch'] ) ? sanitize_text_field( $_POST['branch'] ) : '';

        $querystr = "SELECT DISTINCT $wpdb->posts.*
        FROM $wpdb->posts, $wpdb->postmeta
        WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
        AND (
            ($wpdb->postmeta.meta_key = '_sku' AND $wpdb->postmeta.meta_value LIKE '%{$keyword}%')
            OR
            ($wpdb->posts.post_content LIKE '%{$keyword}%')
            OR
            ($wpdb->posts.post_title LIKE '%{$keyword}%')
        )
        AND ($wpdb->postmeta.meta_key = 'restrofoodbranch_list' AND $wpdb->postmeta.meta_value LIKE '%{$branchId}%')
        AND $wpdb->posts.post_status = 'publish'
        AND $wpdb->posts.post_type = 'product'
        ORDER BY $wpdb->posts.post_date DESC";

        } else {

        $querystr = "SELECT DISTINCT $wpdb->posts.*
        FROM $wpdb->posts, $wpdb->postmeta
        WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
        AND (
            ($wpdb->postmeta.meta_key = '_sku' AND $wpdb->postmeta.meta_value LIKE '%{$keyword}%')
            OR
            ($wpdb->posts.post_content LIKE '%{$keyword}%')
            OR
            ($wpdb->posts.post_title LIKE '%{$keyword}%')
        )
        AND $wpdb->posts.post_status = 'publish'
        AND $wpdb->posts.post_type = 'product'
        ORDER BY $wpdb->posts.post_date DESC";

        }

        $query_results = $wpdb->get_results( $querystr );

        if ( !empty( $query_results ) ) {
 
            ob_start();
 
            $layout = new Product_Layout();

            foreach ( $query_results as $result ) {
 
                $product = get_product( $result->ID );

                $productData = [
                  'query_type'  => 'search',
                  'column' => $col,
                  'product' => $product
                ];

                if( $getLayout != 'grid' ) {
                  $layout->setProductArgs( $productData )->product_layout_list();
                } else {
                  $layout->setProductArgs( $productData )->product_layout_grid();
                }
            
            }
            
    } else {
        esc_html_e( 'Product not found.', 'restrofoodlite' );
    }
    
     echo ob_get_clean();

    }
    die();
  }


/**
 * update_order_review
 * @return
 * 
 */
public function update_order_review() {

  WC()->cart->calculate_shipping();
  WC()->cart->calculate_totals();

  wp_die();
}


/**
 * [order_time_lists description]
 * @return [type] [description]
 */
public function order_time_lists() {

  $date = isset( $_POST['date'] ) ? sanitize_text_field( $_POST['date'] ) : '';
  $branchid = isset( $_POST['branchid'] ) ? sanitize_text_field( $_POST['branchid'] ) : '';
  $timeList = \RestroFoodLite\Date_Time_Map::getTimes( $date, $branchid );
  restrofoodlite_time_solt_options_html( $timeList );
  die();
}

/**
 * [holy_day_check description]
 * @return [type] [description]
 */
public static function update_fixed_cart_subtotal() {
  echo WC()->cart->get_cart_subtotal();
  die();
}

} // End class

// Components_Ajax Class init
new Components_Ajax();
