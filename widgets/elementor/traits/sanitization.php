<?php
/**
 * Sanitization functions for Elementor builder
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    ThemeIsle\ElementorExtraWidgets
 */
namespace ThemeIsle\ElementorExtraWidgets\Traits;

trait Sanitization {
	/**
	 * Sanitize tag output to only the allowed values.
	 *
	 * @param string $tag     Tag to sanitize.
	 * @param string $default Default tag. Defaults to 'p'.
	 *
	 * @return string
	 */
	private function sanitize_tag( $tag, $default = 'p' ) {
		$allowed_tags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p' ];
		return in_array( $tag, $allowed_tags ) ? $tag : $default;
	}

	/**
	 * Sanitize a numeric value.
	 *
	 * @param mixed $value Value to sanitize.
	 * @param int $default Default value. Defaults to 0.
	 *
	 * @return int
	 */
	private function sanitize_numeric( $value, $default = 0 ) {
		return is_numeric( $value ) ? $value : $default;
	}
}
