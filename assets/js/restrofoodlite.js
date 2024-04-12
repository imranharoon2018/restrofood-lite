/*---------------------------------------------
Template name :  RestroFoodLite
Version       :  1.0.0
Author        :  ThemeLooks
Author url    :  http://themelooks.com

NOTE:
------
Please DO NOT EDIT THIS JS, you may need to use "custom.js" file for writing your custom js.
We may release future updates so it will overwrite this file. it's better and safer to use "custom.js".

[Table of Content]

    01: SVG Image
    02: Top 50
----------------------------------------------*/

(function ($) {
    "use strict";

    let i, m, a, cartModal, admin,tips,LocationFinder = {};
    
    i = {

        catSlug: "",
        taxonomy: "",
        options: {
            is_poup: false
        },
        currentPage: "",
        init: function () {

            let $this = this;
            if( $('.restrofoodlite-products').length ) {
                $this.getProducts();
            }
            
            $this.allGetItems();
            $this.getProductByPaginate();
            $this.getProductByCategories();
            $this.getProductByTaxonomy();
            $this.productSearch();
            $this.getProductOrderbyFilter();
            //
            $this.conditionalTimeSelectBox();
            $this.conditionalTimeSelectBoxOnDeliveryDate();


        },
        getProducts: function() {

            let $this   = this,
                $scope  = $('[data-options]').closest('.restrofoodlite-products'),
                $getOptData = $scope.data('options'),
                $getSelectedBranch = $('.fb-select-branch').val(),
                $getCat = $this.options.catSlug ? $this.options.catSlug : $getOptData.cat,
                $branchID = $this.options.branchID ? $this.options.branchID : $getSelectedBranch;
                // check is branch id come from popup
                if( $this.options.is_poup ) {
                   $branchID = $this.options.branchID ? $this.options.branchID : '';
                }
                // Is set branch id from shortcode
                if( $getOptData.branchid ) {
                    $branchID = $getOptData.branchid;
                }

            $.ajax({
                type: "POST",
                url: restrofoodobj.ajaxurl,
                data: {
                    action: "woo_products_view",
                    catSlug: $getCat,
                    taxonomy: $this.options.taxonomy,
                    filter_key: $this.options.filter_key,
                    limit: $getOptData.limit,
                    col: $getOptData.col,
                    style: $getOptData.style,
                    layout: $getOptData.layout,
                    branch_id: $branchID,
                    page: $this.options.page

                },
                beforeSend: function () {
                    $('.restrofoodlite-products').html( a.lodingMarkup() );
                },
                success: function (res) {

                    $('.restrofoodlite-products').append(res);
                    // 
                    a.lodingRemove();
                    a.productListReadMore();
                },
                complete: function() {

                    let t = $('[data-page-number="'+$this.options.page+'"]'),
                        n =t.next();

                    if( n.is(':visible') == false ) {
                        n.addClass('pagi-show');
                    }else {
                        t.next('.pagi-item-dot').hide();
                    }
                    $('.active').prevAll().removeClass('pagi-hide');
                    $('.pagi-last-item.active').prev().hide();
                    a.flyingCart();
                }

            });

        },
        getProductByPaginate: function () {

            let $this = this;

            $(document).on('click', '[data-page-number]', function (e) {

                e.preventDefault();

                let $v = $(this).data('page-number');
                $(this).addClass('active');

                $this.options = {
                    catSlug: $this.catSlug,
                    taxonomy: $this.taxonomy,
                    page: $v

                }

                $this.getProducts();

            });

        },
        getProductByCategories: function () {

            let $this = this;

            $('[name="rb_product_category"]').on('change', function () {

                let $thisEvn = $(this),
                    $v = $thisEvn.val(),
                    $topSelector = $thisEvn.closest('.rb_category_dropdown_inner'),
                    $nearSelector = $thisEvn.closest('li');

                    $topSelector.find('.active').removeClass('active');
                    $nearSelector.addClass('active');

                    $topSelector.find('input:checked').prop('checked', false);
                    $nearSelector.find('input').prop('checked', true);

                //
                $this.catSlug = $v;
                $this.taxonomy = "category";

                $this.options = {
                    catSlug: $v,
                    taxonomy: $this.taxonomy,
                    page: 1
                }

                $this.getProducts();
            })

        },
        getProductByTaxonomy: function () {

            let $this = this;

            $('[name="rb_product_specialoffer"]').on('change', function () {

                let $thisEvn = $(this),
                    $v = $thisEvn.val(),
                    $topSelector = $thisEvn.closest('.rb_category_dropdown_inner'),
                    $nearSelector = $thisEvn.closest('li');

                    $topSelector.find('.active').removeClass('active');
                    $nearSelector.addClass('active');

                    $topSelector.find('input:checked').prop('checked', false);
                    $nearSelector.find('input').prop('checked', true);
                //
                $this.catSlug = $v;
                $this.taxonomy = "specialoffer";

                $this.options = {
                    catSlug: $v,
                    taxonomy: $this.taxonomy,
                    page: 1

                }

                $this.getProducts();
            })

        },
        getProductOrderbyFilter:function(){

            let $this = this;

            $('[name="orderby"]').on('change', function () {

                let $v = $(this).val();

                $this.catSlug = "";
                $this.taxonomy = "";

                $this.options = {
                    catSlug: $this.catSlug,
                    taxonomy: $this.taxonomy,
                    filter_key: $v,
                    page: 1
                }

                $this.getProducts();

            })

        },
        allGetItems: function () {

            let $this = this;

            $(document).on('click', '.all_items', function () {

                $this.catSlug = "";
                $this.taxonomy = "";

                $this.options = {
                    catSlug: $this.catSlug,
                    taxonomy: $this.taxonomy,
                    page: 1

                }

                $this.getProducts();

                $('.rb_custom_checkbox input').removeAttr('checked');

            })

        },
        productSearch: function () {

            let $this = this,
                $layout = $('[data-layout]').data('layout'),
                $col    = $('[data-col]').data('col');

            $(document).on('keyup', '#rb_search', function (e) {

                e.preventDefault();

                let branchId = localStorage.getItem('rb_selected_branch');

                $.ajax({
                    type: 'POST',
                    url: restrofoodobj.ajaxurl,
                    data: {
                        action: 'woo_search_product',
                        keyword: $(this).val(),
                        col: $col,
                        layout: $layout,                
                        branch: branchId                  
                    },
                    beforeSend: function () {
                        $('.restrofoodlite-products').html(a.lodingMarkup());
                    },
                    success: function (res) {
                        
                        if (res.length) {
                            $('.restrofoodlite-products').html(res);

                        } else {
                            $this.getProducts()
                        }

                        a.lodingRemove();
                        a.productListReadMore();

                    }

                })


            });

        },
        conditionalTimeSelectBox: function() {

            let that = this,
                getDate = '',
                branchId = localStorage.getItem('rb_selected_branch');

            // get delivery time Slot list on window load
            $.ajax({

                type: 'POST',
                url: restrofoodobj.ajaxurl,
                data: {
                    action: 'order_time_lists_action',
                    date: getDate,
                    branchid: branchId
                },
                success: function (res) {
                    $('#rb_delivery_time').html(res);
                }

            })
        },
        conditionalTimeSelectBoxOnDeliveryDate: function() {
            let that = this;
            // get delivery time Slot list On click delivery date 
            $( '#rb_delivery_date' ).on( 'change', function(e) {
                
                e.preventDefault();

                let getDate = $(this).val(),
                    branchId = localStorage.getItem('rb_selected_branch');

                if( getDate != '' && $('[name="rb_delivery_schedule_options"]').is(':checked') ) {
                    $('.fb-delivery-time-wrapper').fadeIn();
                }              

                // Ajax Call
                $.ajax({

                    type: 'POST',
                    url: restrofoodobj.ajaxurl,
                    data: {
                        action: 'order_time_lists_action',
                        date: getDate,
                        branchid: branchId
                    },
                    success: function (res) {
                       
                        $('#rb_delivery_time').html(res);
                    }

                })

            } )
        },
        checkoutPageTimeSlotTimeCheck: function( holyDay ) {

            if( restrofoodobj.is_checkout_delivery_option != 'yes' || restrofoodobj.is_checkout_delivery_time_switch != 'yes' ) {
                return;
            }

            let timeOption     = $('[name="rb_delivery_time"] option'),
                $checkModal    = $(document).find('.fb-show-availability-check-modal'),
                $availabilityStatus    = $(document).find('.d_availability_status'),
                $AbilityStatus = localStorage.getItem('fbAbilityStatus'),
                $infoMagAppend = $('.fb-delivery-time-wrapper'),
                $infoMag       = $('.fb-info-msg');

            // Time length check
            if(  timeOption.length > 0 && !holyDay ) {

                $checkModal.fadeIn('slow');
                $availabilityStatus.fadeIn('slow');
                $infoMag.remove();

            } else {

                let $msg;
                $infoMag.remove();
                $checkModal.fadeOut('slow');
                $availabilityStatus.fadeOut('slow');
                if( $('#rb_pickup_branch').val() != '' ) {
                    $msg = restrofoodobj.get_text.closing_time_msg;
                } else {
                    $msg = restrofoodobj.get_text.branch_select_msg;
                }

                $infoMagAppend.append('<div class="fb-info-msg"><p>'+$msg+'</p></div>');
                
            }


        },
        deliveryTimeSlotStatusEvent: function() {

            // Onload event
            let $that = this;

            // Onchange event
            $('[name="rb_delivery_time"]').on( 'change', function() {
                $that.deliveryTimeSlotStatus( $(this).val() );
            } )

        },
        deliveryTimeSlotStatus: function( $val ) {

            let $index   = $val.indexOf("no"),
                $availabilityChecker = $('.fb-checkout-availability-checker-wrapper');

            if( $index != -1 ) {
                $availabilityChecker.hide();
            } else {
                $availabilityChecker.show();
            }

        }
    }

    //
    m = {

        cartBackBtn: false,
        openModal: false,
        isCartModal: false,
        productId: "",
        isVerifiedOwner: "",

        init: function () {

            let $this = this;

            $this.fbClosePopup();
            $this.modalOpen();
            $this.addToCart();
            $this.reviewBack();
            
            //
            if( restrofoodobj.is_enable_reviews == 'yes' ) {
                $this.productReview();
            }

            $this.responsiveSidebarShow();
            //
            a.quantityPlusMinusEvent();
        },
        
        modalOpen: function () {

            let $this = this;

            $(document).on('click', '.rb_order_cart_button', function (e) {

                e.preventDefault();

                $this.openModal = true;

                let $productId = $(this).data('pid');

                $this.productId = $productId;

                $this.getProductInfo();

                // Modal
                $this.modalTemplate();
                //
                $this.fbOpenPopUp();

            })

        },
        modalTemplate: function () {

            // Modal wrapper
            let modalTemp = wp.template('rb_modal_wrapper');
            let modal     = modalTemp();

            $('body').append(modal);
        },
        cartTemplate: function () {

            let $this = this;

            $(document).on('click', '.remove_cart_item', function (e) {

                e.preventDefault();

                let current_qty = parseInt($(this).attr('data-quantity'));
                let id = $(this).attr('data-product_id');

                let cat_item_key = $(this).attr('data-cart_item_key');

                $.ajax({

                    type: 'POST',
                    url: restrofoodobj.ajaxurl,
                    data: {
                        action: 'woo_cart_item_remove',
                        cart_item_key: cat_item_key
                    },
                    success: function (res) {
                        $('.step-cart').remove();
                        $this.getCartItems();
                        $this.cartCount();
                    }

                })

            });

        },
        fbMultiform: function () {

            let multiForm = $('.rb_multiform');
            if (multiForm.length) {
                let multiSelector = multiForm.find('.rb_form_selector_list .rb_single_form_selector input[type=radio]'),
                    forms = multiForm.find('.rb_single_form');

                multiSelector.on('click', function () {
                    let form = $(this).data('form');
                    forms.each(function () {
                        if ($(this).hasClass(form)) {
                            $(this).fadeIn().addClass('show')
                        } else {
                            $(this).hide().removeClass('show')
                        }
                    })
                })
            }

        },
        fbOpenPopUp: function () {

            let $target = $("#rb_popup_modal");

            if (!$target.length) {
                return false;
            }

            $target.fadeIn();
            $target.addClass('open');

            $(document.body).addClass('fbPopupModal-opened ');


        },
        fbClosePopup: function () {

            let $this = this;

            function removePopup() {
                
                let $target = $("#rb_popup_modal")

                $target.fadeTo(1000, 0.01, function () {
                    $(this).slideUp( 150, function () {
                        $(this).remove();
                        
                        // Reset the value
                        $this.productId = "";
                        $this.isVerifiedOwner = "";
                        $this.openModal = false;
                        $this.isCartModal = false;

                    });
                });

                $(document.body).removeClass('fbPopupModal-opened');
            }

            $(document).on('click', '.rb_close_modal_btn', function (e) {
                e.preventDefault()
                removePopup()
            });

            $(document).on('click', '#rb_popup_modal', function (e) {
                let isShow = e.target === e.currentTarget;

                if (isShow) {
                    removePopup()
                }
            });

            $(document).on('keydown', function (e) {
                if (e.key === 'Escape') {
                    removePopup()
                }
            });


        },
        getProductInfo: function () {

            let $this = this;

            $.ajax({

                type: "post",
                url: restrofoodobj.ajaxurl,
                data: {
                    action: "woo_product_byid",
                    product_id: $this.productId
                },
                success: function ( res ) {
                    
                    let data = JSON.parse(res);

                    $this.isVerifiedOwner = data.verified_owner;

                    // Modal product info content
                    let temp = wp.template('rb_product_content');
                    let t = temp(data);

                    $('.rb_steps_wrapper').append(t);

                    // Remove Thousands Separator
                    a.removeThousandsSeparator('item-price');
                    //
                    $this.variationProduct();
                    // 
                    a.addExtraFeatures();
                    //
                    a.lodingRemove();

                    // Flying cart init
                    if( data.type != 'grouped' && data.type != 'external' ) {
                        a.flyingCart();
                    }

                  // product gallery slider init
                  $('#carousel').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    itemWidth: 60,
                    itemMargin: 5,
                    asNavFor: '#slider'
                  });
                 
                  $('#slider').flexslider({
                    animation: "slide",
                    controlNav: false,
                    directionNav: false,
                    animationLoop: false,
                    slideshow: false,
                    sync: "#carousel"
                  });

                  $('.tab-active-status-checker:first-child').addClass('active');
                  $('.variations-tab-content:first-child').addClass('active');
                  
                  $('.fb-single-tab').on( 'click', function() {

                    let $this = $(this),
                        tc = $this.data('tab-item');
                    $('.active').removeClass('active');

                    $this.addClass('active');
                    $('.'+tc).addClass('active');

                  } )


                                      
                }

            })

        },
        productReview: function () {

            let $this = this;

            $(document).on('click', '.fb-product-review', function () {

                $this.getReviewAjax();

                // Hide product content modal
                $('.step-product-info').hide();

            })

        },
        reviewBack: function () {

            $(document).on('click', '.review-back', function () {

                // remove reviews modal
                $('.step-reviews').remove();
                // Show product content modal
                $('.step-product-info').fadeIn();

            })

        },
        getReviewAjax: function () {

            let $this = this,
                $productId = $this.productId;
            // 
            $.ajax({

                type: "post",
                url: restrofoodobj.ajaxurl,
                data: {
                    action: "woo_product_reviews_byid",
                    product_id: $productId
                },
                beforeSend: function () {
                    // Preloader 
                    $('.rb_steps_wrapper').append(a.lodingMarkup());
                },
                success: function (res) {

                    // reset previous reviews modal
                    $('.step-reviews').remove();

                    // load review modal content pass reviews data and product id
                    let temp = wp.template('rb_modal_reviews');
                    let t = temp({ data: res, id: $productId, isVerifiedOwner: $this.isVerifiedOwner });
                    $('.rb_steps_wrapper').append(t);

                    // Preloader remove
                    a.lodingRemove();

                    // init reviews submit event func
                    $this.submitReview();

                }

            })

            return false;

        },
        submitReview: function () {

            let $thisObj = this;

            /// Rating active and assign value
            $('[data-rating]').on('click', function (e) {

                e.preventDefault();

                let $this = $(this);
                $this.addClass('active');
                $this.parent().parent().addClass('selected');
                $('[name="rating"]').val($this.data('rating'));
            })

            // Review comments form submit 
            $('#commentform').on('submit', function (e) {

                e.preventDefault();

                let $url = $(this).attr("action"),
                    formdata = $(this).serialize();

                $.ajax({

                    type: 'post',
                    url: $url,
                    data: formdata,
                    error: function (XMLHttpRequest, textStatus, errorThrown) {

                        let $selector = $('.fb-review-submit-message');

                        if ( textStatus == 'error' ) {
                            $selector.html('<p class="fb-alert fb-alert-warning">' + restrofoodobj.get_text.review_failed_alert + '</p>');
                        }

                    },
                    success: function (data, textStatus) {

                        let $selector = $('.fb-review-submit-message');
                        if (textStatus == 'success') {
                            $selector.html('<p class="fb-alert fb-alert-success">' + restrofoodobj.get_text.review_success_alert + '</p>');
                            $thisObj.getReviewAjax();
                        } else {
                            $selector.html('<p class="fb-alert fb-alert-warning">' + restrofoodobj.get_text.review_failed_alert + '</p>');
                        }

                    }

                });

                return false;

            })
        },
        variationProduct: function () {

            // on Change
            $(document).on('change', '.fb-product-attribute', function () {
                let $t = $(this),
                    $checkedAttr = $t.closest('.rb_list_unstyled').find("input:checked"),
                    $attrName = [];

                //
                $.each( $checkedAttr, function( i, item ) {
                    $attrName.push( [$(item).data('name-attr'), $(item).data('attr-slug')]  );

                })

                a.cartButtonDisabledOnRequiredOptions();

                $.ajax({
                    type: 'post',
                    url: restrofoodobj.ajaxurl,
                    data: {
                        action: 'woo_get_variation_data',
                        attribute: $attrName,
                        pid: $('[name="product_id"]').val()
                    },
                    success: function(res) {

                        if ( !res ) {return;}

                        $('[name="variation_id"]').val(res.data.variation_id);
                        $('.rb_total_Price').attr('data-item-price', res.data.display_price).text( a.currency_symbol_position( res.data.display_price ) );
                        $('.fb-variable-price').html('');
                        $t.parent().parent().parent().find('.fb-variable-price').html(res.data.price_html);
                        $('.product-extra-options:checked').click();
                    }
                })

            })

        },
        addToCart: function () {

            let $thisObj = this;

            $(document).on('submit', '#fbs_single_add_to_cart_button', function (e) {
                e.preventDefault();

                // if multi branch Check branch seclection
                if( restrofoodobj.is_multi_branch ) {

                    let branchId = localStorage.getItem('rb_selected_branch');
                    if( !branchId ) {
                        alert(restrofoodobj.get_text.addcart_ranch_select_alert_msg);
                        return false;
                    }

                }

                let getGroup = $('[data-extra-group]').data('extra-group');

                // 
                let getAttributes = {};

                $('[data-product-attribute]').each(function () {

                    let t = $(this).data('product-attribute'),
                        v = $('[name="' + t + '"]:checked').val();

                    getAttributes[t] = v

                });

                // 
                let extraoptions = $(this).find('.product-extra-options:checked');

                let options = [],
                    formattedOptions = [];

                extraoptions.each(function() {

                    let $this = $(this);
                    options.push($this.val());
                    formattedOptions.push($this.data('formatted-price'));
                })
                //
                let getRequiredStatus = $(this).find('[name="items_required_status[]"]'),
                    requiredStatus = [];

                getRequiredStatus.each( function() {
                    requiredStatus.push( $(this).val() );
                } )

                //
                let $this = $(this),
                    product_qty     = $this.find('input[name=rb_quantity]').val() || 1,
                    product_id      = $this.find('input[name=product_id]').val() || '',
                    variation_id    = $this.find('input[name=variation_id]').val() || 0,
                    product_sku     = $this.find('input[name=product_sku]').val() || '',
                    extra_options   = options,
                    instructions    = $this.find('[name=item_instructions]').val() || '';

                //
                let data = {
                    action: 'woo_rb_ajax_add_to_cart',
                    product_id: product_id,
                    product_sku: product_sku,
                    quantity: product_qty,
                    variation_id: variation_id,
                    instructions: instructions,
                    extra_options: extra_options,
                    required_status: requiredStatus,
                    extra_formatted_options: formattedOptions,
                    attributes: getAttributes
                };

                $.ajax({
                    type: 'post',
                    url: restrofoodobj.ajaxurl,
                    data: data,
                    success: function ( response ) {

                        if ( response.data.status == true ) {
                            // cart modal open status
                            $thisObj.isCartModal = true;

                            // Update mini cart
                            $(document.body).trigger('wc_fragment_refresh');
                            $('.rb_close_modal_btn').trigger('click');

                        } else {

                            let data = {
                                text: response.data.status_msg,
                                alert: "alert-warning"
                            }

                            a.alert(data);

                        }

                    },
                });

                //return false;
            });

        },
        getCartItems: function () {

            let $this = this;

            $.ajax({

                type: "post",
                url: restrofoodobj.ajaxurl,
                data: {
                    action: "woo_cart_items",
                },
                beforeSend: function () {
                    $('.rb_steps_wrapper').append( a.lodingMarkup() );
                },
                success: function (res) {

                    // Modal product info content
                    let temp = wp.template('rb_cart_items'),
                        t = temp(res.data);

                    $this.isCartModal = true;

                    $('.rb_steps_wrapper').append(t)
                    
                    a.lodingRemove();

                    // value assign false
                    $this.cartBackBtn = false;

                }

            })

        },
        cartCount: function () {
            $.ajax({

                type: "post",
                url: restrofoodobj.ajaxurl,
                data: {
                    action: "woo_get_cart_count"
                },
                success: function (res) {
                    $('.rb_cart_count').text(res);

                }

            })
        },
        
        responsiveSidebarShow: function() {
            $('.fb-show-sidebar').on( 'click', function(e) {
                e.preventDefault();
                $('.rb_sidebar').toggle('slow');
            } );
        }


    }

    a = {

        init: function () {

            let $this = this;
            //SVG Image
            $this.SVGImage();
            // 
            $this.checkoutCoupon();
            //
            $this.invoicePrint();
            //
            $this.checkoutPageScheduleType();
            $this.extraFeaturesCollapse();
                        
        },
        SVGImage: function () {

            $(window).on('load', function () {

                $('img.rb_svg').each(function () {
                    let $img = $(this);
                    let imgID = $img.attr('id');
                    let imgClass = $img.attr('class');
                    let imgURL = $img.attr('src');

                    $.get(imgURL, function (data) {
                        // Get the SVG tag, ignore the rest
                        let $svg = $(data).find('svg');

                        // Add replaced image's ID to the new SVG
                        if (typeof imgID !== 'undefined') {
                            $svg = $svg.attr('id', imgID);
                        }
                        // Add replaced image's classes to the new SVG
                        if (typeof imgClass !== 'undefined') {
                            $svg = $svg.attr('class', imgClass + ' replaced-svg');
                        }

                        // Remove any invalid XML tags as per http://validator.w3.org
                        $svg = $svg.removeAttr('xmlns:a');

                        // Check if the viewport is set, else we gonna set it if we can.
                        if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                            $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
                        }

                        // Replace image with new SVG
                        $img.replaceWith($svg);

                    }, 'xml');
                });

            });


        },
        checkoutCoupon: function () {
            let coupon2 = $(".checkout_coupon");
            coupon2.insertBefore('.fb-checkout-order-place-area');
        },
        alert: function (data) {

            let temp = wp.template('rb_modal_alert');
            let t = temp(data);
            $('body').append(t)

            setTimeout(function () {
                $('.fb-alert-wrapper').fadeOut('300', function () {
                    $('.fb-alert-wrapper').remove();
                });

            }, 1000);

        },
        lodingMarkup: function () {

            let html = '';
            html += '<div class="fb-loading">';
            html += '<div class="circle"></div>';
            html += '<div class="circle"></div>';
            html += '<div class="circle"></div>';
            html += '<div class="shadow"></div>';
            html += '<div class="shadow"></div>';
            html += '<div class="shadow"></div>';
            html += '<span>'+restrofoodobj.get_text.loading+'</span>';
            html += '</div>';

            return html;

        },
        lodingRemove: function () {

            $('.fb-loading').fadeOut('slow', function () {
                $(this).remove()
            });
        },
        quantityPlusMinusEvent: function () {

            /* Increase */
            $(document).on('click', '.rb_plus', function (e) {

                e.preventDefault();

                let $qty = $(this).parent().find('[name="rb_quantity"]');

                let currentVal = parseInt( $qty.val() );

                if (!isNaN(currentVal)) {
                    let q = currentVal + 1;

                    $qty.val(q);

                    let t = $(this).closest('.item-cart-qty').find('[data-quantity]');

                    t.attr( 'data-quantity', q );

                    miniCartQtyUpdate($(this));

                }

            });

            /* Decrease */
            $(document).on('click', '.rb_minus', function (e) {

                e.preventDefault();

                let $qty = $(this).parent().find('[name="rb_quantity"]');
                let currentVal = parseInt($qty.val());
                if (!isNaN(currentVal) && currentVal > 1) {
                    let q = currentVal - 1;
                    $qty.val(q);

                    let m = $(this).closest('.item-cart-qty').find('[data-quantity]');

                    m.attr( 'data-quantity', q );

                    miniCartQtyUpdate($(this));

                }
            });

        },
        
        extraFeaturesCollapse: function() {
            $(document).on('click','.fb-product-extra-group-title', function() {
                let $this = $(this); 
                $this.closest('.fb-wrap-selector').find('.rb_extra_group_wrap').slideToggle();
                $this.toggleClass('active');
                
            })
        },
        addExtraFeatures: function () {

            let $thisObj = this,
                EP = 0;
            // Add to Cart button disabled enable on selecte required option
            $thisObj.cartButtonDisabledOnRequiredOptions();

            // extra options change event 
            $(document).on( 'change', '.product-extra-options', function (e) {

                let ob = [],
                    $that = $(this);

                // Required extra item check
                $('[data-extra-group]').each(  function() {

                    let $t = $(this),
                        y = $t.data('extra-group'),
                        r = $t.data('extra-required-count'),
                        m = $t.data('extra-max-count'),
                        c = $t.find('.product-extra-options');

                    let count = 0;
                   
                    c.each( function() {
                       if( $(this).is(":checked") ) {
                            count++;
                        }
                    } )

                    ob.push( {group:y ,count:count, required:r, max: m} );

                } )
                //
                $.each( ob, function( index, item  ) {

                    let $groupSelector = $('[data-extra-group="'+item.group+'"]'),
                        $groupSelectorInner = $groupSelector.closest('.rb_form_extra_input_list'),
                        $groupSelectorRequiredMsg = $groupSelectorInner.find('.required-msg'),
                        $groupSelectorSelectedCount = $groupSelectorInner.find('.selectedcount');

                    // min select item logic
                    if( item.count >= item.required ) {
                        $groupSelectorRequiredMsg.slideUp();
                        $groupSelectorSelectedCount.val('true');

                    } else {
                        $groupSelectorRequiredMsg.slideDown();
                        $groupSelectorSelectedCount.val('false');
                    }

                    // Max select item logic
                    if( item.max && item.count >= item.max ) {
                        $groupSelector.find('.product-extra-options').not('.product-extra-options:checked')
                        .not('[type="radio"]')
                        .attr( 'disabled', true )
                        .parent('label').fadeTo( "slow", 0.5);

                    } else {
                        $groupSelector.find('.product-extra-options').attr( 'disabled', false )
                        .parent('label').fadeTo( "slow", 1);
                    }


                } )

                // Add to Cart button disabled enable on selecte required option
                $thisObj.cartButtonDisabledOnRequiredOptions();

                // Price Calculate

                let el = document.querySelector('[data-item-price]').getAttribute('data-item-price'),
                    ex = 0;

                $('.product-extra-options').each( function() {

                    if( $(this).is(":checked") ) {

                        let p = $(this).data('price');
                        ex += parseFloat( p );
                    }

                } )

                let y = parseFloat( ex ) + parseFloat(el);

                $('.rb_total_Price').html( a.currency_symbol_position( a.addThousandsSeparator( y.toFixed( restrofoodobj.price_decimals ) ) ) )

            })

        },
        cartButtonDisabledOnRequiredOptions: function() {
            let cartBtn = $('.rb_add_to_cart_ajax'),
                    $getCountStatus = $('.selectedcount').map(function() {
                        return [$( this ).val()];
                    })
                    .get();

            // Product variation attribute
            let a = $('[data-attribute-count]'),
                $count = a.data('attribute-count');
            //
            let grs = $.inArray( 'false', $getCountStatus );
            //
                if( grs != '-1' || ( $count > 0 && $count != a.find("input:checked").length ) ) {
                    cartBtn.attr( 'disabled', true ).fadeTo("slow",0.3);
                } else {
                    cartBtn.attr( 'disabled', false ).fadeTo("fast",1);
                }
        },
        flyingCart: function () {

            $(document).on('click', '.ajax_add_to_cart', function () {

                let cart = $(".rb_cart_icon");
                let imgtodrag = $(this).closest('.rb_single_product_item, .rb_food_item, .rb_product_details_form').find(".rb_product_details_img img").eq(0);
                if (imgtodrag) {
                    let imgclone = imgtodrag.clone()
                        .offset({
                            top: imgtodrag.offset().top,
                            left: imgtodrag.offset().left
                        })
                        .css({
                            'opacity': '0.5',
                            'position': 'absolute',
                            'height': '100px',
                            'width': '100px',
                            'z-index': '100000000'
                        })
                        .appendTo($('body'))
                        .animate({
                            'top': cart.offset().top - 25,
                            'left': cart.offset().left + 10,
                            'width': 40,
                            'height': 40
                        }, 1000, 'easeInOutExpo');

                    setTimeout(function () {
                        cart.addClass('fb-shake-animation');
                        //
                        setTimeout(function () {
                            cart.removeClass('fb-shake-animation')
                        }, 1000)

                    }, 1500);

                    imgclone.animate({
                        'width': 0,
                        'height': 0
                    }, function () {
                        $(this).detach()

                    });
                }
            });
        },
        invoicePrint: function() {

            // Print event    
            let $print     = $(document).find('.fb-inv-print'),
                $printBack = $(document).find('.fb-inv-back');

            $print.on( 'click', function() {

                let t = $(this).closest( '.rb_modal_content' ),
                    i = $(t).find(".content-inner-hide"),
                    e = $(t).find(".fb-invoice-template");

                i.hide();
                e.show();
                $( this ).closest('.print-btn-area').find('.fb-inv-back').show()
                e.print({addGlobalStyles: true});

            } )

            // Print Preview          
            $printBack.on( 'click', function() {

                let t = $(this).closest( '.rb_modal_content' ),
                    i = $(t).find(".content-inner-hide"),
                    e = $(t).find(".fb-invoice-template");
                    
                    i.show('slow')
                    e.hide('slow')
                    $(this).hide('slow')

            } )

        },
        currency_symbol_position: function( price = '' ) {

            let currency_pos = restrofoodobj.currency_pos,
                $currency    = restrofoodobj.currency,
                $price;


            switch(currency_pos) {
              case 'right':
                $price = price+$currency;
                break;
              case 'left_space':
                $price = $currency+' '+price;
                break;
              case 'right_space':
                $price = price+' '+$currency;
                break;
              default:
                $price = $currency+price;
                break;
                // code block
            }

            return $price;

        },
        pageAutoRefresh: function() {

            if( restrofoodobj.is_page_custom_admin ) {
                
                let time = restrofoodobj.page_auto_reload_time;
                setTimeout("location.reload(true);", time+'000');

            } 

        },
        productListReadMore: function() {

            // Configure/customize these variables.
           let showChar = restrofoodobj.characters;  // How many characters are shown by default
           let ellipsestext = "...";
           let moretext = restrofoodobj.get_text.show_more;
           let lesstext = restrofoodobj.get_text.show_less;
                
           $('.fb-read-more').each(function() {
                 let content = $(this).html();

                 if(content.length > showChar) {

                    let c = content.substr(0, showChar);
                    let h = content.substr(showChar, content.length - showChar);

                    let html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                    $(this).html(html);
                 }

           });

           $(".morelink").on('click', function(){
                 if($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
                 } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
                 }
                 $(this).parent().prev().toggle();
                 $(this).prev().toggle();
                 return false;
           });


        },
        addThousandsSeparator: function (nStr) {
            nStr += '';
            let x = nStr.split('.');
            let x1 = x[0];
            let x2 = x.length > 1 ? restrofoodobj.wc_decimal_separator + x[1] : '';
            let rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + restrofoodobj.wc_thousand_separator + '$2');
            }
            return x1 + x2;
        },
        removeThousandsSeparator: function( selector ) {

            let $s = $("[data-"+selector+"]"),
                $v = $s.data(selector);
           
                if ( $v.toString().includes(',')  ) {

                   let $d = $v.replace(/,/g, "");

                    $s.attr('data-'+selector, $d);

                }
        },
        checkoutPageDateField: function() {
            $('.restrofoodlite-date-field').datepicker({ dateFormat: restrofoodobj.datepicker_format });
        },
        checkoutPageScheduleType: function() {

            let s = $('[name="rb_delivery_schedule_options"]'),
                t = $('.dp-date-wrapper'),
                deliveryDate = $('[name="rb_delivery_date"] option'),
                timeWrapper = $('.fb-delivery-time-wrapper');

            if( s.val() == 'todayDelivery' ) {
               t.hide() 
            }
            s.on( 'click', function() {

                let $this = $(this);

                if( $this.val() == 'scheduleDelivery' ) {
                    t.show()
                   
                   if( $('[name="rb_delivery_date"]').val() == '' ) {
                    timeWrapper.hide();
                   }                   

                } else {
                    t.hide()
                    deliveryDate.prop('selected', function() {
                    return this.defaultSelected;
                    });
                    $( '#rb_delivery_date' ).change();
                    timeWrapper.fadeIn();
                    
                }

            } )

        },
        orderStartButton:function() {
            let $selectedBranch = $('.rb_modal_location').find('[name="rb_pickup_branch"]').val();

            if( !restrofoodobj.is_multi_branch || $selectedBranch  ) {
                $('.rb_modal_content.fb-ability-checker-form-wrapper').find('.fb-availability-check-result').append('<div class="fb-availability-check-buton-order-start"><button class="rb_close_modal rb_btn_fill">'+restrofoodobj.get_text.start_order+'</button></div>').show();
            }
        },
        emptyOrderStartButton: function() {
            $('.fb-availability-check-buton-order-start').remove();
        }

    }

    cartModal = {

        is_cart: true,
        is_delivery_opt: false,
        is_order_payment: false,
        current_view: '',
        init: function() {
            this.onTriggerMiniCart()
            this.onTriggerCheckout()
            this.miniCartModalClose()
            this.onTriggerBack()
            this.onTriggerOrderPayment()
            this.checkoutError()
            this.addedToCartEvent()

            this.footerFixedCartOnTriggerCartOpen()
        },
        miniCartModalClose: function() {

            let $this = this;

            $(document.body).on( 'click', '.rb_close_mini_cart_modal', function() {
                $this.miniCartModalCloseCB()
            } )
            $(document.body).on( 'click', '.rb_cart_popup_modal', function(e) {
                if( e.currentTarget === e.target ) {
                   $this.miniCartModalCloseCB() 
                }
                
            } )

            $(document).on('keydown', function (e) {
                if (e.key === 'Escape') {
                    $this.miniCartModalCloseCB()
                }
            });
        },
        miniCartModalCloseCB: function () {
            $(document.body).removeClass('fbPopupModal-opened');
            $('.rb_cart_popup_modal').fadeOut();
            $('.step-cart').hide();
            $('.step-checkout').hide();
            $('.fb-shipping-billing-address').hide();
            $('.fb-checkout-review-order').hide();
            $('.rb_cart').removeClass('open')

        },
        onTriggerMiniCart: function() {
            let $that = this;
            $('.rb_cart_count_btn').on( 'click', function() {
                //
                $('body').addClass('fbPopupModal-opened');
                $('.rb_cart_popup_modal').fadeIn();
                $('.rb_cart').addClass('open');
                $('.step-cart').fadeIn();
                //
                $that.current_view = 'cart';

                $that.is_cart = true;
                $that.is_delivery_opt = false;
                $that.is_order_payment = false;
                //
                $that.conditionalShowHide();
            } )
        },
        footerFixedCartOnTriggerCartOpen: function() {

            let $miniCartBottom = $('.mini-cart-bottom-block');

            $('.rb_cart_btn_circle, .rb_cart_close').on( 'click', function(e) {
                $('.rb_order_details_main').slideToggle();
                $miniCartBottom.fadeToggle();
            } )
            //
            $('.rb_cart_close').on( 'click', function(e) {
                $miniCartBottom.fadeOut();
            } )

        },
        onTriggerCheckout: function () {
            let $that = this;
            $(document.body).on( 'click', '.rb_mini_cart_checkout_btn', function(e) {
                e.preventDefault();
                //
                $that.is_cart = false;
                $that.is_order_payment = false;
                $that.is_delivery_opt = true;
                $that.current_view = 'delivery';

                //
                $('.step-cart').hide();
                $('.step-checkout').fadeIn('500');
                // update checkout
                $(document.body).trigger( 'update_checkout' );

                //
                $that.conditionalShowHide();

                // trigger this if delivery option hide from checkout
                if( restrofoodobj.is_checkout_delivery_option != 'yes' ) {
                    $( '.fb-order-payment' ).click();
                }
                

            } );
        },
        onTriggerBack: function () {
            let $that = this;
            $(document.body).on( 'click', '.back-cart', function(e) {
                e.preventDefault();

                let $this = $(this),
                    $trigger = $this.data('back');

                if( $that.current_view == 'delivery' || restrofoodobj.is_checkout_delivery_option != 'yes' ) {

                    $that.is_cart = true;
                    $('.step-cart').fadeIn();
                    $('.step-checkout').hide();

                } else if( $that.current_view == 'order-payment' && restrofoodobj.is_checkout_delivery_option == 'yes' ) {

                    $that.is_delivery_opt = true;
                    $that.current_view = 'delivery';

                    $('.fb-shipping-billing-address').hide();
                    $('.fb-checkout-review-order').hide();

                    $('.rb_delivery').show();
                    
                }

                $that.conditionalShowHide();

            } );
        },
        onTriggerOrderPayment: function () {
            let $that = this;
            $(document.body).on( 'click', '.fb-order-payment', function(e) {
                e.preventDefault();
                
                $that.is_order_payment = true;
                $that.is_cart = false;
                $that.is_delivery_opt = false;

                $(document.body).trigger( 'update_checkout' );

                $that.current_view = 'order-payment';

                $('.fb-shipping-billing-address').fadeIn();
                $('.fb-checkout-review-order').fadeIn();

                $('[data-back]').attr( 'data-back', 'checkout' );

                $that.conditionalShowHide();
            } );
        },
        conditionalShowHide: function() {

            let $this = this,
                $checkoutBtn = $('.rb_mini_cart_checkout_btn'),
                $backCart    = $('.back-cart'),
                $deliveryOpt   = $('.rb_delivery'),
                $orderPayment   = $('.fb-order-payment');

            if( $this.is_cart == true ) {
                $backCart.hide()
                $deliveryOpt.hide()

                $checkoutBtn.show()
                $orderPayment.hide()

            } else if( $this.is_delivery_opt == true ) {

                $deliveryOpt.show()

                $backCart.show()
                $checkoutBtn.hide()
                $orderPayment.show()
                
            } else if( $this.is_order_payment == true ) {
                $deliveryOpt.hide()

                $checkoutBtn.hide()
                $orderPayment.hide()
            }

        },
        checkoutError: function() {
            $(document.body).on( 'checkout_error', function() {
                $('.woocommerce-NoticeGroup-checkout').insertBefore('#place_order')
            })
        },
        addedToCartEvent: function() {
            
            $(document.body).on( 'added_to_cart removed_from_cart', function() {
                $.ajax({
                    post: 'post',
                    url: restrofoodobj.ajaxurl,
                    data: {
                        action: "woo_update_fixed_cart_subtotal"
                    },
                    success: function (res) {
                        $('.fixed-cart-subtotal').html(res);
                    }
                })

            });

        }

    }

    // window on load Init 
    $( window ).on( 'load', function() {
        m.init(); i.init(); a.init(); cartModal.init();
    } )
 
    /**
     *  Custom admin scripts 
     */

    admin = {


        init: function () {

            let $this = this;

            // datepicker init for Date filter 
            $(document).find(".datepicker").datepicker({
                dateFormat: restrofoodobj.datepicker_format,
                 inline: true,
                onSelect: function(dateText, inst) { 
                    var date = $(this).datepicker('getDate'),
                        day  = date.getDate(),  
                        month = date.getMonth() + 1,              
                        year =  date.getFullYear();

                    $(this).data( 'getdate', month+ '/' + day + '/' + year );
                }
            });

            // data table order view modal close
            $this.OrderViewModalClose();
            
            // Delivery Type
            $this.deliveryType();
                    

        },
        
        OrderViewModalClose: function () {

            function removeModal() {
                $('.rb_popup_modal').removeClass('open').fadeOut('300')
                $("body").removeClass('fbPopupModal-opened');
                setTimeout( function() {
                    $(document).find('.orderadmin_popup_modal').remove();
                }, 1000 )
            }

            //
            $(document).on( 'click', '.rb_close_modal', removeModal );

            if( restrofoodobj.is_active_modal_close_btn ) {

                $('.rb_popup_modal').on('click', function (e) {
                    let isShow = e.target === e.currentTarget;

                    if (isShow) {
                        removeModal();
                    }
                })

                $(document).on('keydown', function (e) {
                    if (e.key === 'Escape') {
                        removeModal();
                    }
                })
            }

        },
        
        deliveryType: function() {

            //
            if( restrofoodobj.delivery_options != 'all' )  {
                localStorage.setItem( "rb_delivery_type", restrofoodobj.delivery_options );
            }
           
            //
            let $getAddressArea = $(document).find('.fb-checkout-availability-checker-wrapper'),
                $hideAvailabilityChecker = $('.rb_modal_content').find('.hide-availability-checker'),
                $dTypePickup    = $('.delivery-type-pickup'),
                $dTypeDelivery  = $('.delivery-type-delivery'),
                $dTypeInRestaurant  = $('.delivery-type-in-restaurant'),
                $tableNumbers    = $('.table-numbers-list-wrapper'),
                $fbAbilityStatus = localStorage.getItem( "fbAbilityStatus" ),
                deliveryType     = localStorage.getItem( "rb_delivery_type" );

                //
                if(  deliveryType == 'Pickup' || deliveryType == 'pickup'  ) {
                    $getAddressArea.hide();
                    $hideAvailabilityChecker.hide();
                    $dTypePickup.attr( 'checked', true );
                    //
                    if( restrofoodobj.is_active_location && !restrofoodobj.is_checkout ) {
                        a.emptyOrderStartButton();
                        a.orderStartButton();
                    }

                } else if( deliveryType == 'In-Restaurant' ) {
                    $getAddressArea.hide();
                    $hideAvailabilityChecker.hide();
                    $dTypeInRestaurant.attr( 'checked', true );
                    $tableNumbers.show();
                    if( restrofoodobj.is_active_location && !restrofoodobj.is_checkout ) {
                        a.emptyOrderStartButton();
                        a.orderStartButton();
                    }
                } else {
                    $dTypeDelivery.attr( 'checked', true );
                }

            // On change event of delivery type
            $( "[name='rb_delivery_options']" ).on( "click", function(e) {

                let $getValue = $(this).val(),
                $fbAbilityStatus = localStorage.getItem( "fbAbilityStatus" );

                // Set delivery type in local storage
                localStorage.setItem( "rb_delivery_type", $getValue );

                if( $getValue == 'Pickup' ) {

                    $getAddressArea.hide();
                    $hideAvailabilityChecker.hide();
                    $('.fb-availability-check-result > p').hide();
                    $('.rb_modal_content').find('.fb-availability-check-buton').hide();
                    $tableNumbers.hide();
                    // if deactivate Modal Location Checker
                    if( restrofoodobj.is_active_location && !restrofoodobj.is_checkout ) {
                        a.emptyOrderStartButton();
                        a.orderStartButton();
                    }
                    
                } else if( $getValue == 'In-Restaurant' ) {
                    
                    $getAddressArea.hide();
                    $hideAvailabilityChecker.hide();
                    $('.fb-availability-check-result > p').hide();
                    $('.rb_modal_content').find('.fb-availability-check-buton').hide();
                    $tableNumbers.show();
                    // if deactivate Modal Location Checker
                    if( restrofoodobj.is_active_location && !restrofoodobj.is_checkout ) {
                        a.emptyOrderStartButton();
                        a.orderStartButton();
                    }

                } else {

                    $getAddressArea.show();
                    $hideAvailabilityChecker.show();
                    $tableNumbers.hide();
                    // 
                    if( restrofoodobj.is_active_location ) {
                        a.emptyOrderStartButton();
                        $('.fb-availability-check-buton').show();
                    }
                    
                }

                //

                let data = {
                  action: 'update_order_review_action',
                  security: wc_checkout_params.update_order_review_nonce
                };

                jQuery.post( restrofoodobj.ajaxurl, data, function( response )
                {

                  $('body').trigger( 'update_checkout' );

                });

            });

        },
        preloader: function() {
            $('.restrofoodlite-manager-data').html( '<div class="restrofoodlite-loader"></div>' );
        }
        
    } // 



    // Init admin object

    admin.init();


