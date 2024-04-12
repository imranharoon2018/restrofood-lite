<?php
/**
 * Enqueue scripts
 * @return 
 * 
 */

add_action( 'wp_enqueue_scripts', 'restrofoodlite_enqueue_scripts' );
function restrofoodlite_enqueue_scripts() {

    $getText = \RestroFoodLite\Inc\Text::getText();
    $options = get_option('restrofoodlite_options');
    $getDateFormat = get_option('date_format');


    $availabilityCheckerModal = 'no';
    $autoreload           = !empty( $options['page-autoreload'] ) ? $options['page-autoreload'] : '6';
    $availabilityCheckerActive = 'no';
    $checkoutDeliveryOption = !empty( $options['checkout-delivery-option'] ) ? $options['checkout-delivery-option'] : 'no';
    $checkoutDeliveryTimeSwitch = !empty( $options['pickup-time-switch'] ) ? $options['pickup-time-switch'] : 'no';
    $deliveryOptions      = 'all';
    $audioLoop            = !empty( $options['audio-loop'] ) ? $options['audio-loop'] : 'no';
    $preOrderActive       = '';
    $modalCloseBtn        = !empty( $options['modal-close-btn-show'] ) ? $options['modal-close-btn-show'] : '';
    $notificationAudio    = !empty( $options['notification-audio'] ) ? $options['notification-audio'] : RESTROFOODLITE_DIR_URL.'assets/the-little-dwarf-498.mp3';
    $cartModalStyle       = !empty( $options['cart-modal-style'] ) ? $options['cart-modal-style'] : 'canvas';
    

    //  Style enqueue
    wp_enqueue_style( 'fb-font-awesome', RESTROFOODLITE_DIR_URL.'assets/css/font-awesome.min.css', array(), '4.7.0', 'all' );
    wp_enqueue_style( 'datatables', RESTROFOODLITE_DIR_URL.'assets/css/datatables.css', array(), '1.10.18', 'all' );
    wp_enqueue_style( 'fbMyAccount', RESTROFOODLITE_DIR_URL.'assets/css/fbMyAccount.min.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'flexslider', RESTROFOODLITE_DIR_URL.'assets/css/flexslider.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'restrofoodlite', RESTROFOODLITE_DIR_URL.'assets/css/app.css', array(), '1.0.0', 'all' );
    
    wp_enqueue_script( 'datatables', RESTROFOODLITE_DIR_URL.'assets/js/datatables.js', array('jquery' ), '1.10.18', true );
    
    wp_enqueue_script( 'print', RESTROFOODLITE_DIR_URL.'assets/js/jQuery.print.js', array('jquery' ), '1.6.0', true );

    wp_enqueue_script( 'flexslider', RESTROFOODLITE_DIR_URL.'assets/js/jquery.flexslider-min.js', array('jquery' ), '1.10.18', true );
    wp_enqueue_script( 'restrofoodlite', RESTROFOODLITE_DIR_URL.'assets/js/restrofoodlite.js', array( 'jquery','wp-util','wc-checkout', 'underscore', 'jquery-ui-datepicker','jquery-effects-core' ), '1.0.0', true );

    wp_localize_script(
        'restrofoodlite', 
        'restrofoodobj',
        array(
            
            "ajaxurl"               => admin_url('admin-ajax.php'),
            'currency'              => get_woocommerce_currency_symbol(), 
            'currency_pos'          => get_option( 'woocommerce_currency_pos' ), 
            'datepicker_format'     => restrofoodlite_datepicker_format( esc_html( $getDateFormat ) ),
            'page_auto_reload_time' => $autoreload, 
            'is_login'              => is_user_logged_in(),
            'woo_guest_user_allow'  => get_option('woocommerce_enable_guest_checkout'),
            'is_enable_reviews'     => get_option('woocommerce_enable_reviews'),
            'is_rating_verification_required'  => get_option('woocommerce_review_rating_verification_required'),
            'cart_url'              => wc_get_checkout_url(),
            'get_text'              => $getText,
            'view_cart_btn_text'    => esc_html( $getText['view_cart'] ), 
            'buy_more_btn_text'     => esc_html( $getText['buy_more'] ),
            'dont_cart_msg'         => esc_html( $getText['cart_added_error'] ),
            'is_checkout'           => is_checkout(),
            'is_multi_branch'       => restrofoodlite_is_multi_branch(),
            'characters'            => !empty( $options['desc-characters'] ) ? $options['desc-characters'] : '100',
            'wc_decimal_separator'      => wc_get_price_decimal_separator(),
            'wc_thousand_separator'     => wc_get_price_thousand_separator(),
            'price_decimals'            => wc_get_price_decimals(),
            'noti_audio_loop'           => $audioLoop,
            'is_location_type_address'  => restrofoodlite_is_location_type_address(),
            'is_active_location'        => restrofoodlite_getOptionData('popup-location-active'),
            'notification_audio'        => $notificationAudio,
            'is_availability_checker_active' => $availabilityCheckerActive,
            'is_checkout_delivery_option'    => $checkoutDeliveryOption,
            'is_pre_order_active'            => $preOrderActive,
            'is_active_modal_close_btn'      => $modalCloseBtn,
            'delivery_options'               => $deliveryOptions,
            'is_multideliveryfees'           => get_option( 'restrofoodlite_multideliveryfees_option' ),
            'is_active_inrestaurant'         => restrofoodlite_is_active_inrestaurant(),
            'is_checkout_delivery_time_switch' => $checkoutDeliveryTimeSwitch,
            'cartModalStyle'                   => $cartModalStyle

        ) 
    );


    /**
     * Inline css for custom style
     *  
     */
    
    $mainColor = !empty( $options['main-color'] ) ? esc_html( $options['main-color'] ) : '';

    // Order Button
    $btnBgColor = !empty( $options['btn-bg-color'] ) ? esc_html( $options['btn-bg-color'] ) : '';
    $btnColor = !empty( $options['btn-color'] ) ? esc_html( $options['btn-color'] ) : '';
    $btnHoverBgColor = !empty( $options['btn-hover-bg-color'] ) ? esc_html( $options['btn-hover-bg-color'] ) : '';
    $btnHoverColor = !empty( $options['btn-hover-color'] ) ? esc_html( $options['btn-hover-color'] ) : '';

    // Global Button
    $gobBtnBgColor        = !empty( $options['gob-btn-bg-color'] ) ? esc_html( $options['gob-btn-bg-color'] ) : '';
    $gobBtnColor          = !empty( $options['gob-btn-color'] ) ? esc_html( $options['gob-btn-color'] ) : '';
    $gobBtnHoverBgColor   = !empty( $options['gob-btn-hover-bg-color'] ) ? esc_html( $options['gob-btn-hover-bg-color'] ) : '';
    $gobBtnHoverColor     = !empty( $options['gob-btn-hover-color'] ) ? esc_html( $options['gob-btn-hover-color'] ) : '';

    $cartBtnBg         = !empty( $options['cart-btn-bg'] ) ? esc_html( $options['cart-btn-bg'] ) : '';
    $cartBtnCountBg    = !empty( $options['cart-btn-count-bg'] ) ? esc_html( $options['cart-btn-count-bg'] ) : '';
    $cartBtnCountColor = !empty( $options['cart-btn-count-color'] ) ? esc_html( $options['cart-btn-count-color'] ) : '';

    $categoryItemOddBg    = !empty( $options['category-item-odd-bg'] ) ? esc_html( $options['category-item-odd-bg'] ) : '';
    $categoryItemColor = !empty( $options['category-item-color'] ) ? esc_html( $options['category-item-color'] ) : '';

    $matBg              = !empty( $options['mat-bg'] ) ? esc_html( $options['mat-bg'] ) : '';
    $matTextColor       = !empty( $options['mat-text-color'] ) ? esc_html( $options['mat-text-color'] ) : '';
    $matHoverBg         = !empty( $options['mat-hover-bg'] ) ? esc_html( $options['mat-hover-bg'] ) : '';
    $matHoverTextColor  = !empty( $options['mat-hover-text-color'] ) ? esc_html( $options['mat-hover-text-color'] ) : '';

    $custom_css = "
            .rb_category_list .rb_category_item .rb_category_quantity:before,
            .rb_custom_checkbox label .rb_custom_checkmark:after,
            .rb_pagination_list .rb_pagination_list_item.active, 
            .rb_pagination_list .rb_pagination_list_item:hover,
            .rb_single_product_item .rb_product_top .rb_badge {
                background-color: {$mainColor};
            }
            .rb_category_list .rb_category_item .rb_category_quantity,
            .rb_pagination_list .rb_pagination_list_item,
            .rb_custom_checkbox label input:checked~.rb_input_text, 
            .rb_custom_checkbox label input:checked~.rb_label_title .rb_input_text {
                color: {$mainColor};
            }
            .rb_custom_checkbox label input:checked~.rb_custom_checkmark,
            .rb_pagination_list .rb_pagination_list_item {
                border-color: {$mainColor};
            }
            .rb_order_button {
                background-color: {$btnBgColor};
                color: {$btnColor};
            }
            .rb_order_button:hover {
                background-color: {$btnHoverBgColor};
                color: {$btnHoverColor};
            }
            .rb_btn_fill:not(.toggle) {
                background-color: {$gobBtnBgColor};
                color: {$gobBtnColor};
            }
            .rb_btn_fill:not(.toggle):active, 
            .rb_btn_fill:not(.toggle):focus, 
            .rb_btn_fill:not(.toggle):hover {
                background-color: {$gobBtnHoverBgColor};
                color: {$gobBtnHoverColor};
            }
            .rb_cart_count_btn {
                background-color: {$cartBtnBg}
            }
            .rb_cart_count {
                background-color: {$cartBtnCountBg};
                color: {$cartBtnCountColor}
            }
            .rb_category_list .rb_category_item:nth-of-type(odd) {
                background-color: {$categoryItemOddBg}
            }
            .rb_category_list .rb_category_item {
                color: {$categoryItemColor}
            }
            .restrofoodlite-checkout .woocommerce-MyAccount-navigation {
                background-color: {$matBg};
            }
            .restrofoodlite-checkout .woocommerce-MyAccount-navigation ul li a {
                color: {$matTextColor}
            }
            .restrofoodlite-checkout .woocommerce-MyAccount-navigation ul li.is-active > a, 
            .restrofoodlite-checkout .woocommerce-MyAccount-navigation ul li:hover > a {
                background-color: {$matHoverBg};
                color: {$matHoverTextColor}
            }
            ";




    //
    wp_enqueue_style(
        'custom-style',
        RESTROFOODLITE_DIR_URL.'assets/css/custom.css'
    );
    wp_add_inline_style( 'custom-style', $custom_css );


}