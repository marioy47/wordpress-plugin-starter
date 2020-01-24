<?php
/**
 * Create a custom autloader that supports WP conventions.
 *
 * @package Wordpress_Plugin_Starter
 * @author Mario Yepes <marioy47@gmail.com>
 */

/**
 * Register custom autloader for just this project.
 *
 * @param string $class_name The name of the class passed by PHP.
 * @return void
 */
function wp_plugin_starter_autoloader( $class_name ) {

	$namespace = 'Wp_Starter\\';
	if ( 0 !== strpos( $class_name, $namespace ) ) {
		return;
	}

	$file_name = str_replace(
		array( $namespace, '_' ),
		array( 'class-', '-' ),
		$class_name
	);

	$path = __DIR__ . '/' . strtolower( $file_name ) . '.php';

	if ( file_exists( $path ) ) {
		require $path;
	}
}

spl_autoload_register( 'wp_plugin_starter_autoloader' );
