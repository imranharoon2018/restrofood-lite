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


class Location_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'Location Settings', 'restrofoodlite' ),
            'icon'    => 'fa fa-map',
            'id'      => 'locationSettings'
        ]);
        // Pro features deactivate
        $this->promo();
        $this->switcher(
          [
            'title' => esc_html__( 'Delivery Availability Checker Active', 'restrofoodlite' ),
            'name'  => 'availability-checker-active'
          ]
        );
        $this->selectbox(
          [
            'title' => esc_html__( 'Location Type', 'restrofoodlite' ),
            'name'  => 'location_type',
            'options'   => [
              'address' => esc_html__( 'Address', 'restrofoodlite' ),
              'zip'     => esc_html__( 'Zip Code', 'restrofoodlite' )
            ]
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Set Google API Key', 'restrofoodlite' ),
            'name'  => 'google-api-key',
            'wrapperclass' => 'fb-address-conditional-field',
            'description' => '<a href="http://console.cloud.google.com/" target="_blank">'.esc_html__( 'Create google API ', 'restrofoodlite' ).'</a>',
          ]
        );
        // Check multibranch
        if( !restrofoodlite_is_multi_branch() ) {

          if( !get_option('restrofoodlite_multideliveryfees_option') ) {
            $this->zipcode([
              'title' => esc_html__( 'Add Single Branch Shop Zip Code', 'restrofoodlite' ),
              'name'  => 'delivery_zip',
              'add_btn_text' => esc_html__( 'Add Zip Code', 'restrofoodlite' ),
              'wrap_class' => 'fb-zip-conditional-field'
            ]);
          }
          $this->locationSearch([
            'title' => esc_html__( 'Set Single Branch Shop Location', 'restrofoodlite' ),
            'name'  => 'branch-location',
          ]);
          $this->number(
            [
              'title' => esc_html__( 'Set Distance Restrict (KM)', 'restrofoodlite' ),
              'name'  => 'distance-restrict',
              'class' => 'fb-address-conditional-field'
            ]
          );

          // Get zipcode with fee field from multideliveryfee plugin
          do_action('restrofoodlite_multideliveryfee_field_delivery_settings', $this );
        }

        $this->switcher(
          [
            'title' => esc_html__( 'Location Modal Popup Active', 'restrofoodlite' ),
            'name'  => 'location-popup-active'
          ]
        );
        $this->switcher(
          [
            'title' => esc_html__( 'Modal Location Checker Active', 'restrofoodlite' ),
            'name'  => 'popup-location-active'
          ]
        );
        $this->switcher(
          [
            'title' => esc_html__( 'Modal Close Button Show', 'restrofoodlite' ),
            'name'  => 'modal-close-btn-show'
          ]
        );
        $this->switcher(
          [
            'title' => esc_html__( 'Checkout Page Delivery Location Checker Active', 'restrofoodlite' ),
            'name'  => 'checkout-location-active'
          ]
        );
        
        $this->multiple_select(
          [
            'title' => esc_html__( 'Set Delivery Availability Checker Modal Show Page', 'restrofoodlite' ),
            'name'  => 'availability-checker-modal',
            'options'   => restrofoodlite_get_pages()
          ]
        );

        $this->end_fields_section(); // End fields section
   }
}

new Location_Settings_Tab();