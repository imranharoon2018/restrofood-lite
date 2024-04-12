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


class Color_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'Color Settings', 'restrofoodlite' ),
            'icon'    => 'fa fa-fill',
            'id'      => 'colorsettings'
        ]);

        $this->colorpicker(
          [
            'title' => esc_html__( 'Main Color', 'restrofoodlite' ),
            'name'  => 'main-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Order Button Background Color', 'restrofoodlite' ),
            'name'  => 'btn-bg-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Order Button Color', 'restrofoodlite' ),
            'name'  => 'btn-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Order Button Hover Background Color', 'restrofoodlite' ),
            'name'  => 'btn-hover-bg-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Order Button Hover Color', 'restrofoodlite' ),
            'name'  => 'btn-hover-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Global Button Background Color', 'restrofoodlite' ),
            'name'  => 'gob-btn-bg-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Global Button Color', 'restrofoodlite' ),
            'name'  => 'gob-btn-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Global Button Hover Background Color', 'restrofoodlite' ),
            'name'  => 'gob-btn-hover-bg-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Global Button Hover Color', 'restrofoodlite' ),
            'name'  => 'gob-btn-hover-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Cart Button background', 'restrofoodlite' ),
            'name'  => 'cart-btn-bg',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Cart Button Count background', 'restrofoodlite' ),
            'name'  => 'cart-btn-count-bg',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Cart Button Count Text Color', 'restrofoodlite' ),
            'name'  => 'cart-btn-count-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Category Item Odd Background', 'restrofoodlite' ),
            'name'  => 'category-item-odd-bg',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'Category Item Text Color', 'restrofoodlite' ),
            'name'  => 'category-item-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'My Account Tab Background', 'restrofoodlite' ),
            'name'  => 'mat-bg',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'My Account Tab Text Color', 'restrofoodlite' ),
            'name'  => 'mat-text-color',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'My Account Tab Hover Background', 'restrofoodlite' ),
            'name'  => 'mat-hover-bg',
          ]
        );
        $this->colorpicker(
          [
            'title' => esc_html__( 'My Account Tab Hover Text Color', 'restrofoodlite' ),
            'name'  => 'mat-hover-text-color',
          ]
        );
        
        $this->end_fields_section(); // End fields section
   }
}

new Color_Settings_Tab();