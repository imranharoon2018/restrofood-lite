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


class Page_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'Page Settings', 'restrofoodlite' ),
            'icon'    => 'fa fa-cog',
            'id'      => 'pagesettings'
        ]);
        $this->selectbox(
          [
          'title' => esc_html__( 'Select Restrofood Shop Page', 'restrofoodlite' ),
          'name'  => 'shop-page',
          'options'   => restrofoodlite_get_pages()
          ]
        );
        $this->selectbox(
          [
          'title' => esc_html__( 'Select Branch Manager Page', 'restrofoodlite' ),
          'name'  => 'branch-manager',
          'options'   => restrofoodlite_get_pages(),
          'is_pro' => true
          ]
        );
        $this->selectbox(
          [
          'title' => esc_html__( 'Select Kitchen Manager Page', 'restrofoodlite' ),
          'name'  => 'kitchen-manager',
          'options'   => restrofoodlite_get_pages(),
          'is_pro' => true
          ]
        );
        $this->selectbox(
          [
          'title' => esc_html__( 'Select Delivery Page', 'restrofoodlite' ),
          'name'  => 'delivery',
          'options'   => restrofoodlite_get_pages(),
          'is_pro' => true
          ]
        );
        $this->selectbox(
          [
          'title' => esc_html__( 'Select Admin Page', 'restrofoodlite' ),
          'name'  => 'admin',
          'options'   => restrofoodlite_get_pages(),
          'is_pro' => true
          ]
        );
        


        $this->end_fields_section(); // End fields section
   }
}

new Page_Settings_Tab();