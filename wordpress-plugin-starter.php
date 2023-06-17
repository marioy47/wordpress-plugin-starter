<?php
/**
 * WordPress Plugin Starter
 *
 * Add here your plugin description  and change al the fields.
 *
 * @link              https://marioyepes.com
 * @since             1.0.0
 * @package           Wordpress_Plugin_Starter
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin Starter
 * Plugin URI:        https://marioyepes.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Mario Yepes
 * Author URI:        https://marioyepes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-plugin-starter
 * Domain Path:       /languages
 * cSpell:ignore      WPINC
 */

namespace Wordpress_Plugin_Starter; // Change the namespace!

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once __DIR__ . '/vendor-prefixed/autoload.php'; // See Strauss.
require_once __DIR__ . '/vendor/autoload.php'; // for non prefixed classes.

/**
 * Plugin initialization function.
 *
 * Using a `init_plugin` function to create all objects and variables, keeps
 * the global namespace clean.
 *
 * Also, this will prevent headaches with PHPCS and PhpStan validation.
 *
 * @param Plugin $plugin Instance of the plugin class.
 * @return void Returns nothing since its just for initialization.
 */
function init_plugin( Plugin $plugin ) {
	// Set the slug if necessary and load the text domain.
	$plugin
		->set_plugin_slug( 'wordpress-plugin-starter' )
		->load_textdomain();

	My_Test_Class::factory( $plugin )->add_hooks();
	// Here you should add any initialization code needed, like
	// new classes or calling other WordPress hooks.
}

init_plugin( Plugin::factory( __FILE__ ) );
