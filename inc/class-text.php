<?php 
namespace RestroFoodLite\Inc;
/**
 *
 * @package     Restrofood
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

class Text {

  public static function getText() {
    return self::definedText();
  }

  public static function definedText() {

    $getText = [
      'view_cart'           => esc_html__( 'View Cart', 'restrofoodlite' ),
      'buy_more'            => esc_html__( 'Buy More', 'restrofoodlite' ),
      'cart_added_error'    => esc_html__( 'Product don\'t added in the cart. please try again.', 'restrofoodlite' ),
      'review_success_msg'  => esc_html__( 'Review has been submitted successfully.', 'restrofoodlite' ),
      'review_error_msg'    => esc_html__( 'Review submission Failed. Please try again.', 'restrofoodlite' ),
      'show_more'           => esc_html__( 'Show More', 'restrofoodlite' ),
      'show_less'           => esc_html__( 'Less', 'restrofoodlite' ),
      'loading'             => esc_html__( 'Loading', 'restrofoodlite' ),
      'new_order_placed'    => esc_html__( 'New Order Placed', 'restrofoodlite' ),
      'start_order'         => esc_html__( 'Start Order', 'restrofoodlite' ),
      'delivery_available_success' => esc_html__( 'Delivery is available', 'restrofoodlite' ),
      'delivery_available_error'   => esc_html__( 'Sorry, We are not available to delivery in your area', 'restrofoodlite' ),
      'dp_date_text'       => esc_html__( 'Deliver/Pickup Date', 'restrofoodlite' ),
      'dp_time_text'       => esc_html__( 'Deliver/Pickup Time', 'restrofoodlite' ),
      'dp_today_text'      => esc_html__( 'Today Delivery/Pickup', 'restrofoodlite' ),
      'dp_schedule_text'   => esc_html__( 'Schedule Delivery/Pickup', 'restrofoodlite' ),
      'boy_assigned_success'   => esc_html__( 'Delivery boy assigned success', 'restrofoodlite' ),
      'boy_assigned_failed'   => esc_html__( 'Delivery boy assigned failed', 'restrofoodlite' ),
      'Order_transfer_success'   => esc_html__( 'Order transfer success', 'restrofoodlite' ),
      'Order_transfer_failed'    => esc_html__( 'Order transfer failed', 'restrofoodlite' ),
      'list_type'   => esc_html__( 'List Type', 'restrofoodlite' ),
      'checkbox'    => esc_html__( 'Checkbox', 'restrofoodlite' ),
      'radio'       => esc_html__( 'Radio', 'restrofoodlite' ),
      'feature_section_title'     => esc_html__( 'Feature Section Title', 'restrofoodlite' ),
      'min_required_number'       => esc_html__( 'Feature minimum required number', 'restrofoodlite' ),
      'max_required_number'       => esc_html__( 'Feature max required number', 'restrofoodlite' ),
      'frature_title'             => esc_html__( 'Frature Title', 'restrofoodlite' ),
      'price'                     => esc_html__( 'Price', 'restrofoodlite' ),
      'add_group'                 => esc_html__( 'Add Group', 'restrofoodlite' ),
      'remove_group'              => esc_html__( 'Remove Group', 'restrofoodlite' ),
      'add'                       => esc_html__( 'Add', 'restrofoodlite' ),
      'add_features'              => esc_html__( 'Add Features', 'restrofoodlite' ),
      'remove'                    => esc_html__( 'Remove', 'restrofoodlite' ),
      'slot_full_text'            => esc_html__( 'This time slot is full. Try another time slot', 'restrofoodlite' ),
      'valid_slot_not_available'  => esc_html__( 'Your selected time slot is not available for order.', 'restrofoodlite' ),
      'valid_break_time'          => esc_html__( 'This is break time. Not available for order.', 'restrofoodlite' ),
      'valid_delivery_time_field' => esc_html__( 'Deliver/Pickup Time is a required field.', 'restrofoodlite' ),
      'valid_delivery_type_field' => esc_html__( 'Deliver/Pickup type is a required field.', 'restrofoodlite' ),
      'valid_branch_field'        => esc_html__( 'Deliver/Pickup Branch Name is a required field.', 'restrofoodlite' ),
      'set_flash_sale'           => esc_html__( 'Set Meta', 'restrofoodlite' ),
      'nutrition_title'           => esc_html__( 'Nutrition Title', 'restrofoodlite' ),
      'quantity'                  => esc_html__( 'Quantity', 'restrofoodlite' ),
      'branch_select_msg'         => esc_html__( 'Please select the branch', 'restrofoodlite' ),
      'table_number_label'        => esc_html__( 'Select Table Number', 'restrofoodlite' ),
      'addcart_ranch_select_alert_msg' => esc_html__( 'Please Select the branch before add to cart', 'restrofoodlite' ),
      'closing_time_msg'   => restrofoodlite_getOptionData( 'closing-time-msg', esc_html__( 'This is closing time. So you can\'t order.', 'restrofoodlite' ) ),
      'cat_nav_text' => restrofoodlite_getOptionData( 'category-nav-text', esc_html__( 'Offers & Category', 'restrofoodlite' ) ),
      'cat_heading_text' => restrofoodlite_getOptionData( 'categories-heading-text', esc_html__( 'Categories', 'restrofoodlite' ) ),
      'spec_offer_heading_text' => restrofoodlite_getOptionData( 'special-offer-heading-text', esc_html__( 'Special Offer', 'restrofoodlite' ) ),
      'visibility_heading_text' => restrofoodlite_getOptionData( 'food-visibility-heading-text', esc_html__( 'Food Visibility', 'restrofoodlite' ) ),
      'product_top_title_text' => restrofoodlite_getOptionData( 'product-top-title-text', esc_html__( 'Our All Delicious Foods', 'restrofoodlite' ) )
    ];

    return apply_filters( 'restrofoodlite_define_text', $getText );

  }


}


