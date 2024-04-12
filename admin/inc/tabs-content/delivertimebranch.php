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


class Delivertimebranch_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'Delivery Settings', 'restrofoodlite' ),
            'icon'    => 'fa fa-truck',
            'id'      => 'delivertimebranch'
        ]);

        $this->switcher(
          [
            'title' => esc_html__( 'Checkout Delivery Option Show/Hide', 'restrofoodlite' ),
            'name'  => 'checkout-delivery-option'
          ]
        );
        $this->selectbox(
          [
            'title'     => esc_html__( 'Set Delivery Options', 'restrofoodlite' ),
            'name'      => 'delivery-options',
            'options'   => [
              'all'   => esc_html__( 'Delivery/Pickup Both', 'restrofoodlite' ),
              'delivery' => esc_html__( 'Only Delivery ( Pro )', 'restrofoodlite' ),
              'pickup'   => esc_html__( 'Only Pickup ( Pro )', 'restrofoodlite' )
            ]
          ]
        );        
        $this->text(
          [
            'title' => esc_html__( 'Set Delivery Fee', 'restrofoodlite' ),
            'name'  => 'delivery-fee'
          ]
        );
        $this->number(
          [
            'title' => esc_html__( 'Minimum order amount', 'restrofoodlite' ),
            'name'  => 'minimum-order-amount'
          ]
        );
        $this->number(
          [
            'title' => esc_html__( 'Free shipping require minimum order amount', 'restrofoodlite' ),
            'name'  => 'free-shipping-amount'
          ]
        );
        $this->switcher(
          [
            'title' => esc_html__( 'Deliver/Pickup Time and Date Show/Hide', 'restrofoodlite' ),
            'name'  => 'pickup-time-switch'
          ]
        );
        $this->switcher(
          [
            'title' => esc_html__( 'Off current date order', 'restrofoodlite' ),
            'name'  => 'off-current-order',
            'is_pro' => true
          ]
        );
        $this->switcher(
          [
            'title' => esc_html__( 'Pre order active', 'restrofoodlite' ),
            'name'  => 'pre-order-active',
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Deliver/Pickup Time Option Note', 'restrofoodlite' ),
            'name'  => 'delivery-time-note',
            'is_pro' => true
          ]
        );
        // Check multibranch
        if( !restrofoodlite_is_multi_branch() ) {
          $this->day_based_time(
            [
              'title' => esc_html__( 'Delivery Time and Day ', 'restrofoodlite' ),
              'class' => 'delivery-time-day',
              'name'  => 'delivery-time-day'
            ]
          );
        }
        $this->selectbox(
          [
            'title'     => esc_html__( 'Delivery Time Format', 'restrofoodlite' ),
            'name'      => 'delivery-time-format',
            'options'   => [
              '12'    => esc_html__( '12 Hour', 'restrofoodlite' ), 
              '24'    => esc_html__( '24 Hour', 'restrofoodlite' )
            ]
          ]
        );
        $this->selectbox(
          [
            'title'     => esc_html__( 'Delivery Time Slot', 'restrofoodlite' ),
            'name'      => 'delivery-time-slot',
            'options'   => [
              '2,30'    => esc_html__( '30min', 'restrofoodlite' ), 
              '66'    => esc_html__( '60min ( Pro )', 'restrofoodlite' ),
              '120'   => esc_html__( '120min ( Pro )', 'restrofoodlite' ),
              '180'   => esc_html__( '180min ( Pro )', 'restrofoodlite' )
            ]
          ]
        );
        $this->number(
          [
            'title' => esc_html__( 'Order Limit On Time Slot', 'restrofoodlite' ),
            'name'  => 'order-limit-time-slot',
            'is_pro' => true
          ]
        );
        $this->number(
          [
            'title' => esc_html__( 'Pre Order Days Limit', 'restrofoodlite' ),
            'name'  => 'date-days-limit',
            'is_pro' => true
          ]
        );
        $this->timezone_select(
          [
            'title'     => esc_html__( 'Set Time Zone', 'restrofoodlite' ),
            'name'      => 'time-zone'
          ]
        );
        $this->switcher(
          [
            'title' => esc_html__( 'Order Delivery Directions Map Active', 'restrofoodlite' ),
            'name'  => 'delivery-directions-map',
            'is_pro' => true
          ]
        );
        $this->selectbox(
          [
            'title'     => esc_html__( 'Delivery Directions Map Transport Mode', 'restrofoodlite' ),
            'name'      => 'delivery-transport-mode',
            'options'   => [
              'driving'    => esc_html__( 'Driving', 'restrofoodlite' ), 
              'walking'    => esc_html__( 'Walking', 'restrofoodlite' ),
              'bicycling'  => esc_html__( 'Bicycling', 'restrofoodlite' )
            ],
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Closing Time Info Text', 'restrofoodlite' ),
            'name'  => 'closing-time-msg'
          ]
        );

        $this->end_fields_section(); // End fields section
   }
}

new Delivertimebranch_Settings_Tab();