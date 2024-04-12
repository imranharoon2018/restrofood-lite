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


class Email_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'Email Settings', 'restrofoodlite' ),
            'icon'    => 'fa fa-envelope',
            'id'      => 'emailsettings'
        ]);
        // Pro features deactivate
        $this->promo();
        $this->switcher(
          [
            'title' => esc_html__( 'Active Email Notification', 'restrofoodlite' ),
            'name'  => 'active-e-notification'
          ]
        );
        $this->switcher(
          [
            'title' => esc_html__( 'Active Delivery Boy Assign Email Notification', 'restrofoodlite' ),
            'name'  => 'active-order-assign-mail-notification'
          ]
        );
        $this->text(
          [
            'title'       => esc_html__( 'Subject Text', 'restrofoodlite' ),
            'name'        => 'subject-text',
          ]
        );
        $this->text(
          [
            'title'       => esc_html__( 'Order Cancel Notification Text', 'restrofoodlite' ),
            'name'        => 'on-cancel-text',
          ]
        );
        $this->text(
          [
            'title'       => esc_html__( 'Send To Cooking Notification Text', 'restrofoodlite' ),
            'name'        => 'on-stc-text',
          ]
        );
        $this->text(
          [
            'title'       => esc_html__( 'Accept Cooking Notification Text', 'restrofoodlite' ),
            'name'        => 'on-ac-text',
          ]
        );
        $this->text(
          [
            'title'       => esc_html__( 'Cooking Complete Notification Text', 'restrofoodlite' ),
            'name'        => 'on-cc-text',
          ]
        );
        $this->text(
          [
            'title'       => esc_html__( 'On The Way Notification Text', 'restrofoodlite' ),
            'name'        => 'on-owd-text',
          ]
        );
        $this->text(
          [
            'title'       => esc_html__( 'Delivery Complete Notification Text', 'restrofoodlite' ),
            'name'        => 'on-dc-text',
          ]
        );
        $this->text(
          [
            'title'       => esc_html__( 'Email Template Header Text', 'restrofoodlite' ),
            'name'        => 'et-header-text',
          ]
        );
        $this->text(
          [
            'title'       => esc_html__( 'Email Template Footer Text', 'restrofoodlite' ),
            'name'        => 'et-footer-text',
          ]
        );
        $this->colorpicker(
          [
            'title'       => esc_html__( 'Email Template Header Background Color', 'restrofoodlite' ),
            'name'        => 'et-bg-color',
          ]
        );

        $this->end_fields_section(); // End fields section
   }
}

new Email_Settings_Tab();