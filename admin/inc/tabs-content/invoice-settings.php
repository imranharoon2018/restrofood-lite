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


class Invoice_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'Invoice Settings', 'restrofoodlite' ),
            'icon'    => 'fas fa-file-invoice',
            'id'      => 'invoicesettings'
        ]);
        // Pro features deactivate
        $this->promo();
        $this->selectbox(
          [
          'title' => esc_html__( 'Invoice Type', 'restrofoodlite' ),
          'name'  => 'invoice_type',
          'options'   => [
            'normal' => esc_html__('Normal Printer', 'restrofoodlite'),
            'thermal' => esc_html__('Thermal/Receipt Printer', 'restrofoodlite'),
          ]
          ]
        );
        $this->media(
          [
            'title' => esc_html__( 'Logo Upload', 'restrofoodlite' ),
            'name'  => 'invoice_logo',
          ]
        );
        $this->text(
          [
          'title' => esc_html__( 'Invoice header restaurant name', 'restrofoodlite' ),
          'name'  => 'header_restaurant_name',
          ]
        );
        $this->text(
          [
          'title' => esc_html__( 'Invoice header restaurant Address', 'restrofoodlite' ),
          'name'  => 'header_restaurant_address',
          ]
        );
        $this->text(
          [
          'title' => esc_html__( 'Invoice Footer Text', 'restrofoodlite' ),
          'name'  => 'invoice_footer_text',
          ]
        );   


        $this->end_fields_section(); // End fields section
   }
}

new Invoice_Settings_Tab();