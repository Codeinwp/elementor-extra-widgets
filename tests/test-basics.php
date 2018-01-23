<?php
/**
 * Basic Tests
 *
 * @package ThemeIsle\ElementorExtraWidgets
 */

/**
 * Test functions in register.php
 */
class Plugin_Test extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		wp_set_current_user( $this->factory->user->create( [ 'role' => 'administrator' ] ) );

		do_action( 'init' );
		do_action( 'plugins_loaded' );
	}

	/**
	 * Tests test_library_availability().
	 *
	 * @covers ElementorExtraWidgets::instance();
	 */
	function test_library_availability() {
		$this->assertTrue( class_exists( '\ThemeIsle\ElementorExtraWidgets') );
	}

	/**
	 * Test the right type of class instance
	 *
	 * @covers ElementorExtraWidgets::instance();
	 */
	public function test_getInstance() {
		$this->assertInstanceOf( '\Themeisle\ElementorExtraWidgets', \Themeisle\ElementorExtraWidgets::instance() );
	}

	/**
	 * Test if the library version is the same from the composer.json
	 *
	 * @covers ElementorExtraWidgets::$version
	 */
	function test_version() {
		$composer_version = json_decode( file_get_contents( dirname( dirname( __FILE__ ) ) . '/composer.json' ) );
		$this->assertTrue( $composer_version->version === \ThemeIsle\ElementorExtraWidgets::$version );
	}

	/**
	 * Test if the class enqueues the required assets
	 * @covers ElementorExtraWidgets::register_assets
	 */
	public function test_assets_enqueue() {
		$this->assertFalse( wp_script_is( 'obfx-grid-js', 'registered' ) );
		$this->assertFalse( wp_style_is( 'eaw-elementor', 'registered' ) );
	}

	/**
	 * @expectedIncorrectUsage __clone
	 */
	public function test_Clone() {
		$obj_cloned = clone \Themeisle\ElementorExtraWidgets::$instance;
	}

	/**
	 * @expectedIncorrectUsage __wakeup
	 */
	public function test_Wakeup() {
		unserialize( serialize( \Themeisle\ElementorExtraWidgets::$instance ) );
	}
}