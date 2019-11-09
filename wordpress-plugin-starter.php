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
 * Plugin Name:       wordpress-plugin-starter
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

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Rename this, and start at version 1.0.0
 *
 * @link https://semver.org
 */
define( 'WORDPRESS_PLUGIN_STARTER_VERSION', '1.0.0' );

require_once __DIR__ . '/vendor/autoload.php';
