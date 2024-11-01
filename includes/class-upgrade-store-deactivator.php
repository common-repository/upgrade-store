<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://programmelab.com
 * @since      1.0.0
 *
 * @package    Upgrade_Store
 * @subpackage Upgrade_Store/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Upgrade_Store
 * @subpackage Upgrade_Store/includes
 * @author     ProgrammeLab <rizvi@programmelab.com>
 */
class Upgrade_Store_Deactivator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		update_option('upgrade-store_hide_admin_notice', false);

		delete_option('upgrade_store_api_attachments');
		delete_option('upgrade_store_api_woo_email');
		delete_option('upgrade_store_api_quickview');
		delete_option('upgrade_store_api_stocks_left');
		delete_option('upgrade_store_api_banner');
		delete_option('upgrade_store_api_settings');
	}
}
