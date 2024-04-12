<?php 
namespace RestroFoodLite\Admin\Field;
 /**
  * 
  * @package    RestroFoodLite 
  * @since      3.0.0
  * @version    3.0.0
  * @author     ThemeLooks
  * @Websites:  http://themelooks.com/
  *
  */

trait Number {

	protected static $args;

	public function number( $args ) {

		$default = [
			'title' => '',
			'name'	=> '',
			'description'	=> '',
			'class'			=> '',
			'condition'		=> '',
			'is_pro'		=> false
		];

		self::$args = wp_parse_args( $args, $default );

		self::number_markup();
		
	}

	protected static function number_markup() {

		$optionName = self::$optionName;
	    $args = self::$args;
	    $getData = self::$getOptionData;
	    $fieldName  = $args['name'];
	    $value = !empty( $getData[$fieldName] ) ? $getData[$fieldName] : '';

	    $conditionData = '';
	    if( !empty( $args['condition'] ) ) {
	      $conditionData = json_encode( $args['condition'] );
	    }
		?>
		<div class="restrofoodlite-admin-field <?php echo esc_attr( $args['class'] ); ?>" data-condition="<?php echo esc_html($conditionData); ?>">
			<h4><?php echo esc_html( $args['title'] ); echo !empty( $args['is_pro'] ) ? '<span class="pro-label">Pro</span>' : ''; ?></h4>
			<div class="fb-field-group">
			<input type="number" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>" placeholder="<?php esc_attr_e( '6', 'restrofoodlite' );  ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo !empty( $args['is_pro'] ) ? 'disabled' : ''; ?> />
			<?php
			if( !empty( $args['description'] ) ) {
				echo '<p>'.esc_html( $args['description'] ).'</p>';
			}
			?>
			</div>
		</div>
		<?php
	}
}
