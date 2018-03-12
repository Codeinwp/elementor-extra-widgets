<?php

namespace ThemeIsle\ElementorExtraWidgets;

class Typed_Headline_Placeholder extends Premium_Placeholder {

	public function get_title() {
		return 'Typed Headline';
	}

	public function get_pro_element_name() {
		return 'typed-headline';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-accordion';
	}
}