<?php
/**
 * Plugin Loader.
 *
 * @package {{package}}
 * @since 1.1.0
 */

namespace ZIPWP_CLIENT;

use ZIPWP_CLIENT\Inc\Api\ApiInit;
use ZIPWP_CLIENT\Inc\Admin\Onboarding;
use ZIPWP_CLIENT\Inc\Admin\Dashboard;
use ZIPWP_CLIENT\Inc\Admin\SiteProtection;
use ZIPWP_CLIENT\Inc\Admin\SiteProgress;
use ZIPWP_CLIENT\Inc\Updater;

/**
 * Plugin_Loader
 *
 * @since 1.1.0
 */
class Plugin_Loader {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class Instance.
	 * @since 1.1.0
	 */
	private static $instance = null;

	/**
	 * Initiator
	 *
	 * @since 1.1.0
	 * @return object initialized object of class.
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Autoload classes.
	 *
	 * @since 1.1.0
	 * @param string $class class name.
	 *
	 * @return void
	 */
	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$class_to_load = preg_replace(
			[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
			[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
			$class
		);

		if ( empty( $class_to_load ) ) {
			return;
		}

		$filename = strtolower( $class_to_load );

		$file = ZIPWP_CLIENT_DIR . $filename . '.php';

		// if the file redable, include it.
		if ( is_readable( $file ) ) {
			require_once $file;
		}
	}

	/**
	 * Constructor
	 *
	 * @since 1.1.0
	 */
	public function __construct() {

		spl_autoload_register( [ $this, 'autoload' ] );

		add_action( 'plugins_loaded', [ $this, 'load_classes' ], 888 );
		add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
	}


	/**
	 * Loads plugin classes as per requirement.
	 *
	 * @return void
	 * @since  0.0.2
	 */
	public function load_classes() {
		ApiInit::instance();
		Dashboard::instance();
		Onboarding::instance();
		SiteProgress::instance();
		SiteProtection::instance();

		// Updater.
		Updater::instance();
	}

	/**
	 * Load Plugin Text Domain.
	 * This will load the translation textdomain depending on the file priorities.
	 *      1. Global Languages /wp-content/languages/plugin-base/ folder
	 *      2. Local dorectory /wp-content/plugins/plugin-base/languages/ folder
	 *
	 * @since 1.1.0
	 * @return void
	 */
	public function load_textdomain() {
		// Default languages directory.
		$lang_dir = ZIPWP_CLIENT_DIR . 'languages/';

		/**
		 * Filters the languages directory path to use for plugin.
		 *
		 * @param string $lang_dir The languages directory path.
		 */
		$lang_dir = apply_filters( 'zipwp_client_languages_directory', $lang_dir );

		// Traditional WordPress plugin locale filter.
		global $wp_version;

		$get_locale = get_locale();

		if ( $wp_version >= 4.7 ) {
			$get_locale = get_user_locale();
		}

		/**
		 * Language Locale for plugin
		 *
		 * Uses get_user_locale()` in WordPress 4.7 or greater,
		 * otherwise uses `get_locale()`.
		 */
		$locale = apply_filters( 'plugin_locale', $get_locale, 'zipwp-client' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'zipwp-client', $locale );

		// Setup paths to current locale file.
		$mofile_global = WP_LANG_DIR . '/plugins/' . $mofile;
		$mofile_local  = $lang_dir . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/zipwp-client/ folder.
			load_textdomain( 'zipwp-client', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/zipwp-client/languages/ folder.
			load_textdomain( 'zipwp-client', $mofile_local );
		} else {
			// Load the default language files.
			load_plugin_textdomain( 'zipwp-client', false, $lang_dir );
		}
	}
}

/**
 * Kicking this off by calling 'instance()' method
 */
Plugin_Loader::instance();
