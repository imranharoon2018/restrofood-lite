<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$options = get_option('restrofoodlite_options');
?>

 <div class="rb_steps_content step-completed">

      <!-- Thank You Content -->
      <div class="rb_order_final">
        <div class="rb_thankyou_content">
          <?php
          //
          if( !empty( $options['received-page-title'] ) ) {
            echo '<h2>'.esc_html( $options['received-page-title'] ).'</h2>';
          }
          //
          if( !empty( $options['received-description'] ) ) {
            echo '<p>'.esc_html( $options['received-description'] ).'</p>';
          }
          ?>
          
        </div>
      </div>
      <!-- End Thank You Content -->

      <!-- Order Details -->
      <div class="rb_row">
        <div class="rb_col_lg_8">
          <div class="rb_card">
            <div class="rb_card_title">
              <h3><?php esc_html_e( 'Order Details', 'restrofoodlite' ); ?></h3>
            </div>
            <!-- Order Info -->
            <div class="rb_order_info">
              <?php if ( $order->has_status( 'failed' ) ) : ?>

					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'restrofoodlite' ); ?></p>

					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
						<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'restrofoodlite' ); ?></a>
						<?php if ( is_user_logged_in() ) : ?>
							<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'restrofoodlite' ); ?></a>
						<?php endif; ?>
					</p>

				<?php else : ?>

					<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'restrofoodlite' ), $order ); ?></p>
        
          <div class="rb_order_btn_group">
            <?php 
              $myaccountLink = get_permalink( get_option('woocommerce_myaccount_page_id') ); 
              $ordersLink     = $myaccountLink.'/orders';
              $viewOrderLink  = $myaccountLink.'/view-order/'.$order->get_id();
            ?>
            <a class="rb_btn_fill" href="<?php echo esc_url( $ordersLink ); ?>"><?php esc_html_e( 'View Orders', 'restrofoodlite' ); ?></a>
            <a class="rb_btn_fill" href="<?php echo esc_url( $viewOrderLink ); ?>"><?php esc_html_e( 'Order Tracking', 'restrofoodlite' ); ?></a>
          </div>

					<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details rb_list_unstyled">

						<li class="woocommerce-order-overview__order order">
							<?php esc_html_e( 'Order number:', 'restrofoodlite' ); ?>
							<strong><?php echo esc_html( $order->get_order_number() ); ?></strong>
						</li>

						<li class="woocommerce-order-overview__date date">
							<?php esc_html_e( 'Date:', 'restrofoodlite' ); ?>
							<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
						</li>

						<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
							<li class="woocommerce-order-overview__email email">
								<?php esc_html_e( 'Email:', 'restrofoodlite' ); ?>
								<strong><?php echo sanitize_email( $order->get_billing_email() ); ?></strong>
							</li>
						<?php endif; ?>

						<li class="woocommerce-order-overview__total total">
							<?php esc_html_e( 'Total:', 'restrofoodlite' ); ?>
							<strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong>
						</li>

						<?php if ( $order->get_payment_method_title() ) : ?>
							<li class="woocommerce-order-overview__payment-method method">
								<?php esc_html_e( 'Payment method:', 'restrofoodlite' ); ?>
								<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
							</li>
						<?php endif; ?>

					</ul>

				<?php endif; ?>
            </div>
            <!-- End Order Info -->

            <!-- Delivery Address -->
            <div class="rb_input_group style_two">
            	<?php $show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address(); ?>

              <span class="rb_input_label"><?php esc_html_e( 'Contact Info', 'restrofoodlite' ) ?></span>
              <div class="rb_delivery_address rb_input_style">

					<section class="woocommerce-customer-details">

						<?php if ( $show_shipping ) : ?>

						<section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
							<div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-1">

						<?php endif; ?>

						<h2 class="woocommerce-column__title"><?php esc_html_e( 'Billing address', 'restrofoodlite' ); ?></h2>

						<address>
							<?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'restrofoodlite' ) ) ); ?>

							<?php if ( $order->get_billing_phone() ) : ?>
								<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
							<?php endif; ?>

							<?php if ( $order->get_billing_email() ) : ?>
								<p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
							<?php endif; ?>
						</address>

						<?php if ( $show_shipping ) : ?>

							</div><!-- /.col-1 -->

							<div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2">
								<h2 class="woocommerce-column__title"><?php esc_html_e( 'Shipping address', 'restrofoodlite' ); ?></h2>
								<address>
									<?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'restrofoodlite' ) ) ); ?>
								</address>
							</div><!-- /.col-2 -->

						</section><!-- /.col2-set -->

						<?php endif; ?>

						<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

					</section>

              </div>
            </div>
            <!-- End Delivery Address -->

            <!-- Payment Method -->
            <div class="rb_method_item">
              <div class="rb_input_group style_two">
                <span class="rb_input_style">
                  <span class="rb_custom_checkbox">
                    <?php echo wp_kses_post( $order->get_payment_method_title() ); ?>
                    <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
                  </span>
                </span>
                <label
                  for="rb_delivery_time"
                  class="rb_input_label"
                  ><?php esc_html_e( 'Payment Method', 'restrofoodlite' ); ?></label
                >
              </div>
            </div>
            <!-- End Payment Method -->
          </div>
        </div>

        <div class="rb_col_lg_4">
          <!-- Card -->
          <div class="rb_card rb_mt_50 rb_mt_lg_0">
            <?php 
            if( !empty( $options['active-invitation'] ) ):
            ?>
            <!-- Title -->
            <div class="rb_card_title">
              <h3><?php esc_html_e( 'Invite your friend', 'restrofoodlite' ); ?></h3>
            </div>
            <p>
              <?php esc_html_e( 'Additional information you\'d like we delivery
              services. Thank you!', 'restrofoodlite' ); ?>
            </p>
            <!-- End Title -->

            <!-- Invitation Form -->
            <div class="rb_invitation_form">
              <form action="" id="invitemail" method="post">
                <input
                  type="text"
                  class="rb_input_style"
                  name="invite_mail"
                  required
                  placeholder="<?php esc_html_e( 'Your email Address','restrofoodlite' ); ?>"
                />
                <button type="submit" class="rb_btn_fill rb_w_100">
                  <?php esc_html_e( 'Invite frends', 'restrofoodlite' ); ?>
                </button>
              </form>
            </div>
            <!-- Invitation Form -->
            <?php 
            endif;
            ?>
            <!-- Share Button Group -->
            <?php 
            if( !empty( $options['facebook-share-link'] ) || !empty( $options['twitter-share-link'] )  ):
            ?>
            <div class="rb_share_btn_group">
              <span class="rb_share_btn_title">
                <span><?php esc_html_e( 'OR', 'restrofoodlite' ); ?></span>
              </span>
              <?php 
              if( !empty( $options['twitter-share-link'] ) ):
              ?>
              <a href="<?php echo esc_url( $options['twitter-share-link'] ); ?>" class="rb_btn_fill rb_w_100">
                <img src="<?php echo esc_url( RESTROFOODLITE_DIR_URL.'assets/img/icon/twitter.svg' ); ?>" class="rb_svg" alt="<?php esc_attr_e( 'Share on twitter', 'restrofoodlite' ); ?>" />
                <?php esc_html_e( 'Share on twitter', 'restrofoodlite' ); ?></a>
              <?php
              endif;
              // 
              if( !empty( $options['facebook-share-link'] ) ):
              ?>
              <a href="<?php echo esc_url( $options['facebook-share-link'] ); ?>" class="rb_btn_fill rb_w_100">
                <img src="<?php echo esc_url( RESTROFOODLITE_DIR_URL.'assets/img/icon/facebook.svg' ); ?>" class="rb_svg" alt="<?php esc_attr_e( 'Share on facebook', 'restrofoodlite' ); ?>"/>
                <?php esc_html_e( 'Share on facebook', 'restrofoodlite' ); ?></a>
              <?php 
              endif;
              ?>
            </div>
            <?php 
            endif;
            ?>
            <!-- End Share Button Group -->
          </div>
          <!-- End Card -->
        </div>
      </div>
      <!-- End Order Details -->
   
  </div>


<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
	?>

		

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'restrofoodlite' ), null ); ?></p>

	<?php endif; ?>

</div>
