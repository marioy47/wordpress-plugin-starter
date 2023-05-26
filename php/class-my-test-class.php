<?php
/**
 * Test Class.
 *
 * This is just an example. This file shouldn't be shipped in your plugin.
 *
 * @package Wordpress_Plugin_Starter
 */

namespace Wp_Starter;

/**
 * This is a pretty empty class. Use it as a template for new classes.
 */
class My_Test_Class {

	/**
	 * Local instance of the Plugin object.
	 *
	 * @var Plugin
	 */
	protected $plugin;
	/**
	 * Singleton.
	 * You have to use the factory method.
	 *
	 * @param Plugin $plugin Instance of the plugin class.
	 */
	private function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Factory.
	 * Creates instances without the need of the 'new' keyword.
	 *
	 * @param Plugin $plugin Instance of the plugin class.
	 * @return self
	 */
	public static function factory( Plugin $plugin ): self {
		static $obj;
		return isset( $obj ) ? $obj : $obj = new self( $plugin );
	}

	/**
	 * Add your WordPress hooks here.
	 *
	 * @return self
	 */
	public function add_hooks(): self {
		add_action( 'wp_footer', array( $this, 'footer_changes' ) );
		return $this;
	}

	/**
	 * Execute the 'init' hoook added in wp_hooks.
	 *
	 * @return self
	 */
	public function footer_changes(): self {
		// Translators: The path to the current plugin.
		$message = sprintf( __( 'This content was added by "%s"', 'wordpress-plugin-starter' ), $this->plugin->get_file_path() );
		echo '<div style="color: red; background-color: white;">' . esc_html( $message ) . '</div>';
		return $this;
	}
}
