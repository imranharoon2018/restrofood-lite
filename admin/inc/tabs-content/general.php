<?php
namespace RestroFoodLite\Admin;
 /**
  * 
  * @package    RestroFoodLite 
  * @since      3.0.0
  * @version    3.0.0
  * @author     ThemeLooks
  * @Websites:  http://themelooks.com/
  *
  */


class General_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'General Settings', 'restrofoodlite' ),
            'class'   => 'active',
            'id'      => 'general',
            'icon'    => 'fa fa-home',
            'display' => 'block'
        ]);

        $this->switcher(
          [
            'title' => esc_html__( 'Search Section Show', 'restrofoodlite' ),
            'name'  => 'search-section'
          ]
        );
        $this->selectbox(
          [
            'title' => esc_html__( 'Mini Cart Style', 'restrofoodlite' ),
            'name'  => 'cart-modal-style',
            'options'   => [
              'canvas'          => esc_html__( 'Canvas Modal', 'restrofoodlite' ), 
              'footer-fixed'    => esc_html__( 'Footer Fixed ( pro )', 'restrofoodlite' ),
              'beside-products' => esc_html__( 'Beside Products ( pro )', 'restrofoodlite' )
            ]
          ]
        );
        $this->switcher(
          [
            'title' => esc_html__( 'Add To Cart Button Show', 'restrofoodlite' ),
            'name'  => 'show-cart-button'
          ]
        );
        $this->number(
          [
            'title' => esc_html__( 'Product Per Page', 'restrofoodlite' ),
            'name'  => 'product-limit'
          ]
        );
        $this->selectbox(
          [
            'title' => esc_html__( 'Product Order By', 'restrofoodlite' ),
            'name'  => 'product-order',
            'options'   => [
              'DESC' => esc_html__( 'DESC', 'restrofoodlite' ), 
              'ASC'  => esc_html__( 'ASC', 'restrofoodlite' )
            ]
          ]
        );
        $this->selectbox(
          [
            'title' => esc_html__( 'Product Layout', 'restrofoodlite' ),
            'name'  => 'product-layout',
            'options'   => [ 'grid' => esc_html__( 'Grid Column', 'restrofoodlite' ), 'list' => esc_html__( 'List Column ( pro )', 'restrofoodlite' ) ]
          ]
        );
        $this->selectbox(
          [
            'title' => esc_html__( 'Layout Style', 'restrofoodlite' ),
            'name'  => 'product-layout-style',
            'options'   => [
              '1' => esc_html__( 'Style 1', 'restrofoodlite' ), 
              '2' => esc_html__( 'Style 2 ( pro )', 'restrofoodlite' ),
              '3' => esc_html__( 'Style 3 ( pro )', 'restrofoodlite' ) 
            ]
          ]
        );
        $this->selectbox(
          [
            'title' => esc_html__( 'Product Column', 'restrofoodlite' ),
            'name'  => 'product-column',
            'options'   => [ 
              '6' => esc_html__( '2 Column', 'restrofoodlite' ), 
              '4' => esc_html__( '3 Column', 'restrofoodlite' ), 
              '3' => esc_html__( '4 Column', 'restrofoodlite' ) 
            ]
          ]
        );
        $this->number(
          [
            'title' => esc_html__( 'Manager Page Order Notification Delay Time ( default 6 second )', 'restrofoodlite' ),
            'name'  => 'page-autoreload',
            'placeholder' => esc_attr__( '6', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->number(
          [
            'title' => esc_html__( 'Set List View Product Description Characters', 'restrofoodlite' ),
            'name'  => 'desc-characters',
            'description' => esc_html__( 'This option work only for list style 3.', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title'       => esc_html__( 'Order Button Text', 'restrofoodlite' ),
            'name'        => 'order-btn-text',
          ]
        );
        $this->media(
          [
            'title'       => esc_html__( 'Cart Button Icon', 'restrofoodlite' ),
            'name'        => 'cart-btn-icon',
          ]
        );

        $this->selectbox(
          [
            'title' => esc_html__( 'Branch Type', 'restrofoodlite' ),
            'name'  => 'brunch-type',
            'options'   => [ 
              'single' => esc_html__( 'Single Branch', 'restrofoodlite' ), 
              'multi' => esc_html__( 'Multi Branch', 'restrofoodlite' ) 
            ],
            'is_pro' => true
          ]
        );

        $this->switcher(
          [
            'title' => esc_html__( 'Notification Audio Loop', 'restrofoodlite' ),
            'name'  => 'audio-loop',
            'is_pro' => true
          ]
        );
        $this->media(
          [
            'title'       => esc_html__( 'Upload Notification Audio MP3', 'restrofoodlite' ),
            'name'        => 'notification-audio',
            'is_pro' => true
          ]
        );
        $this->end_fields_section(); // End fields section
   }
}

new General_Settings_Tab();