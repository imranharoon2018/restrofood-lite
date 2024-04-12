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


class Textedit_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'Text Edit', 'restrofoodlite' ),
            'icon'    => 'fa fa-edit',
            'id'      => 'textedit'
        ]);

        $this->text( 
          [
            'title' => esc_html__( 'Category Nav Text', 'restrofoodlite' ),
            'name'  => 'category-nav-text',
            'placeholder' => esc_html__('Offers & Category', 'restrofoodlite')
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Categories Heading Text', 'restrofoodlite' ),
            'name'  => 'categories-heading-text',
            'placeholder' => esc_html__('Categories', 'restrofoodlite')
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Special Offer Categories Heading Text', 'restrofoodlite' ),
            'name'  => 'special-offer-heading-text',
            'placeholder' => esc_html__('Special Offer', 'restrofoodlite')
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Food Visibility Categories Heading Text', 'restrofoodlite' ),
            'name'  => 'food-visibility-heading-text',
            'placeholder' => esc_html__('Food Visibility', 'restrofoodlite')
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Visiblity Alert Message', 'restrofoodlite' ),
            'name'  => 'product-visibility-alert-msg',
            'placeholder' => esc_html__( 'Not Available for this time.', 'restrofoodlite' )
          ]
        );
        $this->text(
          [
            'title' => esc_html__( 'Products Top Title Text', 'restrofoodlite' ),
            'name'  => 'product-top-title-text',
            'placeholder' => esc_html__( 'Our All Delicious Foods', 'restrofoodlite' )
          ]
        );


        $this->end_fields_section(); // End fields section
   }
}

new Textedit_Settings_Tab();