/**
 * Category Dropdown
 * 
 */

    function collapse() {
        $(document.body).on('click', '[data-toggle="collapse"]', function (e) {
            var target = '#' + $(this).data('target');
            $(this).toggleClass('collapsed');
            // $(target).toggleClass('open');
            $(target).slideToggle();
            
            e.preventDefault();
        })
    }
    collapse();


    /**
     *  Flash Sale Product 
     * 
     *  
     **/
    $(window).load(function() {
        let $slider = $('.flashproductslider');
        if( $slider.length ) {
            $slider.each( function() {

                let t = $( this );
                t.flexslider({
                    animation: "slide",
                    animationLoop: true,
                    itemWidth: 250,
                    itemMargin: 15,
                    mousewheel: true,
                    maxItems: t.data('items'),
                    start: function(slider ) {
                       flexsliderEqHight('.flashproductslider', '.rb_single_product_item');
                    }
                });

            } )
        }

        let flexsliderEqHight = function(slideContainer, slideItem) {
          let slider_height = 0;
          let $slider_slide = $(slideContainer).find(slideItem);
          $slider_slide.each(function() {
            let $height = $(this).outerHeight(true);

            if ( slider_height < $height ) {
               slider_height = $height;
            }
          });
          $slider_slide.css('min-height', slider_height);
        };

    });

    /*========================
        Elementor Hooked
    ==========================*/

    function elementorSupport($scope, $) {
        m.init(); i.init(); a.init(); cartModal.init(); 
    }

    function elementorSupportFalshSsaleProducts( $scope, $ ) {
        /**
         *  Flash Sale Product 
         * 
         *  
         **/

        let $slider = $('.flashproductslider');
        if( $slider.length ) {
            $slider.each( function() {

                let t = $( this );
                t.flexslider({
                    animation: "slide",
                    animationLoop: true,
                    itemWidth: 250,
                    itemMargin: 15,
                    mousewheel: true,
                    maxItems: t.data('items')
                });

            } )
        }

    }


    let elementTypeSkin = {
        'restrofoodlite-falsh-sale-products.default' : elementorSupportFalshSsaleProducts,
        'restrofoodlite-products-card.default' : elementorSupport,
    }

    $(window).on('elementor/frontend/init', function () {

        let $EF = elementorFrontend;

        if( $EF.isEditMode() ) {
            $.each( elementTypeSkin, function( widgetName, fuHandler ) {
                $EF.hooks.addAction('frontend/element_ready/'+widgetName, fuHandler );
            } )  
        }

    });


    // Mini Cart Qty Update

    function miniCartQtyUpdate(t) {

        let $selector = t.closest( '.rb_quantity' ).find('.rb_input_text'),
            $qty = $selector.val(),
            $pid = $selector.data('product_id'),
            $cartContainer = $('.mini-cart-content-inner');

            console.log( $qty );

        $.ajax({

            type: 'POST',
            url: restrofoodobj.ajaxurl,
            data:{
                action: 'woo_mini_cart_qty_update',
                item_qty: $qty,
                item_id: $pid
            },
            beforeSend: function() {
                $cartContainer.css('opacity', '0.5');
            },
            success: function( res ) {
                $(document.body).trigger('wc_fragment_refresh');
            },
            complete: function() {
                $cartContainer.css('opacity', '1');
            }
        })

    }


    $('.grid-layout-cart-mobile-bar-cart-up').on( 'click', function() {
        $(this).closest('.rb_grid_layout_cart_content').toggleClass('cart-toggle');
        
    } )



}(jQuery))