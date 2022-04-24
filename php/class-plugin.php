<?php
/**
 * Class with utility plugin functions.
 *
 * @package Wordpress_Plugin_Starter
 */

namespace Wp_Starter;

/**
 * Class with utility plugin functions.
 */
class Plugin {

	/**
	 * Absolute path to the plugin's initial file.
	 *
	 * @var string
	 */
	protected $plugin_file_path;

	/**
	 * The version taken from the initial file.
	 *
	 * @var string
	 */
	protected $plugin_version;

	/**
	 * Hast to coincide with the one in `phpcs.xml.dist`.
	 *
	 * @var string
	 */
	protected $plugin_text_domain;

	/**
	 * Where the `.po` files will be stored. By default `/languages`.
	 *
	 * @var string
	 */
	protected $plugin_lang_dir;

	/**
	 * PLugin base name retreived from the function `plugin_basename`.
	 *
	 * @var string
	 */
	protected $plugin_basename;

	/**
	 * Plugin relative path extracted from the `plugin_file_path` variable.
	 *
	 * @var string
	 */
	protected $plugin_dirname;

	/**
	 * Plugin slug.
	 *
	 * @var string
	 */
	protected $plugin_slug;

	/**
	 * There should be only one instance of this class on the plugin.
	 *
	 * @param string $file_path Path  to the plugin's initial file.
	 */
	private function __construct( string $file_path ) {
		$this->plugin_file_path = $file_path;
		$initial_file_info      = get_file_data(
			$file_path,
			array(
				'Version'     => 'Version',
				'Text Domain' => 'Text Domain',
				'Domain Path' => 'Domain Path',
			),
			false
		);
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$this->plugin_version = time();
		} elseif ( array_key_exists( 'Version', $initial_file_info ) ) {
			$this->plugin_version = $initial_file_info['Version'];
		}
		if ( empty( $this->plugin_version ) ) {
			$this->plugin_version = time();
		}
		if ( array_key_exists( 'Text Domain', $initial_file_info ) ) {
			$this->plugin_text_domain = $initial_file_info['Text Domain'];
		}
		if ( array_key_exists( 'Domain Path', $initial_file_info ) ) {
			$this->plugin_lang_dir = $initial_file_info['Domain Path'];
		}
		$this->plugin_basename = plugin_basename( $file_path );
		$this->plugin_dirname  = basename( dirname( $file_path ) );
	}

	/**
	 * Create an instance of the `Plugin` class passing the path to the _plugin_ initial file.
	 *
	 * ```php
	 * // Usage: Call it from the initial plugin file like this:
	 * $my_plugin = Plugin::from_file_path( __FILE__ );
	 * ```
	 * And pass it to the consructor of the other classes to have access to the plugin variables:
	 *
	 * ```php
	 * Other_Class::factory( $my_plugin );
	 * ```
	 *
	 * @param string $file_path Absolute path (__FILE__) to the plugin's initial file.
	 * @return Plugin
	 */
	public static function factory( string $file_path ): self {
		static $obj;
		return isset( $obj ) ? $obj : new self( $file_path );
	}

	/**
	 * The absolute path ot the plugins initial file.
	 *
	 * @return string
	 */
	public function get_file_path(): string {
		return $this->plugin_file_path;
	}

	/**
	 * Plugin version taken from the heading comments of the initial file.
	 *
	 * - If `WP_DEBUG` is active, the it passes the current `time()`
	 * - If the `Version` item in the plugins comment is empty, it passes the `time()` 
	 *
	 * @return string
	 */
	public function get_version(): string {
		return $this->plugin_version;
	}

	/**
	 * Getter for the plugin's base name as created by `plugin_basename()`.
	 *
	 * @link https://developer.wordpress.org/reference/functions/plugin_basename/
	 * @return string
	 */
	public function get_basename(): string {
		return $this->plugin_basename;
	}

	/**
	 * Get's the plugin directory name.
	 *
	 * @return string
	 */
	public function get_dirname(): string {
		return $this->plugin_dirname;
	}

	/**
	 * Get's the plugin slug.
	 *
	 * **The plugin slug has to be set manually using `set_slug()`. Otherwise you'll get an error**.
	 *
	 * @return string
	 */
	public function get_slug(): string {
		if ( empty( $this->plugin_slug ) ) {
			_doing_it_wrong( __FUNCTION__, 'You have to specify the plugin slug first', 1 );
		}
		return $this->plugin_slug;
	}

	/**
	 * Set the plugin slug in case you need it for URL params.
	 *
	 * @param string $slug The new plugin slug. Example: `my-custom-plugin-slug`.
	 * @return self
	 */
	public function set_slug( $slug ): self {
		$this->plugin_slug = sanitize_title( $slug );
		return $this;
	}

	/**
	 * Loads the language strings from a po file.
	 *
	 * The comments on the initial file have to be set for this to work:
	 *
	 * @link https://developer.wordpress.org/plugins/plugin-basics/header-requirements/#header-fields
	 *
	 * @return self
	 */
	public function load_textdomain(): self {
		if ( empty( $this->plugin_lang_dir ) ) {
			_doing_it_wrong( __FUNCTION__, 'No "Domain Path" found in the plugin\'s file heading', esc_attr( $this->plugin_version ) );
		}
		if ( empty( $this->plugin_text_domain ) ) {
			_doing_it_wrong( __FUNCTION__, 'No "Text Domain" assigned in the plugin\'s file heading', esc_attr( $this->plugin_version ) );
		}
		$dir = trim( $this->plugin_lang_dir, DIRECTORY_SEPARATOR );
		load_plugin_textdomain( $this->plugin_text_domain, false, $this->plugin_dirname . DIRECTORY_SEPARATOR . $dir );
		return $this;
	}
}
