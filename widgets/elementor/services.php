<?php
/**
 * Services widget for Elementor builder
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
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Repeater;
use ThemeIsle\ElementorExtraWidgets\Traits\Sanitization;

/**
 * Class Services
 *
 * @package ThemeIsle\ElementorExtraWidgets
 */
class Services extends Widget_Base {
	use Sanitization;

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'obfx-services';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Services', 'textdomain' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-star';
	}

	/**
	 * Retrieve the list of styles the services widget depended on.
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
		$this->services_content();
		$this->style_icon();
		$this->style_grid_options();
	}

	/**
	 * Content controls
	 */
	private function services_content() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Services', 'textdomain' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
            'type',
            [
                'label'   => __( 'Type', 'textdomain' ),
                'type'    => Controls_Manager::CHOOSE,
                'label_block' => true,
                'default' => 'icon',
                'options'   => [
                    'icon'   => [
                        'title' => __( 'Icon', 'textdomain' ),
                        'icon'  => 'fa fa-icons',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'textdomain' ),
                        'icon'  => 'fa fa-photo',
                    ],
                ],
            ]
        );

		$repeater->add_control(
            'title',
            [
                'label'   => __( 'Title & Description', 'textdomain' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Service Title', 'textdomain' ),
            ]
        );

		$repeater->add_control(
            'text',
            [
	            'type'        => Controls_Manager::TEXTAREA,
	            'placeholder' => __( 'Plan Features', 'textdomain' ),
	            'default'     => __( 'Feature', 'textdomain' ),
            ]
        );

		$repeater->add_control(
            'icon_new',
            [
	            'label'       => __( 'Icon', 'textdomain' ),
	            'type' => Controls_Manager::ICONS,
                'default' => [
	                'value' => 'fas fa-gem',
	                'library' => 'solid',
                ],
	            'fa4compatibility' => 'icon',
	            'condition' => [
		            'type' => 'icon',
	            ],
            ]
        );

		$repeater->add_control(
            'color',
            [
	            'label'       => __( 'Icon Color', 'textdomain' ),
	            'type'        => Controls_Manager::COLOR,
	            'label_block' => false,
	            'default'     => '#333333',
	            'condition' => [
		            'type' => 'icon',
	            ],
            ]
        );

		$repeater->add_control(
            'image',
            [
	            'label'   => __( 'Image', 'textdomain' ),
	            'type'    => Controls_Manager::MEDIA,
	            'condition' => [
		            'type' => 'image',
	            ],
            ]
        );

		$repeater->add_control(
            'link',
            [
	            'label'       => __( 'Link to', 'textdomain' ),
	            'type'        => Controls_Manager::URL,
	            'separator' => 'before',
	            'placeholder' => __( 'https://example.com', 'textdomain' ),
            ]
        );

		$this->add_control(
			'services_list',
			[
				'label'       => __( 'Services', 'textdomain' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => [
					[
						'title' => __( 'Award-Winning​', 'textdomain' ),
						'text'  => __( 'Add some text here to describe your services to the page visitors.​', 'textdomain' ),
						'icon_new'  => [
							'value' => 'fas fa-trophy',
							'library' => 'solid',
                        ],
						'color' => '#333333',
						'type' => 'icon',
					],
					[
						'title' => __( 'Professional​', 'textdomain' ),
						'text'  => __( 'Add some text here to describe your services to the page visitors.​', 'textdomain' ),
						'icon_new'  => [
							'value' => 'fas fa-suitcase',
							'library' => 'solid',
						],
						'color' => '#333333',
						'type' => 'icon',
					],
					[
						'title' => __( 'Consulting​', 'textdomain' ),
						'text'  => __( 'Add some text here to describe your services to the page visitors.​', 'textdomain' ),
						'icon_new'  => [
							'value' => 'fas fa-handshake',
							'library' => 'solid',
						],
						'color' => '#333333',
						'type' => 'icon',
					],
				],
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{title}}',
			]
		);

		$this->add_control(
			'align',
			[
				'label'     => '<i class="fa fa-arrows"></i> ' . __( 'Icon Position', 'textdomain' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'textdomain' ),
						'icon'  => 'fa fa-angle-left',
					],
					'top' => [
						'title' => __( 'Top', 'textdomain' ),
						'icon'  => 'fa fa-angle-up',
					],
					'right'  => [
						'title' => __( 'Right', 'textdomain' ),
						'icon'  => 'fa fa-angle-right',
					],
				],
				'default'   => 'top',
				'prefix_class' => 'obfx-position-',
				'toggle' => false,
			]
		);

		// Columns.
		$this->add_responsive_control(
			'grid_columns',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => '<i class="fa fa-columns"></i> ' . __( 'Columns', 'textdomain' ),
				'default'        => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'options'        => [
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Icon Style Controls
	 */
	private function style_icon() {
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon / Image', 'textdomain' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'textdomain' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.obfx-position-right .obfx-icon, {{WRAPPER}}.obfx-position-right .obfx-image' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.obfx-position-left .obfx-icon, {{WRAPPER}}.obfx-position-left .obfx-image' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.obfx-position-top .obfx-icon, {{WRAPPER}}.obfx-position-top .obfx-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Size', 'textdomain' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'default' => [
					'size' => 35,
				],
				'selectors' => [
					'{{WRAPPER}} i.obfx-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} img.obfx-icon' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .obfx-image' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'textdomain' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'textdomain' ),
				'type' => Controls_Manager::CHOOSE,
				'toggle' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'textdomain' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'textdomain' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'textdomain' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .obfx-grid .obfx-grid-container .obfx-grid-wrapper .obfx-service-box' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
					'{{WRAPPER}} .obfx-grid .obfx-grid-container .obfx-grid-wrapper .obfx-service-box .obfx-service-text' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'textdomain' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'textdomain' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .obfx-service-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'textdomain' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .obfx-service-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .obfx-service-title',
				'scheme' => Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'textdomain' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'textdomain' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .obfx-service-text' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .obfx-service-text',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Grid Style Controls
	 */
	private function style_grid_options() {
		$this->start_controls_section(
			'section_grid_style',
			[
				'label' => __( 'Grid', 'textdomain' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Columns margin.
		$this->add_control(
			'grid_style_columns_margin',
			[
				'label'     => __( 'Columns margin', 'textdomain' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 15,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .obfx-grid-wrapper'   => 'padding-right: calc( {{SIZE}}{{UNIT}} ); padding-left: calc( {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .obfx-grid-container' => 'margin-left: calc( -{{SIZE}}{{UNIT}} ); margin-right: calc( -{{SIZE}}{{UNIT}} );',
				],
			]
		);

		// Row margin.
		$this->add_control(
			'grid_style_rows_margin',
			[
				'label'     => __( 'Rows margin', 'textdomain' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 30,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .obfx-grid-wrapper' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Background.
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'grid_style_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .obfx-grid',
			]
		);

		// Items options.
		$this->add_control(
			'grid_items_style_heading',
			[
				'label'     => __( 'Items', 'textdomain' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Items internal padding.
		$this->add_control(
			'grid_items_style_padding',
			[
				'label'      => __( 'Padding', 'textdomain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .obfx-grid-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Items border radius.
		$this->add_control(
			'grid_items_style_border_radius',
			[
				'label'      => __( 'Border Radius', 'textdomain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .obfx-grid-col' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->items_style_tabs();
		$this->end_controls_section();
	}

	/**
	 * Items Style Controls
	 */
	private function items_style_tabs() {
		$this->start_controls_tabs( 'tabs_background' );

		$this->start_controls_tab(
			'tab_background_normal',
			[
				'label' => __( 'Normal', 'textdomain' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'grid_items_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .obfx-service-box',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'grid_items_box_shadow',
				'selector'  => '{{WRAPPER}} .obfx-service-box',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_background_hover',
			[
				'label' => __( 'Hover', 'textdomain' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'grid_items_background_hover',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .obfx-service-box:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'grid_items_box_shadow_hover',
				'selector'  => '{{WRAPPER}} .obfx-service-box:hover',
			]
		);

		$this->add_control(
			'hover_transition',
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
				'selectors'   => [
					'{{WRAPPER}} .obfx-service-box' => 'transition: all {{SIZE}}s ease;',
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

		$grid_columns_mobile = ! empty( $settings['grid_columns_mobile'] ) ? ' obfx-grid-mobile-' . $this->sanitize_numeric( $settings['grid_columns_mobile'], 1 ) : '';
		$grid_columns_tablet = ! empty( $settings['grid_columns_tablet'] ) ? ' obfx-grid-tablet-' . $this->sanitize_numeric( $settings['grid_columns_tablet'], 2 ) : '';
		$grid_columns = ! empty( $settings['grid_columns'] ) ? ' obfx-grid-desktop-' . $this->sanitize_numeric( $settings['grid_columns'], 3 ) : '';

		echo '<div class="obfx-grid"><div class="obfx-grid-container' . $grid_columns_mobile . $grid_columns_tablet . $grid_columns . '">';
		foreach ( $settings['services_list'] as $service ) {
			if ( ! empty( $service['link']['url'] ) ) {
				$this->add_render_attribute( 'link', 'href', $service['link']['url'] );

				if ( $service['link']['is_external'] ) {
					$this->add_render_attribute( 'link', 'target', '_blank' );
				}

				if ( $service['link']['nofollow'] ) {
					$this->add_render_attribute( 'link', 'rel', 'nofollow' );
				}
			} ?>
			<div class="obfx-grid-wrapper">
				<?php
				if ( ! empty( $service['link']['url'] ) ) {
					$link_props = ' href="' . esc_url( $service['link']['url'] ) . '" ';
					if ( $service['link']['is_external'] === 'on' ) {
						$link_props .= ' target="_blank" ';
					}
					if ( $service['link']['nofollow'] === 'on' ) {
						$link_props .= ' rel="nofollow" ';
					}
					echo '<a' . $link_props . '>';
				} ?>
				<div class="obfx-service-box obfx-grid-col">
					<?php
					if ( $service['type'] === 'icon' ) {
						if ( empty( $service['icon'] ) || isset( $service['__fa4_migrated']['icon_new'] ) ) {
							if ( isset( $service['icon_new']['value']['url'] ) ) {
								echo '<span class="obfx-icon-wrap"><img class="obfx-icon" src="' . esc_url( $service['icon_new']['value']['url'] ) . '" alt="' . esc_attr( get_post_meta( $service['icon_new']['value']['id'], '_wp_attachment_image_alt', true ) ) . '"/></span>';
							} else {
								echo '<span class="obfx-icon-wrap"><i class="obfx-icon ' . esc_attr( $service['icon_new']['value'] ) . '" aria-hidden="true" style="color:' . esc_attr( $service['color'] ) . '"></i></span>';
							}
						} else {
							echo '<span class="obfx-icon-wrap"><i class="obfx-icon ' . esc_attr( $service['icon'] ) . '" style="color: ' . esc_attr( $service['color'] ) . '"></i></span>';
						}
					} elseif ( $service['type'] === 'image' && ! empty( $service['image']['url'] ) ) { ?>
						<span class="obfx-image-wrap"><img class="obfx-image" src="<?php echo esc_url( $service['image']['url'] ); ?>" alt="<?php echo esc_attr( get_post_meta( $service['image']['id'], '_wp_attachment_image_alt', true ) ); ?>"/></span>
						<?php
					}
					if ( ! empty( $service['title'] ) || ! empty( $service['text'] ) ) { ?>
						<div class="obfx-service-box-content">
							<?php if ( ! empty( $service['title'] ) ) { ?>
								<h4 class="obfx-service-title"><?php echo esc_attr( $service['title'] ); ?></h4>
								<?php
							}
							if ( ! empty( $service['text'] ) ) { ?>
								<p class="obfx-service-text"><?php echo esc_attr( $service['text'] ); ?></p>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
				<?php
				if ( ! empty( $service['link'] ) ) {
					echo '</a>';
				} ?>
			</div>
			<?php
		}
		echo '</div></div>';
	}
}
