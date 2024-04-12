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

class Shortcodelist_Settings_Tab extends Settings_Fields_Base {

  public function get_option_name() {
    return 'restrofoodlite_options'; // set option name it will be same or different name
  }

   public function tab_setting_fields() {

        $this->start_fields_section([
            'title'   => esc_html__( 'Shortcode List', 'restrofoodlite' ),
            'icon'    => 'fa fa-code',
            'id'      => 'shortcodelist'
        ]);
        ?>
        <h3><?php esc_html_e( 'Shortcode List', 'restrofoodlite' ); ?></h3>
              <div class="shortcode-item-list">
                <h4><?php esc_html_e( 'Product Page Shortcode:', 'restrofoodlite' ); ?></h4>

                <code>[restrofoodlite_products]</code>
                <code>[restrofoodlite_products col="4" cat="accessories" layout="grid" search="yes" padding_top="120px" padding_bottom="120px"]</code>
                <h5><?php esc_html_e( 'Attrubute List', 'restrofoodlite' ); ?></h5>
                <ul>
                  <li><pre><?php esc_html_e( 'cat - cat="category name"', 'restrofoodlite' ); ?> </pre></li>
                  <li><pre><?php esc_html_e( 'col - col="column" available value like ( 2, 3, 4 )', 'restrofoodlite' ); ?> </pre></li>
                  <li><pre><?php esc_html_e( 'layout - layout="layout" available value like grid or list', 'restrofoodlite' ); ?> </pre></li>
                  <li><pre><?php esc_html_e( 'style - style="1" available value like 1,2,3', 'restrofoodlite' ); ?> </pre></li>
                  <li><pre><?php esc_html_e( 'mini cart type - mini_cart_type="canvas" available value like canvas, footer-fixed, beside-products', 'restrofoodlite' ); ?> </pre></li>
                  <li><pre><?php esc_html_e( 'search - search="yes" available value like yes or no', 'restrofoodlite' ); ?> </pre></li>
                  <li><pre><?php esc_html_e( 'Wrapper Padding Top - padding_top="120px" ', 'restrofoodlite' ); ?> </pre></li>
                  <li><pre><?php esc_html_e( 'Wrapper Padding Bottom - padding_bottom="120px" ', 'restrofoodlite' ); ?> </pre></li>
                </ul>
              </div>
              <div class="shortcode-item-list">
                <h4><?php esc_html_e( 'Delivery ability checker form:', 'restrofoodlite' ); ?><span class="pro-label">Pro</span></h4>
                <code>[restrofoodlite_delivery_ability_checker]</code>
                <code>[restrofoodlite_delivery_ability_checker button_text="search"]</code>
                <h5><?php esc_html_e( 'Attrubute List', 'restrofoodlite' ); ?></h5>
                <ul>
                  <li><pre><?php esc_html_e( 'button_text - button_text="search"', 'restrofoodlite' ); ?> </pre></li>
                </ul>
              </div>

              <div class="restrofoodlite-shortcode-generator-wrapper">
                  <h2><?php esc_html_e( 'Shortcode Generator', 'restrofoodlite' ); ?></h2>
                  <div class="restrofoodlite-shortcode-generator-inner">
                      <select id="shortcodeType">
                          <option value=""><?php esc_html_e( 'Shortcode For ?', 'restrofoodlite' ); ?></option>
                          <option value="restrofoodlite_products"><?php esc_html_e( 'Products', 'restrofoodlite' ); ?></option>
                          <option value=""><?php esc_html_e( 'Delivery ability checker form ( Pro )', 'restrofoodlite' ); ?></option>
                      </select>
                      <select id="layout" class="single-field shortcode-attr-single-field produt-attr-field">
                          <option value=""><?php esc_html_e( 'Select layout type', 'restrofoodlite' ); ?></option>
                          <option value="grid"><?php esc_html_e( 'Grid', 'restrofoodlite' ); ?></option>
                          <option value=""><?php esc_html_e( 'List ( Pro )', 'restrofoodlite' ); ?></option>
                      </select>
                      <select id="column" class="single-field shortcode-attr-single-field produt-attr-field">
                          <option value=""><?php esc_html_e( 'Select Column', 'restrofoodlite' ); ?></option>
                          <option value="1"><?php esc_html_e( '1 Column', 'restrofoodlite' ); ?></option>
                          <option value="2"><?php esc_html_e( '2 Column', 'restrofoodlite' ); ?></option>
                          <option value="3"><?php esc_html_e( '3 Column', 'restrofoodlite' ); ?></option>
                          <option value="4"><?php esc_html_e( '4 Column', 'restrofoodlite' ); ?></option>
                      </select>
                      <select id="style" class="single-field shortcode-attr-single-field produt-attr-field">
                          <option value=""><?php esc_html_e( 'Select Style', 'restrofoodlite' ); ?></option>
                          <option value="1"><?php esc_html_e( 'Style 1', 'restrofoodlite' ); ?></option>
                          <option value=""><?php esc_html_e( 'Style 2 ( Pro )', 'restrofoodlite' ); ?></option>
                          <option value=""><?php esc_html_e( 'Style 3 ( Pro )', 'restrofoodlite' ); ?></option>
                      </select>
                      <select id="mini_cart_type" class="single-field shortcode-attr-single-field produt-attr-field">
                          <option value=""><?php esc_html_e( 'Mini Cart Type', 'restrofoodlite' ); ?></option>
                          <option value="canvas"><?php esc_html_e( 'Canvas Modal', 'restrofoodlite' ); ?></option>
                          <option value=""><?php esc_html_e( 'Footer Fixed ( Pro )', 'restrofoodlite' ); ?></option>
                          <option value=""><?php esc_html_e( 'Beside Products ( Pro )', 'restrofoodlite' ); ?></option>
                      </select>
                      <input type="number" id="limit" class="single-field shortcode-attr-single-field produt-attr-field" placeholder="<?php esc_html_e( 'Limit', 'restrofoodlite' ); ?>" />
                      <select id="search" class="single-field shortcode-attr-single-field produt-attr-field">
                          <option value=""><?php esc_html_e( 'Product quick search bar?', 'restrofoodlite' ); ?></option>
                          <option value="yes"><?php esc_html_e( 'Yes', 'restrofoodlite' ); ?></option>
                          <option value="no"><?php esc_html_e( 'No', 'restrofoodlite' ); ?></option>
                      </select>
                      <select id="categories" class="single-field shortcode-attr-single-field produt-attr-field" multiple>
                          <option value=""><?php esc_html_e( 'Select Categoty', 'restrofoodlite' ); ?></option>
                          <?php 
                          $getTerms = restrofoodlite_get_terms('product_cat');
                          if( !empty( $getTerms ) ) {
                            foreach ( $getTerms as $key => $value) {

                              echo '<option value="'.esc_html( $value->slug ).'">'.esc_html( $value->name ).'</option>';
                            }
                          }
                          ?>
                      </select>
                      <?php
                      do_action('restrofoodlite_shortcode_branch_list');
                      ?>
                      <input type="number" id="padding_top" class="single-field shortcode-attr-single-field produt-attr-field" placeholder="<?php esc_html_e( 'Padding Top', 'restrofoodlite' ); ?>" />

                      <input type="number" id="padding_bottom" class="single-field shortcode-attr-single-field produt-attr-field" placeholder="<?php esc_html_e( 'Padding Bottom', 'restrofoodlite' ); ?>" />

                      <input type="text" id="search_text" class="single-field shortcode-attr-single-field ability-checker-attr-field" placeholder="<?php esc_html_e( 'Search....', 'restrofoodlite' ); ?>" />

                      <div class="button-area">
                        <span id="scodegenerate" class="button button-primary"><?php esc_html_e( 'Generate', 'restrofoodlite' ); ?></span>
                        <span id="scode-copy" class="button button-primary"><?php esc_html_e( 'Copy', 'restrofoodlite' ); ?></span>
                      </div>

                  </div>
                  <div class="scode-show"></div>
              </div>
              
        <?php
        $this->end_fields_section(); // End fields section
   }
}

new Shortcodelist_Settings_Tab();