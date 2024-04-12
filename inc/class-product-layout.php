<?php 
namespace RestroFoodLite;
/**
 *
 * @package     Restrofood
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

class Product_Layout {

  public $productArgs;

  /**
   * [setProductArgs description]
   * @param [type] $args [description]
   */
  public function setProductArgs( $args ) {
    $this->productArgs = $args;
    return $this;
  }

  /**
   * [product_layout_grid description]
   * @return [type] [description]
   */
  public function product_layout_grid() {
    $getData = $this->productArgs;

    if( !empty( $getData['query_type'] ) && $getData['query_type'] == 'search' ) {
      $product = $getData['product'];
      $imgUrl = get_the_post_thumbnail_url( $product->get_id(), 'full' );
    } else {
      $product = $getData['product'];
      $imgUrl  = $getData['imgurl'];
    }

    $column  = $getData['column'];

    ?>
    <div class="<?php echo esc_attr( 'rb_col_xl_'.$column.' grid_style_'.$getData['style'].' rb_col_lg_4 rb_col_sm_6' ); ?>">
        <!-- Single Product -->
        <div class="rb_single_product_item">
          <!-- Product Thumb -->
          <div class="rb_product_top">
            <!-- Product Thumb -->
            <div class="rb_product_thumb rb_product_details_img">
              <img src="<?php echo esc_url( $imgUrl ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" />
            </div>
            <!-- End Product Thumb -->
            <!-- OnSale -->
            <?php 
            if( !empty( $product->get_regular_price() ) && !empty( $product->get_sale_price() )  ) {
              echo '<span class="rb_badge">'.esc_html__( 'On sale', 'restrofoodlite' ).'</span>';
            }
            ?>
            <!-- End OnSale -->
          </div>
          <!-- End Product Thumb -->
          <!-- Product Content -->
          <div class="rb_product_content">
            <!-- Title -->
            <h4 class="rb_product_title rb_order_cart_button" data-pid="<?php echo esc_attr( $product->get_id() ); ?>" data-toggle="fbPopupModal" data-target="rb_popup_modal"><?php echo esc_html( $product->get_name() ); ?></h4>
            <!-- End Title -->
            <!-- Price -->
            <h6 class="rb_product_price">
              <?php
              echo wp_kses_post( $product->get_price_html() );
              ?>
            </h6>
            <!-- End Price -->
            <!-- Star Rating -->
            <div class="rb_star_rating">
              <?php
              $avRating = $product->get_average_rating();
              $totalRating = $product->get_rating_count();
              echo '<div class="rb-star-icon-wrap">';
                restrofoodlite_rating_reviews( esc_html( $avRating ) );
              echo '</div>';
              //
              if( $avRating > 0 && $totalRating > 0 ) {
                echo '<div class="rb-star-rating-word">';
                if( $avRating > 0 ) {
                  echo '<span>'.esc_html( $avRating ).'</span>';
                }
                //
                if( $totalRating > 0 ) {
                  echo '<span>('.esc_html( $totalRating ).' '.esc_html__( 'Ratings', 'restrofoodlite' ).')</span>';
                }
                echo '</div>';
              }
              ?>                    
            </div>
            <!-- End Star Rating -->
            <div class="item-cart-area item-cart-qty">
              <?php
              $this->buttonSet($getData);
              ?>
            </div>

          </div>
          <!-- End Product Content -->
        </div>
        <!-- Single Product -->
    </div>

    <?php

  }
  
  public function buttonSet( $getData, $gridType = '', $isQty = true, $is_icon = false ) {

    $product = $getData['product'];
    $options = $getData['options'];
    if( empty( $options['show-cart-button'] ) && $options['show-cart-button'] != 'yes'  ) {
      return;
    }

    $productID = $product->get_id();
    //
    if( $product->is_type( 'variable' ) ) {
      $is_featured_required = true;
      $AddOpacity = 'gb-opacity-0';
    } else {
      $is_featured_required = false;
      $AddOpacity = '';
    }
    //

    if( $isQty != false ):
    ?>
    <div class="rb_quantity">
      <div class="rb_input_group <?php echo esc_attr( $AddOpacity ); ?>">
          <input type="text" class="rb_input_text rb_qty" name="rb_quantity" min="1" value="1">
          <span class="rb_minus rb_minus_2"><img src="<?php echo RESTROFOODLITE_DIR_URL.'assets/img/icon/minus1.svg'; ?>" alt=""></span>
          <span class="rb_plus  rb_plus_2"><img src="<?php echo RESTROFOODLITE_DIR_URL.'assets/img/icon/plus1.svg'; ?>" alt=""></span>
      </div>
    </div>
    <?php
    endif;
    //
    if( $is_icon != true  ) {
      $cartText = esc_html__( 'Add to cart', 'restrofoodlite' );
      $optionCartText = esc_html__( 'Select Options', 'restrofoodlite' );
    } else {
      $cartText = '<i class="fas fa-shopping-cart"></i>';
      $optionCartText = '<i class="fa fa-plus"></i>';
    }

    $allowHtml = [ 'i' => [ 'class' => [] ] ];

    //
    if( $is_featured_required != true ) {
      echo '<a href="?add-to-cart='.esc_attr( $productID ).'" class="rb_btn_fill ajax_add_to_cart add_to_cart_button rb_order_button" data-quantity="1"  data-product_id="'.esc_attr( $productID ).'" data-product_sku="woo-beanie" aria-label="'.esc_attr( $product->get_name() ).'" >'.wp_kses( $cartText, $allowHtml ).'</a>';
    } else {
      echo '<a href="#" class="rb_btn_fill rb_order_button rb_order_cart_button" data-pid="'.esc_attr( $product->get_id() ).'" data-toggle="fbPopupModal" data-target="rb_popup_modal">'.wp_kses( $optionCartText, $allowHtml ).'</a>';
    }
    

  }



}
