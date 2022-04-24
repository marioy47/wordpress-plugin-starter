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
 */

namespace Wp_Starter; // Change the namespace!

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once __DIR__ . '/vendor/autoload.php';

$current_plugin = Plugin::factory( __FILE__ )
	->set_slug( 'this-is-the-slug' )
	->load_textdomain();

// Remove this line and delete php/class-my-test-class.php.
My_Test_Class::factory( $current_plugin )->add_hooks();


unset( $current_plugin );
