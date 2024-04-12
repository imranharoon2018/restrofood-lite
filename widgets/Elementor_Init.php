<?php
namespace RestroFoodLite\widgets;
/**
 *
 * @package     Restrofood
 * @author      ThemeLooks
 * @copyright   2020 ThemeLooks
 * @license     GPL-2.0-or-later
 *
 *
 */

 // Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Elementor_Init {

	public static function init() {
		add_action( 'elementor/elements/categories_registered', [ __CLASS__, 'categories' ] );
		add_action( 'elementor/widgets/register', [ __CLASS__, 'widgets' ] );
	}

	public static function categories( $elements_manager ) {

		$elements_manager->add_category(
			'restrofoodlite-elements-category',
			[
				'title' => esc_html__( 'Restrofood Plugin', 'restrofoodlite' ),
				'icon' => 'fa fa-plug',
			]
		);

	}

	public static function widgets( $widgets_manager ) {

		require_once( RESTROFOODLITE_DIR_PATH . 'widgets/Products_Card.php' );
		//
		$widgets_manager->register( new Products_Card());

	}
	


}

Elementor_Init::init();