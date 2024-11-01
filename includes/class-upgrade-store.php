<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://programmelab.com
 * @since      1.0.0
 *
 * @package    Upgrade_Store
 * @subpackage Upgrade_Store/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Upgrade_Store
 * @subpackage Upgrade_Store/includes
 * @author     ProgrammeLab <rizvi@programmelab.com>
 */
class Upgrade_Store
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Upgrade_Store_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('UPGRADE_STORE_VERSION')) {
			$this->version = UPGRADE_STORE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'upgrade-store';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Upgrade_Store_Loader. Orchestrates the hooks of the plugin.
	 * - Upgrade_Store_i18n. Defines internationalization functionality.
	 * - Upgrade_Store_Admin. Defines all hooks for the admin area.
	 * - Upgrade_Store_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{
		require_once(ABSPATH . 'wp-admin/includes/plugin.php');

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-upgrade-store-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-upgrade-store-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-upgrade-store-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-upgrade-store-public.php';

		/**
		 * Custom Post Types
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-upgrade-store-post_types.php';

		/**
		 * Custom Post Types
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-upgrade-store-settings.php';

		$this->loader = new Upgrade_Store_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Upgrade_Store_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Upgrade_Store_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Upgrade_Store_Admin($this->get_plugin_name(), $this->get_version());

		if (!is_plugin_active('woocommerce/woocommerce.php')) {
			$this->loader->add_action('admin_notices', $plugin_admin, 'upgrade_store_woo_check');
			add_action("wp_ajax_upgrade_store_ajax_install_plugin", "wp_ajax_install_plugin");
		}

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
		// Add menu item
		$this->loader->add_action('admin_menu', $plugin_admin, 'upgrade_store_admin_menu');
		// Add Settings link to the plugin
		$plugin_basename = plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_name . '.php');
		$this->loader->add_filter('plugin_action_links_' . $plugin_basename, $plugin_admin, 'upgrade_store_add_action_links');

		//add_action( 'admin_notices', 'upgrade_store_admin_welcome_notice' );
		$this->loader->add_action('admin_notices', $plugin_admin, 'upgrade_store_admin_welcome_notice');

		$upgrade_store_api_settings = (get_option('upgrade_store_api_settings')) ? get_option('upgrade_store_api_settings') : [];


		$this->loader->add_action('woocommerce_product_data_tabs', $plugin_admin, 'upgrade_store_product_edit_tab', 10, 1);
		$this->loader->add_action('woocommerce_product_data_panels', $plugin_admin, 'upgrade_store_product_tab_field');

		if (isset($upgrade_store_api_settings['settings_enable_product_email']) && $upgrade_store_api_settings['settings_enable_product_email']) {
			// add_action( 'init', 'woo_remove_hooks' );
			$this->loader->add_action('init', $plugin_admin, 'upgrade_store_woo_remove_hooks');
		}
		$this->loader->add_action('in_admin_header', $plugin_admin, 'upgrade_store_remove_admin_notices');


		$this->loader->add_action('save_post', $plugin_admin, 'upgrade_store_save_product_meta_data', 10, 3);
		//add_filter( 'parent_file', 'wporg_func_upgrade_store_parent_file_callback' );
		$this->loader->add_filter('parent_file', $plugin_admin, 'upgrade_store_parent_file_callback', 10, 3);
		// add_action('in_admin_header', 'upgrade_store_custom_in_admin_header');
		// $this->loader->add_action('in_admin_header', $plugin_admin, 'upgrade_store_custom_in_admin_header');
		/**
		 * in_admin_header fires between <div id="wpcontent"> and <div id="wpbody"> tags, which was creating issue with 'Screen Options', so the hook is changed to all_admin_notices
		 */
		$this->loader->add_action('all_admin_notices', $plugin_admin, 'upgrade_store_custom_in_admin_header');

		$plugin_post_types = new Upgrade_Store_Post_Types();
		$plugin_settings = new Upgrade_Store_Settings();

		/**
		 * The problem with the initial activation code is that when the activation hook runs, it's after the init hook has run,
		 * so hooking into init from the activation hook won't do anything.
		 * You don't need to register the CPT within the activation function unless you need rewrite rules to be added
		 * via flush_rewrite_rules() on activation. In that case, you'll want to register the CPT normally, via the
		 * loader on the init hook, and also re-register it within the activation function and
		 * call flush_rewrite_rules() to add the CPT rewrite rules.
		 *
		 * @link https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/issues/261
		 */
		$this->loader->add_action('init', $plugin_post_types, 'create_custom_post_type', 999);
		$this->loader->add_action('admin_init', $plugin_settings, 'api_settings_init');

		/**
		 * Add metabox and register custom fields
		 *
		 * @link https://code.tutsplus.com/articles/rock-solid-wordpress-30-themes-using-custom-post-types--net-12093
		 */
		// $this->loader->add_action('admin_init', $plugin_admin, 'upgrade_store_add_attachments_tab_metabox');
		$this->loader->add_action('current_screen', $plugin_admin, 'upgrade_store_add_attachments_tab_metabox');
		$this->loader->add_action('save_post', $plugin_admin, 'upgrade_store_save_attachments_tab_metabox');


		$this->loader->add_action('wp_ajax_prefix_upgrade_store_hide_admin_notice_ajax', $plugin_admin, 'upgrade_store_hide_admin_notice_ajax');
		$this->loader->add_action('wp_ajax_nopriv_prefix_upgrade_store_hide_admin_notice_ajax', $plugin_admin, 'upgrade_store_hide_admin_notice_ajax');

		$this->loader->add_action('wp_ajax_prefix_upgrade_store_save_setting_data', $plugin_admin, 'upgrade_store_save_setting_data');

		$this->loader->add_action('wp_ajax_nopriv_prefix_upgrade_store_save_setting_data', $plugin_admin, 'upgrade_store_save_setting_data');
		$this->loader->add_action('save_post', $plugin_admin, 'upgrade_store_save_inventory_tab_metabox');
		$this->loader->add_action('save_post', $plugin_admin, 'upgrade_store_save_banner_image_tab_metabox');
		$this->loader->add_action('save_post', $plugin_admin, 'upgrade_store_save_gallery_type_metabox');


		/**
		 * Modify columns in tests list in admin area.
		 *
		 * The hooks to create custom columns and their associated data for a custom post type
		 * are manage_{$post_type}_posts_columns and
		 * manage_{$post_type}_{$post_type_type}_custom_column or manage_{$post_type_hierarchical}_custom_column respectively,
		 * where {$post_type} is the name of the custom post type and {$post_type_hierarchical} is post or page.
		 *
		 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/manage_posts_custom_column
		 * @link https://wordpress.stackexchange.com/questions/253640/adding-custom-columns-to-custom-post-types/253644#253644
		 */
		$this->loader->add_filter('manage_product-tab_posts_columns', $plugin_admin, 'upgrade_store_manage_product_tab_posts_columns');
		// $this->loader->add_action('manage_product-tab_posts_custom_column', $plugin_admin, 'upgrade_store_manage_product_tab_posts_custom_column', 10, 2);

		//add_filter('admin_body_class', 'upgrade_store_admin_body_class');
		$this->loader->add_filter('admin_body_class', $plugin_admin, 'upgrade_store_admin_body_class');
		// add_action('woocommerce_product_options_sku', 'upgrade_store_render_inventory_tab_metabox');
		$this->loader->add_action('woocommerce_product_options_sku', $plugin_admin, 'upgrade_store_render_inventory_tab_metabox');

		$this->loader->add_action('admin_init', $plugin_admin, 'upgrade_store_do_activation_redirect');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Upgrade_Store_Public($this->get_plugin_name(), $this->get_version());
		$upgrade_store_api_settings =  get_option('upgrade_store_api_settings') ? get_option('upgrade_store_api_settings') : [];

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		$this->loader->add_action('wp_ajax_prefix_upgrade_store_get_product_details', $plugin_public, 'upgrade_store_get_product_details');
		$this->loader->add_action('wp_ajax_nopriv_prefix_upgrade_store_get_product_details', $plugin_public, 'upgrade_store_get_product_details');

		$this->loader->add_action('init', $plugin_public, 'upgrade_store_customize_woo_hooks');

		$this->loader->add_action('woocommerce_single_product_summary', $plugin_public, 'upgrade_store_woo_count_down_data', 21);

		$this->loader->add_action('woocommerce_single_product_summary', $plugin_public, 'upgrade_store_woo_stocks_left_data', 22);

		$this->loader->add_action('woocommerce_after_shop_loop_item', $plugin_public, 'upgrade_store_woo_stocks_left_data_loop_item', 11);

		// $this->loader->add_action('woocommerce_after_single_product_summary', $plugin_public, 'upgrade_store_woo_count_down_data', 1);

		$this->loader->add_filter('woocommerce_product_tabs', $plugin_public, 'upgrade_store_woo_new_product_tab');
		// add_filter('woocommerce_get_stock_html', 'upgrade_store_woocommerce_stock_html', 10, 3);
		$this->loader->add_filter('woocommerce_get_stock_html', $plugin_public, 'upgrade_store_woocommerce_stock_html', 10, 2);

		$this->loader->add_shortcode("discount", $plugin_public, "upgrade_store_woo_discount");
		$this->loader->add_shortcode("quantity", $plugin_public, "upgrade_store_woo_quantity");
		//add_action('woocommerce_before_main_content', 'upgrade_store_archive_banner_image_setup');
		$this->loader->add_action('woocommerce_before_main_content', $plugin_public, 'upgrade_store_archive_banner_image_setup');

		if (isset($upgrade_store_api_settings['settings_enable_gallery'])) {
			$this->loader->add_action('wp_footer', $plugin_public, 'upgrade_store_disable_product_image_right_click');
			// add_action('init', 'upgrade_store_woocommerce_show_product_images_customization');
			$this->loader->add_action('init', $plugin_public, 'upgrade_store_woocommerce_show_product_images_customization');
		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Upgrade_Store_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
