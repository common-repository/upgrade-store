<?php

/**
 * Fired during plugin activation
 *
 * @link       https://programmelab.com
 * @since      1.0.0
 *
 * @package    Upgrade_Store
 * @subpackage Upgrade_Store/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Upgrade_Store
 * @subpackage Upgrade_Store/includes
 * @author     ProgrammeLab <rizvi@programmelab.com>
 */
class Upgrade_Store_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		$upgrade_store_api_attachments = [
			"attachment_enable_tab_name" => 1,
			"attachment_enable_tab_icon" => 1,
			// "attachment_open_in_new_tab" => 0,
			// "attachment_enable_external_url" => 0,
			"attachment_category_for" => "all",
			"attachment_categories" => [],
		];
		$upgrade_store_api_woo_email = [
			"wc_disable_low_stock_notifications" => 1,
			"wc_disable_no_stock_notifications" => 1,
			"wc_disable_product_on_backorder_notifications" => 1,
			"wc_disable_pending_processing_new_orders_notifications" => 1,
			"wc_disable_pending_completed_orders_notifications" => 1,
			"wc_disable_pending_onhold_new_orders_notifications" => 1,
			"wc_disable_failed_processing_new_orders_notifications" => 1,
			"wc_disable_failed_completed_orders_notifications" => 1,
			"wc_disable_failed_onhold_new_orders_notifications" => 1,
			"wc_disable_failed_onhold_orders_notifications" => 1,
			"wc_disable_failed_processing_orders_notifications" => 1,
			"wc_disable_pending_processing_orders_notifications" => 1,
			"wc_disable_pending_onhold_orders_notifications" => 1,
			"wc_disable_order_status_completed_notifications" => 1,
			"wc_disable_order_new_customer_note_notifications" => 1,
		];
		$upgrade_store_api_quickview = [
			'quickview_enable_cart_button' => 1,
			'quickview_enable_for_product' => 1,
			'quickview_enable_full_details' => 1,
			'quickview_enable_zoom' => 1,
			'quickview_category_for' => 'all',
			'quickview_categories' => [],
		];
		$upgrade_store_api_stocks_left = [
			'stocks_left_enable_shop_page' => 1,
			// 'stocks_left_hide_default_stock_count' => 1,
		];
		$upgrade_store_api_banner = [
			'banner_enable_shop_page' => 1,
			'shop_page_banner_image_alt' => '',
			'shop_page_banner_url' => '',
			'shop_page_banner_internal_image' => [
				'id' => '',
				'url' => '',
				'name' => ''
			],
			'shop_page_banner_url' => '',
			'shop_page_banner_external_image_url' => '',
			'banner_enable_all_product_page' => 1,
			'all_product_page_banner_image_alt' => '',
			'all_product_page_banner_url' => '',
			'all_product_page_banner_internal_image' => [
				'id' => '',
				'url' => '',
				'name' => ''
			],
			'all_product_page_banner_url' => '',
			'all_product_page_banner_external_image_url' => '',
			'banner_enable_specific_product' => 1,

		];

		$upgrade_store_api_gallery = [
			'gallery_enable_gallery_type' => 1,
			'gallery_select_gallery_type' => 'type-1',
			'gallery_enable_gallery_lock' => 1,
			'gallery_enable_for_quickview' => 1,
			'gallery_enable_specific_product' => 1,
		];

		$upgrade_store_api_settings = [
			"settings_enable_product_tab" => 1,
			"settings_enable_attachments_tab" => 1,
			"settings_enable_quickview_tab" => 1,
			"settings_enable_product_email" => 1,
			"settings_enable_countdown_timer" => 1,
			"settings_enable_stocks_left" => 1,
			"settings_enable_banner" => 1,
			"settings_enable_gallery" => 1,
		];

		update_option('upgrade_store_api_attachments', $upgrade_store_api_attachments);
		update_option('upgrade_store_api_woo_email', $upgrade_store_api_woo_email);
		update_option('upgrade_store_api_quickview', $upgrade_store_api_quickview);
		update_option('upgrade_store_api_stocks_left', $upgrade_store_api_stocks_left);
		update_option('upgrade_store_api_banner', $upgrade_store_api_banner);
		update_option('upgrade_store_api_gallery', $upgrade_store_api_gallery);
		update_option('upgrade_store_api_settings', $upgrade_store_api_settings);
		add_option('upgrade_store_do_activation_redirect', true);
	}
}
