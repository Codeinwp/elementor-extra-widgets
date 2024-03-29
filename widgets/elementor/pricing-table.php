<?php
/**
 * Pricing Table widget for Elementor builder
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    ThemeIsle\ElementorExtraWidgets
 */
namespace ThemeIsle\ElementorExtraWidgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Repeater;
use ThemeIsle\ElementorExtraWidgets\Traits\Sanitization;

/**
 * Class Pricing_Table
 *
 * @package ThemeIsle\ElementorExtraWidgets
 */
class Pricing_Table extends Widget_Base {
	use Sanitization;

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Pricing Table', 'textdomain' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-price-table';
	}

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'obfx-pricing-table';
	}

	/**
	 * Retrieve the list of styles the pricing table widget depended on.
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_style_depends() {
		return [ 'eaw-elementor', 'font-awesome-5' ];
	}

	/**
	 * Widget Category
	 *
	 * @return array
	 */
	public function get_categories() {
		$category_args = apply_filters( 'elementor_extra_widgets_category_args', array() );
		$slug = isset( $category_args['slug'] ) ?  $category_args['slug'] : 'obfx-elementor-widgets';
		return [ $slug ];
	}

	/**
	 * Register Elementor Controls
	 */
	protected function register_controls() {
		$this->plan_title_section();

		$this->plan_price_tag_section();

		$this->features_section();

		$this->button_section();

		$this->header_style_section();

		$this->price_tag_style_section();

		$this->features_style_section();

		$this->button_style_section();
	}

	/**
	 * Content > Title section.
	 */
	private function plan_title_section() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Plan Title', 'textdomain' ),
			]
		);

		$this->add_control(
			'title',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Title', 'textdomain' ),
				'placeholder' => __( 'Title', 'textdomain' ),
				'default'     => __( 'Pricing Plan', 'textdomain' ),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Title HTML tag', 'textdomain' ),
				'default' => 'h3',
				'options' => [
					'h1' => __( 'h1', 'textdomain' ),
					'h2' => __( 'h2', 'textdomain' ),
					'h3' => __( 'h3', 'textdomain' ),
					'h4' => __( 'h4', 'textdomain' ),
					'h5' => __( 'h5', 'textdomain' ),
					'h6' => __( 'h6', 'textdomain' ),
					'p'  => __( 'p', 'textdomain' ),
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Subtitle', 'textdomain' ),
				'placeholder' => __( 'Subtitle', 'textdomain' ),
				'default'     => __( 'Description', 'textdomain' ),
			]
		);

		$this->add_control(
			'subtitle_tag',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Subtitle HTML Tag', 'textdomain' ),
				'default' => 'p',
				'options' => [
					'h1' => __( 'h1', 'textdomain' ),
					'h2' => __( 'h2', 'textdomain' ),
					'h3' => __( 'h3', 'textdomain' ),
					'h4' => __( 'h4', 'textdomain' ),
					'h5' => __( 'h5', 'textdomain' ),
					'h6' => __( 'h6', 'textdomain' ),
					'p'  => __( 'p', 'textdomain' ),
				],
			]
		);
		$this->end_controls_section(); // end section-title
	}

	/**
	 * Content > Price Tag section.
	 */
	private function plan_price_tag_section() {
		$this->start_controls_section(
			'section_price_tag',
			[
				'label' => __( 'Price Tag', 'textdomain' ),
			]
		);

		$this->add_control(
			'price_tag_text',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Price', 'textdomain' ),
				'placeholder' => __( 'Price', 'textdomain' ),
				'default'     => __( '50', 'textdomain' ),
				'separator'   => 'after',
			]
		);

		$this->add_control(
			'price_tag_currency',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Currency', 'textdomain' ),
				'placeholder' => __( 'Currency', 'textdomain' ),
				'default'     => __( '$', 'textdomain' ),
			]
		);

		$this->add_control(
			'price_tag_currency_position',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Currency Position', 'textdomain' ),
				'default' => 'left',
				'options' => [
					'left'  => __( 'Before', 'textdomain' ),
					'right' => __( 'After', 'textdomain' ),
				],
			]
		);

		$this->add_control(
			'price_tag_period',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Period', 'textdomain' ),
				'placeholder' => __( '/month', 'textdomain' ),
				'default'     => __( '/month', 'textdomain' ),
				'separator'   => 'before',
			]
		);
		$this->end_controls_section(); // end section-price-tag
	}

	/**
	 * Content > Features section.
	 */
	private function features_section() {
		$this->start_controls_section(
			'section_features',
			[
				'label' => __( 'Features', 'textdomain' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'accent',
			[
				'label'       => __( 'Accented Text', 'textdomain' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'description' => __( 'Appears before feature text', 'textdomain' ),
				'default'     => __( 'Accent', 'textdomain' ),
			]
		);

		$repeater->add_control(
			'text',
			[
				'label'       => __( 'Text', 'textdomain' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Plan Features', 'textdomain' ),
				'default'     => __( 'Feature', 'textdomain' ),
			]
		);

		$repeater->add_control(
			'feature_icon_new',
			[
				'label'       => __( 'Icon', 'textdomain' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'fa4compatibility' => 'feature_icon',
			]
		);

		$this->add_control(
			'feature_list',
			[
				'label'       => __( 'Plan Features', 'textdomain' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => [
					[
						'accent' => __( 'First', 'textdomain' ),
						'text'   => __( 'Feature', 'textdomain' ),
					],
					[
						'accent' => __( 'Second', 'textdomain' ),
						'text'   => __( 'Feature', 'textdomain' ),
					],
					[
						'accent' => __( 'Third', 'textdomain' ),
						'text'   => __( 'Feature', 'textdomain' ),
					],
				],
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{ accent + " " + text }}',
			]
		);

		$this->add_responsive_control(
			'features_align',
			[
				'label'     => __( 'Alignment', 'textdomain' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => __( 'Left', 'textdomain' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'textdomain' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'textdomain' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'textdomain' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .obfx-feature-list' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // end section-features
	}

	/**
	 * Content > Button section.
	 */
	private function button_section() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Button', 'textdomain' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Text', 'textdomain' ),
				'placeholder' => __( 'Buy Now', 'textdomain' ),
				'default'     => __( 'Buy Now', 'textdomain' ),
			]
		);

		$this->add_control(
			'button_link',
			[
				'type'        => Controls_Manager::URL,
				'label'       => __( 'Link', 'textdomain' ),
				'placeholder' => __( 'https://example.com', 'textdomain' ),
			]
		);

		$this->add_control(
			'button_icon_new',
			[
				'type'             => Controls_Manager::ICONS,
				'label'            => __( 'Icon', 'textdomain' ),
				'fa4compatibility' => 'button_icon',
			]
		);

		$this->add_control(
			'button_icon_align',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => __( 'Icon Position', 'textdomain' ),
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Before', 'textdomain' ),
					'right' => __( 'After', 'textdomain' ),
				],
				'condition' => [
					'button_icon!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_indent',
			[
				'type'      => Controls_Manager::SLIDER,
				'label'     => __( 'Icon Spacing', 'textdomain' ),
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .obfx-button-icon-align-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .obfx-button-icon-align-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end section_button
	}

	/**
	 * Style > Header section.
	 */
	private function header_style_section() {
		$this->start_controls_section(
			'section_header_style',
			[
				'label' => __( 'Header', 'textdomain' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'header_padding',
			[
				'label'      => __( 'Header Padding', 'textdomain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .obfx-title-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'plan_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Title Color', 'textdomain' ),
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#464959',
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-table-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'plan_title_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .obfx-pricing-table-title',
			]
		);

		$this->add_control(
			'plan_subtitle_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Subtitle Color', 'textdomain' ),
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#60647d',
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-table-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'plan_subtitle_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .obfx-pricing-table-subtitle',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'heading_section_bg',
				'label'    => __( 'Section Background', 'textdomain' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .obfx-title-wrapper',
			]
		);
		$this->end_controls_section(); // end section_header_style
	}

	/**
	 * Style > Price Tag section.
	 */
	private function price_tag_style_section() {
		$this->start_controls_section(
			'section_price_box',
			[
				'label' => __( 'Price Tag', 'textdomain' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'price_box_padding',
			[
				'type'       => Controls_Manager::DIMENSIONS,
				'label'      => __( 'Price Box Padding', 'textdomain' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .obfx-price-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pricing_section_bg',
				'label'    => __( 'Section Background', 'textdomain' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .obfx-price-wrapper',
			]
		);

		$this->add_control(
			'price_tag_heading_currency',
			[
				'label'     => __( 'Currency', 'textdomain' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'currency_color',
			[
				'label'     => __( 'Currency Color', 'textdomain' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#60647d',
				'selectors' => [
					'{{WRAPPER}} .obfx-price-currency' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'currency_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .obfx-price-currency',
			]
		);

		$this->add_control(
			'price_tag_heading_price',
			[
				'label'     => __( 'Price', 'textdomain' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'price_text_color',
			[
				'label'     => __( 'Price Color', 'textdomain' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#60647d',
				'selectors' => [
					'{{WRAPPER}} .obfx-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .obfx-price',
			]
		);

		$this->add_control(
			'price_tag_heading_period',
			[
				'label'     => __( 'Period', 'textdomain' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'period_color',
			[
				'label'     => __( 'Period Color', 'textdomain' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#60647d',
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-period' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'price_sub_text_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .obfx-pricing-period',
			]
		);
		$this->end_controls_section(); // end pricing-section
	}

	/**
	 * Style > Features section.
	 */
	private function features_style_section() {
		$this->start_controls_section(
			'section_features_style',
			[
				'label' => __( 'Features', 'textdomain' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'features_section_bg',
				'label'    => __( 'Section Background', 'textdomain' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .obfx-feature-list',
			]
		);

		$this->add_responsive_control(
			'features_box_padding',
			[
				'type'       => Controls_Manager::DIMENSIONS,
				'label'      => __( 'Features List Padding', 'textdomain' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .obfx-feature-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'features_accented_heading',
			[
				'label'     => __( 'Accented', 'textdomain' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'features_accented_text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Accented Color', 'textdomain' ),
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#60647d',
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-table-accented' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'features_accented_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .obfx-pricing-table-accented',
			]
		);

		$this->add_control(
			'features_features_heading',
			[
				'label'     => __( 'Features', 'textdomain' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'features_text_color',
			[
				'label'     => __( 'Features Color', 'textdomain' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#b1b3c0',
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-table-feature' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'features_features_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .obfx-pricing-table-feature',
			]
		);

		$this->add_control(
			'features_icons_heading',
			[
				'label'     => __( 'Icons', 'textdomain' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'features_icon_color',
			[
				'label'     => __( 'Icon Color', 'textdomain' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#b1b3c0',
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-table-feature-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'features_icon_size',
			[
				'type'      => Controls_Manager::SLIDER,
				'label'     => __( 'Icon Size', 'textdomain' ),
				'default'   => [
					'size' => 16,
				],
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} i.obfx-pricing-table-feature-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} img.obfx-pricing-table-feature-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'features_icon_indent',
			[
				'type'      => Controls_Manager::SLIDER,
				'label'     => __( 'Icon Spacing', 'textdomain' ),
				'default'   => [
					'size' => 5,
				],
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} i.obfx-pricing-table-feature-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // end section_features_style
	}

	/**
	 * Style > Button section.
	 */
	private function button_style_section() {
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button', 'textdomain' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(), [
				'name'     => 'button_section_bg',
				'label'    => __( 'Section Background', 'textdomain' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .obfx-pricing-table-button-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __( 'Typography', 'textdomain' ),
				'scheme'   => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .obfx-pricing-table-button-wrapper',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'textdomain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .obfx-pricing-table-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_padding',
			[
				'label'      => __( 'Padding', 'textdomain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .obfx-pricing-table-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'type'      => Controls_Manager::SLIDER,
				'label'     => __( 'Icon Size', 'textdomain' ),
				'default'   => [
					'size' => 16,
				],
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-table-button-wrapper i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .obfx-pricing-table-button-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Add the tabbed control.
		$this->tabbed_button_controls();

		$this->end_controls_section(); // end section_button_style
	}

	/**
	 * Tabs for the Style > Button section.
	 */
	private function tabbed_button_controls() {
		$this->start_controls_tabs( 'tabs_background' );

		$this->start_controls_tab(
			'tab_background_normal',
			[
				'label' => __( 'Normal', 'textdomain' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Text Color', 'textdomain' ),
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-table-button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Background Color', 'textdomain' ),
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#93c64f',
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-table-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'button_box_shadow',
				'selector'  => '{{WRAPPER}} .obfx-pricing-table-button',
				'separator' => '',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_background_hover',
			[
				'label' => __( 'Hover', 'textdomain' ),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Text Color', 'textdomain' ),
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-table-button:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Background Color', 'textdomain' ),
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#74c600',
				'selectors' => [
					'{{WRAPPER}} .obfx-pricing-table-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'button_hover_box_shadow',
				'selector'  => '{{WRAPPER}} .obfx-pricing-table-button:hover',
				'separator' => '',
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label'       => __( 'Transition Duration', 'textdomain' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 0.3,
				],
				'range'       => [
					'px' => [
						'max'  => 3,
						'step' => 0.1,
					],
				],
				'render_type' => 'ui',
				'selectors'   => [
					'{{WRAPPER}} .obfx-pricing-table-button' => 'transition: all {{SIZE}}s ease;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	/**
	 * Render function to output the pricing table.
	 */
	protected function render() {
		$settings = $this->get_settings();

		$this->add_render_attribute( 'title', 'class', 'obfx-pricing-table-title' );
		$this->add_render_attribute( 'subtitle', 'class', 'obfx-pricing-table-subtitle' );
		$this->add_render_attribute( 'button', 'class', 'obfx-pricing-table-button' );
//		$this->add_render_attribute( 'button_icon', 'class', $settings['button_icon'] );
		$this->add_render_attribute( 'button_icon_align', 'class', 'obfx-button-icon-align-' . esc_attr( $settings['button_icon_align'] ) );
		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', esc_url( $settings['button_link']['url'] ) );

			if ( ! empty( $settings['button_link']['is_external'] ) ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}
			if ( ! empty( $settings['button_link']['nofollow'] ) ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}

		$output = '';

		$output .= '<div class="obfx-pricing-table-wrapper">';

		if ( ! empty( $settings['title'] ) || ! empty( $settings['subtitle'] ) ) {
			$output .= '<div class="obfx-title-wrapper">';
			if ( ! empty( $settings['title'] ) ) {
				$title_tag = $this->sanitize_tag( $settings['title_tag'], 'h3' );
				// Start of title tag.
				$output .= '<' . esc_html( $title_tag ) . ' ' . $this->get_render_attribute_string( 'title' ) . '>';

				// Title string.
				$output .= esc_html( $settings['title'] );

				// End of title tag.
				$output .= '</' . esc_html( $title_tag ) . '>';
			}
			if ( ! empty( $settings['subtitle'] ) ) {
				$subtitle_tag = $this->sanitize_tag( $settings['subtitle_tag'], 'p' );
				// Start of subtitle tag.
				$output .= '<' . esc_html( $subtitle_tag ) . ' ' . $this->get_render_attribute_string( 'subtitle' ) . '>';

				// Subtitle string.
				$output .= esc_html( $settings['subtitle'] );

				// End of subtitle tag.
				$output .= '</' . esc_html( $subtitle_tag ) . '>';

			}

			$output .= '</div> <!-- /.obfx-title-wrapper -->';
		}

		if ( ! empty( $settings['price_tag_text'] ) || ! empty( $settings['price_tag_currency'] ) || ! empty( $settings['price_tag_period'] ) ) {
			$output .= '<div class="obfx-price-wrapper">';

			if ( ! empty( $settings['price_tag_currency'] ) && ( $settings['price_tag_currency_position'] == 'left' ) ) {
				$output .= '<span class="obfx-price-currency">' . esc_html( $settings['price_tag_currency'] ) . '</span>';
			}

			if ( ( isset( $settings['price_tag_text'] ) && $settings['price_tag_text'] === '0' ) || ! empty( $settings['price_tag_text'] ) ) {
				$output .= '<span class="obfx-price">' . esc_html( $settings['price_tag_text'] ) . '</span>';
			}

			if ( ! empty( $settings['price_tag_currency'] ) && ( $settings['price_tag_currency_position'] == 'right' ) ) {
				$output .= '<span class="obfx-price-currency">' . esc_html( $settings['price_tag_currency'] ) . '</span>';
			}

			if ( ! empty( $settings['price_tag_period'] ) ) {
				$output .= '<span class="obfx-pricing-period">' . esc_html( $settings['price_tag_period'] ) . '</span>';
			}

			$output .= '</div> <!-- /.obfx-price-wrapper -->';
		}

		if ( count( $settings['feature_list'] ) ) {
			$output .= '<ul class="obfx-feature-list">';
			foreach ( $settings['feature_list'] as $feature ) {
				$output .= '<li>';

				if ( empty($feature['feature_icon']) || isset($feature['__fa4_migrated']['feature_icon_new']) ) {
					if( isset($feature['feature_icon_new']['value']['url']) ) {
						$output .= '<img class="obfx-pricing-table-feature-icon" src="'.esc_url( $feature['feature_icon_new']['value']['url'] ).'" alt="'.esc_attr(get_post_meta($feature['feature_icon_new']['value']['id'], '_wp_attachment_image_alt', true)).'"/>';
                    } else {
						$output .= '<i class="obfx-pricing-table-feature-icon '.esc_attr( $feature['feature_icon_new']['value'] ).'" aria-hidden="true"></i>';
                    }
                } else {
					$output .= '<i class="obfx-pricing-table-feature-icon ' . esc_attr( $feature['feature_icon'] ) . '"></i>';
                }

				if ( ! empty( $feature['accent'] ) ) {
					$output .= '<span class="obfx-pricing-table-accented">' . esc_html( $feature['accent'] ) . '</span>';
					$output .= ' ';
				}
				if ( ! empty( $feature['text'] ) ) {
					$output .= '<span class="obfx-pricing-table-feature">' . esc_html( $feature['text'] ) . '</span>';
				}
				$output .= '</li>';
			}
			$output .= '</ul>';
		}

		if ( ! empty( $settings['button_text'] ) ) {
			$output .= '<div class="obfx-pricing-table-button-wrapper">';

			$output .= '<a ' . $this->get_render_attribute_string( 'button' ) . '>';




			if ( $settings['button_icon_align'] == 'left' ) {
				$output .= $this->display_button_icon( $settings );
			}

			$output .= '<span class="elementor-button-text">' . esc_html( $settings['button_text'] ) . '</span>';

			if ( $settings['button_icon_align'] == 'right' ) {
				$output .= $this->display_button_icon( $settings );
			}

			$output .= '</a>';
			$output .= '</div> <!-- /.obfx-pricing-table-button-wrapper -->';

		}
		$output .= '</div> <!-- /.obfx-pricing-table-wrapper -->';

		echo $output;
	}

	private function display_button_icon($settings) {
		$output = '';
		if ( empty( $settings['button_icon'] ) || isset( $settings['__fa4_migrated']['button_icon_new'] ) ) {
			if ( isset( $settings['button_icon_new']['value']['url'] ) ) {
				$output .= '<span ' . $this->get_render_attribute_string( 'button_icon_align' ) . ' >';
				$output .= '<img src="' . esc_url( $settings['button_icon_new']['value']['url'] ) . '" alt="' . esc_attr( get_post_meta( $settings['button_icon_new']['value']['id'], '_wp_attachment_image_alt', true ) ) . '"/>';
				$output .= '</span>';
			} else {
				$output .= '<span ' . $this->get_render_attribute_string( 'button_icon_align' ) . ' >';
				$output .= '<i class="' . esc_attr( $settings['button_icon_new']['value'] ) . '" aria-hidden="true"></i>';
				$output .= '</span>';
			}
		} else {
			$output .= '<span ' . $this->get_render_attribute_string( 'button_icon_align' ) . ' >';
			$output .= '<i class="' . esc_attr( $settings['button_icon'] ) . '"></i>';
			$output .= '</span>';
		}
		return $output;
	}
}

