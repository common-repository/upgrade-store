<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://programmelab.com
 * @since      1.0.0
 *
 * @package    Upgrade_Store
 * @subpackage Upgrade_Store/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Upgrade_Store
 * @subpackage Upgrade_Store/public
 * @author     ProgrammeLab <rizvi@programmelab.com>
 */
class Upgrade_Store_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name . '-jquery.countdown', plugin_dir_url(__FILE__) . 'plugins/jquery-countdown/jquery.countdown.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name . '-jquery-modal', plugin_dir_url(__FILE__) . 'plugins/jquery-modal/jquery.modal.min.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name . '-fancyapps', plugin_dir_url(__FILE__) . 'plugins/fancybox/fancybox.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name . '-swiper', plugin_dir_url(__FILE__) . 'plugins/swiper/swiper-bundle.min.css', array(), $this->version, 'all');

		// wp_enqueue_style($this->plugin_name . '-fancyapps', '//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/upgrade-store-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script($this->plugin_name . '-jquery.countdown', plugin_dir_url(__FILE__) . 'plugins/jquery-countdown/jquery.countdown.js', array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name . '-jquery-modal', plugin_dir_url(__FILE__) . 'plugins/jquery-modal/jquery.modal.min.js', array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name . '-fancyapps', plugin_dir_url(__FILE__) . 'plugins/fancybox/fancybox.umd.js', array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name . '-swiper', plugin_dir_url(__FILE__) . 'plugins/swiper/swiper-bundle.min.js', array('jquery'), $this->version, false);

		// /plugins/woocommerce/assets/js/zoom/jquery.zoom.js
		// plugins_url('woocommerce/assets/js/zoom/jquery.zoom.js)

		// wp_enqueue_script($this->plugin_name . '-jquery.zoom', plugins_url('woocommerce/assets/js/zoom/jquery.zoom.js'), array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name . '-jquery.zoom', plugin_dir_url(__FILE__) . 'plugins/jquery-zoom/jquery.zoom.min.js', array('jquery'), $this->version, false);



		// wp_enqueue_script($this->plugin_name . '-fancyapps', '//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name . '-ajax', plugin_dir_url(__FILE__) . 'js/upgrade-store-public-ajax.js', array('jquery'), $this->version, false);
		$ajax_params = array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'security' => esc_attr(wp_create_nonce('upgrade_store_security_nonce')),
		);
		wp_localize_script($this->plugin_name . '-ajax', 'ajax_obj', $ajax_params);

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/upgrade-store-public.js', array('jquery'), $this->version, false);
	}
	public function upgrade_store_woo_discount($atts)
	{
		$output = '';
		$args = shortcode_atts(
			array(
				'id'   => get_the_ID(),
			),
			$atts
		);
		$product_id = sanitize_text_field(filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT));;
		$product = wc_get_product($product_id);
		if ($product) {
			$sale_price = $product->get_sale_price();
			if ($sale_price) {
				$regular_price = $product->get_regular_price();
				$output = number_format(($regular_price - $sale_price) * 100 / $regular_price, 2);
			} else {
				$output = esc_html__('This product is not on sale', 'upgrade-store');
			}
		} else {
			$output = esc_html__('This is not a product', 'upgrade-store');
		}

		return $output;
	}
	public function upgrade_store_woo_quantity($atts)
	{
		$output = '';
		$args = shortcode_atts(
			array(
				'id'   => get_the_ID(),
			),
			$atts
		);
		$product_id = sanitize_text_field(filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT));;
		$product = wc_get_product($product_id);
		if ($product) {
			$stock_quantity = $product->get_stock_quantity();
			if ($stock_quantity) {
				$output = $stock_quantity;
			} else {
				$output = esc_html__('This product is not available.', 'upgrade-store');
			}
		} else {
			$output = esc_html__('This is not a product', 'upgrade-store');
		}

		return $output;
	}
	public function upgrade_store_woo_count_down_data()
	{
		$upgrade_store_api_settings = (get_option('upgrade_store_api_settings')) ? get_option('upgrade_store_api_settings') : [];
		$product_countdown_data = get_post_meta(get_the_ID(), '_upgrade_store_product_countdown_data', true) ? get_post_meta(get_the_ID(), '_upgrade_store_product_countdown_data', true) : [];
		if (isset($product_countdown_data['time-duration-start']) && $product_countdown_data['time-duration-start'] && isset($product_countdown_data['time-duration-end']) && $product_countdown_data['time-duration-end'] && isset($upgrade_store_api_settings["settings_enable_countdown_timer"])) :
			$now    = new DateTime();
			$startTime = preg_replace('/T/i', ' ', $product_countdown_data['time-duration-start']);
			$endTime = preg_replace('/T/i', ' ', $product_countdown_data['time-duration-end']);
?>
			<div class="upgrade-store-woo-meta-data woo-count-down-data text-center">
				<?php if (isset($product_countdown_data['countdown-heading'])) : ?>
					<h3 class="meta-data-heading"><?php echo esc_html(do_shortcode($product_countdown_data['countdown-heading'])) ?></h3>
				<?php endif ?>
				<?php if (isset($product_countdown_data['countdown-subtext'])) : ?>
					<h4 class="meta-data-subtext"><?php echo esc_html(do_shortcode($product_countdown_data['countdown-subtext'])) ?></h4>
				<?php endif ?>
				<?php if (new DateTime($startTime) < $now) : ?>
					<div class="alt-1 count-down"><?php echo esc_html($product_countdown_data['time-duration-end']) ?></div>
				<?php endif ?>
			</div>
		<?php
		endif;
	}
	public function upgrade_store_woo_stocks_left_data()
	{
		$upgrade_store_api_settings = (get_option('upgrade_store_api_settings')) ? get_option('upgrade_store_api_settings') : [];
		$post_id = get_the_ID();
		$product = wc_get_product($post_id);
		$prefix = '_upgrade_store_inventory_';
		$total_sold_count_text = get_post_meta($post_id, $prefix . "total_sold_count_text", true);
		$subtext = get_post_meta($post_id, $prefix . "subtext", true);
		if (($total_sold_count_text || $subtext) && isset($upgrade_store_api_settings["settings_enable_stocks_left"])) :
		?>
			<div class="upgrade-store-woo-meta-data woo-stocks-left-data">
				<?php if ($total_sold_count_text) : ?>
					<h4 class="meta-data-subtext"><?php echo esc_html(do_shortcode($total_sold_count_text)) ?>: <span class="text-blue"><?php echo esc_html($product->get_total_sales()) ?></span></h4>
				<?php endif ?>
				<?php if ($subtext) : ?>
					<h3 class="meta-data-heading"><?php echo esc_html(do_shortcode($subtext)) ?></h3>
				<?php endif ?>

			</div>
		<?php
		endif;
	}
	public function upgrade_store_woo_stocks_left_data_loop_item()
	{
		$upgrade_store_api_settings = (get_option('upgrade_store_api_settings')) ? get_option('upgrade_store_api_settings') : [];
		$upgrade_store_api_stocks_left = (get_option('upgrade_store_api_stocks_left')) ? get_option('upgrade_store_api_stocks_left') : [];
		global $product;
		if ($product->get_stock_quantity() && isset($upgrade_store_api_settings['settings_enable_stocks_left']) && isset($upgrade_store_api_stocks_left['stocks_left_enable_shop_page'])) {
		?>
			<div class="woo-stocks-left-loop-data text-center">
				<p><?php printf(esc_html__('Only %1$s Left.', 'upgrade-store'), esc_html($product->get_stock_quantity())); ?></p>
			</div>
		<?php
		}
	}
	public function upgrade_store_woocommerce_stock_html($html, $product)
	{
		$upgrade_store_api_settings = (get_option('upgrade_store_api_settings')) ? get_option('upgrade_store_api_settings') : [];
		$upgrade_store_api_stocks_left = (get_option('upgrade_store_api_stocks_left')) ? get_option('upgrade_store_api_stocks_left') : [];
		if (isset($upgrade_store_api_settings['settings_enable_stocks_left']) && isset($upgrade_store_api_stocks_left['stocks_left_hide_default_stock_count']))
			$html = '';
		return $html;
	}
	public function upgrade_store_woo_new_product_tab($tabs)
	{

		$upgrade_store_api_settings = (get_option('upgrade_store_api_settings')) ? get_option('upgrade_store_api_settings') : [];

		if (isset($upgrade_store_api_settings["settings_enable_product_tab"]) && $upgrade_store_api_settings['settings_enable_product_tab']) {
			global $product;
			$product_tabs = get_post_meta($product->get_id(), '_upgrade_store_product_tab_data', true);
			// Adds the new tab
			if (@$product_tabs && sizeof($product_tabs)) {
				foreach ($product_tabs as $index => $product_tab) {
					$post_data = get_post($index);
					$post_content = $post_data->post_content;
					$post_content = apply_filters('the_content', $post_content);
					$post_content = str_replace(']]>', ']]&gt;', $post_content);

					$data = [];
					$data['title'] = get_the_title($index);

					$data['content'] = (is_array($product_tab) && isset($product_tab["enable"]) && $product_tab['enable']) ? $product_tab['editor'] : $post_content;

					$tabs['custom_tab_' . $index] = array(
						'title' 	=> esc_html($data['title']),
						'priority' 	=> 1,
						'callback' 	=> function () use ($data) {
							echo '<h2 class="tab-title">' . esc_html($data['title']) . '</h2>';
							echo '<div class="tab-intro">' . wp_kses_post(do_shortcode($data['content'])) . '</div>';
						}
					);
				}
			} else {
				$args = array(
					'post_type'			=> 'product-tab',
					'posts_per_page'	=> -1
				);
				$query = new WP_Query($args);
				if ($query->have_posts()) {
					$data = [];
					while ($query->have_posts()) {
						$query->the_post();

						$post_content = get_the_content();
						$post_content = apply_filters('the_content', $post_content);
						$post_content = str_replace(']]>', ']]&gt;', $post_content);

						$data['title'] = get_the_title();
						$data['content'] = $post_content;

						$tabs['custom_tab_' . get_the_ID()] = array(
							'title' 	=> esc_html($data['title']),
							'priority' 	=> 1,
							'callback' 	=> function () use ($data) {
								echo '<h2 class="tab-title">' . esc_html($data['title']) . '</h2>';
								echo '<div class="tab-intro">' . wp_kses_post(do_shortcode($data['content'])) . '</div>';
							}
						);
					}
				}
				wp_reset_postdata();
			}
		}
		if (isset($upgrade_store_api_settings["settings_enable_attachments_tab"]) && $upgrade_store_api_settings['settings_enable_attachments_tab']) {
			$upgrade_store_api_attachments = get_option('upgrade_store_api_attachments');
			//upgrade_store_api_attachments[attachment_enable_tab_name]
			//upgrade_store_api_attachments[attachment_enable_tab_icon]
			$cat_ids = [];
			$show_meta = false;
			$categories_for_the_current_post = get_the_terms(get_the_ID(), 'product_cat');

			$name = (!isset($upgrade_store_api_attachments["attachment_enable_tab_name"])) ? esc_html__("Attachment", 'upgrade-store') : ((get_post_meta(get_the_ID(), '_upgrade_store_product_attachment_name', true)) ? get_post_meta(get_the_ID(), '_upgrade_store_product_attachment_name', true) : esc_html__("Attachment", 'upgrade-store'));
			// $name = "test";
			$icon = (isset($upgrade_store_api_attachments["attachment_enable_tab_icon"])) ? get_post_meta(get_the_ID(), '_upgrade_store_product_attachment_icon', true) : '';


			if (@$categories_for_the_current_post && sizeof($categories_for_the_current_post)) {
				foreach ($categories_for_the_current_post as $category) {
					$cat_ids[] = $category->term_id;
				}
			}
			if ($upgrade_store_api_attachments['attachment_category_for'] == 'all') {
				$show_meta = true;
			} else {
				$result = [];
				if (is_array($cat_ids) && is_array($upgrade_store_api_attachments) && isset($upgrade_store_api_attachments["attachment_categories"]) && is_array($upgrade_store_api_attachments['attachment_categories'])) $result = array_intersect($cat_ids, $upgrade_store_api_attachments['attachment_categories']);
				if (sizeof($result)) $show_meta = true;
				else  $show_meta = false;
			}
			if (!$name) $show_meta = false;
			if ($show_meta) {
				$data = [];
				$data['title'] = $name;
				$data['icon'] = ($icon && is_array($icon) && $icon['url']) ? '<span class="title-icon"  style="--background: url(' . $icon['url'] . ')"></span>' : '';
				$tabs['custom_tab_attachments'] = array(
					'title' 	=> $data['icon'] . '<span class="title-name">' . esc_html($data['title']) . '</span>',
					'priority' 	=> 2,
					'callback' 	=> function () use ($data) {
						$description = get_post_meta(get_the_ID(), '_upgrade_store_product_attachment_description', true);
						$type = get_post_meta(get_the_ID(), '_upgrade_store_product_attachment_type', true);
						$internalFile = get_post_meta(get_the_ID(), '_upgrade_store_product_attachment_internalFile', true);
						$externalFile = get_post_meta(get_the_ID(), '_upgrade_store_product_attachment_externalFile', true);
						$newWindow = get_post_meta(get_the_ID(), '_upgrade_store_product_attachment_newWindow', true);
						$attr = ($newWindow) ? 'target="_blank"' : 'download';
						if ($type == 'external' && $externalFile) {
							$fileToDownload = $externalFile;
						} else {
							if ($internalFile && is_array($internalFile)) {
								$fileToDownload = $internalFile['url'];
							} else {
								$fileToDownload = '';
							}
						}
						echo '<div class="tab-intro">';
						if ($description) {
							echo '<div class="tab-description">';
							echo '<h4 class="description-title">' . esc_html__('Descriptions', 'upgrade-store') . '</h4>';
							echo '<div class="description-content">' . wp_kses_post(do_shortcode($description)) . '</div>';
							echo '</div>';
						}
						if ($fileToDownload) {
							echo '<div class="downloadable-data">';
							echo '<strong class="description-title inline-content">' . esc_html($data['title']) . ': </strong>';
							echo '<a class="download-button" href="' . esc_url($fileToDownload) . '" ' . esc_html($attr) . '>' . esc_html__('Download', 'upgrade-store') . '</a>';
							echo '</div>';
							echo '</div>';
						}
					}
				);
			}
		}
		return $tabs;
	}
	// Callback function
	public function upgrade_store_get_product_details()
	{

		if (!wp_verify_nonce(sanitize_text_field(wp_unslash(@$_POST['security'])), 'upgrade_store_security_nonce')) {
			wp_send_json_error(esc_html__("Nonce validation failed.", "upgrade-store"));
			die();
		}

		if (!$_POST['product_id']) {
			wp_send_json_error(esc_html__("Necessary variables not set.", "upgrade-store"));
			die();
		}


		$html = "";
		global $post;
		$product = wc_get_product($_POST['product_id']);



		if ($product->get_id()) {
			$ret['success'] = 1;
			$upgrade_store_api_quickview = get_option('upgrade_store_api_quickview');
			ob_start();
			//upgrade_store_api_settings[settings_enable_gallery]
			//upgrade_store_api_gallery[gallery_enable_gallery_type]
			//upgrade_store_api_gallery[gallery_select_gallery_type]
			//upgrade_store_api_gallery[gallery_enable_for_quickview]
			$upgrade_store_api_settings = get_option('upgrade_store_api_settings') ? get_option('upgrade_store_api_settings') : [];
			$upgrade_store_api_gallery = get_option('upgrade_store_api_gallery') ? get_option('upgrade_store_api_gallery') : [];
		?>
			<div class="single-product">
				<div id="product-<?php echo esc_html($product->get_id()) ?>" class="product">
					<?php if (isset($upgrade_store_api_settings['settings_enable_gallery']) && isset($upgrade_store_api_gallery['gallery_enable_gallery_type']) && isset($upgrade_store_api_gallery['gallery_enable_for_quickview'])) : ?>
						<?php
						$upgrade_store_gallery_type = get_post_meta($product->get_id(), '_upgrade_store_gallery_type', true);
						$type = isset($upgrade_store_api_gallery['gallery_select_gallery_type']) ? $upgrade_store_api_gallery['gallery_select_gallery_type'] : 'type-1';
						if (isset($upgrade_store_api_gallery['gallery_enable_specific_product'])) {
							$type = ($upgrade_store_gallery_type) ? $upgrade_store_gallery_type : $type;
						}
						$galleryType = $slidesPerView = $direction = $conClass = '';
						if ($type ==  'type-6' || $type ==  'type-7' || $type ==  'type-8') {
							$galleryType = 'block';
						} else {
							$galleryType = 'slider';
							if ($type ==  'type-1') {
								$slidesPerView = 2;
							} else if ($type ==  'type-3' || $type ==  'type-5' || $type ==  'type-9') {
								$slidesPerView = 3;
							} else if ($type ==  'type-2' || $type ==  'type-4' || $type ==  'type-10') {
								$slidesPerView = 4;
							}
							if ($type ==  'type-1' || $type ==  'type-2' || $type ==  'type-3' || $type ==  'type-4') {
								$direction = 'vertical';
								$conClass = 'vertical-slider gallery-wrapper gallery-row gallery-g-2 gallery-flex-row';
								if ($type ==  'type-2' || $type ==  'type-3') {
									$conClass .= '-reverse';
								}
							} else if ($type ==  'type-5' || $type ==  'type-9' || $type ==  'type-10') {
								$direction = 'horizontal';
								$conClass = 'gallery-d-flex gallery-gap-2 gallery-flex-column';
								if ($type ==  'type-5') {
									$conClass = 'inside-thumbnail ' . $conClass;
								}
								//$conClass .= '-reverse';
							}
						}
						$gallery_images = $product->get_gallery_image_ids() ? $product->get_gallery_image_ids() : [];
						if ($product->get_image_id()) {
							array_unshift($gallery_images, intval($product->get_image_id()));
						}
						if (sizeof($gallery_images) > 1) : ?>
							<div class="woocommerce-product-gallery upgrade-store-woocommerce-product-gallery">
								<?php if ($galleryType == 'slider') : ?>
									<div class="gallery-wrapper <?php echo esc_html($conClass) ?>">
										<div class="gallery-main-slider <?php echo ($direction == 'vertical') ? 'gallery-col-big' : '' ?>">
											<div class="swiper gallery-slider">
												<div class="swiper-wrapper">
													<?php foreach ($gallery_images as $attachment_id) : ?>
														<div class="swiper-slide">
															<?php echo wp_get_attachment_image($attachment_id, 'woocommerce_single');  ?>
														</div>
													<?php endforeach ?>
												</div>
											</div>
										</div>
										<div class="gallery-thumbnail-slider <?php echo ($direction == 'vertical') ? 'gallery-col-small' : '' ?>">
											<div class="swiper gallery-slider-nav slider-nav <?php echo ($direction == 'vertical') ? 'vertical-slider-nav' : '' ?>">
												<div class="swiper-wrapper">
													<?php foreach ($gallery_images as $attachment_id) : ?>
														<div class="swiper-slide">
															<?php echo wp_get_attachment_image($attachment_id, 'woocommerce_gallery_thumbnail');  ?>
														</div>
													<?php endforeach ?>

												</div>
												<div class="swiper-button-next"></div>
												<div class="swiper-button-prev"></div>
											</div>
										</div>
									</div>
								<?php else : ?>
									<div class="gallery-wrapper gallery-grid <?php echo esc_html($type) ?>">
										<?php foreach ($gallery_images as $attachment_id) : ?>
											<div class="gallery-unit">
												<?php echo wp_get_attachment_image($attachment_id, 'full');  ?>
											</div>
										<?php endforeach ?>
									</div>
								<?php endif ?>
							</div>
							<script>
								var swiperNav = new Swiper(".gallery-slider-nav", {
									loop: true,
									lazy: true,
									spaceBetween: 10,
									autoHeight: true,
									slidesPerView: <?php echo esc_html($slidesPerView) ?>,
									direction: "<?php echo esc_html($direction) ?>", //horizontal, vertical
									navigation: {
										nextEl: ".swiper-button-next",
										prevEl: ".swiper-button-prev",
									},
									// direction: "vertical",
								});
								var swiper = new Swiper(".gallery-slider", {
									loop: true,
									lazy: true,
									autoHeight: true,
									spaceBetween: 10,
									direction: "<?php echo esc_html($direction) ?>", //horizontal, vertical
									navigation: {
										nextEl: ".swiper-button-next",
										prevEl: ".swiper-button-prev",
									},
									thumbs: {
										swiper: swiperNav,
									},
									// on: {
									// 	transitionStart: function() {
									// 		var videos = document.querySelectorAll("video");
									// 		Array.prototype.forEach.call(videos, function(video) {
									// 			video.pause();
									// 		});
									// 	},
									// 	transitionEnd: function() {
									// 		var activeIndex = this.activeIndex;
									// 		var activeSlide =
									// 			document.getElementsByClassName("swiper-slide")[activeIndex];
									// 		var activeSlideVideo = activeSlide.getElementsByTagName("video")[0];
									// 		if (activeSlideVideo) activeSlideVideo.play();
									// 	},
									// },
									// autoplay: {
									// 	delay: 2500,
									// 	disableOnInteraction: false,
									// },
								});
							</script>
						<?php elseif (sizeof($gallery_images) == 1) : ?>
							<div class="woocommerce-product-gallery upgrade-store-woocommerce-product-gallery">
								<div class="upgrade-store-woocommerce-product-gallery__image">
									<?php echo wp_get_attachment_image($product->get_image_id(), 'woocommerce_single');  ?>
								</div>
							</div>
						<?php endif; ?>
					<?php else : ?>
						<?php if ($product->get_image_id()) : ?>
							<div class="woocommerce-product-gallery upgrade-store-woocommerce-product-gallery">
								<div class="woocommerce-product-gallery__wrapper <?php echo (isset($upgrade_store_api_quickview["quickview_enable_zoom"])) ? 'zoom-image' : '' ?>" data-img="<?php echo esc_url(wp_get_attachment_url($product->get_image_id())) ?>">
									<?php echo wp_get_attachment_image($product->get_image_id(), 'full', "", array('class' => 'quickview-feature-image')); ?>
								</div>
								<?php
								$gallery_image_ids = $product->get_gallery_image_ids();
								if ($gallery_image_ids && is_array($gallery_image_ids)) :
								?>
									<ol class="flex-control-nav flex-control-thumbs quickview-control-thumbs">
										<li class="active">
											<?php echo wp_get_attachment_image($product->get_image_id(), 'woocommerce_gallery_thumbnail', "", array("class" => "img-responsive quickview-gallery-image", "data-src" => esc_url(wp_get_attachment_url($product->get_image_id()))));  ?>
										</li>
										<?php foreach ($gallery_image_ids as $image_id) : ?>
											<li>
												<?php echo wp_get_attachment_image($image_id, array('100', '100'), false, array("class" => "quickview-gallery-image", "data-src" => esc_url(wp_get_attachment_url($image_id))));  ?>
											</li>
										<?php endforeach; ?>
									</ol>
								<?php endif ?>
								<?php if (isset($upgrade_store_api_quickview["quickview_enable_full_details"])) : ?>
									<a href="<?php echo esc_url(get_the_permalink($product->get_id())) ?>" class="quickview-full-details-button button alt"><?php echo esc_html__('View Full Details', 'upgrade-store') ?></a>
								<?php endif ?>
							</div>
						<?php endif ?>
					<?php endif ?>
					<div class="summary entry-summary">
						<h1 class="product_title entry-title"><?php echo esc_html($product->get_name()) ?></h1>
						<p class="price">
							<?php echo wp_kses_post($product->get_price_html()) ?>
						</p>
						<div class="woocommerce-product-details__short-description">
							<?php echo wp_kses_post($product->get_short_description()) ?>
						</div>
						<?php
						if (isset($upgrade_store_api_quickview["quickview_enable_cart_button"])) {
							if ($product->get_type() == 'simple') {
								if ($product->is_purchasable()) {
									echo '<form class="cart" action="" method="post" enctype="multipart/form-data"><div class="quantity"><label class="screen-reader-text" for="quantity_' . esc_html($product->get_id()) . '">' . esc_html($product->get_name()) . ' quantity</label><input type="number" id="quantity_' . esc_html($product->get_id()) . '" class="input-text qty text" name="quantity" value="1" aria-label="Product quantity" size="4" min="1" max="" step="1" placeholder="" inputmode="numeric" autocomplete="off"></div><button type="submit" name="add-to-cart" value="' . esc_html($product->get_id()) . '" class="single_add_to_cart_button button alt">' . esc_html($product->add_to_cart_text()) . '</button></form>';
								}
							} elseif ($product->get_type() == 'variable') {
								echo '<div class="quickview-cart-button-wrap"><a href="' . esc_url(get_the_permalink($product->get_id())) . '" data-quantity="1" class="button product_type_variable add_to_cart_button alt" data-product_id="' . esc_html($product->get_id()) . '" data-product_sku="' . esc_html($product->get_sku()) . '" aria-label="' . esc_html($product->add_to_cart_text()) . ' for “' . esc_html($product->get_name()) . '”" aria-describedby="This product has multiple variants. The options may be chosen on the product page" rel="nofollow">' . esc_html($product->add_to_cart_text()) . '</a></div>';
							} elseif ($product->get_type() == 'grouped') {
								echo '<div class="quickview-cart-button-wrap"><a href="' . esc_url(get_the_permalink($product->get_id())) . '" data-quantity="1" class="button product_type_grouped alt" data-product_id="' . esc_html($product->get_id()) . '" data-product_sku="' . esc_html($product->get_sku()) . '" aria-label="' . esc_html($product->add_to_cart_text()) . ' in the “' . esc_html($product->get_name()) . '” group" aria-describedby="" rel="nofollow">' . esc_html($product->add_to_cart_text()) . '</a></div>';
							} elseif ($product->get_type() == 'external') {
								$product_url = (get_post_meta($product->get_id(), '_product_url', true)) ? get_post_meta($product->get_id(), '_product_url', true) : get_the_permalink($product->get_id());
								echo '<div class="quickview-cart-button-wrap"><a href="' . esc_url($product_url) . '" data-quantity="1" class="button product_type_external alt" data-product_id="' . esc_html($product->get_id()) . '" data-product_sku="' . esc_html($product->get_sku()) . '" aria-label="' . esc_html($product->add_to_cart_text()) . '" aria-describedby="" rel="nofollow">' . esc_html($product->add_to_cart_text()) . '</a></div>';
							}
						}
						?>
						<div class="product_meta">
							<?php if ($product->get_sku()) : ?>
								<span class="sku_wrapper"><?php echo esc_html__('SKU', 'upgrade-store') ?>: <span class="sku"><?php echo esc_html($product->get_sku()) ?></span></span>
							<?php endif ?>
							<?php $categories = $product->get_category_ids(); ?>
							<?php if ($categories && is_array($categories)) : ?>
								<span class="posted_in"><?php echo esc_html__('Category', 'upgrade-store') ?>:
									<?php foreach ($categories as $id) : ?>
										<?php
										$term = get_term($id);
										// $taxonomy = get_taxonomy($term->taxonomy);
										$term_link = get_term_link($term);
										?>
										<a href="<?php echo esc_url($term_link) ?>" rel="tag"><?php echo esc_html($term->name) ?></a>
									<?php endforeach ?>
								</span>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		<?php
			$html = ob_get_clean();
			$ret['html'] = $html;
		}
		die(wp_json_encode($ret));
	}
	public function upgrade_store_customize_woo_hooks()
	{

		$upgrade_store_api_quickview = get_option('upgrade_store_api_quickview');

		add_action('woocommerce_before_shop_loop_item_title', function () {
			echo '<span class="woocommerce-loop-product__thumbnail-wrapper">';
		}, 9);
		if (is_array($upgrade_store_api_quickview) && isset($upgrade_store_api_quickview["quickview_enable_for_product"])) {
			add_action('woocommerce_before_shop_loop_item_title', function () {
				global $product;
				$show = $this->upgrade_store_enable_quickview($product->get_id());
				if ($show) {
					$feature_image_id = $product->get_image_id();
					$feature_image_url = $feature_image_id ? wp_get_attachment_url($feature_image_id) : '';
					$gallery_image_ids = $product->get_gallery_image_ids();
					if ($feature_image_url) {
						echo '<span class="fancybox-gallery">';
						echo '<span data-fancybox="gallery-' . esc_html($product->get_id()) . '" data-src="' . esc_url($feature_image_url) . '">Zoom</span>';
						if ($gallery_image_ids) {
							foreach ($gallery_image_ids as $attachment_id) {
								echo '<span data-fancybox="gallery-' . esc_html($product->get_id()) . '" data-src="' . esc_url(wp_get_attachment_url($attachment_id)) . '">Image - ' . esc_html($attachment_id) . '</span>';
							}
						}
						echo '</span>';
					}
					echo '</span">';
				}
			}, 11);
		}
		add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 12);
		add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 13);

		add_action('woocommerce_after_shop_loop_item', function () {
			global $product;
			$show = $this->upgrade_store_enable_quickview($product->get_id());
			if ($show)	echo '<div class="quickview-opener-wrapper"><button class="quickview-opener" data-product_id="' . esc_html($product->get_id()) . '">' . esc_html__('Quick View', 'upgrade-store') . '</button></div>';
		}, 9);
		add_action('woocommerce_after_main_content', function () {
			global $product;
			echo '<div class="quickview-dialog" style="display: none">Loading...</div>';
		}, 999);
	}
	public function upgrade_store_enable_quickview($product_id)
	{

		$upgrade_store_api_quickview = get_option('upgrade_store_api_quickview');
		$upgrade_store_api_settings = get_option('upgrade_store_api_settings');
		$show_meta = false;
		if (is_array($upgrade_store_api_settings) && isset($upgrade_store_api_settings['settings_enable_quickview_tab'])) {
			$cat_ids = [];
			$categories_for_the_current_post = get_the_terms($product_id, 'product_cat');
			if (@$categories_for_the_current_post && sizeof($categories_for_the_current_post)) {
				foreach ($categories_for_the_current_post as $category) {
					$cat_ids[] = $category->term_id;
				}
			}
			if (@$upgrade_store_api_quickview['quickview_category_for'] == 'all') {
				$show_meta = true;
			} else {
				$result = [];
				if (is_array($cat_ids) && is_array($upgrade_store_api_quickview) && isset($upgrade_store_api_quickview["quickview_categories"]) && is_array($upgrade_store_api_quickview['quickview_categories'])) $result = array_intersect($cat_ids, $upgrade_store_api_quickview['quickview_categories']);
				if (sizeof($result)) $show_meta = true;
			}
		}
		return $show_meta;
	}
	public function upgrade_store_archive_banner_image_setup()
	{
		global $post;
		$upgrade_store_api_settings = get_option('upgrade_store_api_settings');
		if (isset($upgrade_store_api_settings['settings_enable_banner'])) {
			$fig = $links_start = $img = $link_end = '';
			$upgrade_store_api_banner = get_option('upgrade_store_api_banner');

			$alt = '';
			if (!is_single()) {
				if (isset($upgrade_store_api_banner['banner_enable_shop_page'])) {
					if (isset($upgrade_store_api_banner['shop_page_banner_width'])) {
						if ($upgrade_store_api_banner['shop_page_banner_width'] == 'align-wide') $fig = 'alignwide';
						else if ($upgrade_store_api_banner['shop_page_banner_width'] == 'align-full-width') $fig = 'alignfull';
						else $fig = '';
					}
					if (isset($upgrade_store_api_banner['shop_page_banner_external_image']['url']) && $upgrade_store_api_banner['shop_page_banner_external_image']['url']) {
						//$upgrade_store_api_banner['shop_page_banner_image_alt']
						$alt = $upgrade_store_api_banner['shop_page_banner_external_image']['alt'] ? $upgrade_store_api_banner['shop_page_banner_external_image']['alt'] : (is_shop() ? woocommerce_page_title(false) : single_cat_title('', false));
					}


					if (isset($upgrade_store_api_banner['shop_page_banner_url']) && $upgrade_store_api_banner['shop_page_banner_url']) {
						$links_start = '<a href="' . esc_url($upgrade_store_api_banner['shop_page_banner_url']) . '" >';
						$link_end = '</a>';
					}
					if (isset($upgrade_store_api_banner['shop_page_banner_external_image']['url']) && $upgrade_store_api_banner['shop_page_banner_external_image']['url']) {
						$img = '<img class="category-banner" src="' . esc_url($upgrade_store_api_banner['shop_page_banner_external_image']['url']) . '" alt="' . esc_html($alt) . '" />';
					} elseif (isset($upgrade_store_api_banner['shop_page_banner_internal_image']['id']) && $upgrade_store_api_banner['shop_page_banner_internal_image']['id']) {
						$img = wp_get_attachment_image($upgrade_store_api_banner['shop_page_banner_internal_image']['id'], 'full', false, array('class' => 'category-banner'));
					}
				}
			} else {
				if (isset($upgrade_store_api_banner['banner_enable_all_product_page'])) {

					if (isset($upgrade_store_api_banner['all_product_page_banner_width'])) {
						if ($upgrade_store_api_banner['all_product_page_banner_width'] == 'align-wide') $fig = 'alignwide';
						else if ($upgrade_store_api_banner['all_product_page_banner_width'] == 'align-full-width') $fig = 'alignfull';
						else $fig = '';
					}

					$image_alt = isset($upgrade_store_api_banner['all_product_page_banner_image_alt']) ? $upgrade_store_api_banner['all_product_page_banner_image_alt'] : '';


					if (isset($upgrade_store_api_banner['all_product_page_banner_external_image']['url']) && $upgrade_store_api_banner['all_product_page_banner_external_image']['url']) {
						//$upgrade_store_api_banner['all_product_page_banner_image_alt']
						$image_alt = $upgrade_store_api_banner['all_product_page_banner_external_image']['alt'];
					}

					$url = isset($upgrade_store_api_banner['all_product_page_banner_url']) ? $upgrade_store_api_banner['all_product_page_banner_url'] : '';

					$internal_image = isset($upgrade_store_api_banner['all_product_page_banner_internal_image']) ? $upgrade_store_api_banner['all_product_page_banner_internal_image'] : '';

					$external_image_url = isset($upgrade_store_api_banner['all_product_page_banner_external_image']['url']) ? $upgrade_store_api_banner['all_product_page_banner_external_image']['url'] : '';

					if ($external_image_url) {
						$alt = $image_alt ? $image_alt : get_the_title();
					}

					if ($external_image_url) {
						$img = '<img class="category-banner" src="' . esc_url($external_image_url) . '" alt="' . esc_html($alt) . '" />';
					} else if (isset($internal_image['id']) && $internal_image['id']) {
						$img = wp_get_attachment_image($internal_image['id'], 'full', false, array('class' => 'category-banner'));
					}


					if (isset($upgrade_store_api_banner['banner_enable_specific_product'])) {
						//_upgrade_store_banner_width
						$upgrade_store_banner_width = get_post_meta($post->ID, '_upgrade_store_banner_width', true);
						if ($upgrade_store_banner_width) {
							if ($upgrade_store_banner_width == 'align-wide') $fig = 'alignwide';
							else if ($upgrade_store_banner_width == 'align-full-width') $fig = 'alignfull';
						}

						$image_alt_from_meta = get_post_meta($post->ID, '_upgrade_store_banner_alt_text', true);

						$image_alt = $image_alt_from_meta ? $image_alt_from_meta : $image_alt;

						$url_from_meta = get_post_meta($post->ID, '_upgrade_store_banner_url', true);
						$url = $url_from_meta ? $url_from_meta : $url;

						$internal_image_from_meta = get_post_meta($post->ID, '_upgrade_store_banner_internal_image', true);
						// $internal_image = (isset($internal_image_from_meta['id']) && $internal_image_from_meta['id']) ? $internal_image_from_meta : $internal_image;

						$external_image_url_from_meta = get_post_meta($post->ID, '_upgrade_store_banner_external_image_url', true);

						// $external_image_url = $external_image_url_from_meta ? $external_image_url_from_meta : $external_image_url;

						if ($external_image_url) {
							$alt = $image_alt ? $image_alt : get_the_title();
						}

						if ($external_image_url_from_meta) {
							$img = '<img class="category-banner" src="' . esc_url($external_image_url_from_meta) . '" alt="' . esc_html($alt) . '" />';
						} else if (isset($internal_image_from_meta['id']) && $internal_image_from_meta['id']) {
							$img = wp_get_attachment_image($internal_image_from_meta['id'], 'full', false, array('class' => 'category-banner'));
						}
					}
					if ($url) {
						$links_start = '<a href="' . esc_url($url) . '" >';
						$link_end = '</a>';
					}
				}
			}
			//alignwide, alignfull, 
			echo $img ? wp_kses_post('<figure class="wp-block-image category-banner-image ' . esc_html($fig) . '">' . $links_start . $img . $link_end . '</figure>') : '';
		}
	}
	public function upgrade_store_disable_product_image_right_click()
	{
		//upgrade_store_api_gallery[gallery_enable_gallery_lock]
		$upgrade_store_api_gallery = get_option('upgrade_store_api_gallery') ? get_option('upgrade_store_api_gallery') : [];
		if (isset($upgrade_store_api_gallery['gallery_enable_gallery_lock'])) {
		?>
			<script>
				jQuery(document).ready(function($) {
					$('.woocommerce-product-gallery').bind('contextmenu', function(e) {
						return false;
					});
				});
			</script>
		<?php
		}
	}
	public function upgrade_store_woocommerce_show_product_images_customization()
	{
		// upgrade_store_api_gallery[gallery_enable_gallery_type]
		$upgrade_store_api_gallery = get_option('upgrade_store_api_gallery') ? get_option('upgrade_store_api_gallery') : [];

		if (isset($upgrade_store_api_gallery['gallery_enable_gallery_type'])) {
			remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
			add_action('woocommerce_before_single_product_summary', [$this, 'upgrade_store_woocommerce_show_product_images'], 20);
		}
	}
	public function upgrade_store_woocommerce_show_product_images()
	{
		global $product;
		$upgrade_store_api_gallery = get_option('upgrade_store_api_gallery') ? get_option('upgrade_store_api_gallery') : [];
		$upgrade_store_gallery_type = get_post_meta($product->get_id(), '_upgrade_store_gallery_type', true);


		$type = isset($upgrade_store_api_gallery['gallery_select_gallery_type']) ? $upgrade_store_api_gallery['gallery_select_gallery_type'] : 'type-1';
		if (isset($upgrade_store_api_gallery['gallery_enable_specific_product'])) {
			$type = ($upgrade_store_gallery_type) ? $upgrade_store_gallery_type : $type;
		}
		$galleryType = $slidesPerView = $direction = $conClass = '';
		if ($type ==  'type-6' || $type ==  'type-7' || $type ==  'type-8') {
			$galleryType = 'block';
		} else {
			$galleryType = 'slider';
			if ($type ==  'type-1') {
				$slidesPerView = 2;
			} else if ($type ==  'type-3' || $type ==  'type-5' || $type ==  'type-9') {
				$slidesPerView = 3;
			} else if ($type ==  'type-2' || $type ==  'type-4' || $type ==  'type-10') {
				$slidesPerView = 4;
			}
			if ($type ==  'type-1' || $type ==  'type-2' || $type ==  'type-3' || $type ==  'type-4') {
				$direction = 'vertical';
				$conClass = 'vertical-slider gallery-wrapper gallery-row gallery-g-2 gallery-flex-row';
				if ($type ==  'type-2' || $type ==  'type-3') {
					$conClass .= '-reverse';
				}
			} else if ($type ==  'type-5' || $type ==  'type-9' || $type ==  'type-10') {
				$direction = 'horizontal';
				$conClass = 'gallery-d-flex gallery-gap-2 gallery-flex-column';
				if ($type ==  'type-5') {
					$conClass = 'inside-thumbnail ' . $conClass;
				}
				//$conClass .= '-reverse';
			}
		}
		$gallery_images = $product->get_gallery_image_ids() ? $product->get_gallery_image_ids() : [];
		if ($product->get_image_id()) {
			array_unshift($gallery_images, intval($product->get_image_id()));
		}
		if (sizeof($gallery_images) > 1) : ?>
			<div class="woocommerce-product-gallery upgrade-store-woocommerce-product-gallery">
				<?php if ($galleryType == 'slider') : ?>
					<div class="gallery-wrapper <?php echo esc_html($conClass) ?>">
						<div class="gallery-main-slider <?php echo ($direction == 'vertical') ? 'gallery-col-big' : '' ?>">
							<div class="swiper gallery-slider">
								<div class="swiper-wrapper">
									<?php foreach ($gallery_images as $attachment_id) : ?>
										<div class="swiper-slide">
											<?php echo wp_get_attachment_image($attachment_id, 'woocommerce_single');  ?>
										</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
						<div class="gallery-thumbnail-slider <?php echo ($direction == 'vertical') ? 'gallery-col-small' : '' ?>">
							<div class="swiper gallery-slider-nav slider-nav <?php echo ($direction == 'vertical') ? 'vertical-slider-nav' : '' ?>">
								<div class="swiper-wrapper">
									<?php foreach ($gallery_images as $attachment_id) : ?>
										<div class="swiper-slide">
											<?php echo wp_get_attachment_image($attachment_id, 'woocommerce_gallery_thumbnail');  ?>
										</div>
									<?php endforeach ?>

								</div>
								<div class="swiper-button-next"></div>
								<div class="swiper-button-prev"></div>
							</div>
						</div>
					</div>
				<?php else : ?>
					<div class="gallery-wrapper gallery-grid <?php echo esc_html($type) ?>">
						<?php foreach ($gallery_images as $attachment_id) : ?>
							<div class="gallery-unit">
								<?php echo wp_get_attachment_image($attachment_id, 'full');  ?>
							</div>
						<?php endforeach ?>
					</div>
				<?php endif ?>
			</div>
			<script>
				var swiperNav = new Swiper(".gallery-slider-nav", {
					loop: true,
					lazy: true,
					spaceBetween: 10,
					autoHeight: true,
					slidesPerView: <?php echo esc_html($slidesPerView) ?>,
					direction: "<?php echo esc_html($direction) ?>", //horizontal, vertical
					navigation: {
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
					},
					// direction: "vertical",
				});
				var swiper = new Swiper(".gallery-slider", {
					loop: true,
					lazy: true,
					autoHeight: true,
					spaceBetween: 10,
					direction: "<?php echo esc_html($direction) ?>", //horizontal, vertical
					navigation: {
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
					},
					thumbs: {
						swiper: swiperNav,
					},
					// on: {
					// 	transitionStart: function() {
					// 		var videos = document.querySelectorAll("video");
					// 		Array.prototype.forEach.call(videos, function(video) {
					// 			video.pause();
					// 		});
					// 	},
					// 	transitionEnd: function() {
					// 		var activeIndex = this.activeIndex;
					// 		var activeSlide =
					// 			document.getElementsByClassName("swiper-slide")[activeIndex];
					// 		var activeSlideVideo = activeSlide.getElementsByTagName("video")[0];
					// 		if (activeSlideVideo) activeSlideVideo.play();
					// 	},
					// },
					// autoplay: {
					// 	delay: 2500,
					// 	disableOnInteraction: false,
					// },
				});
			</script>
		<?php elseif (sizeof($gallery_images) == 1) : ?>
			<div class="woocommerce-product-gallery upgrade-store-woocommerce-product-gallery">
				<div class="upgrade-store-woocommerce-product-gallery__image">
					<?php echo wp_get_attachment_image($product->get_image_id(), 'woocommerce_single');  ?>
				</div>
			</div>
		<?php endif; ?>
<?php
	}
}
