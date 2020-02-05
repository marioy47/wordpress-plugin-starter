<?php
/**
 * Test Class.
 *
 * @package Wordpress_Plugin_Starter
 */

namespace Wp_Starter;

/**
 * This is a pretty empty class. Use it as a template for new classes.
 */
class My_Test_Class {
	/**
	 * Singleton.
	 * You have to use the factory method.
	 */
	private function __construct() {

	}

	/**
	 * Factory.
	 * Creates instances without the need of the 'new' keyword.
	 *
	 * @return self
	 */
	public static function factory(): self {
		static $obj;
		return isset( $obj ) ? $obj : $obj = new self();
	}

	/**
	 * Add your WordPress hooks here.
	 *
	 * @return self
	 */
	public function wp_hooks(): self {
		add_action( 'wp_footer', array( $this, 'footer_changes' ) );
		return $this;
	}

	/**
	 * Execute the 'init' hoook added in wp_hooks.
	 *
	 * @return self
	 */
	public function footer_changes(): self {
		echo '<div style="color: red; background-color: white;">This content was added the by WordPress Plugin Starter</div>';
		return $this;
	}
}
