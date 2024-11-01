<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://programmelab.com
 * @since             1.0.0
 * @package           Upgrade_Store
 *
 * @wordpress-plugin
 * Plugin Name:       Upgrade Store
 * Plugin URI:        https://programmelab.com
 * Description:       Toolkits to upgrade customer experience for your WooCommerce store. Includes modules such as Product Tabs, Product Attachment, Product Notification, Quick View, Stocks Left, Stocks Left countdown, Store Banner, Product Gallery and More.
 * Version:           1.0.3
 * Author:            ProgrammeLab
 * Author URI:        https://programmelab.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       upgrade-store
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('UPGRADE_STORE_VERSION', '1.0.3');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-upgrade-store-activator.php
 */
function upgrade_store_activate()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-upgrade-store-activator.php';
	Upgrade_Store_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-upgrade-store-deactivator.php
 */
function upgrade_store_deactivate()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-upgrade-store-deactivator.php';
	Upgrade_Store_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'upgrade_store_activate');
register_deactivation_hook(__FILE__, 'upgrade_store_deactivate');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-upgrade-store.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function upgrade_store_run()
{

	$plugin = new Upgrade_Store();
	$plugin->run();
}
upgrade_store_run();






/**
 * Get information about available image sizes
 */
function get_image_sizes($size = '')
{
	$wp_additional_image_sizes = wp_get_additional_image_sizes();

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach ($get_intermediate_image_sizes as $_size) {
		if (in_array($_size, array('thumbnail', 'medium', 'large'))) {
			$sizes[$_size]['width'] = get_option($_size . '_size_w');
			$sizes[$_size]['height'] = get_option($_size . '_size_h');
			$sizes[$_size]['crop'] = (bool) get_option($_size . '_crop');
		} elseif (isset($wp_additional_image_sizes[$_size])) {
			$sizes[$_size] = array(
				'width' => $wp_additional_image_sizes[$_size]['width'],
				'height' => $wp_additional_image_sizes[$_size]['height'],
				'crop' =>  $wp_additional_image_sizes[$_size]['crop']
			);
		}
	}

	// Get only 1 size if found
	if ($size) {
		if (isset($sizes[$size])) {
			return $sizes[$size];
		} else {
			return false;
		}
	}
	return $sizes;
}
