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
 
abstract class Settings_Fields_Base {

  public static  $optionName;

  public static $getOptionData;

  use \RestroFoodLite\Admin\Field\Checkbox;
  use \RestroFoodLite\Admin\Field\Switcher;
  use \RestroFoodLite\Admin\Field\Colorpicker;
  use \RestroFoodLite\Admin\Field\MediaUpload;
  use \RestroFoodLite\Admin\Field\Timepicker;
  use \RestroFoodLite\Admin\Field\Textarea;
  use \RestroFoodLite\Admin\Field\Text;
  use \RestroFoodLite\Admin\Field\Selectbox;
  use \RestroFoodLite\Admin\Field\Number;
  use \RestroFoodLite\Admin\Field\TimezoneSelect;
  use \RestroFoodLite\Admin\Field\Zipcode;
  use \RestroFoodLite\Admin\Field\LocationSearch;
  use \RestroFoodLite\Admin\Field\MultipleSelect;
  use \RestroFoodLite\Admin\Field\Day_Based_Time;
  use \RestroFoodLite\Admin\Field\kmFeeRepeater;
  use \RestroFoodLite\Admin\Field\ZipcodeMultiInput;
  use \RestroFoodLite\Admin\Field\Product_Visibility_Time;


  public function __construct() {

    self::$optionName = $this->get_option_name();
    self::$getOptionData = get_option(self::$optionName);

    $this->tab_setting_fields();

  }

  public function get_option_name() {}
  public function tab_setting_fields() {}

  public function start_fields_section( $args ) {

    $default = [
      'title'     => esc_html__( 'Title goes to here', 'restrofoodlite' ),
      'class'     => '',
      'icon'      => '',
      'id'        => '',
      'display'   => 'none',
    ];

    $args = wp_parse_args( $args, $default );

    ?>
    <div id="<?php echo esc_attr( $args['id'] ); ?>" data-tab="<?php echo esc_attr( $args['id'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" style="display: <?php echo esc_attr( $args['display'] ); ?>;">
      <div class="tab-inner-container">

        <div class="fb-title-area">
          <h3 class="fb-tab-tilte"><i class="<?php echo esc_attr( $args['icon'] ); ?>"></i><?php echo esc_html( $args['title'] ); ?></h3>
          <?php $this->saveButton(); ?>
        </div>

        <div class="dashboard-content-wrap">
    <?php
  }

  public function end_fields_section() {
    $this->saveButton('fb-bottom-save-btn');
    echo '</div></div></div>';
  }

  public function saveButton( $class = '' ) {
    echo '<div class="'.esc_attr( $class ).' fb-top-save-btn"><button type="submit" class="fb-title-save-btn">'.esc_html__( 'Save Setting', 'restrofoodlite' ).'</button></div>';
  }

  public function promo() {
    ?>
    <div class="fbl-overlay"><div class="fbl-promo-inner"><h3>Order management system is a pro version features </h3><a href="<?php echo esc_url( RESTROFOODLITE_PRO_URL ); ?>" class="button button-primary fbl-buy" target="_blank">Buy Now</a></div></div>
    <?php
  }


}