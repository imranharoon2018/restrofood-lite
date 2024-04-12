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

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Elementor Products_Card widget.
 *
 * @since 1.0
 */

class Products_Card extends Widget_Base {
    
	public function get_name() {
		return 'restrofoodlite-products-card';
	}

	public function get_title() {
		return esc_html__( 'Products Card', 'restrofoodlite' );
	}

	public function get_icon() {
		return 'eicon-text';
	}

	public function get_categories() {
		return ['restrofoodlite-elements-category'];
	}

	protected function register_controls() {

		$repeater = new \Elementor\Repeater();

        // ---------------------------------------- content ------------------------------
        $this->start_controls_section(
            'restrofoodlite_products_card_content_settings',
            [
                'label' => esc_html__( 'Products Card Content', 'restrofoodlite' ),
            ]
        );
       
        $this->add_control(
            'limit',
            [
                'label' => esc_html__( 'Limit', 'restrofoodlite' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 10
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Layout', 'restrofoodlite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid'  => esc_html__( 'Grid', 'restrofoodlite' ),
                    'list' => esc_html__( 'List', 'restrofoodlite' ),
                ],
            ]
        );
        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Layout Style', 'restrofoodlite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'  => esc_html__( 'Style 1', 'restrofoodlite' ),
                    '2' => esc_html__( 'Style 2', 'restrofoodlite' ),
                    '3' => esc_html__( 'Style 3', 'restrofoodlite' )
                ],
            ]
        );
        $this->add_control(
            'column',
            [
                'label' => esc_html__( 'Column', 'restrofoodlite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'condition' => [ 'layout' => 'grid' ],
                'default' => '4',
                'options' => [
                    '2'  => esc_html__( '2 Column', 'restrofoodlite' ),
                    '3' => esc_html__( '3 Column', 'restrofoodlite' ),
                    '4' => esc_html__( '4 Column', 'restrofoodlite' )
                ],
            ]
        );
        $this->add_control(
            'mini_cart_type',
            [
                'label' => esc_html__( 'Mini Cart Type', 'restrofoodlite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'canvas',
                'options' => [
                    'canvas'  => esc_html__( 'Canvas', 'restrofoodlite' ),
                    'footer-fixed' => esc_html__( 'Footer Fixed', 'restrofoodlite' ),
                    'beside-products' => esc_html__( 'Beside Products', 'restrofoodlite' )
                ],
            ]
        );
        $this->add_control(
            'cat',
            [
                'label' => esc_html__( 'Category', 'restrofoodlite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => restrofoodlite_get_categories(),
            ]
        );
        $this->add_control(
            'show_search',
            [
                'label' => esc_html__( 'Show Search', 'restrofoodlite' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'restrofoodlite' ),
                'label_off' => esc_html__( 'Hide', 'restrofoodlite' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->end_controls_section(); // End  content

        //------------------------------ Style ------------------------------
        $this->start_controls_section(
            'restrofoodlite_products_card_style', [
                'label' => esc_html__( 'Products Card Style', 'restrofoodlite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_padding',
            [
                'label' => esc_html__( 'Padding', 'restrofoodlite' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .rb__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'section_margin',
            [
                'label' => esc_html__( 'Margin', 'restrofoodlite' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .rb__wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'flash_sale_background',
                'label' => esc_html__( 'Background', 'restrofoodlite' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rb__wrapper',
            ]
        );


        $this->end_controls_section();

        

	}

	protected function render() {

        // get settings
        $settings = $this->get_settings_for_display();

        $limit          = !empty( $settings['limit'] ) ? $settings['limit'] : '';
        $col            = !empty( $settings['column'] ) ? $settings['column'] : '';
        $layout         = !empty( $settings['layout'] ) ? $settings['layout'] : '';
        $style          = !empty( $settings['style'] ) ? $settings['style'] : '';
        $miniCartType   = !empty( $settings['mini_cart_type'] ) ? $settings['mini_cart_type'] : '';
        $search         = !empty( $settings['show_search'] ) ? $settings['show_search'] : '';
        $cat            = !empty( $settings['cat'] ) ? $settings['cat'] : '';

        echo do_shortcode( '[restrofoodlite_products limit="'.esc_attr( $limit ).'" style="'.esc_attr($style).'"  col="'.esc_attr( $col ).'" layout="'.esc_attr( $layout ).'" mini_cart_type="'.esc_attr( $miniCartType ).'" search="'.esc_attr( $search ).'" cat="'.esc_attr( $cat ).'"]' );

    }
    
}
