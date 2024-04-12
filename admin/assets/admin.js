(function ($) {
    "use strict";
    
    var restrofoodAdmin = {

        init: function () {

            var $this = this;

            /**
             * datepicker init for Date filter 
             * { dateFormat: 'dd-mm-yy' }
             * 
             */

            $(".datepicker").datepicker({ 
                dateFormat: adminRestrofoodobj.datepicker_format,
                 inline: true,
                onSelect: function(dateText, inst) { 
                    var date = $(this).datepicker('getDate'),
                        day  = date.getDate(),  
                        month = date.getMonth() + 1,              
                        year =  date.getFullYear();

                    $(this).data( 'getdate', month+ '/' + day + '/' + year );
                }
            });


            // Time Picker init
            $this.timePicker();

            // admin settings tab
            $this.adminSettingsTab();

            // Media uploader
            $this.mediaUploader();

            // color picker
            $this.colorPicker();

            // Order view modal
            $this.OrderViewModal();

            // Shortcode Generator
            $this.shortcodeGenerator();
            
        },
        colorPicker: function () {
            $('.fb-color-field').wpColorPicker();
        },
        timePicker: function () {
            // Time picker
            let $timeFormat = 'h:mm tt';;

            if( adminRestrofoodobj.time_format == '24' ) {
                $timeFormat = 'hh:mm tt';
            }

            $('.time-picker').mdtimepicker({
                // format of the input value
                format: $timeFormat 
            });
        },
        adminSettingsTab: function () {

            // Tab
            var tabSelect = $('[data-tab-select]');
            var tab = $('[data-tab]');
            tabSelect.each(function () {
                var tabText = $(this).data('tab-select');
                $(this).on('click', function () {
                    localStorage.setItem("tabActivation", tabText);
                    
                    $(this).addClass('active').siblings().removeClass('active');
                    tab.each(function () {
                        if (tabText === $(this).data('tab')) {
                            $(this).fadeIn(500).siblings().hide(); // for click
                            // $(this).fadeIn(500).siblings().stop().hide(); // active if hover
                            $(this).addClass('active').siblings().removeClass('active');
                        }
                    });
                });
                if ($(this).hasClass('active')) {
                    tab.each(function () {
                        if (tabText === $(this).data('tab')) {
                            $(this).addClass('active');
                        }
                        if ($(this).hasClass('active')) {
                            $(this).show().siblings().hide();

                        }
                    });
                }
            });

            // Check active tab
            let activateTab = localStorage.getItem("tabActivation");

            if( activateTab ) {
                $('[data-tab-select="'+activateTab+'"]').addClass('active').siblings().removeClass('active');
                $('[data-tab="'+activateTab+'"]').show().siblings().hide();
            }

        },
        mediaUploader: function () {

            // Media Upload
            var mediaUploader, t;

            $('.restrofoodlite_image_upload_btn').on('click', function (e) {

                e.preventDefault();

                t = $(this).parent().find('.restrofoodlite_background_image');

                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    }, multiple: false
                });
                mediaUploader.on('select', function () {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();

                    t.val(attachment.url)

                });
                mediaUploader.open();
            });

        },
        OrderViewModal: function () {

            // Modal Open Event
            $(document).on('click', '.fb-view-order', function () {
                $(this).parent().find('.rb_popup_modal').addClass('open').fadeIn('300');
                $("body").addClass('fbPopupModal-opened');

            });

            function removeModal() {
                $('.rb_popup_modal').removeClass('open').fadeOut('300')
                $("body").removeClass('fbPopupModal-opened');
            }

            // Modal Close event
            $(document).on('click', '.rb_close_modal', removeModal)

            $(document).on('click', '.rb_popup_modal', function (e) {
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

        },
        currency_symbol_position: function( price = '' ) {

            var currency_pos = adminRestrofoodobj.currency_pos,
                $currency = adminRestrofoodobj.currency,
                $price;


            switch( currency_pos ) {
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

        shortcodeGenerator: function() {

            /*********************************
                Shortcode Generator Options
            **********************************/
            
            // Selectors 
            let $shortcodeType  = $('#shortcodeType'),
                $column         = $('#column'),
                $layout         = $('#layout'),
                $limit          = $('#limit'),
                $style          = $('#style'),
                $search         = $('#search'),
                $padding_top    = $("#padding_top"),
                $padding_bottom = $("#padding_bottom"),
                $categories     = $("#categories"),
                $branch_list    = $("#branch_list"),
                $search_text    = $("#search_text"),
                $mini_cart_type = $("#mini_cart_type"),
                $buttonArea     = $('.button-area'),
                $scodeShow      = $('.scode-show'),
                $scodeCopy      = $( '#scode-copy' ),
                $selectAll      = $('.shortcode-attr-single-field'),
                $selectProdutAttr      = $('.produt-attr-field'),
                $selectAbilityChecker  = $('.ability-checker-attr-field');
                
            // Default events
            $buttonArea.hide();

            if( $shortcodeType.val() == '' ) {
                $selectAll.hide()
            }

            $scodeCopy.hide();

            // Review Type on change events
            
            $shortcodeType.on( 'change', function() {

                $buttonArea.show();

                if( $(this).val() == 'restrofoodlite_products' ) {
                    $selectProdutAttr.show();
                    $mini_cart_type.show();
                    $style.show();
                    $selectAbilityChecker.hide();
                    $limit.hide();
                }else if( $(this).val() == 'restrofoodlite_delivery_ability_checker' ) {
                    $selectAbilityChecker.show();
                    $mini_cart_type.hide();
                    $style.hide();
                    $selectProdutAttr.hide();
                }else {
                    $selectAll.hide();
                }
                
            });  
            
            $( '#scodegenerate' ).on( 'click', function() {

                let $attr ='';

                let $getShortcode = $shortcodeType.val();

                //
                if( $column.is(":visible") ) {
                    $attr += ' col="'+$column.val()+'"';
                }
                //
                if( $layout.is(":visible") && $layout ) {
                    $attr += ' layout="'+$layout.val()+'"';
                }
                //
                if( $style.is(":visible") && $style ) {
                    $attr += ' style="'+$style.val()+'"';
                }
                //
                if( $mini_cart_type.is(":visible") && $mini_cart_type ) {
                    $attr += ' mini_cart_type="'+$mini_cart_type.val()+'"';
                }
                //
                if( $limit.is(":visible") && $limit ) {
                    $attr += ' limit="'+$limit.val()+'"';
                }
                //
                if( $search.is(":visible") ) {
                    $attr += ' search="'+$search.val()+'"';
                }
                //
                if( $padding_top.is(":visible") ) {
                    $attr += ' padding_top="'+$padding_top.val()+'"';
                }
                //
                if( $padding_bottom.is(":visible") ) {
                    $attr += ' padding_bottom="'+$padding_bottom.val()+'"';
                }
                //
                if( $categories.is(":visible") ) {
                    $attr += ' cat="'+$categories.val()+'"';
                }
                //
                if( $search_text.is(":visible") ) {
                    $attr += ' button_text="'+$search_text.val()+'"';
                }
                //
                if( $branch_list.is(":visible") ) {
                    $attr += ' branch_id="'+$branch_list.val()+'"';
                }

                $scodeShow.fadeIn('slow');
                $scodeCopy.show();
                $scodeShow.html( '<p class="shortcodearea"><code>['+$getShortcode+' '+$attr+']</code></p>' );

            });


            // Copy shortcode
            $scodeCopy.on( 'click', function() {

                var $shortcode = $('.shortcodearea');

                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($shortcode.text()).select();
                document.execCommand("copy");
                $temp.remove();

                $scodeShow.fadeIn('slow').fadeOut('slow');
                $(this).fadeOut('slow');


            } );


        }


    }

    // Init object

    restrofoodAdmin.init();

})(jQuery)