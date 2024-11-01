<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://programmelab.com
 * @since      1.0.0
 *
 * @package    Upgrade_Store
 * @subpackage Upgrade_Store/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Upgrade_Store
 * @subpackage Upgrade_Store/admin
 * @author     ProgrammeLab <rizvi@programmelab.com>
 */
class Upgrade_Store_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Upgrade_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Upgrade_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name . '-jquery.datetimepicker', plugin_dir_url(__FILE__) . 'plugins/jquery.datetimepicker/jquery.datetimepicker.css', array(), $this->version, 'all');

		wp_enqueue_style('select2', plugin_dir_url(__FILE__) . 'plugins/select2/css/select2.min.css', array(), $this->version, 'all');

		wp_enqueue_style('toastr', plugin_dir_url(__FILE__) . 'plugins/toastr/toastr.min.css', array(), $this->version, 'all');

		// wp_enqueue_style('hint-css', plugin_dir_url(__FILE__) . 'plugins/cool-hint-css/src/hint-css.css', array(), $this->version, 'all');

		wp_enqueue_style('hint-css', plugin_dir_url(__FILE__) . 'plugins/cool-hint-css/src/hint.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name . '-fancyapps', plugin_dir_url(__FILE__) . '../public/plugins/fancybox/fancybox.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/upgrade-store-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Upgrade_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Upgrade_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script('jquery-ui-tooltip');
		wp_enqueue_media();

		wp_enqueue_script($this->plugin_name . '-jquery.datetimepicker', plugin_dir_url(__FILE__) . 'plugins/jquery.datetimepicker/jquery.datetimepicker.js', array('jquery'), $this->version, false);

		wp_enqueue_script('select2', plugin_dir_url(__FILE__) . 'plugins/select2/js/select2.min.js', array('jquery'), $this->version, false);

		wp_enqueue_script('toastr', plugin_dir_url(__FILE__) . 'plugins/toastr/toastr.min.js', array('jquery'), $this->version, false);

		wp_enqueue_script('jquery.validate', plugin_dir_url(__FILE__) . 'plugins/jquery.validate/jquery.validate.min.js', array('jquery'), $this->version, false);

		// wp_enqueue_script('hint-css', plugin_dir_url(__FILE__) . 'plugins/cool-hint-css/src/hint-css.js', array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name . '-fancyapps', plugin_dir_url(__FILE__) . '../public/plugins/fancybox/fancybox.umd.js', array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name . '-ajax', plugin_dir_url(__FILE__) . 'js/upgrade-store-admin-ajax.js', array('jquery'), $this->version, false);
		$ajax_params = array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'security' => esc_attr(wp_create_nonce('upgrade_store_security_nonce')),
		);
		wp_localize_script($this->plugin_name . '-ajax', 'ajax_obj', $ajax_params);

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/upgrade-store-admin.js', array('jquery'), $this->version, false);
	}
	public function upgrade_store_woo_check()
	{

		if (current_user_can('activate_plugins')) {
			if (!is_plugin_active('woocommerce/woocommerce.php') && !file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
?>
				<div id="message" class="error">
					<?php /* translators: %1$s: WooCommerce plugin url start, %2$s: WooCommerce plugin url end */ ?>
					<p><?php printf(esc_html__('Upgrade Store requires %1$s WooCommerce %2$s to be activated.', 'upgrade-store'), '<strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a></strong>'); ?></p>
					<p><a id="upgrade_store_wooinstall" class="install-now button" data-plugin-slug="woocommerce"><?php esc_html_e('Install Now', 'upgrade-store'); ?></a></p>
				</div>

				<script>
					jQuery(document).on('click', '#upgrade_store_wooinstall', function(e) {
						e.preventDefault();
						var current = jQuery(this);
						var plugin_slug = current.attr("data-plugin-slug");
						var ajax_url = '<?php echo esc_url(admin_url('admin-ajax.php')) ?>';

						current.addClass('updating-message').text('Installing...');

						var data = {
							action: 'upgrade_store_ajax_install_plugin',
							_ajax_nonce: '<?php echo esc_attr(wp_create_nonce('updates')); ?>',
							slug: plugin_slug,
						};

						jQuery.post(ajax_url, data, function(response) {
								current.removeClass('updating-message');
								current.addClass('updated-message').text('Installing...');
								current.attr("href", response.data.activateUrl);
							})
							.fail(function() {
								current.removeClass('updating-message').text('Install Failed');
							})
							.always(function() {
								current.removeClass('install-now updated-message').addClass('activate-now button-primary').text('Activating...');
								current.unbind(e);
								current[0].click();
							});
					});
				</script>

			<?php
			} elseif (!is_plugin_active('woocommerce/woocommerce.php') && file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
			?>

				<div id="message" class="error">
					<?php /* translators: %1$s: WooCommerce plugin url start, %2$s: WooCommerce plugin url end */ ?>
					<p><?php printf(esc_html__('Upgrade Store requires %1$s WooCommerce %2$s to be activated.', 'upgrade-store'), '<strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a></strong>'); ?></p>
					<p><a href="<?php echo esc_url(get_admin_url()); ?>plugins.php?_wpnonce=<?php echo esc_attr(wp_create_nonce('activate-plugin_woocommerce/woocommerce.php')); ?>&action=activate&plugin=woocommerce/woocommerce.php" class="button activate-now button-primary"><?php esc_html_e('Activate', 'upgrade-store'); ?></a></p>
				</div>
			<?php
			} elseif (version_compare(get_option('woocommerce_db_version'), '2.5', '<')) {
			?>

				<div id="message" class="error">
					<?php /* translators: %1$s: strong tag start, %2$s: strong tag end, %3$s: plugin url start, %4$s: plugin url end */ ?>
					<p><?php printf(esc_html__('%1$sUpgrade Store is inactive.%2$s This plugin requires WooCommerce 2.5 or newer. Please %3$supdate WooCommerce to version 2.5 or newer%4$s', 'upgrade-store'), '<strong>', '</strong>', '<a href="' . esc_url(admin_url('plugins.php')) . '">', '&nbsp;&raquo;</a>'); ?></p>
				</div>

				<?php
			}
		}
	}
	public function upgrade_store_admin_menu()
	{
		add_menu_page(
			esc_html__('Upgrade Store', 'upgrade-store'),
			esc_html__('Upgrade Store', 'upgrade-store'),
			'manage_options',
			$this->plugin_name,
			array($this, 'upgrade_store_dashboard_page_html'),
			plugin_dir_url(__DIR__) . 'admin/images/icon-20.svg',
			57
		);


		add_submenu_page(
			'upgrade-store',
			'Welcome',
			'Welcome',
			'manage_options',
			$this->plugin_name . '-welcome',
			array($this, 'upgrade_store_welcome_options_page_html')
		);

		// add_submenu_page('upgrade-store', esc_html__('Dashboard', 'upgrade-store'), esc_html__('Dashboard', 'upgrade-store'), 'manage_options', 'upgrade-store', array($this, 'upgrade_store_dashboard_page_html'));

		add_submenu_page('edit.php?post_type=product-tab', esc_html__('Product Attachment', 'upgrade-store'), esc_html__('Product Attachment', 'upgrade-store'), 'manage_options', 'upgrade-store' . '-attachment', array($this, 'upgrade_store_overview_options_page_html'));

		add_submenu_page('edit.php?post_type=product-tab', esc_html__('Product Notifications', 'upgrade-store'), esc_html__('Product Notifications', 'upgrade-store'), 'manage_options', 'upgrade-store' . '-woo-email', array($this, 'upgrade_store_woo_email_options_page_html'));

		add_submenu_page('edit.php?post_type=product-tab', esc_html__('Quick View', 'upgrade-store'), esc_html__('Quick View', 'upgrade-store'), 'manage_options', 'upgrade-store' . '-quickview', array($this, 'upgrade_store_quickview_options_page_html'));

		add_submenu_page('edit.php?post_type=product-tab',  esc_html__('Settings', 'upgrade-store'),  esc_html__('Settings', 'upgrade-store'), 'manage_options', 'upgrade-store' . '-settings', array($this, 'upgrade_store_settings_options_page_html'));

		add_submenu_page('edit.php?post_type=product-tab',  esc_html__('Stocks Left', 'upgrade-store'),  esc_html__('Stocks Left', 'upgrade-store'), 'manage_options', 'upgrade-store' . '-stocks-left', array($this, 'upgrade_store_stocks_left_options_page_html'));

		add_submenu_page('edit.php?post_type=product-tab',  esc_html__('Banner', 'upgrade-store'),  esc_html__('Banner', 'upgrade-store'), 'manage_options', 'upgrade-store' . '-banner', array($this, 'upgrade_store_banner_options_page_html'));

		add_submenu_page('edit.php?post_type=product-tab',  esc_html__('Gallery', 'upgrade-store'),  esc_html__('Gallery', 'upgrade-store'), 'manage_options', 'upgrade-store' . '-gallery', array($this, 'upgrade_store_gallery_options_page_html'));

		// add_submenu_page(null, 'Welcome', 'Welcome', 'manage_options', 'upgrade-store' . '-welcome', array($this, 'upgrade_store_welcome_options_page_html'));
	}
	public function upgrade_store_welcome_options_page_html()
	{
		include_once('partials/' . $this->plugin_name . '-admin-display-welcome.php');
	}
	public function upgrade_store_dashboard_page_html()
	{
		include_once('partials/' . $this->plugin_name . '-admin-display-dashboard.php');
	}
	public function upgrade_store_overview_options_page_html()
	{
		include_once('partials/' . $this->plugin_name . '-admin-display-attachment.php');
	}
	public function upgrade_store_woo_email_options_page_html()
	{
		include_once('partials/' . $this->plugin_name . '-admin-display-woo-email.php');
	}
	public function upgrade_store_quickview_options_page_html()
	{
		include_once('partials/' . $this->plugin_name . '-admin-display-quickview.php');
	}
	public function upgrade_store_stocks_left_options_page_html()
	{
		include_once('partials/' . $this->plugin_name . '-admin-display-stocks-left.php');
	}
	public function upgrade_store_banner_options_page_html()
	{
		include_once('partials/' . $this->plugin_name . '-admin-display-banner.php');
	}
	public function upgrade_store_gallery_options_page_html()
	{
		include_once('partials/' . $this->plugin_name . '-admin-display-gallery.php');
	}
	public function upgrade_store_settings_options_page_html()
	{
		include_once('partials/' . $this->plugin_name . '-admin-display-settings.php');
	}


	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function upgrade_store_add_action_links($links)
	{

		/**
		 * Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		 * The "plugins.php" must match with the previously added add_submenu_page first option.
		 * For custom post type you have to change 'plugins.php?page=' to 'edit.php?post_type=your_custom_post_type&page='
		 */
		$settings_link = array('<a href="' . admin_url('admin.php?page=' . $this->plugin_name . '-settings') . '">' . esc_html__('Settings', 'upgrade-store') . '</a>',);

		// -- OR --

		// $settings_link = array( '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . esc_html__( 'Settings', 'upgrade-store' ) . '</a>', );

		return array_merge($settings_link, $links);
	}
	public function upgrade_store_admin_welcome_notice()
	{
		$current_screen = get_current_screen();
		if (is_plugin_active('woocommerce/woocommerce.php')) {
			if ($current_screen->id == "dashboard" || $current_screen->id == "plugins") {
				$icon = plugins_url('/images/notice-icon.png', __FILE__);
				$hide_admin_notice = get_option($this->plugin_name . '_hide_admin_notice');
				if (!$hide_admin_notice) :
				?>
					<div class="notice notice-success upgrade-store-notice">
						<div class="wrapper">
							<?php if ($icon) : ?>
								<div class="part-img"><img src="<?php echo esc_url($icon) ?>" alt=""></div>
							<?php endif ?>
							<div class="part-text">
								<h4><?php echo esc_html__("You're almost there", 'upgrade-store') ?></h4>
								<p><?php printf(esc_html__('Elevate your online store with our WooCommerce extension "Upgrade Store". Unlock powerful features to optimize sales, streamline operations, and enhance customer experience. %1$sTake your e-commerce business to new heights effortlessly.', 'upgrade-store'), '<br/>'); ?></p>
								<div class="upgrade-store-button-group">
									<a href="<?php echo esc_url(admin_url('/admin.php?page=upgrade-store-settings')) ?>" class="button button-primary"><?php echo esc_html__("Get Started", 'upgrade-store') ?></a>
									<a href="<?php echo esc_url('https://www.programmelab.com/?utm_source=org&utm_medium=notice&utm_campaign=first-install') ?>" class="button button-link" target="_blank">
										<span class="text-part"><?php echo esc_html__("Learn More", 'upgrade-store') ?></span>
										<svg width="20" height="6" viewBox="0 0 20 6" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M20 3L15 0.113249V5.88675L20 3ZM0 3.5H15.5V2.5H0V3.5Z" fill="#0071AD" fill-opacity="0.5" />
										</svg>
									</a>
								</div>
							</div>
						</div>
						<button type="button" class="notice-dismiss upgrade-store-notice-dismiss"><span class="screen-reader-text"><?php echo esc_html__("Dismiss this notice.", 'upgrade-store') ?></span></button>
					</div>
			<?php
				endif;
			}
		}
	}

	/**
	 * Product Add/Edit custom tabs
	 *
	 * @param array $default_tabs tabs.
	 *
	 * @return array $default_tabs
	 */
	public function upgrade_store_product_edit_tab($default_tabs)
	{
		$upgrade_store_api_settings = (get_option('upgrade_store_api_settings')) ? get_option('upgrade_store_api_settings') : [];
		$upgrade_store_api_banner = get_option('upgrade_store_api_banner') ? get_option('upgrade_store_api_banner') : [];
		$tabs = [];
		if (isset($upgrade_store_api_settings["settings_enable_product_tab"])) {
			$tabs['upgrade_store_product_tabs'] = array(
				'label'       => esc_html__('Product Tabs', 'upgrade-store'),
				'target'      => 'upgrade_store_product_tabs', // ID of tab field
				'priority'    => 9999,
				'class'       => array(),
			);
		}
		if (isset($upgrade_store_api_settings["settings_enable_countdown_timer"])) {
			$tabs['upgrade_store_countdown_timer'] = array(
				'label'       => esc_html__('Countdown Timer', 'upgrade-store'),
				'target'      => 'upgrade_store_countdown_timer', // ID of tab field
				'priority'    => 9999,
				'class'       => array(),
			);
		}
		if (isset($upgrade_store_api_settings['settings_enable_banner']) && isset($upgrade_store_api_banner['banner_enable_all_product_page']) && isset($upgrade_store_api_banner['banner_enable_specific_product'])) {
			$tabs['upgrade_store_banner_image'] = array(
				'label'       => esc_html__('Banner Image', 'upgrade-store'),
				'target'      => 'upgrade_store_banner_image', // ID of tab field
				'priority'    => 9999,
				'class'       => array(),
			);
		}
		$default_tabs = array_merge($default_tabs, $tabs);
		return $default_tabs;
	}
	/**
	 * Product Add/Edit custom tab field
	 *
	 * @return void
	 */
	public function upgrade_store_product_tab_field()
	{
		$upgrade_store_api_settings = (get_option('upgrade_store_api_settings')) ? get_option('upgrade_store_api_settings') : [];
		$upgrade_store_api_banner = get_option('upgrade_store_api_banner') ? get_option('upgrade_store_api_banner') : [];

		wp_nonce_field('woocommerce_upgrade_store_options_panel_action', 'woocommerce_upgrade_store_options_panel_field');
		global $post;
		$product_id = $post->ID;
		if (isset($upgrade_store_api_settings['settings_enable_product_tab'])) :
			$args = array(
				'post_type' 		=> 'product-tab',
				'numberposts' 	=> -1,
			);
			$tabs = get_posts($args);
			?>
			<div id="upgrade_store_product_tabs" class="panel woocommerce_options_panel woocommerce_upgrade_store_options_panel woocommerce_upgrade_store_product_tabs_options_panel" style="display: none">
				<?php

				$product_tab_data = get_post_meta($product_id, '_upgrade_store_product_tab_data', true) ? get_post_meta($product_id, '_upgrade_store_product_tab_data', true) : [];
				?>
				<?php if ($tabs && sizeof($tabs)) : ?>
					<div class="tab-content-wrap">
						<?php foreach ($tabs as $tab) : ?>
							<?php
							$pid = $tab->ID;
							$overWrite = ($product_tab_data) ? ((is_array($product_tab_data) && isset($product_tab_data[$pid]['enable'])) ? 1 : 0) : 0;
							?>
							<fieldset class="tab-container">
								<div class="group-title">
									<h4><?php echo esc_html($tab->post_title) ?></h4>
									<div class="action-wrap">
										<div class="unit">
											<label for="over-write-<?php echo esc_html($pid) ?>"><?php echo esc_html__("Override", "upgrade-store") ?></label>
											<div class="position-relative switcher">
												<label for="over-write-<?php echo esc_html($pid) ?>">
													<input class="upgrade-store-tab-content-toggle" type="checkbox" name="_upgrade_store_product_tab_data[<?php echo esc_html($pid) ?>][enable]" id="over-write-<?php echo esc_html($pid) ?>" value="1" <?php checked($overWrite, 1, 1) ?>>
													<em data-on="on" data-off="off"></em>
													<span></span>
												</label>
												<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Override the existing product tabs and customize it for this specific product.", 'upgrade-store') ?>"><i class="dashicons dashicons-editor-help"></i></span>
											</div>

										</div>
										<div class="unit">
											<a class="edit-global-tab" target="_blank" href="<?php echo esc_url(admin_url('post.php?post=' . $pid . '&amp;action=edit')) ?>">
												<span class="dashicons dashicons-edit"></span>
												<span class="text"><?php echo esc_html__("Manage global tab", "upgrade-store") ?></span>
											</a>
										</div>
									</div>
								</div>
								<div class="group-content <?php echo (!$overWrite) ? 'hidden' : '' ?>">
									<input type="hidden" name="_upgrade_store_product_tab_data[<?php echo esc_html($pid) ?>][title]" value="<?php echo esc_html($tab->post_title) ?>">
									<?php
									$content   = ($overWrite) ? $product_tab_data[$pid]['editor'] : $tab->post_content;
									$editor_id = 'change-content-' . $pid;
									$settings  = array(
										'textarea_name' => '_upgrade_store_product_tab_data[' . $pid . '][editor]',
										//'media_buttons' => false,
									);
									wp_editor(wp_kses_post($content), $editor_id, $settings);
									?>
								</div>
							</fieldset>
						<?php endforeach; ?>
					</div>
				<?php endif;
				wp_reset_postdata(); ?>
			</div>
		<?php endif ?>
		<?php if (isset($upgrade_store_api_settings['settings_enable_countdown_timer'])) : ?>
			<?php
			$product_countdown_data = get_post_meta($product_id, '_upgrade_store_product_countdown_data', true) ? get_post_meta($product_id, '_upgrade_store_product_countdown_data', true) : [];
			?>
			<div id="upgrade_store_countdown_timer" class="panel woocommerce_options_panel woocommerce_upgrade_store_options_panel woocommerce_upgrade_store_countdown_timer_options_panel" style="display: none">
				<table class="form-table upgrade-store-metabox-table" role="presentation">
					<tbody>
						<tr>
							<th scope="row">
								<label for="product-discount"><?php echo esc_html__("Product Discount (%)", "upgrade-store") ?></label>
							</th>
							<td>
								<div class="position-relative">
									<span id="show-discount" data-content="<?php echo esc_html__("Discount", "upgrade-store") ?>"><?php echo esc_html__('Please set "Sale price" first.', 'upgrade-store') ?></span>
									<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("This percentage will be shown in the countdown timer.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
								</div>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="countdown-heading"><?php echo esc_html__("Countdown Heading", "upgrade-store") ?></label>
							</th>
							<td>
								<div class="position-relative">
									<input type="text" class="short upgrade-store-tab-countdown-heading" name="_upgrade_store_product_countdown_data[countdown-heading]" id="countdown-heading" value="<?php echo (isset($product_countdown_data['countdown-heading'])) ? esc_html($product_countdown_data['countdown-heading']) : '' ?>" placeholder="<?php printf(esc_html__('%1$s OFF', 'upgrade-store'), '[discount]%'); ?>" />
									<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Set the header text for the countdown timer.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
								</div>
								<p class="text-help"><?php printf(esc_html__('Use %1$s shortcode to set the discount amount in your text.', 'upgrade-store'), '[discount]'); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="countdown-subtext"><?php echo esc_html__("Countdown Subtext", "upgrade-store") ?></label>
							</th>
							<td>
								<div class="position-relative">
									<input type="text" class="short upgrade-store-tab-countdown-subtext" name="_upgrade_store_product_countdown_data[countdown-subtext]" id="countdown-subtext" value="<?php echo (isset($product_countdown_data['countdown-subtext'])) ? esc_html(@$product_countdown_data['countdown-subtext']) : '' ?>" placeholder="<?php printf(esc_html__('%1$s OFF', 'upgrade-store'), '[discount]%'); ?>" />
									<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Set the subtext for the countdown timer.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
								</div>
								<p class="text-help"><?php printf(esc_html__('Use %1$s shortcode to set the discount amount in your text.', 'upgrade-store'), '[discount]'); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="time-duration-start"><?php echo esc_html__("Time Duration", "upgrade-store") ?></label>
							</th>
							<td class="upgrade-store-tab-time-duration">
								<div class="position-relative">
									<input type="datetime-local" class="short upgrade-store-tab-time-duration-start" name="_upgrade_store_product_countdown_data[time-duration-start]" id="time-duration-start" value="<?php echo (isset($product_countdown_data['time-duration-start'])) ? esc_html($product_countdown_data['time-duration-start']) : '' ?>" placeholder="<?php echo esc_html__('Start... YYYY-MM-DD', 'upgrade-store'); ?>" />
									<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Start date and time for the countdown timer.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
								</div>
								<div class="position-relative">
									<input type="datetime-local" class="short upgrade-store-tab-time-duration-end" name="_upgrade_store_product_countdown_data[time-duration-end]" id="time-duration-end" value="<?php echo (isset($product_countdown_data['time-duration-end'])) ? esc_html($product_countdown_data['time-duration-end']) : '' ?>" placeholder="<?php echo esc_html__("End... YYYY-MM-DD", "upgrade-store"); ?>" />
									<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("End date and time for the countdown timer.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
								</div>
								<div class="time-notice">
									<?php echo esc_html__("Set the countdown timer, to see it in the frontend.", 'upgrade-store') ?>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php endif ?>
		<?php if (isset($upgrade_store_api_banner['banner_enable_specific_product'])) : ?>
			<?php
			wp_nonce_field('upgrade_store_product_inventory_banner_image_action', 'upgrade_store_product_inventory_banner_image');

			$upgrade_store_banner_alt_text = get_post_meta($product_id, '_upgrade_store_banner_alt_text', true);
			$upgrade_store_banner_width = get_post_meta($product_id, '_upgrade_store_banner_width', true);
			$upgrade_store_banner_url = get_post_meta($product_id, '_upgrade_store_banner_url', true);
			$upgrade_store_banner_internal_image = get_post_meta($product_id, '_upgrade_store_banner_internal_image', true);
			$upgrade_store_banner_external_image_url = get_post_meta($product_id, '_upgrade_store_banner_external_image_url', true);
			?>
			<div id="upgrade_store_banner_image" class="panel woocommerce_options_panel woocommerce_upgrade_store_options_panel woocommerce_upgrade_store_banner_image_options_panel" style="display: none">
				<table class="form-table upgrade-store-metabox-table" role="presentation">
					<tbody>

						<tr>
							<th scope="row">
								<label><?php echo esc_html__("Banner Image", "upgrade-store") ?></label>
							</th>
							<td>
								<div class="banner-meta-box">
									<div class="upgrade-store-meta-unit image-uploader-unit">
										<div class="title-wrap">
											<h4 class="position-relative">
												<?php echo esc_html__("Banner Image", "upgrade-store") ?>
												<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Upload a banner image.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
											</h4>
										</div>
										<div class="position-relative upgrade_store_image">
											<div class="image-uploader">
												<div class="file-name <?php echo (isset($upgrade_store_banner_internal_image['id']) && $upgrade_store_banner_internal_image['id']) ? 'with-close-button' : '' ?>">
													<?php if (isset($upgrade_store_banner_internal_image['id']) && $upgrade_store_banner_internal_image['id']) : ?>

														<span class="gallery" data-fancybox="gallery-<?php echo esc_html(wp_rand(0, 999)) ?>" data-src="<?php echo esc_url($upgrade_store_banner_internal_image['url']) ?>">
															<?php echo wp_get_attachment_image($upgrade_store_banner_internal_image['id'], 'thumbnail', false, array('class' => 'option-image')) ?>
														</span>
													<?php else : ?>
														<span class="gallery">
															<img width="150" height="150" src="<?php echo esc_url(plugins_url('images/no_image_available.png', __FILE__)); ?>" class="option-image">
														</span>
													<?php endif ?>
													<span class="remove-image" data-default="<?php echo esc_url(plugins_url('images/no_image_available.png', __FILE__)); ?>"></span>
												</div>
												<div class="file-detail">
													<input name="_upgrade_store_banner_internal_image[url]" type="hidden" id="_upgrade_store_banner_internal_image_url" value="<?php echo isset($upgrade_store_banner_internal_image['url']) ? esc_html($upgrade_store_banner_internal_image['url']) : '' ?>" class="imageUrl">
													<input name="_upgrade_store_banner_internal_image[id]" type="hidden" id="_upgrade_store_banner_internal_image_id" value="<?php echo isset($upgrade_store_banner_internal_image['id']) ? esc_html($upgrade_store_banner_internal_image['id']) : '' ?>" class="imageId">
													<input name="_upgrade_store_banner_internal_image[name]" type="hidden" id="_upgrade_store_banner_internal_image_name" value="<?php echo isset($upgrade_store_banner_internal_image['name']) ? esc_html($upgrade_store_banner_internal_image['name']) : '' ?>" class="imageName">
													<div class="upload-help-text">
														<?php echo '<p>' . sprintf(esc_html__('Size: Optional %1$s File Support: %2$s', 'upgrade-store'), '<br/>', 'jpg, .jpeg, . gif, or .png.') . '</p>' ?>
													</div>
													<button class="button button-primary image-uploader-button single-image-uploader-button"><?php echo esc_html__("Upload Image", "upgrade-store") ?></button>
												</div>
											</div>
										</div>
									</div>
									<div class="group-unit-wrap m-t-24">
										<div class="unit unit-0 url_wrap">
											<div class="group-title">
												<h4 class="position-relative">
													<?php echo esc_html__("Upload from an URL", "upgrade-store") ?> <span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Upload image from a supported URL", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
												</h4>
											</div>
											<div class="position-relative">
												<input type="text" class="upgrade-store-tab-banner-external-image-url" name="_upgrade_store_banner_external_image_url" id="banner-external-image-url" value="<?php echo esc_url($upgrade_store_banner_external_image_url) ?>" placeholder="<?php echo esc_html__('Add the URL here', 'upgrade-store'); ?>" />
											</div>
										</div>
										<div class="unit unit-1 alt_wrap">
											<div class="group-title">
												<h4 class="position-relative">
													<?php echo esc_html__("Banner Alt Text", "upgrade-store") ?> <span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Set alt text for your image.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
												</h4>
											</div>
											<div class="position-relative">
												<input type="text" class="upgrade-store-tab-banner-alt-text" name="_upgrade_store_banner_alt_text" id="banner-alt-text" value="<?php echo esc_html($upgrade_store_banner_alt_text) ?>" placeholder="<?php echo esc_html__('WooCommerce Product', 'upgrade-store'); ?>" />
											</div>
										</div>
									</div>
									<div class="position-relative m-t-24 input-with-title">
										<div class="group-title">
											<h4 class="position-relative">
												<?php echo esc_html__("Select Type", "upgrade-store") ?> <span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Set the default image alignment.", "upgrade-store"); ?>"><i class="dashicons dashicons-editor-help"></i></span>
											</h4>
										</div>
										<div class="position-relative upgrade_store_text select2-icon">
											<select name="_upgrade_store_banner_width">
												<option value="align-center" <?php selected($upgrade_store_banner_width, 'align-center', true) ?>><?php echo esc_html__('None', 'upgrade-store'); ?></option>
												<option value="align-wide" <?php selected($upgrade_store_banner_width, 'align-wide', true) ?>><?php echo esc_html__('Wide Width', 'upgrade-store'); ?></option>
												<option value="align-full-width" <?php selected($upgrade_store_banner_width, 'align-full-width', true) ?>><?php echo esc_html__('Full Width', 'upgrade-store'); ?></option>
											</select>
										</div>
									</div>
									<div class="position-relative m-t-24 input-with-title">
										<div class="group-title">
											<h4 class="position-relative">
												<?php echo esc_html__("Banner URL", "upgrade-store") ?> <span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Set a banner URL where the users will be redirected.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
											</h4>
										</div>
										<div class="position-relative">
											<input type="text" class="upgrade-store-tab-banner-url" name="_upgrade_store_banner_url" id="banner-url" value="<?php echo esc_url($upgrade_store_banner_url) ?>" placeholder="<?php echo esc_html__('Add the URL here', 'upgrade-store'); ?>" />
										</div>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php endif ?>

		<?php
	}

	public function upgrade_store_save_banner_image_tab_metabox($post)
	{
		global $post;
		$post_id = ($post) ? $post->ID : 0;
		if (!isset($_POST['upgrade_store_product_inventory_banner_image']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['upgrade_store_product_inventory_banner_image'])), 'upgrade_store_product_inventory_banner_image_action')) {
			return;
		}

		// Check if user has permissions to save data.
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		// Check if not an autosave.
		if (wp_is_post_autosave($post_id)) {
			return;
		}

		// Check if not a revision.
		if (wp_is_post_revision($post_id)) {
			return;
		}

		$upgrade_store_banner_alt_text = sanitize_text_field($_POST["_upgrade_store_banner_alt_text"]);
		$upgrade_store_banner_width = sanitize_text_field($_POST["_upgrade_store_banner_width"]);
		$upgrade_store_banner_url = sanitize_url($_POST["_upgrade_store_banner_url"]);
		$upgrade_store_banner_internal_image = $this->upgrade_store_recursive_sanitize_array_field($_POST["_upgrade_store_banner_internal_image"]);
		$upgrade_store_banner_external_image_url = sanitize_url($_POST["_upgrade_store_banner_external_image_url"]);

		update_post_meta($post_id, "_upgrade_store_banner_alt_text", $upgrade_store_banner_alt_text);
		update_post_meta($post_id, "_upgrade_store_banner_width", $upgrade_store_banner_width);
		update_post_meta($post_id, "_upgrade_store_banner_url", $upgrade_store_banner_url);
		update_post_meta($post_id, "_upgrade_store_banner_internal_image", $upgrade_store_banner_internal_image);
		update_post_meta($post_id, "_upgrade_store_banner_external_image_url", $upgrade_store_banner_external_image_url);
	}
	/**
	 * Save custom data
	 *
	 * @return boolean
	 */
	public function upgrade_store_save_product_meta_data($post_id, $post, $update)
	{
		global $post;
		if (isset($_POST['woocommerce_upgrade_store_options_panel_field']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['woocommerce_upgrade_store_options_panel_field'])), 'woocommerce_upgrade_store_options_panel_action')) {

			$upgrade_store_product_tab_data = $this->upgrade_store_recursive_sanitize_array_field($_POST['_upgrade_store_product_tab_data']);
			$upgrade_store_product_countdown_data = $this->upgrade_store_recursive_sanitize_array_field($_POST['_upgrade_store_product_countdown_data']);

			if (isset($_POST['_upgrade_store_product_tab_data']))
				update_post_meta($post->ID, '_upgrade_store_product_tab_data', $upgrade_store_product_tab_data);
			else
				update_post_meta($post->ID, '_upgrade_store_product_tab_data', '');

			if (isset($_POST['_upgrade_store_product_countdown_data']))
				update_post_meta($post->ID, '_upgrade_store_product_countdown_data', $upgrade_store_product_countdown_data);
			else
				update_post_meta($post->ID, '_upgrade_store_product_countdown_data', '');
		}
	}
	/**
	 * Sets the parent file for hidden sub menus.
	 * Showing the parent menu active.
	 * 
	 * @param $parent_file
	 *
	 * @return mixed
	 */
	public function upgrade_store_parent_file_callback($parent_file)
	{
		global $plugin_page, $submenu_file;
		if (
			'upgrade-store-attachment' == $plugin_page
			|| 'upgrade-store-woo-email' == $plugin_page
			|| 'upgrade-store-quickview' == $plugin_page
			|| 'upgrade-store-stocks-left' == $plugin_page
			|| 'upgrade-store-banner' == $plugin_page
			|| 'upgrade-store-gallery' == $plugin_page
			|| 'upgrade-store-settings' == $plugin_page
		) {
			// $plugin_page = 'edit.php?post_type=product';
			// $submenu_file = 'edit.php?post_type=product-tab';

			$plugin_page = $this->plugin_name;
			$submenu_file = 'edit.php?post_type=product-tab';
		}
		return $parent_file;
	}
	/*add_filter('admin_body_class', 'upgrade_store_admin_body_class');*/
	public function upgrade_store_admin_body_class($classes)
	{

		$current_screen = get_current_screen();
		// var_dump($current_screen->id);
		if ($current_screen->id == 'edit-product-tab' || $current_screen->id == 'admin_page_upgrade-store-attachment' || $current_screen->id == 'admin_page_upgrade-store-woo-email' || $current_screen->id == 'admin_page_upgrade-store-quickview' || $current_screen->id == 'admin_page_upgrade-store-stocks-left' ||  $current_screen->id == 'admin_page_upgrade-store-banner'  ||  $current_screen->id == 'admin_page_upgrade-store-gallery' || $current_screen->id == 'admin_page_upgrade-store-settings') {
			$classes .= 'upgrade-store-settings-admin-page';
		}
		if ($current_screen->id == 'upgrade-store_page_upgrade-store-welcome') {
			$classes .= 'upgrade-store-stretch-width-template';
		}
		return $classes;
	}
	public function upgrade_store_custom_in_admin_header()
	{
		$current_screen = get_current_screen();
		if ($current_screen->id == 'edit-product-tab' || $current_screen->id == 'admin_page_upgrade-store-attachment' || $current_screen->id == 'admin_page_upgrade-store-woo-email' || $current_screen->id == 'admin_page_upgrade-store-quickview' || $current_screen->id == 'admin_page_upgrade-store-stocks-left' ||  $current_screen->id == 'admin_page_upgrade-store-banner' ||  $current_screen->id == 'admin_page_upgrade-store-gallery' || $current_screen->id == 'admin_page_upgrade-store-settings') {
		?>
			<div class="clear" style="margin-top:24px"></div>
			<div class="upgrade-store-wrapper">
				<div class="logo-wrap">
					<a href="#"><img src="<?php echo esc_url(plugins_url('images/logo.svg', __FILE__)) ?>" width="204" height="32" alt="Upgrade Store - Logo"></a>
					<div class="version"><?php echo esc_html__("Version", "upgrade-store") ?> <?php echo esc_html(UPGRADE_STORE_VERSION) ?></div>
				</div>

				<ul class="upgrade-store-nav-tab-wrapper">
					<li><a href="<?php echo esc_url(admin_url('/edit.php?post_type=product-tab')) ?>" class="upgrade-store-nav-tab<?php echo ($current_screen->id == 'edit-product-tab') ? ' nav-tab-active' : '' ?>"><?php echo esc_html__("Product Tabs", 'upgrade-store') ?></a></li>

					<li><a href="<?php echo esc_url(admin_url('/admin.php?page=upgrade-store-attachment')) ?>" class="upgrade-store-nav-tab<?php echo ($current_screen->id == 'admin_page_upgrade-store-attachment') ? ' nav-tab-active' : '' ?>"><?php echo esc_html__("Product Attachments", 'upgrade-store') ?></a></li>

					<li><a href="<?php echo esc_url(admin_url('/admin.php?page=upgrade-store-woo-email')) ?>" class="upgrade-store-nav-tab<?php echo ($current_screen->id == 'admin_page_upgrade-store-woo-email') ? ' nav-tab-active' : '' ?>"><?php echo esc_html__("Product Notifications", 'upgrade-store') ?></a></li>

					<li><a href="<?php echo esc_url(admin_url('/admin.php?page=upgrade-store-quickview')) ?>" class="upgrade-store-nav-tab<?php echo ($current_screen->id == 'admin_page_upgrade-store-quickview') ? ' nav-tab-active' : '' ?>"><?php echo esc_html__("Quick View", 'upgrade-store') ?></a></li>

					<li><a href="<?php echo esc_url(admin_url('/admin.php?page=upgrade-store-stocks-left')) ?>" class="upgrade-store-nav-tab<?php echo ($current_screen->id == 'admin_page_upgrade-store-stocks-left') ? ' nav-tab-active' : '' ?>"><?php echo esc_html__("Stocks Left", 'upgrade-store') ?></a></li>

					<li><a href="<?php echo esc_url(admin_url('/admin.php?page=upgrade-store-banner')) ?>" class="upgrade-store-nav-tab<?php echo ($current_screen->id == 'admin_page_upgrade-store-banner') ? ' nav-tab-active' : '' ?>"><?php echo esc_html__("Banner", 'upgrade-store') ?></a></li>

					<li><a href="<?php echo esc_url(admin_url('/admin.php?page=upgrade-store-gallery')) ?>" class="upgrade-store-nav-tab<?php echo ($current_screen->id == 'admin_page_upgrade-store-gallery') ? ' nav-tab-active' : '' ?>"><?php echo esc_html__("Gallery", 'upgrade-store') ?></a></li>

					<li><a href="<?php echo esc_url(admin_url('/admin.php?page=upgrade-store-settings')) ?>" class="upgrade-store-nav-tab<?php echo ($current_screen->id == 'admin_page_upgrade-store-settings') ? ' nav-tab-active' : '' ?>"><?php echo esc_html__("Settings", 'upgrade-store') ?></a></li>
				</ul>
			</div>
		<?php
		}
	}

	/**
	 * Adds the meta box.
	 */
	public function upgrade_store_add_attachments_tab_metabox()
	{
		$upgrade_store_api_settings = (get_option('upgrade_store_api_settings')) ? get_option('upgrade_store_api_settings') : [];

		$upgrade_store_api_gallery = get_option('upgrade_store_api_gallery') ? get_option('upgrade_store_api_gallery') : [];

		if (isset($upgrade_store_api_settings['settings_enable_attachments_tab']) && $upgrade_store_api_settings['settings_enable_attachments_tab']) {

			add_meta_box(
				'upgrade-store-product-attachment-metabox',
				esc_html__('WooCommerce Product Attachment', 'upgrade-store'),
				array($this, 'upgrade_store_render_attachments_tab_metabox'),
				'product',
				'advanced',
				'default'
			);
		}
		//upgrade_store_api_settings[settings_enable_gallery]
		//upgrade_store_api_gallery[gallery_enable_gallery_type]
		//upgrade_store_api_gallery[gallery_enable_specific_product]
		if (isset($upgrade_store_api_settings['settings_enable_gallery']) && isset($upgrade_store_api_gallery['gallery_enable_gallery_type']) && isset($upgrade_store_api_gallery['gallery_enable_specific_product'])) {
			add_meta_box(
				'upgrade-store-gallery-type-metabox',
				esc_html__('Upgrade Store Gallery Type', 'upgrade-store'),
				array($this, 'upgrade_store_render_gallery_type_metabox'),
				'product',
				'advanced',
				'default'
			);
		}
	}
	/**
	 * Renders the meta box.
	 */

	public function upgrade_store_render_gallery_type_metabox($post)
	{
		// $product = wc_get_product($post->ID);
		$upgrade_store_api_gallery = get_option('upgrade_store_api_gallery'); // [gallery_select_gallery_type]
		$upgrade_store_gallery_type = get_post_meta($post->ID, '_upgrade_store_gallery_type', true) ? get_post_meta($post->ID, '_upgrade_store_gallery_type', true) : (isset($upgrade_store_api_gallery['gallery_select_gallery_type']) ? $upgrade_store_api_gallery['gallery_select_gallery_type'] : 'type-1');
		wp_nonce_field('upgrade_store_gallery_type_metabox_action', 'upgrade_store_gallery_type_metabox');
		?>
		<table class="form-table upgrade-store-metabox-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">
						<label for="name"><?php echo esc_html__("Select Gallery Type", 'upgrade-store') ?></label>
					</th>
					<td>

						<div class="position-relative image-select-inline">
							<div class="image-select-wrapper">
								<div class="image-select-unit">
									<input class="gallery_select_gallery_type gallery_select_gallery_type-type-1" name="_upgrade_store_gallery_type" id="gallery_select_gallery_type-type-1" type="radio" value="type-1" <?php checked($upgrade_store_gallery_type, 'type-1', true) ?>>
									<label for="gallery_select_gallery_type-type-1"><span></span> <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>admin/images/gallery-layout-1.png"></label>

								</div>
								<div class="image-select-unit">
									<input class="gallery_select_gallery_type gallery_select_gallery_type-type-2" name="_upgrade_store_gallery_type" id="gallery_select_gallery_type-type-2" type="radio" value="type-2" <?php checked($upgrade_store_gallery_type, 'type-2', true) ?>>
									<label for="gallery_select_gallery_type-type-2"><span></span> <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>admin/images/gallery-layout-2.png"></label>

								</div>
								<div class="image-select-unit">
									<input class="gallery_select_gallery_type gallery_select_gallery_type-type-3" name="_upgrade_store_gallery_type" id="gallery_select_gallery_type-type-3" type="radio" value="type-3" <?php checked($upgrade_store_gallery_type, 'type-3', true) ?>>
									<label for="gallery_select_gallery_type-type-3"><span></span> <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>admin/images/gallery-layout-3.png"></label>

								</div>
								<div class="image-select-unit">
									<input class="gallery_select_gallery_type gallery_select_gallery_type-type-4" name="_upgrade_store_gallery_type" id="gallery_select_gallery_type-type-4" type="radio" value="type-4" <?php checked($upgrade_store_gallery_type, 'type-4', true) ?>>
									<label for="gallery_select_gallery_type-type-4"><span></span> <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>admin/images/gallery-layout-4.png"></label>

								</div>
								<div class="image-select-unit">
									<input class="gallery_select_gallery_type gallery_select_gallery_type-type-5" name="_upgrade_store_gallery_type" id="gallery_select_gallery_type-type-5" type="radio" value="type-5" <?php checked($upgrade_store_gallery_type, 'type-5', true) ?>>
									<label for="gallery_select_gallery_type-type-5"><span></span> <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>admin/images/gallery-layout-5.png"></label>

								</div>
								<div class="image-select-unit">
									<input class="gallery_select_gallery_type gallery_select_gallery_type-type-6" name="_upgrade_store_gallery_type" id="gallery_select_gallery_type-type-6" type="radio" value="type-6" <?php checked($upgrade_store_gallery_type, 'type-6', true) ?>>
									<label for="gallery_select_gallery_type-type-6"><span></span> <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>admin/images/gallery-layout-6.png"></label>

								</div>
								<div class="image-select-unit">
									<input class="gallery_select_gallery_type gallery_select_gallery_type-type-7" name="_upgrade_store_gallery_type" id="gallery_select_gallery_type-type-7" type="radio" value="type-7" <?php checked($upgrade_store_gallery_type, 'type-7', true) ?>>
									<label for="gallery_select_gallery_type-type-7"><span></span> <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>admin/images/gallery-layout-7.png"></label>

								</div>
								<div class="image-select-unit">
									<input class="gallery_select_gallery_type gallery_select_gallery_type-type-8" name="_upgrade_store_gallery_type" id="gallery_select_gallery_type-type-8" type="radio" value="type-8" <?php checked($upgrade_store_gallery_type, 'type-8', true) ?>>
									<label for="gallery_select_gallery_type-type-8"><span></span> <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>admin/images/gallery-layout-8.png"></label>

								</div>
								<div class="image-select-unit">
									<input class="gallery_select_gallery_type gallery_select_gallery_type-type-9" name="_upgrade_store_gallery_type" id="gallery_select_gallery_type-type-9" type="radio" value="type-9" <?php checked($upgrade_store_gallery_type, 'type-9', true) ?>>
									<label for="gallery_select_gallery_type-type-9"><span></span> <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>admin/images/gallery-layout-9.png"></label>

								</div>
								<div class="image-select-unit">
									<input class="gallery_select_gallery_type gallery_select_gallery_type-type-10" name="_upgrade_store_gallery_type" id="gallery_select_gallery_type-type-10" type="radio" value="type-10" <?php checked($upgrade_store_gallery_type, 'type-10', true) ?>>
									<label for="gallery_select_gallery_type-type-10"><span></span> <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>admin/images/gallery-layout-10.png"></label>

								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}
	public function upgrade_store_save_gallery_type_metabox($post)
	{
		global $post;
		$post_id = ($post) ? $post->ID : 0;
		if (!isset($_POST['upgrade_store_gallery_type_metabox']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['upgrade_store_gallery_type_metabox'])), 'upgrade_store_gallery_type_metabox_action')) {
			return;
		}

		// Check if user has permissions to save data.
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		// Check if not an autosave.
		if (wp_is_post_autosave($post_id)) {
			return;
		}

		// Check if not a revision.
		if (wp_is_post_revision($post_id)) {
			return;
		}

		$upgrade_store_gallery_type = sanitize_text_field($_POST["_upgrade_store_gallery_type"]);
		update_post_meta($post->ID, "_upgrade_store_gallery_type", $upgrade_store_gallery_type);
	}
	public function upgrade_store_render_attachments_tab_metabox($post)
	{

		$upgrade_store_api_attachments = get_option('upgrade_store_api_attachments');
		$cat_ids = [];
		$show_meta = false;
		$categories_for_the_current_post = get_the_terms($post->ID, 'product_cat');
		if (isset($categories_for_the_current_post) && is_array($categories_for_the_current_post) && sizeof($categories_for_the_current_post)) {
			foreach ($categories_for_the_current_post as $category) {
				$cat_ids[] = $category->term_id;
			}
		}
		if (isset($upgrade_store_api_attachments['attachment_category_for']) &&  $upgrade_store_api_attachments['attachment_category_for'] == 'all') {
			$show_meta = true;
		} else {
			$result = [];
			if (is_array($cat_ids) && is_array($upgrade_store_api_attachments) && isset($upgrade_store_api_attachments["attachment_categories"]) && is_array($upgrade_store_api_attachments['attachment_categories'])) $result = array_intersect($cat_ids, $upgrade_store_api_attachments['attachment_categories']);
			if (sizeof($result)) {
				$show_meta = true;
			}
		}
		if ($show_meta) :
			//_upgrade_store_product_attachment_
			$prefix = '_upgrade_store_product_attachment_';
			// Add nonce for security and authentication.
			wp_nonce_field('upgrade_store_product_attachment_metabox_action', 'upgrade_store_product_attachment_metabox');

			$upgrade_store_api_attachments = get_option('upgrade_store_api_attachments');
			$check = get_post_meta($post->ID, $prefix . 'check', true);
			$name = get_post_meta($post->ID, $prefix . 'name', true);
			$description = get_post_meta($post->ID, $prefix . 'description', true);
			$icon = get_post_meta($post->ID, $prefix . 'icon', true);
			$type = get_post_meta($post->ID, $prefix . 'type', true);
			$internalFile = get_post_meta($post->ID, $prefix . 'internalFile', true);
			$externalFile = get_post_meta($post->ID, $prefix . 'externalFile', true);
			$newWindow = ($check) ? get_post_meta($post->ID, $prefix . 'newWindow', true) : isset($upgrade_store_api_attachments['attachment_open_in_new_tab']);

		?>
			<table class="form-table upgrade-store-metabox-table" role="presentation">
				<tbody>
					<?php if (isset($upgrade_store_api_attachments["attachment_enable_tab_name"]) && $upgrade_store_api_attachments['attachment_enable_tab_name']) : ?>
						<tr>
							<th scope="row">
								<label for="<?php echo esc_html($prefix) ?>name"><?php echo esc_html__("Name", 'upgrade-store') ?> <span class="text-danger">*</span></label>
							</th>
							<td>
								<div class="position-relative">
									<input name="<?php echo esc_html($prefix) ?>name" type="text" id="<?php echo esc_html($prefix) ?>name" value="<?php echo esc_html(@$name) ?>" class="regular-text" placeholder="<?php echo esc_html__("Set a name for the attachment tab.", 'upgrade-store'); ?>" required />
									<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Set the tab name.", 'upgrade-store') ?>"><i class="dashicons dashicons-editor-help"></i></span>
								</div>
							</td>
						</tr>
					<?php endif ?>
					<tr>
						<th scope="row">
							<label for="<?php echo esc_html($prefix) ?>description"><?php echo esc_html__("Description", 'upgrade-store') ?></label>
						</th>
						<td>
							<div class="position-relative">
								<textarea name="<?php echo esc_html($prefix) ?>description" rows="10" cols="50" id="<?php echo esc_html($prefix) ?>description" class="large-text" placeholder="<?php echo esc_html__("Add a short description.", 'upgrade-store') ?>"><?php echo esc_textarea(@$description) ?></textarea>
								<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Add the description.", 'upgrade-store') ?>"><i class="dashicons dashicons-editor-help"></i></span>

							</div>
						</td>
					</tr>
					<?php if (isset($upgrade_store_api_attachments["attachment_enable_tab_icon"]) && $upgrade_store_api_attachments['attachment_enable_tab_icon']) : ?>
						<tr>
							<th scope="row">
								<label for="<?php echo esc_html($prefix) ?>icon"><?php echo esc_html__("Set Icon", 'upgrade-store') ?></label>
							</th>
							<td>
								<div class="file-uploader">
									<div class="file-name">
										<?php if ($icon) : ?>
											<a href="<?php echo esc_url($icon['url']) ?>" target="_blank"><?php echo esc_html($icon['name']) ?></a>
										<?php else : ?>
											<?php echo esc_html__("No file selected", 'upgrade-store') ?>
										<?php endif ?>
									</div>
									<input name="<?php echo esc_html($prefix) ?>icon[url]" type="hidden" id="<?php echo esc_html($prefix) ?>icon" value="<?php echo ($icon && isset($icon['url'])) ? esc_url($icon['url']) : '' ?>" class="fileUrl" />
									<input name="<?php echo esc_html($prefix) ?>icon[id]" type="hidden" id="<?php echo esc_html($prefix) ?>icon" value="<?php echo ($icon && isset($icon['id'])) ? esc_html($icon['id']) : '' ?>" class="fileId" />
									<input name="<?php echo esc_html($prefix) ?>icon[name]" type="hidden" id="<?php echo esc_html($prefix) ?>icon" value="<?php echo ($icon && isset($icon['name'])) ? esc_html($icon['name']) : '' ?>" class="fileName" />
									<button class="button file-uploader-button single-file-uploader-button"><?php echo esc_html__("Upload Icon", 'upgrade-store') ?></button>
								</div>
								<div class="text-muted"><?php echo esc_html__("Select an icon for the tab.", 'upgrade-store') ?></div>
							</td>
						</tr>
					<?php endif ?>
					<?php if (isset($upgrade_store_api_attachments["attachment_enable_external_url"]) && $upgrade_store_api_attachments['attachment_enable_external_url']) :
					?>
						<tr>
							<th scope="row">
								<label for="<?php echo esc_html($prefix) ?>type"><?php echo esc_html__("Attachment Type", 'upgrade-store') ?></label>
							</th>
							<td>
								<select name="<?php echo esc_html($prefix) ?>type" id="<?php echo esc_html($prefix) ?>type">
									<option value="internal" <?php selected($type, 'internal', true) ?>><?php echo esc_html__("File Upload", 'upgrade-store') ?></option>
									<option value="external" <?php selected($type, 'external', true) ?>><?php echo esc_html__("File URL", 'upgrade-store') ?></option>
								</select>
								<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Choose the file attachment type.", 'upgrade-store') ?>"><i class="dashicons dashicons-editor-help"></i></span>
							</td>
						</tr>
					<?php endif
					?>
					<tr class="<?php echo esc_html($prefix) ?>internal_file_con">
						<th scope="row">
							<label for="<?php echo esc_html($prefix) ?>internalFile"><?php echo esc_html__("Upload Attachment File", 'upgrade-store') ?></label>
						</th>
						<td>
							<div class="file-uploader">
								<div class="file-name">
									<?php if ($internalFile) : ?>
										<a href="<?php echo esc_url($internalFile['url']) ?>" target="_blank"><?php echo esc_html($internalFile['name']) ?></a>
									<?php else : ?>
										<?php echo esc_html__("No file selected", 'upgrade-store') ?>
									<?php endif ?>
								</div>
								<input name="<?php echo esc_html($prefix) ?>internalFile[url]" type="hidden" id="<?php echo esc_html($prefix) ?>internalFile" value="<?php echo ($internalFile && isset($internalFile['url'])) ? esc_url($internalFile['url']) : '' ?>" class="fileUrl" />
								<input name="<?php echo esc_html($prefix) ?>internalFile[id]" type="hidden" id="<?php echo esc_html($prefix) ?>internalFile" value="<?php echo ($internalFile && isset($internalFile['id'])) ? esc_html($internalFile['id']) : '' ?>" class="fileId" />
								<input name="<?php echo esc_html($prefix) ?>internalFile[name]" type="hidden" id="<?php echo esc_html($prefix) ?>internalFile" value="<?php echo ($internalFile && isset($internalFile['name'])) ? esc_html($internalFile['name']) : '' ?>" class="fileName" />
								<button class="button file-uploader-button single-file-uploader-button">Upload File</button>
							</div>
							<div class="text-muted"><?php echo esc_html__("Select upload attachment File.", 'upgrade-store') ?></div>
						</td>
					</tr>

					<tr class="<?php echo esc_html($prefix) ?>external_file_con">
						<th scope="row">
							<label for="<?php echo esc_html($prefix) ?>externalFile"><?php echo esc_html__("FIle URL", 'upgrade-store') ?></label>
						</th>
						<td>
							<div class="position-relative">
								<input name="<?php echo esc_html($prefix) ?>externalFile" type="text" id="<?php echo esc_html($prefix) ?>externalFile" value="<?php echo esc_url(@$externalFile) ?>" class="regular-text" />
							</div>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="<?php echo esc_html($prefix) ?>newWindow"><?php echo esc_html__("Open in new tab", 'upgrade-store') ?></label>
						</th>
						<td>
							<div class="position-relative switcher">
								<label for="<?php echo esc_html($prefix) ?>newWindow">
									<input type="checkbox" name="<?php echo esc_html($prefix) ?>newWindow" id="<?php echo esc_html($prefix) ?>newWindow" value="1" <?php checked($newWindow, 1, true); ?>>
									<em data-on="on" data-off="off"></em>
									<span></span>
								</label>
								<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Enable/disable opens in a new tab option.", 'upgrade-store') ?>"><i class="dashicons dashicons-editor-help"></i></span>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<input name="<?php echo esc_html($prefix) ?>check" type="hidden" id="<?php echo esc_html($prefix) ?>check" value="1" />
		<?php else : ?>
			<div class="upgrade-store-metabox-not-anable">
				<div class="wrap">
					<h3 class="not-anable-heading"><?php echo esc_html__("You Haven't Enabled Product Attachment for this Category of Product", "upgrade-store") ?></h3>
					<p class="not-anable-intro"><?php echo esc_html__("Please enable product attachment for this category of product from Upgrade Store settings page to see the product attachment options for this product.", "upgrade-store") ?></p>
					<a class="not-anable-link" href="<?php echo esc_url(admin_url('admin.php?page=upgrade-store-attachment')) ?>" target="_blank"><?php echo esc_html__("Go to Settings", "upgrade-store") ?></a>

				</div>
			</div>
		<?php
		endif;
	}

	/**
	 * Handles saving the meta box.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post object.
	 * @return null
	 */
	public function upgrade_store_save_attachments_tab_metabox($post)
	{
		global $post;
		$post_id = ($post) ? $post->ID : 0;
		if (!isset($_POST['upgrade_store_product_attachment_metabox']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['upgrade_store_product_attachment_metabox'])), 'upgrade_store_product_attachment_metabox_action')) {
			return;
		}

		// Check if user has permissions to save data.
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		// Check if not an autosave.
		if (wp_is_post_autosave($post_id)) {
			return;
		}

		// Check if not a revision.
		if (wp_is_post_revision($post_id)) {
			return;
		}
		$prefix = '_upgrade_store_product_attachment_';

		$name = sanitize_text_field($_POST[$prefix . "name"]);
		$description = sanitize_textarea_field($_POST[$prefix . "description"]);
		$icon = $this->upgrade_store_recursive_sanitize_array_field($_POST[$prefix . "icon"]);
		$type = isset($_POST[$prefix . "type"]) ? sanitize_text_field($_POST[$prefix . "type"]) : '';
		$internalFile = $this->upgrade_store_recursive_sanitize_array_field($_POST[$prefix . "internalFile"]);
		$externalFile = isset($_POST[$prefix . "externalFile"]) ? sanitize_url($_POST[$prefix . "externalFile"]) : '';
		$newWindow = isset($_POST[$prefix . "newWindow"]) ? sanitize_text_field($_POST[$prefix . "newWindow"]) : '';
		$check = sanitize_text_field($_POST[$prefix . "check"]);

		update_post_meta($post->ID, $prefix . "name", $name);
		update_post_meta($post->ID, $prefix . "description", $description);
		update_post_meta($post->ID, $prefix . "icon", $icon);
		update_post_meta($post->ID, $prefix . "type", $type);
		update_post_meta($post->ID, $prefix . "internalFile", $internalFile);
		update_post_meta($post->ID, $prefix . "externalFile", $externalFile);
		update_post_meta($post->ID, $prefix . "newWindow", $newWindow);
		update_post_meta($post->ID, $prefix . "check", $check);
	}
	public function upgrade_store_render_inventory_tab_metabox()
	{
		$upgrade_store_api_settings = (get_option('upgrade_store_api_settings')) ? get_option('upgrade_store_api_settings') : [];

		if (isset($upgrade_store_api_settings['settings_enable_stocks_left']) && $upgrade_store_api_settings['settings_enable_stocks_left']) {
			global $post;
			wp_nonce_field('upgrade_store_product_inventory_metabox_action', 'upgrade_store_product_inventory_metabox');
			$_stock = get_post_meta($post->ID, '_stock', true);

			$prefix = '_upgrade_store_inventory_';
			$total_sold_count_text = get_post_meta($post->ID, $prefix . "total_sold_count_text", true);
			$subtext = get_post_meta($post->ID, $prefix . "subtext", true);
		?>
			<table class="form-table upgrade-store-metabox-table" role="presentation">
				<tbody>
					<tr>
						<th scope="row">
							<label for="<?php echo esc_html($prefix) ?>total_sold_count_text"><?php echo esc_html__("Total Sold Count Text", "upgrade-store") ?></label>
						</th>
						<td>
							<div class="position-relative">
								<input name="<?php echo esc_html($prefix) ?>total_sold_count_text" type="text" id="<?php echo esc_html($prefix) ?>total_sold_count_text" value="<?php echo esc_html($total_sold_count_text) ?>" class="regular-text" placeholder="<?php echo esc_html__("Total Sold", "upgrade-store") ?>">
								<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Set the heading text for the countdown.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
							</div>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php echo esc_html__("Quantity", "upgrade-store") ?></label>
						</th>
						<td>
							<div class="position-relative">
								<span id="show-stock" data-content="<?php echo esc_html__("Number of Stocks left will be shown here.", "upgrade-store") ?>"><?php echo ($_stock) ? esc_html($_stock) : esc_html__("Number of Stocks left will be shown here.", "upgrade-store") ?></span>
								<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Automatically calculates how many stocks are left.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
							</div>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="<?php echo esc_html($prefix) ?>subtext"><?php echo esc_html__("Subtext", "upgrade-store") ?></label>
						</th>
						<td>
							<div class="position-relative">
								<input name="<?php echo esc_html($prefix) ?>subtext" type="text" id="<?php echo esc_html($prefix) ?>subtext" value="<?php echo esc_html($subtext) ?>" class="regular-text" placeholder="<?php echo esc_html__("Hurry Up! Only [quantity] Left In Stock", " upgrade-store") ?>">
								<span class="tooltip hint--bottom" aria-label="<?php echo esc_html__("Set the subtext for the countdown.", "upgrade-store") ?>"><i class="dashicons dashicons-editor-help"></i></span>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
<?php
		}
	}
	public function upgrade_store_save_inventory_tab_metabox($post)
	{
		global $post;
		$post_id = ($post) ? $post->ID : 0;
		if (!isset($_POST['upgrade_store_product_inventory_metabox']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['upgrade_store_product_inventory_metabox'])), 'upgrade_store_product_inventory_metabox_action')) {
			return;
		}

		// Check if user has permissions to save data.
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		// Check if not an autosave.
		if (wp_is_post_autosave($post_id)) {
			return;
		}

		// Check if not a revision.
		if (wp_is_post_revision($post_id)) {
			return;
		}

		$prefix = '_upgrade_store_inventory_';

		$total_sold_count_text = sanitize_text_field($_POST[$prefix . "total_sold_count_text"]);
		$subtext = sanitize_text_field($_POST[$prefix . "subtext"]);

		update_post_meta($post_id, $prefix . "total_sold_count_text", $total_sold_count_text);
		update_post_meta($post_id, $prefix . "subtext", $subtext);
	}
	public function upgrade_store_manage_product_tab_posts_columns($columns)
	{
		unset(
			// $columns['author'],
			$columns['comments'],
			// $columns['date']
			// $columns['rank_math_seo_details'],

		);

		// $columns['view-globally'] = esc_html__('View globally', 'upgrade-store');
		// $columns['identifier'] = esc_html__('Identifier', 'upgrade-store');
		/**
		 * Rearrange column order
		 *
		 * Now define a new order. you need to look up the column
		 * names in the HTML of the admin interface HTML of the table header.
		 *
		 *     "cb" is the "select all" checkbox.
		 *     "title" is the title column.
		 *     "date" is the date column.
		 *     "icl_translations" comes from a plugin (eg.: WPML).
		 *
		 * change the order of the names to change the order of the columns.
		 *
		 * @link http://wordpress.stackexchange.com/questions/8427/change-order-of-custom-columns-for-edit-panels
		 */
		$custom_order = array('cb', 'title', 'author', 'date');

		// -- OR --
		// https://crunchify.com/how-to-move-wordpress-admin-column-before-or-after-any-other-column-manage-post-columns-hook/

		/**
		 * return a new column array to wordpress.
		 * order is the exactly like you set in $customOrder.
		 */
		// foreach ($custom_order as $column_name) {
		// 	$rearranged[$column_name] = $columns[$column_name];
		// }
		// // var_dump($rearranged);
		// return $rearranged;

		return $columns;
	}
	public function upgrade_store_manage_product_tab_posts_custom_column($column, $post_id)
	{
		switch ($column) {
			case 'view-globally':
				// $terms = get_the_term_list($post_id, 'book_author', '', ',', '');
				// if (is_string($terms))
				// 	echo $terms;
				// else
				// 	esc_html_e('Unable to get author(s)', 'your_text_domain');
				echo 'Yes';
				break;
			case 'identifier':
				// echo get_post_meta($post_id, 'publisher', true);
				echo 'wpt-' . esc_html($post_id);
				break;
		}
	}
	// Callback function
	public function upgrade_store_hide_admin_notice_ajax()
	{
		if (!check_ajax_referer('upgrade_store_security_nonce', 'security', false)) {
			wp_send_json_error('Invalid security token sent.');
			die();
		}
		update_option($this->plugin_name . '_hide_admin_notice', true);
		$ret = array('success' => true);
		die(wp_json_encode($ret));
	}
	public function upgrade_store_save_setting_data()
	{
		// if (!check_ajax_referer('upgrade_store_security_nonce', 'security', false)) {
		// 	wp_send_json_error('Invalid security token sent.');
		// 	die();
		// }
		if (!wp_verify_nonce(sanitize_text_field(wp_unslash(@$_POST['security'])), 'upgrade_store_security_nonce')) {
			wp_send_json_error('Nonce validation failed.');
			die();
		}
		parse_str($_POST['form_data'], $form_data);
		$option_name = esc_html($_POST['option_name']);
		$option_value = $this->upgrade_store_recursive_sanitize_array_field($form_data[$_POST['option_name']]);
		update_option($option_name, $option_value);
		$ret = array('success' => true);
		die(wp_json_encode($ret));
	}
	public function upgrade_store_woo_remove_hooks()
	{
		//upgrade_store_api_woo_email
		$upgrade_store_api_woo_email = (get_option('upgrade_store_api_woo_email')) ? get_option('upgrade_store_api_woo_email') : [];

		/**
		 * Hooks for sending emails during store events
		 *
		 */
		if (isset($upgrade_store_api_woo_email['wc_disable_low_stock_notifications']) && $upgrade_store_api_woo_email['wc_disable_low_stock_notifications']) {
			remove_action('woocommerce_low_stock_notification', 'low_stock');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_no_stock_notifications']) && $upgrade_store_api_woo_email['wc_disable_no_stock_notifications']) {
			remove_action('woocommerce_no_stock_notification', 'no_stock');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_product_on_backorder_notifications']) && $upgrade_store_api_woo_email['wc_disable_product_on_backorder_notifications']) {
			remove_action('woocommerce_product_on_backorder_notification', 'backorder');
		}

		if (isset($upgrade_store_api_woo_email['wc_disable_pending_processing_new_orders_notifications']) && $upgrade_store_api_woo_email['wc_disable_pending_processing_new_orders_notifications']) {
			remove_action('woocommerce_order_status_pending_to_processing_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_pending_completed_orders_notifications']) && $upgrade_store_api_woo_email['wc_disable_pending_completed_orders_notifications']) {
			remove_action('woocommerce_order_status_pending_to_completed_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_pending_onhold_new_orders_notifications']) && $upgrade_store_api_woo_email['wc_disable_pending_onhold_new_orders_notifications']) {
			remove_action('woocommerce_order_status_pending_to_on-hold_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_failed_processing_new_orders_notifications']) && $upgrade_store_api_woo_email['wc_disable_failed_processing_new_orders_notifications']) {
			remove_action('woocommerce_order_status_failed_to_processing_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_failed_processing_orders_notifications']) && $upgrade_store_api_woo_email['wc_disable_failed_processing_orders_notifications']) {
			remove_action('woocommerce_order_status_failed_to_processing_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_failed_completed_orders_notifications']) && $upgrade_store_api_woo_email['wc_disable_failed_completed_orders_notifications']) {
			remove_action('woocommerce_order_status_failed_to_completed_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_failed_onhold_new_orders_notifications']) && $upgrade_store_api_woo_email['wc_disable_failed_onhold_new_orders_notifications']) {
			remove_action('woocommerce_order_status_failed_to_on-hold_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_failed_onhold_orders_notifications']) && $upgrade_store_api_woo_email['wc_disable_failed_onhold_orders_notifications']) {
			remove_action('woocommerce_order_status_failed_to_on-hold_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_pending_processing_orders_notifications']) && $upgrade_store_api_woo_email['wc_disable_pending_processing_orders_notifications']) {
			remove_action('woocommerce_order_status_pending_to_processing_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_pending_onhold_orders_notifications']) && $upgrade_store_api_woo_email['wc_disable_pending_onhold_orders_notifications']) {
			remove_action('woocommerce_order_status_pending_to_on-hold_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_order_status_completed_notifications']) && $upgrade_store_api_woo_email['wc_disable_order_status_completed_notifications']) {
			remove_action('woocommerce_order_status_completed_notification', 'trigger');
		}
		if (isset($upgrade_store_api_woo_email['wc_disable_order_new_customer_note_notifications']) && $upgrade_store_api_woo_email['wc_disable_order_new_customer_note_notifications']) {
			remove_action('woocommerce_new_customer_note_notification', 'trigger');
		}
	}
	public function upgrade_store_remove_admin_notices()
	{
		$current_screen = get_current_screen();
		if ($current_screen->id == 'edit-product-tab' || $current_screen->id == 'admin_page_upgrade-store-attachment' || $current_screen->id == 'admin_page_upgrade-store-woo-email' || $current_screen->id == 'admin_page_upgrade-store-quickview' || $current_screen->id == 'admin_page_upgrade-store-settings') {
			remove_all_actions('user_admin_notices');
			remove_all_actions('admin_notices');
		}
	}
	/**
	 * Recursive sanitation for an array
	 * 
	 * @param $array
	 *
	 * @return mixed
	 */
	public function upgrade_store_recursive_sanitize_array_field($array)
	{
		foreach ($array as $key => &$value) {
			if (is_array($value)) {
				$value = $this->upgrade_store_recursive_sanitize_array_field($value);
			} else {
				if ($key == 'editor')
					$value = wp_kses_post($value);
				elseif ($key == 'url')
					$value = sanitize_url($value);
				elseif ($key == 'id')
					$value = sanitize_text_field(filter_var($value, FILTER_SANITIZE_NUMBER_INT));
				else
					$value = sanitize_text_field($value);
			}
		}

		return $array;
	}



	public function upgrade_store_do_activation_redirect()
	{
		if (get_option('upgrade_store_do_activation_redirect')) {
			delete_option('upgrade_store_do_activation_redirect');
			wp_safe_redirect(admin_url('admin.php?page=' . $this->plugin_name . '-welcome'));
		}
	}
}
