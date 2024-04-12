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

class Hooks {

  function __construct() {

    // Restrofood shop page shortcode register hook
    add_shortcode( 'restrofoodlite_products', [ __CLASS__, 'restrofoodlite_shortcode' ] );

    // Restrofood shop page shortcode register hook
    add_shortcode( 'restrofoodlite_flash_products', [ __CLASS__, 'restrofoodlite_flash_sale_shortcode' ] );
    
    // Restrofood shop page Template include filter hook
    add_filter( 'template_include', [ __CLASS__, 'restrofoodlite_page_template'], 99 );

    // register_taxonomy for specialoffer post types.
    add_action( 'init', [ __CLASS__, 'restrofoodlite_specialoffer_taxonomy'], 0 );

    // Js template hook in footer action hook
    add_action( 'wp_footer', [ __CLASS__, 'rb_js_template'] );

    // Mini Cart
    add_action( 'wp_footer', [ __CLASS__, 'restrofoodlite_mini_cart'] );

  }

  /**
   * Restrofood shop page shortcode register
   *
   * 
   */
  public static function restrofoodlite_shortcode( $atts ) {

    $attr = shortcode_atts( array(
      'limit'     => '10',
      'col'     => '3',
      'style'   => '1',
      'layout'  => 'grid',
      'sidebar' => 'yes',
      'search'  => 'yes',
      'cat'     => '',
      'mini_cart_type'  => '',
      'branch_id'       => '',
      'padding_top'     => '',
      'padding_bottom'  => '',
      'shortcode'       => true
    ), $atts );

    global $restrofoodAttr;

    $restrofoodAttr = $attr;

    ob_start();
    include RESTROFOODLITE_DIR_PATH.'view/template-part-woo-items.php';
    return ob_get_clean();
   
  }

  /**
   * Restrofood shop page shortcode register
   *
   * 
   */
  public static function restrofoodlite_flash_sale_shortcode( $atts ) {

    $attr = shortcode_atts( array(
      'limit'           => '6',
      'per_slide'       => '4',
      'title'           => '',
      'show_btn'        => '',
      'link'            => '',
      'branch_id'       => '',
      'padding_top'     => '',
      'padding_bottom'  => '',
      'shortcode'       => true
    ), $atts );

    global $restrofoodFlashProducts;

    $restrofoodFlashProducts = $attr;

    ob_start();
    include RESTROFOODLITE_DIR_PATH.'view/template-woo-flash-sale-items.php';
    return ob_get_clean();
   
  }

  /**
   * Restrofood shop page Template include
   *
   * 
   */   
  public static function restrofoodlite_page_template( $template ) {
   
    $options = get_option('restrofoodlite_options');

    $shop_page            = !empty( $options['shop-page'] ) ? $options['shop-page'] : 'restrofoodlite';

    // Woo Items
    if ( is_page( $shop_page )  ) {

        $new_template = RESTROFOODLITE_DIR_PATH.'view/template-woo-items.php';

        if ( '' != $new_template ) {
            return $new_template ;
        }
    }

    return $template;

  }

  /**
   * Register.
   *
   * @see register_taxonomy for specialoffer post types.
   * 
   */
  public static function restrofoodlite_specialoffer_taxonomy() {

      $args = array(
          'label'        => esc_html__( 'Special Offer', 'restrofoodlite' ),
          'public'       => true,
          'rewrite'      => array( 'slug' => 'special-offer' ),
          'hierarchical' => true
      );

      register_taxonomy( 'specialoffer', 'product', $args );
      
  }


  /**
   *
   * Js template hook in footer
   * 
   * 
   */  
  public static function rb_js_template() {

    include RESTROFOODLITE_DIR_PATH.'view/template-modal-wrapper.php';
    include RESTROFOODLITE_DIR_PATH.'view/template-modal-product-content.php';
    include RESTROFOODLITE_DIR_PATH.'view/template-modal-reviews.php';
    include RESTROFOODLITE_DIR_PATH.'view/template-modal-alert.php';

    // Template Without Underscore
    include RESTROFOODLITE_DIR_PATH.'view/modal-cart.php';

  }


/**
 * restrofoodlite_mini_cart
 * @return html
 */
public static function restrofoodlite_mini_cart() {
  //
  global $restrofoodAttr;
  //  
  if(  !is_page( restrofoodlite_getOptionData('shop-page') ) && !isset( $restrofoodAttr['shortcode'] ) ) {
    return;
  }
  // Check cart modal style is not canvas
  $miniCartType = !empty( $restrofoodAttr['mini_cart_type'] ) ? $restrofoodAttr['mini_cart_type'] : '';
  $is_minicart = false;

  if( 'canvas' == $miniCartType ) {
    $is_minicart = true;
  } else if( 'canvas' == restrofoodlite_getOptionData('cart-modal-style') && !$miniCartType ) {
    $is_minicart = true;
  }
  //
  if( !$is_minicart ) {
    return;
  }

  ?>
  <!-- Cart Button -->
  <span class="rb_cart_count_btn rb_floating_cart_btn">
    <?php
    if( !is_admin() ):
    ?>
    <span class="rb_cart_count rb_cart_icon"><?php echo sprintf( esc_html__( '%s Items', 'restrofoodlite' ), esc_html( WC()->cart->get_cart_contents_count() ) ); ?></span>
    <?php
    endif;
    ?>
    <span class="rb_cart_icon">
      <?php 
      if( !empty( $options['cart-btn-icon'] ) ) {
        echo '<img src="'.esc_url( $options['cart-btn-icon'] ).'" class="rb_svg" alt="'.esc_attr( 'cart count', 'restrofoodlite' ).'" />';
      } else {
        $icon = RESTROFOODLITE_DIR_URL.'assets/img/icon/cart-btn-icon.svg';
        echo '<img src="'.esc_url( $icon ).'" class="rb_svg" alt="'.esc_attr( 'cart count', 'restrofoodlite' ).'" />';
      }
      ?>
    </span>
  </span>
  <!-- End Cart Button -->
  <?php
}


}

// Hooks class init
new Hooks();