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

trait Selectbox {

	protected static $args;

	public function selectbox( $args ) {

		$default = [
			'title' => '',
			'name'	=> '',
			'description'	=> '',
			'class'			=> '',
			'condition'		=> '',
			'options'		=> [],
			'is_pro'		=> false
		];

		self::$args = wp_parse_args( $args, $default );

		self::selectbox_markup();

	}

	protected static function selectbox_markup() {

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
		<div class="restrofoodlite-admin-field" data-condition="<?php echo esc_html($conditionData); ?>">
			<h4><?php echo esc_html( $args['title'] ); echo !empty( $args['is_pro'] ) ? '<span class="pro-label">Pro</span>' : ''; ?></h4>
			<div class="fb-field-group">
			<select name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>" <?php echo !empty( $args['is_pro'] ) ? 'disabled' : ''; ?>>
				<?php 
	        foreach( $args['options'] as  $key => $option ) {
	          echo '<option value="'.esc_attr( $key ).'" '.selected( $value, $key, false ).'>'.esc_html( $option ).'</option>';
	        }
        ?>
			</select>
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
