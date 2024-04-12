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

trait Day_Based_Time {

	protected static $args;

	public function day_based_time( $args ) {

		$default = [
			'title' => '',
			'name'	=> '',
			'description'	=> '',
			'class'			=> '',
			'condition'		=> '',
		];

		self::$args = wp_parse_args( $args, $default );
		self::day_based_time_markup();
	}

	protected static function day_based_time_markup() {

		$optionName = self::$optionName;
	    $args 		= self::$args;
	    $getData 	= self::$getOptionData;
	    $fieldName  = $args['name'];
	    $value 		= !empty( $getData[$fieldName] ) ? $getData[$fieldName] : '';

	    $conditionData = '';
	    if( !empty( $args['condition'] ) ) {
	      $conditionData = json_encode( $args['condition'] );
	    }


		?>
		<div class="restrofoodlite-admin-field" data-condition="<?php echo esc_html($conditionData); ?>">
			<h4><?php echo esc_html( $args['title'] ); ?></h4>
			<?php
			if( !empty( $args['description'] ) ) {
				echo '<p>'.esc_html( $args['description'] ).'</p>';
			}
			?>
			<div class="day-based-time">
                <div class="field-wrapper-fd">
	                <?php
		            $days = restrofoodlite_get_weekday();
	                ?>
	              	<div class="single-field-wrap fb-d-felx fb-align-items-center">
	              	<div class="day-field-group">
	              		<p><?php esc_html_e( 'Days', 'restrofoodlite' ); ?></p>
	              		<input type="hidden" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[0][day]" value="0" />
	              		<input type="text" value="<?php echo esc_html( $days[0] ); ?>" readonly />
              		</div>

	                <div class="holy-day-checkbox">
	                	<p><?php esc_html_e( 'HoliDay?', 'restrofoodlite' ); ?></p>
	                	<input type="checkbox" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[0][is-holy-day]" value="yes" <?php checked( !empty( $value[0]['is-holy-day'] ) ? $value[0]['is-holy-day'] : '', 'yes' ); ?> />
	              	</div>
	              	<div class="day-field-group">
	              		<p><?php esc_html_e( 'Opening Time', 'restrofoodlite' ); ?></p>
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[0][open-time]" value="<?php echo !empty( $value[0]['open-time'] ) ? esc_html( $value[0]['open-time'] ) : '' ?>" />
	                </div>
	                <div class="day-field-group">
	                	<p><?php esc_html_e( 'Closing Time', 'restrofoodlite' ); ?></p>
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[0][end-time]" value="<?php echo !empty( $value[0]['end-time'] ) ? esc_html( $value[0]['end-time'] ) : '' ?>" />
	                </div>
	                <div class="day-field-group">
	                	<p><?php esc_html_e( 'Break Start Time', 'restrofoodlite' ); ?></p>
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[0][break-time-from]" value="<?php echo !empty( $value[0]['break-time-from'] ) ? esc_html( $value[0]['break-time-from'] ) : '' ?>" />
	              	</div>
	                <div class="day-field-group">
	                	<p><?php esc_html_e( 'Break End Time', 'restrofoodlite' ); ?></p>
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[0][break-time-to]" value="<?php echo !empty( $value[0]['break-time-to'] ) ? esc_html( $value[0]['break-time-to'] ) : '' ?>" />
	              	</div>
	              	</div>
	              	<div class="single-field-wrap fb-d-felx fb-align-items-center">
	              		<div class="day-field-group">
	              		<input type="hidden" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[1][day]" value="1" />
              			<input type="text" value="<?php echo esc_html( $days[1] ); ?>" readonly />
              			</div>
	                  
	                  <div class="holy-day-checkbox">
	                	<input type="checkbox" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[1][is-holy-day]" value="yes" <?php checked( !empty( $value[1]['is-holy-day'] ) ? $value[1]['is-holy-day'] : '', 'yes' ); ?> />
	              	  </div>
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[1][open-time]" value="<?php echo !empty( $value[1]['open-time'] ) ? esc_html( $value[1]['open-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[1][end-time]" value="<?php echo !empty( $value[1]['end-time'] ) ? esc_html( $value[1]['end-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[1][break-time-from]" value="<?php echo !empty( $value[1]['break-time-from'] ) ? esc_html( $value[1]['break-time-from'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[1][break-time-to]" value="<?php echo !empty( $value[1]['break-time-to'] ) ? esc_html( $value[1]['break-time-to'] ) : '' ?>" />
	              	</div>
	              	<div class="single-field-wrap fb-d-felx fb-align-items-center">
	              		<div class="day-field-group">
	              		<input type="hidden" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[2][day]" value="2" />
              			<input type="text" value="<?php echo esc_html( $days[2] ); ?>" readonly />
              			</div>

	                  <div class="holy-day-checkbox">
	                	<input type="checkbox" <?php checked( !empty( $value[2]['is-holy-day'] ) ? $value[2]['is-holy-day'] : '', 'yes' ); ?> name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[2][is-holy-day]" value="yes" />
	              	  </div>
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[2][open-time]" value="<?php echo !empty( $value[2]['open-time'] ) ? esc_html( $value[2]['open-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[2][end-time]" value="<?php echo !empty( $value[2]['end-time'] ) ? esc_html( $value[2]['end-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[2][break-time-from]" value="<?php echo !empty( $value[2]['break-time-from'] ) ? esc_html( $value[2]['break-time-from'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[2][break-time-to]" value="<?php echo !empty( $value[2]['break-time-to'] ) ? esc_html( $value[2]['break-time-to'] ) : '' ?>" />
	              	</div>
	              	
	              	<div class="single-field-wrap fb-d-felx fb-align-items-center">
	              		<div class="day-field-group">
	              		<input type="hidden" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[3][day]" value="3" />
              			<input type="text" value="<?php echo esc_html( $days[3] ); ?>" readonly />
              			</div>
	                  
	                  <div class="holy-day-checkbox">
	                	<input type="checkbox" <?php checked( !empty( $value[3]['is-holy-day'] ) ? $value[3]['is-holy-day'] : '', 'yes' ); ?> name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[3][is-holy-day]" value="yes" />
	              	  </div>
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[3][open-time]" value="<?php echo !empty( $value[3]['open-time'] ) ? esc_html( $value[3]['open-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[3][end-time]" value="<?php echo !empty( $value[3]['end-time'] ) ? esc_html( $value[3]['end-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[3][break-time-from]" value="<?php echo !empty( $value[3]['break-time-from'] ) ? esc_html( $value[3]['break-time-from'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[3][break-time-to]" value="<?php echo !empty( $value[3]['break-time-to'] ) ? esc_html( $value[3]['break-time-to'] ) : '' ?>" />
	              	</div>
	              	
	              	<div class="single-field-wrap fb-d-felx fb-align-items-center">
	              		<div class="day-field-group">
	                	<input type="hidden" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[4][day]" value="4" />
              			<input type="text" value="<?php echo esc_html( $days[4] ); ?>" readonly />
              			</div>

	                  <div class="holy-day-checkbox">
	                	<input type="checkbox" <?php checked( !empty( $value[4]['is-holy-day'] ) ? $value[4]['is-holy-day'] : '', 'yes' ); ?> name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[4][is-holy-day]" value="yes" />
	              	  </div>
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[4][open-time]" value="<?php echo !empty( $value[4]['open-time'] ) ? esc_html( $value[4]['open-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[4][end-time]" value="<?php echo !empty( $value[4]['end-time'] ) ? esc_html( $value[4]['end-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[4][break-time-from]" value="<?php echo !empty( $value[4]['break-time-from'] ) ? esc_html( $value[4]['break-time-from'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[4][break-time-to]" value="<?php echo !empty( $value[4]['break-time-to'] ) ? esc_html( $value[4]['break-time-to'] ) : '' ?>" />
	              	</div>
	              	
	              	<div class="single-field-wrap fb-d-felx fb-align-items-center">
	              		<div class="day-field-group">
	              		<input type="hidden" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[5][day]" value="5" />
              			<input type="text" value="<?php echo esc_html( $days[5] ); ?>" readonly />
              			</div>

	                  <div class="holy-day-checkbox">
	                	<input type="checkbox" <?php checked( !empty( $value[5]['is-holy-day'] ) ? $value[5]['is-holy-day'] : '', 'yes' ); ?> name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[5][is-holy-day]" value="yes" />
	              	  </div>
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[5][open-time]" value="<?php echo !empty( $value[5]['open-time'] ) ? esc_html( $value[5]['open-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[5][end-time]" value="<?php echo !empty( $value[5]['end-time'] ) ? esc_html( $value[5]['end-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[5][break-time-from]" value="<?php echo !empty( $value[5]['break-time-from'] ) ? esc_html( $value[5]['break-time-from'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[5][break-time-to]" value="<?php echo !empty( $value[5]['break-time-to'] ) ? esc_html( $value[5]['break-time-to'] ) : '' ?>" />
	              	</div>
	              	
	              	<div class="single-field-wrap fb-d-felx fb-align-items-center">
		              	<div class="day-field-group">
		              		<input type="hidden" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[6][day]" value="6" />
	              			<input type="text" value="<?php echo esc_html( $days[6] ); ?>" readonly />
		                </div>
		                <div class="holy-day-checkbox">
		                	<input type="checkbox" <?php checked( !empty( $value[6]['is-holy-day'] ) ? $value[6]['is-holy-day'] : '', 'yes' ); ?> name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[6][is-holy-day]" value="yes" />
		              	</div>
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[6][open-time]" value="<?php echo !empty( $value[6]['open-time'] ) ? esc_html( $value[6]['open-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[6][end-time]" value="<?php echo !empty( $value[6]['end-time'] ) ? esc_html( $value[6]['end-time'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[6][break-time-from]" value="<?php echo !empty( $value[6]['break-time-from'] ) ? esc_html( $value[6]['break-time-from'] ) : '' ?>" />
	                  <input class="time-picker" type="text" name="<?php echo esc_attr( $optionName ).'['.$fieldName.']'; ?>[6][break-time-to]" value="<?php echo !empty( $value[6]['break-time-to'] ) ? esc_html( $value[6]['break-time-to'] ) : '' ?>" />
	              	</div>

                </div>
            </div>
        </div>
		<?php
	}
}
