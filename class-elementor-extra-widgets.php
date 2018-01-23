<?php
/**
 * Class ThemeIsle\ElementorExtraWidgets
 *
 * @package     ThemeIsle\ElementorExtraWidgets
 * @copyright   Copyright (c) 2017, Andrei Lupu
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace ThemeIsle;

if ( ! class_exists( '\ThemeIsle\ElementorExtraWidgets' ) ) {

	class ElementorExtraWidgets {
		/**
		 * @var ElementorExtraWidgets
		 */
		public static $instance = null;

		/**
		 * The version of this library
		 * @var string
		 */
		public static $version = '1.0.0';

		/**
		 * Defines the library behaviour
		 */
		protected function init() {
			add_action( 'elementor/init', array( $this, 'add_elementor_category' ) );
			add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_assets' ) );
			add_action( 'elementor/preview/enqueue_scripts', array( $this, 'register_assets' ) );

			add_action( 'widgets_init', array( $this, 'register_woo_widgets' ) );
			add_action( 'widgets_init', array( $this, 'register_posts_widgets' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ), 999 );

			add_action( 'elementor/widgets/widgets_registered', array( $this, 'add_elementor_widgets' ) );
		}

		/**
		 * Add the Category for Orbit Fox Widgets.
		 */
		public function add_elementor_category() {

			$category_args = apply_filters( 'elementor_extra_widgets_category_args', array(
				'slug' => 'obfx-elementor-widgets',
				'title' => __( 'Orbit Fox Addons', 'textdomain' ),
				'icon'  => 'fa fa-plug',
			) );

			\Elementor\Plugin::instance()->elements_manager->add_category(
				$category_args['slug'],
				array(
					'title' => $category_args['title'],
					'icon'  => $category_args['slug'],
				),
				1
			);

		}

		public function register_assets() {
			// Register custom JS for grid.
			wp_register_script( 'obfx-grid-js', plugins_url( '/js/obfx-grid.js', __FILE__ ), array(), $this::$version, true );
			wp_register_style( 'eaw-elementor', plugins_url( '/css/public.css', __FILE__ ), array(), $this::$version );
		}

		/**
		 * Require and instantiate Elementor Widgets.
		 *
		 * @param $widgets_manager
		 */
		public function add_elementor_widgets( $widgets_manager ) {
			$elementor_widgets = array(
				'pricing-table',
				'services',
				'posts-grid',
			);

			foreach ( $elementor_widgets as $widget ) {
				require_once dirname( __FILE__ ) . '/widgets/elementor/' . $widget . '.php';
			}

			// Pricing table
			$widget = new ElementorExtraWidgets\Pricing_Table();
			$widgets_manager->register_widget_type( $widget );
			// Services
			$widget = new ElementorExtraWidgets\Services();
			$widgets_manager->register_widget_type( $widget );
			// Posts grid
			$widget = new ElementorExtraWidgets\Posts_Grid();
			$widgets_manager->register_widget_type( $widget );
		}

		/**
		 * WooCommerce Widget section
		 *
		 * @since   1.0.0
		 * @return  void
		 */
		public function register_woo_widgets() {
			if ( ! class_exists( 'woocommerce' ) ) { // Lets not do anything unless WooCommerce is active!
				return null;
			}

			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/products-categories.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/recent-products.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/featured-products.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/popular-products.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/sale-products.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/best-products.php' );

			register_widget( 'Woo_Product_Categories' );
			register_widget( 'Woo_Recent_Products' );
			register_widget( 'Woo_Featured_Products' );
			register_widget( 'Woo_Popular_Products' );
			register_widget( 'Woo_Sale_Products' );
			register_widget( 'Woo_Best_Products' );
		}

		/**
		 * Posts Widget section
		 *
		 * @since   1.0.0
		 * @return  void
		 */
		public function register_posts_widgets() {
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/wp/eaw-posts-widget.php' );
			register_widget( 'EAW_Recent_Posts' );

			include_once( plugin_dir_path( __FILE__ ) . 'widgets/wp/eaw-posts-widget-plus.php' );
			register_widget( 'EAW_Recent_Posts_Plus' );
		}

		/**
		 *
		 * @static
		 * @since 1.0.0
		 * @access public
		 * @return ElementorExtraWidgets
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
				self::$instance->init();
			}

			return self::$instance;
		}

		/**
		 * Throw error on object clone
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'textdomain' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'textdomain' ), '1.0.0' );
		}
	}
}