<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Nanomag for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
add_action( 'tgmpa_register', 'shareblock_news_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function shareblock_news_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'               => esc_html__( 'shareblock Function', 'shareblock' ), // The plugin name.
			'slug'               => 'shareblock-function', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/inc/plugins/shareblock-function.zip',
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),        
        array(
            'name'      => esc_html__( 'Elementor', 'shareblock' ),
            'slug'      => 'elementor',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Contact Form 7', 'shareblock' ),
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'WooCommerce', 'shareblock' ),
            'slug'      => 'woocommerce',
            'required'  => false,
        )        
                     

        
    );

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'shareblock',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'shareblock' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'shareblock' ),
			/* translators: %s: plugin name. * /
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'shareblock' ),
			/* translators: %s: plugin name. * /
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'shareblock' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'shareblock' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'shareblock'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'shareblock'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'shareblock'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'shareblock'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'shareblock'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'shareblock'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'shareblock'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'shareblock'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'shareblock'
			),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'shareblock' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'shareblock' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'shareblock' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'shareblock' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'shareblock' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'shareblock' ),
			'dismiss'                         => esc_html__( 'Dismiss this notice', 'shareblock' ),
			'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'shareblock' ),
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'shareblock' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}
function shareblock_news_custom_message_style() {
          echo '<style type="text/css">
          #setting-error-tgmpa{display: block;}
          [id*="_home_carousel_post_widget-"],
          [id*="_home_post_list_medium_widget-"],
          [id*="_home_ajax_main_full_bellow_small_list_post_widget-"],
          [id*="_home_ajax_main_right_list_widget-"],
          [id*="_home_post_slider_widget-"],
          [id*="_home_post_slider_tab_widget-"],
          [id*="_home_post_two_columns_widget-"],
          [id*="_home_ajax_main_bellow_grid_3_col_post_widget-"],
          [id*="_home_ajax_main_bellow_list_widget-"],
          [id*="_home_ajax_grid_small_three_col_widget-"],
          [id*="_siteorigin-panels-builder-"],
          [id*="_shareblock_home_large_grid_widget-"],
          [id*="_shareblock_home_large_list_widget-"],
          [id*="_shareblock_2main_right_listwidgets-"],
          [id*="_jl_home_carousel_widget-"],
          [id*="_shareblock_home_feature_boxwidgets-"],
          [id*="_shareblock_recent_grid5_widgets-"],
          [id*="_shareblock_recent_grid6_widgets-"],
          [id*="_home_grid_overlay_widget-"],
          [id*="_shareblock_grid_right_listwidgets-"],
          [id*="_shareblock_main_b_gridwidgets-"],
          [id*="_home_post_main_right_list_widget-"],
          [id*="_home_post_newsticker_widget-"],
          [id*="_shareblock_home_small_list_widget-"],
          [id*="_shareblock_home_large_widget-"],
          [id*="_siteorigin-panels-postloop-"],
          [id*="_siteorigin-panels-post-content-"],
          [id*="_home_ajax_main2_below_post_list_widget-"],
          [id*="_home_ajax_main2_below_post_number_widget-"],
          [id*="_home_ajax_main_right_post_number_widget-"],
          [id*="_home_ajax_main_right_bellow_grid_3_col_post_widget-"],
          [id*="_home_ajax_grid_small_overlay_col_widget-"]{display: none;}
          </style>';
        }
        add_action('admin_head', 'shareblock_news_custom_message_style');



