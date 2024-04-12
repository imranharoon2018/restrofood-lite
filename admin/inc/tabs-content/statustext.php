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


class StatusText_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'Status Text', 'restrofoodlite' ),
            'icon'    => 'fa fa-pen',
            'id'      => 'statustext'
        ]);
        $this->text(
          [
            'title' => esc_html__( 'Order Cancel Text', 'restrofoodlite' ),
            'name'  => 'order-cancel-text',
            'placeholder' => esc_html__( 'Order Cancel', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Order Failed Text', 'restrofoodlite' ),
            'name'  => 'order-failed-text',
            'placeholder' => esc_html__( 'Order Failed', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'New Order Text', 'restrofoodlite' ),
            'name'  => 'new-order-text',
            'placeholder' => esc_html__( 'New Order', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Send To Cooking Text', 'restrofoodlite' ),
            'name'  => 'send-to-cooking-text',
            'placeholder' => esc_html__( 'Send To Cooking', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Cooking Processing Text', 'restrofoodlite' ),
            'name'  => 'cooking-processing-text',
            'placeholder' => esc_html__( 'Cooking Processing', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Cooking Completed Text', 'restrofoodlite' ),
            'name'  => 'cooking-completed-text',
            'placeholder' => esc_html__( 'Cooking Completed', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Waiting For Kitchen Accept Text', 'restrofoodlite' ),
            'name'  => 'waiting-for-kitchen-accept-text',
            'placeholder' => esc_html__( 'Waiting For Kitchen Accept', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'On The Way Text', 'restrofoodlite' ),
            'name'  => 'on-the-way-text',
            'placeholder' => esc_html__( 'On The Way', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Ready To Delivery Text', 'restrofoodlite' ),
            'name'  => 'ready-to-delivery-text',
            'placeholder' => esc_html__( 'Ready To Delivery', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Delivery Completed Text', 'restrofoodlite' ),
            'name'  => 'delivery-completed-text',
            'placeholder' => esc_html__( 'Delivery Completed', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Order Placed Text', 'restrofoodlite' ),
            'name'  => 'order-placed-text',
            'placeholder' => esc_html__( 'Order Placed', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Accepted Cooking Text', 'restrofoodlite' ),
            'name'  => 'accepted-cooking-text',
            'placeholder' => esc_html__( 'Accepted Cooking', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Processing Text', 'restrofoodlite' ),
            'name'  => 'processing-text',
            'placeholder' => esc_html__( 'Processing', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'On The Way To Delivery Text', 'restrofoodlite' ),
            'name'  => 'way-to-delivery-text',
            'placeholder' => esc_html__( 'On The Way To Delivery', 'restrofoodlite' ),
            'is_pro' => true
          ]
        );
        
        $this->end_fields_section(); // End fields section
   }
}

new StatusText_Settings_Tab();