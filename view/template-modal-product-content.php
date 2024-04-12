<script type="text/html" id="tmpl-rb_product_content">
<!-- Step Content -->
<ul class="rb_steps_list">
</ul>
<div class="rb_steps_content step-product-info">
  <form action="#" id="fbs_single_add_to_cart_button" method="post" class="rb_product_details_form">
    <div class="rb_row">
      <div class="rb_col_12">
        <div class="modal-content-left-content">
          <div class="rb_row">
            <div class="rb_col_md_6">
              <div class="modal-product-image">
                <!-- Product Details Image -->
                <# if( ! _.isEmpty(data.galleryimgs) ){ #>
                <!-- Place somewhere in the <body> of your page -->
                <div id="slider" class="flexslider rb_product_details_img">
                  <ul class="slides">
                    <li><img src={{data.thumbnail}} /></li>
                    <# _.each( data.galleryimgs, function( item, key ) { #>
                      <li><img src={{item}} alt={{key}} /></li>
                    <#} ) #>
                    <!-- items mirrored twice, total of 12 -->
                  </ul>
                </div>
                <div id="carousel" class="flexslider gallery-nav">
                  <ul class="slides">
                    <li><img src={{data.thumbnail}} /></li>
                    <# _.each( data.galleryimgs, function( item, key ) { #>
                      <li><img src={{item}} alt={{key}} /></li>
                    <#} ) #>
                    <!-- items mirrored twice, total of 12 -->
                  </ul>
                </div>
                <# } else{ #> 
                <div class="rb_product_details_img">
                  <img src={{data.thumbnail}} alt="" />
                </div>
                <#} #>
              <!-- End Product Details Image -->
              </div>
            </div>

            <div class="rb_col_md_6">
                <h3 class="rb_product_title">{{data.title}}</h3>
                <# if( data.nutrition ){ #>
                <div class="product-nutrition">
                  <ul>
                  <# _.each( data.nutrition, function( item, key ) { #>
                      <li><span>{{item.title}}</span><span class="nutrition-qty">{{item.quantity}}</span></li>
                  <#} ) #>
                  </ul>
                </div>
                <#}

                if( data.short_description ){
                #>
                <p class="product-short-description">{{data.short_description}}</p>
                <#}#>
                <h6 class="pricing-wrap">
                <?php esc_html_e( 'Price:', 'restrofoodlite' ); ?>
                <p class="rb_product_price"> {{{data.price_html}}} </p>
                </h6>
                <# if( restrofoodobj.is_enable_reviews == 'yes' ) { #>
                <div class="fb-product-reviews">
                  <div class="rb_star_rating">{{{data.star_rating}}}</div>
                  <span class="woocommerce-review-link fb-product-review">(<span class="count">{{data.reviewcount}}</span> <?php esc_html_e( 'customer reviews', 'restrofoodlite'); ?>)</span>
                </div> 
                <#}#>
            </div>

          </div>
        </div>
      </div>

      <div class="rb_col_12">
        <div class="rb_mt_50 rb_mt_lg_0">
          <!-- Tabs area -->
          <div class="moal-product-info-tabs-wrap">
            <div class="tab-items">
              <ul>
                <# if( data.attributes.length != 0  ){ #>
                <li class="fb-single-tab tab-active-status-checker" data-tab-item="variations"><?php esc_html_e( 'Variations', 'restrofoodlite' ); ?></li>
                <#
                }
                if( data.description ) {
                #>
                <li class="fb-single-tab tab-active-status-checker" data-tab-item="descriptions"><?php esc_html_e( 'Descriptions', 'restrofoodlite' ); ?></li>
                <#}#>
              </ul>
            </div>
            <div>
            <# if( data.attributes.length != 0 ){ #>
            <div class="variations-tab-content variations">
              <!-- Extra Options -->
              <div class="rb_extra_options">
                <# if( data.attributes.length != 0 ) { #>
                <h4><?php esc_html_e( 'Variations', 'restrofoodlite' ); ?></h4>
                <# } #>
                  
                <ul class="rb_list_unstyled rb_attribute_list" data-attribute-count={{data.attributes_count}}>
                <# _.each( data.attributes, function( items, key ) {  #>
                  <div class="attribute-items-wrap fb-wrap-selector">
                  <li data-product-attribute={{items.attribute}}>
                    <h5 class="rb_label_title fb-product-extra-group-title"><span>{{key}} <span>*</span></span> <span class="icon-set"><i class="fas fa-angle-down"></i><i class="fas fa-angle-up"></i></span></h5>
                  </li>
                  <div class="product-variation-wrap rb_extra_group_wrap fb-d-none">
                  <# _.each( items.options, function( item ) { #>
                  <li>

                    <# var t = items.name; #>
                    <span class="rb_custom_checkbox">
                      <label>
                        <input
                          type="radio"
                          value="{{item.name}}"
                          name="{{items.attribute}}"
                          data-attr-slug="{{item.slug}}"
                          data-name-attr="{{items.attribute}}"
                          data-name="{{item.name}}"
                          class="fb-product-attribute"
                          
                        />
                        <span class="rb_input_text">{{{item.name}}}</span>
                        <span class="rb_custom_checkmark"></span>
                      </label>
                    </span>
                    <span class="fb-variable-price"></span>
                  </li>
                  <# } )#>
                  </div> 
                  </div> 
                  <# } ) #>
                  
                </ul>
              </div>

            </div>
            <# } 
            if( data.description ) {
            #>
            <!-- Product Details Content -->
            <div class="variations-tab-content descriptions">
              <div class="rb_product_details_content">
                <div class="rb_product_summary">{{{data.description}}}</div>
              </div>
            </div>
            <#}#>
            </div>
          </div>

          <!-- Quantity -->
          <div class="product-details-qty rb_d_flex rb_align_items_center rb_justify_content_between">
            <span class="rb_label_title"><?php esc_html_e( 'Quantity', 'restrofoodlite' ); ?></span>
            <div class="rb_quantity rb_d_flex rb_align_items_center">
              <div class="rb_input_group">
                  <input type="text" class="rb_input_text" name="rb_quantity" value="1">
                  <span class="rb_minus rb_minus_2"><img src="<?php echo RESTROFOODLITE_DIR_URL.'assets/img/icon/minus1.svg'; ?>" alt=""></span>
                  <span class="rb_plus rb_plus_2"><img src="<?php echo RESTROFOODLITE_DIR_URL.'assets/img/icon/plus1.svg'; ?>" alt=""></span>
              </div>
            </div>
          </div>
          <!-- End Quantity -->

          <!-- Input List -->
          <div class="rb_form_input_list">
            <h5 class="input_list_title">
              <?php esc_html_e( 'Special Instructions?', 'restrofoodlite' ); ?>
            </h5>
            <textarea
              class="rb_input_style"
              placeholder="<?php esc_attr_e( 'Add instructions...', 'restrofoodlite' ); ?>"
              name="item_instructions"
            ></textarea>
          </div>
          <!-- End Input List -->

          <!-- Total Price -->
          <div class="rb_label_title rb_total_price rb_d_flex rb_align_items_center rb_justify_content_between">
            <span><?php esc_html_e( 'Total Price', 'restrofoodlite' ); ?></span>
            <span class="rb_total_Price" data-item-price={{data.price}}><?php echo restrofoodlite_currency_symbol_position( "{{data.display_price}}" , false ); ?></span>
          </div>
          <!-- End Tolal Price -->
          <input type="hidden" name="product_id" value={{data.id}} />
          <input type="hidden" name="variation_id" class="variation_id" value="" />
          <input type="hidden" name="product_sku" value={{data.sku}} />
          <!-- Add To Cart -->
          <?php
          $options = get_option('restrofoodlite_options');
          if( !empty( $options['show-cart-button'] ) && $options['show-cart-button'] == 'yes'  ):
          ?>
          <button type="submit" class="rb_btn_fill rb_w_100 rb_add_to_cart_ajax ajax_add_to_cart" ><?php esc_html_e( 'Add to cart', 'restrofoodlite' ); ?></button>
          <?php
          endif;
          ?>

          <div class="fb-after-cart-button" style="display:none"></div>
          <!-- End Add To Cart -->
        </div>
        <!-- End Card -->
      </div>

    </div>
  </form>
</div>
<!-- End Step Content -->

</script>