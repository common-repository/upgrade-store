<?php
class Upgrade_Store_Settings
{
    /*public function __construct()
    {
        add_action('admin_init', [$this, 'api_settings_init']);
    }*/
    public function api_settings_init()
    {
        register_setting('upgrade_store_settings', 'upgrade_store_api_settings');
        register_setting('upgrade_store_attachments', 'upgrade_store_api_attachments');
        register_setting('upgrade_store_woo_email', 'upgrade_store_api_woo_email');
        register_setting('upgrade_store_quickview', 'upgrade_store_api_quickview');
        register_setting('upgrade_store_stocks_left', 'upgrade_store_api_stocks_left');
        register_setting('upgrade_store_banner', 'upgrade_store_api_banner');
        register_setting('upgrade_store_gallery', 'upgrade_store_api_gallery');
        add_settings_section(
            'upgrade_store_setting_api_section',
            '',
            '',
            'upgrade_store_settings'
        );

        add_settings_field(
            'upgrade_store_settings_enable_product_tab',
            esc_html__('Product Tabs', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_settings',
            'upgrade_store_setting_api_section',
            [
                'label_for' => 'settings_enable_product_tab',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable product tabs to add extra tabs for your products.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_settings',
                'title' => esc_html__('Product Tabs', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Seamlessly explore key product details with clear and categorized tabs. Add new product tabs using "Upgrade Store".', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_settings_enable_attachments_tab',
            esc_html__('Product Attachments', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_settings',
            'upgrade_store_setting_api_section',
            [
                'label_for' => 'settings_enable_attachments_tab',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable product attachments for the tabs section.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_settings',
                'title' => esc_html__('Product Attachments', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Add valuable resources like manuals, guides, or certificates for this product to your product tabs. With advanced customization options.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_settings_enable_quickview_tab',
            esc_html__('Quick View', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_settings',
            'upgrade_store_setting_api_section',
            [
                'label_for' => 'settings_enable_quickview_tab',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable a quick view option for the shop page.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_settings',
                'title' => esc_html__('Quick View', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Give your customers the ability to quickly view products right from the shop. Increase conversion using complete customization options.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_settings_enable_product_email',
            esc_html__('Product Notifications', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_settings',
            'upgrade_store_setting_api_section',
            [
                'label_for' => 'settings_enable_product_email',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Mute default WooCommerce notifications.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_settings',
                'title' => esc_html__('Product Notifications', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Streamline your WooCommerce notifications by enabling/disabling what notification you wish to receive.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_settings_enable_countdown_timer',
            esc_html__('Countdown Timer', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_settings',
            'upgrade_store_setting_api_section',
            [
                'label_for' => 'settings_enable_countdown_timer',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Add a countdown timer for products.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_settings',
                'title' => esc_html__('Countdown Timer', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Countdown timers create the urgency for the customers that will drive sales and increase your store\'s profit.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_settings_enable_stocks_left',
            esc_html__('Stocks Left', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_settings',
            'upgrade_store_setting_api_section',
            [
                'label_for' => 'settings_enable_stocks_left',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Display a stocks left section for products.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_settings',
                'title' => esc_html__('Stocks Left', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Show the amount of stocks left so customers don\'t miss out on any product deals or limited products that they are looking for.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_settings_enable_banner',
            esc_html__('Banner', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_settings',
            'upgrade_store_setting_api_section',
            [
                'label_for' => 'settings_enable_banner',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Showcase banner for marketing purposes.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_settings',
                'title' => esc_html__('Banner', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Add a banner that best aligns with your current marketing goals and target audience. Customize the settings to your needs.', 'upgrade-store') .  '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_settings_enable_gallery',
            esc_html__('Gallery', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_settings',
            'upgrade_store_setting_api_section',
            [
                'label_for' => 'settings_enable_gallery',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('No hints.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_settings',
                'title' => esc_html__('Gallery', 'upgrade-store'),
                'description' => '<p>' . esc_html__('No description.', 'upgrade-store') .  '</p>',
            ]
        );

        add_settings_section(
            'upgrade_store_attachments_api_section',
            '',
            '',
            'upgrade_store_attachments'
        );

        add_settings_field(
            'upgrade_store_attachment_enable_tab_name',
            esc_html__('Set Tab Name', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_attachments',
            'upgrade_store_attachments_api_section',
            [
                'label_for' => 'attachment_enable_tab_name',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable tab name option globally.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_attachments',
                'title' => esc_html__('Set Tab Name', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Design your product pages exactly how you want them with custom tab names.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_attachment_enable_tab_icon',
            esc_html__('Set Tab Icon', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_attachments',
            'upgrade_store_attachments_api_section',
            [
                'label_for' => 'attachment_enable_tab_icon',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable tab icon upload option.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_attachments',
                'title' => esc_html__('Set Tab Icon', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Add a visual layer to your tabs, making navigation even more intuitive.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_attachment_open_in_new_tab',
            esc_html__('Open in a new tab', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_attachments',
            'upgrade_store_attachments_api_section',
            [
                'label_for' => 'attachment_open_in_new_tab',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Set the attachment link open option in a new tab.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_attachments',
                'title' => esc_html__('Open in a new tab', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Links open in new tabs, allowing you to keep your current page open for easy reference.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_attachment_enable_external_url',
            esc_html__('Enable External URL', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_attachments',
            'upgrade_store_attachments_api_section',
            [
                'label_for' => 'attachment_enable_external_url',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Add attachments from an external link.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_attachments',
                'title' => esc_html__('Enable External URL', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Link to external resources directly within your content for a richer user experience.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_attachment_category_for',
            esc_html__('Category', 'upgrade-store'),
            [$this, 'upgrade_store_radio'],
            'upgrade_store_attachments',
            'upgrade_store_attachments_api_section',
            [
                'label_for' => 'attachment_category_for',
                'class' => 'upgrade_store_row attachment_category_for_row',
                'element_class' => 'radio-inline',
                'default' => 'all',
                'options' => [
                    'all' => esc_html__('All Product', 'upgrade-store'),
                    'specific' => esc_html__('Specific Product', 'upgrade-store'),
                ],
                'meta_key' => 'upgrade_store_api_attachments',
                'hints' => esc_html__('Show a full details option in the quickview.', 'upgrade-store'),
                'title' => esc_html__('Category', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Categorize your content for specific audiences, delivering the right message to the right people.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_attachment_categories',
            '',
            [$this, 'upgrade_store_multi_select'],
            'upgrade_store_attachments',
            'upgrade_store_attachments_api_section',
            [
                'label_for' => 'attachment_categories',
                'class' => 'upgrade_store_row attachment_categories_row',
                'element_class' => 'select2',
                'default' => [],
                'multiple' => true,
                'options' => $this->get_terms("product_cat"),
                'meta_key' => 'upgrade_store_api_attachments'
            ]
        );

        add_settings_section(
            'upgrade_store_woo_email_api_section',
            '',
            '',
            'upgrade_store_woo_email'
        );

        add_settings_field(
            'upgrade_store_wc_disable_low_stock_notifications',
            esc_html__('Low Stock', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_low_stock_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable low-stock notifications.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('Low Stock', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_no_stock_notifications',
            esc_html__('No Stock', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_no_stock_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable no-stock notifications.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('No Stock', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_product_on_backorder_notifications',
            esc_html__('Product on Backorder', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_product_on_backorder_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable product on backorder notifications.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('Product on Backorder', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_pending_processing_new_orders_notifications',
            esc_html__('New Order - Pending to Processing Orders', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_pending_processing_new_orders_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on pending processing orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('New Order - Pending to Processing Orders', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_pending_completed_orders_notifications',
            esc_html__('New Order - Pending to Completed Orders', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_pending_completed_orders_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on pending to completed orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('New Order - Pending to Completed Orders', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_pending_onhold_new_orders_notifications',
            esc_html__('New Order - Pending to On-hold Orders', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_pending_onhold_new_orders_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on pending to on-hold orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('New Order - Pending to On-hold Orders', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_failed_processing_new_orders_notifications',
            esc_html__('New Order - Failed to Processing Orders', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_failed_processing_new_orders_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on failed process orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('New Order - Failed to Processing Orders', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_failed_completed_orders_notifications',
            esc_html__('New Order - Failed to Completed Orders', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_failed_completed_orders_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on failed-to-complete orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('New Order - Failed to Completed Orders', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_failed_onhold_new_orders_notifications',
            esc_html__('New Order - Failed to On-hold Orders', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_failed_onhold_new_orders_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on failed to on-hold orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('New Order - Failed to On-hold Orders', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_failed_onhold_orders_notifications',
            esc_html__('Failed to On-hold Orders', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_failed_onhold_orders_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on failed to on-hold orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('Failed to On-hold Orders', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_failed_processing_orders_notifications',
            esc_html__('Failed to Processing Orders', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_failed_processing_orders_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on failed process orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('Failed to Processing Orders', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_pending_processing_orders_notifications',
            esc_html__('Pending to Processing Orders ', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_pending_processing_orders_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on pending processing orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('Pending to Processing Orders ', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_pending_onhold_orders_notifications',
            esc_html__('Pending to On-hold Orders', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_pending_onhold_orders_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on pending to on-hold orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('Pending to On-hold Orders', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_order_status_completed_notifications',
            esc_html__('Order Status Completed', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_order_status_completed_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable notifications on completed orders.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('Order Status Completed', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_field(
            'upgrade_store_wc_disable_order_new_customer_note_notifications',
            esc_html__('New Customer Note', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_woo_email',
            'upgrade_store_woo_email_api_section',
            [
                'label_for' => 'wc_disable_order_new_customer_note_notifications',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable/disable new customer note notifications.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_woo_email',
                'title' => esc_html__('New Customer Note', 'upgrade-store'),
                'description' => '',
            ]
        );

        add_settings_section(
            'upgrade_store_quickview_api_section',
            '',
            '',
            'upgrade_store_quickview'
        );

        add_settings_field(
            'upgrade_store_quickview_enable_cart_button',
            esc_html__('Enable Cart Button', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_quickview',
            'upgrade_store_quickview_api_section',
            [
                'label_for' => 'quickview_enable_cart_button',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable the cart option in the quick-view.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_quickview',
                'title' => esc_html__('Enable Cart Button', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Cart buttons allow you to seamlessly add products to your purchase.', 'upgrade-store') . '</p>'
            ]
        );

        add_settings_field(
            'upgrade_store_quickview_enable_for_product',
            esc_html__('Enable Quickview for Products', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_quickview',
            'upgrade_store_quickview_api_section',
            [
                'label_for' => 'quickview_enable_for_product',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable product details in the quick view.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_quickview',
                'title' => esc_html__('Enable Quickview for Products', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Get a quick look at product details with a click, saving you time while browsing.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_quickview_enable_full_details',
            esc_html__('Enable Full Details', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_quickview',
            'upgrade_store_quickview_api_section',
            [
                'label_for' => 'quickview_enable_full_details',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable full description in the quick view.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_quickview',
                'title' => esc_html__('Enable Full Details', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Click to access the full product description with all the information you need.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_quickview_enable_zoom',
            esc_html__('Enable Zoom', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_quickview',
            'upgrade_store_quickview_api_section',
            [
                'label_for' => 'quickview_enable_zoom',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable image magnification in the quick view.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_quickview',
                'title' => esc_html__('Enable Zoom', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Get a magnified view of the product, ensuring you don\'t miss a thing.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_quickview_category_for',
            esc_html__('Show Quickview', 'upgrade-store'),
            [$this, 'upgrade_store_radio'],
            'upgrade_store_quickview',
            'upgrade_store_quickview_api_section',
            [
                'label_for' => 'quickview_category_for',
                'class' => 'upgrade_store_row quickview_category_for_row',
                'element_class' => 'radio-inline',
                'default' => 'all',
                'options' => [
                    'all' => esc_html__('All Product', 'upgrade-store'),
                    'specific' => esc_html__('Specific Product', 'upgrade-store'),
                ],
                'meta_key' => 'upgrade_store_api_quickview',
                'hints' => esc_html__('Set quick view for specific categories of products or all.', 'upgrade-store'),
                'title' => esc_html__('Show Quickview', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Enable product details within a chosen category or allow all products.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_quickview_categories',
            '',
            [$this, 'upgrade_store_multi_select'],
            'upgrade_store_quickview',
            'upgrade_store_quickview_api_section',
            [
                'label_for' => 'quickview_categories',
                'class' => 'upgrade_store_row quickview_categories_row',
                'element_class' => 'select2',
                'default' => [],
                'multiple' => true,
                'options' => $this->get_terms("product_cat"),
                'meta_key' => 'upgrade_store_api_quickview'
            ]
        );


        add_settings_section(
            'upgrade_store_stocks_left_api_section',
            '',
            '',
            'upgrade_store_stocks_left'
        );

        add_settings_field(
            'upgrade_store_stocks_left_enable_shop_page',
            esc_html__('Shop Page', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_stocks_left',
            'upgrade_store_stocks_left_api_section',
            [
                'label_for' => 'stocks_left_enable_shop_page',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable the stocks left on the shop page.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_stocks_left',
                'title' => esc_html__('Shop Page', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Choose if you want to show how many stocks are left for a product on the shop page.', 'upgrade-store') . '</p>',
            ]
        );
        add_settings_field(
            'upgrade_store_stocks_left_hide_default_stock_count',
            esc_html__('Hide Default Stock Count', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_stocks_left',
            'upgrade_store_stocks_left_api_section',
            [
                'label_for' => 'stocks_left_hide_default_stock_count',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Stop WooCommerce default stocks left message.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_stocks_left',
                'title' => esc_html__('Hide Default Stock Count', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Stop WooCommerce from showing the default "stocks left" message on the product page.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_section(
            'upgrade_store_banner_api_section',
            '',
            '',
            'upgrade_store_banner'
        );
        add_settings_field(
            'upgrade_store_banner_enable_shop_page',
            esc_html__('Shop', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [
                'label_for' => 'banner_enable_shop_page',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable banner option for shop page.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_banner',
                'title' => esc_html__('Shop', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Choose a banner for the shop page that best aligns with your current marketing goals and target audience.', 'upgrade-store') . '</p>',
            ]
        );
        add_settings_field(
            'upgrade_store_shop_page_banner_internal_image',
            esc_html__('Banner Image', 'upgrade-store'),
            [$this, 'upgrade_store_image'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [
                'label_for' => 'shop_page_banner_internal_image',
                'class' => 'upgrade_store_row sub-element sub-element-banner_enable_shop_page',
                'element_class' => 'upgrade_store_image',
                'default' => [
                    'id' => '',
                    'name' => '',
                    'url' => ''
                ],
                'upload-help-text' => '<p>' . sprintf(esc_html__('Size: Optional %1$s File Support: %2$s', 'upgrade-store'), '<br/>', 'jpg, .jpeg, . gif, or .png.') . '</p>',
                'placeholder' => esc_html__('Add the URL here', 'upgrade-store'),
                'hints' => esc_html__('Upload a banner image.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_banner',
                'title' => esc_html__('Banner Image', 'upgrade-store'),
            ]
        );
        //group unit
        add_settings_field(
            'upgrade_store_shop_page_banner_external_image',
            esc_html__('Upload from an URL', 'upgrade-store'),
            [$this, 'upgrade_store_group'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [

                'label_for' => 'shop_page_banner_external_image',
                'class' => 'upgrade_store_row sub-element sub-element-banner_enable_shop_page',
                'element_class' => 'upgrade_store_text',
                'meta_key' => 'upgrade_store_api_banner',
                // 'hints' => esc_html__('Show the add to cart option in the stocks left.', 'upgrade-store'),
                // 'title' => esc_html__('Upload from an URL', 'upgrade-store'),
                'elements' => [
                    [
                        'title' => esc_html__('Upload from an URL', 'upgrade-store'),
                        'default' => '',
                        'type' => 'url',
                        'label_for' => 'url',
                        'class' => 'url_wrap',
                        'placeholder' => esc_html__('Add the URL here', 'upgrade-store'),
                        'hints' => esc_html__('Upload image from a supported URL.', 'upgrade-store'),
                    ],
                    [
                        'title' => esc_html__('Banner Alt Text', 'upgrade-store'),
                        'default' => '',
                        'type' => 'text',
                        'label_for' => 'alt',
                        'class' => 'alt_wrap',
                        'placeholder' => esc_html__('Add the URL here', 'upgrade-store'),
                        'hints' => esc_html__('Set alt text for your image.', 'upgrade-store'),
                    ],
                ]

            ]
        );

        add_settings_field(
            'upgrade_store_shop_page_banner_width',
            esc_html__('Select Type', 'upgrade-store'),
            [$this, 'upgrade_store_select'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [
                'label_for' => 'shop_page_banner_width',
                'class' => 'upgrade_store_row sub-element sub-element-banner_enable_shop_page',
                'element_class' => 'upgrade_store_text select2-icon',
                'default' => '',
                'hints' => esc_html__('Set the default image alignment.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_banner',
                'title' => esc_html__('Select Type', 'upgrade-store'),
                'options' => [
                    'align-center' => 'None',
                    'align-wide' => 'Wide Width',
                    'align-full-width' => 'Full Width'
                ],
            ]
        );
        add_settings_field(
            'upgrade_store_shop_page_banner_url',
            esc_html__('Banner URL', 'upgrade-store'),
            [$this, 'upgrade_store_text'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [
                'label_for' => 'shop_page_banner_url',
                'class' => 'upgrade_store_row sub-element sub-element-banner_enable_shop_page',
                'element_class' => 'upgrade_store_text',
                'default' => '',
                'type' => 'url',
                'placeholder' => esc_html__('Add the URL here', 'upgrade-store'),
                'hints' => esc_html__('Set a banner URL where the users will be redirected.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_banner',
                'title' => esc_html__('Banner URL', 'upgrade-store'),
            ]
        );
        //end of Banner->Shop 
        add_settings_field(
            'upgrade_store_banner_enable_all_product_page',
            esc_html__('All Product', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [
                'label_for' => 'banner_enable_all_product_page',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable banner option for product page.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_banner',
                'title' => esc_html__('All Product', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Choose a banner for the products page that best aligns with your current marketing goals and target audience.', 'upgrade-store') . '</p>',
            ]
        );

        add_settings_field(
            'upgrade_store_all_product_page_banner_internal_image',
            esc_html__('Banner Image', 'upgrade-store'),
            [$this, 'upgrade_store_image'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [
                'label_for' => 'all_product_page_banner_internal_image',
                'class' => 'upgrade_store_row sub-element sub-element-banner_enable_all_product_page',
                'element_class' => 'upgrade_store_image',
                'default' => [
                    'id' => '',
                    'name' => '',
                    'url' => ''
                ],
                'upload-help-text' => '<p>' . sprintf(esc_html__('Size: Optional %1$s File Support: %2$s', 'upgrade-store'), '<br/>', 'jpg, .jpeg, . gif, or .png.') . '</p>',
                'placeholder' => esc_html__('Add the URL here', 'upgrade-store'),
                'hints' => esc_html__('Upload a banner image.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_banner',
                'title' => esc_html__('Banner Image', 'upgrade-store'),
            ]
        );
        //group unit
        add_settings_field(
            'upgrade_store_all_product_page_banner_external_image',
            esc_html__('Upload from an URL', 'upgrade-store'),
            [$this, 'upgrade_store_group'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [

                'label_for' => 'all_product_page_banner_external_image',
                'class' => 'upgrade_store_row sub-element sub-element-banner_enable_all_product_page',
                'element_class' => 'upgrade_store_text',
                'meta_key' => 'upgrade_store_api_banner',
                // 'hints' => esc_html__('Show the add to cart option in the stocks left.', 'upgrade-store'),
                // 'title' => esc_html__('Upload from an URL', 'upgrade-store'),
                'elements' => [
                    [
                        'title' => esc_html__('Upload from an URL', 'upgrade-store'),
                        'default' => '',
                        'type' => 'url',
                        'label_for' => 'url',
                        'class' => 'url_wrap',
                        'placeholder' => esc_html__('Add the URL here', 'upgrade-store'),
                        'hints' => esc_html__('Upload image from a supported URL.', 'upgrade-store'),
                    ],
                    [
                        'title' => esc_html__('Banner Alt Text', 'upgrade-store'),
                        'default' => '',
                        'type' => 'text',
                        'label_for' => 'alt',
                        'class' => 'alt_wrap',
                        'placeholder' => esc_html__('Add the URL here', 'upgrade-store'),
                        'hints' => esc_html__('Set alt text for your image.', 'upgrade-store'),
                    ],
                ]

            ]
        );
        add_settings_field(
            'upgrade_store_all_product_page_banner_width',
            esc_html__('Select Type', 'upgrade-store'),
            [$this, 'upgrade_store_select'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [
                'label_for' => 'all_product_page_banner_width',
                'class' => 'upgrade_store_row sub-element sub-element-banner_enable_all_product_page',
                'element_class' => 'upgrade_store_text select2-icon',
                'default' => '',
                'hints' => esc_html__('Set the default image alignment.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_banner',
                'title' => esc_html__('Select Type', 'upgrade-store'),
                'options' => [
                    'align-center' => 'None',
                    'align-wide' => 'Wide Width',
                    'align-full-width' => 'Full Width'
                ],
            ]
        );
        add_settings_field(
            'upgrade_store_all_product_page_banner_url',
            esc_html__('Banner URL', 'upgrade-store'),
            [$this, 'upgrade_store_text'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [
                'label_for' => 'all_product_page_banner_url',
                'class' => 'upgrade_store_row sub-element sub-element-banner_enable_all_product_page',
                'element_class' => 'upgrade_store_text',
                'default' => '',
                'type' => 'url',
                'placeholder' => esc_html__('Add the URL here', 'upgrade-store'),
                'hints' => esc_html__('Set a banner URL where the users will be redirected.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_banner',
                'title' => esc_html__('Banner URL', 'upgrade-store'),
            ]
        );

        add_settings_field(
            'upgrade_store_banner_enable_specific_product',
            esc_html__('Specific Product', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_banner',
            'upgrade_store_banner_api_section',
            [
                'label_for' => 'banner_enable_specific_product',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable banner option for specific product settings.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_banner',
                'title' => esc_html__('Specific Product', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Choose a specific banner for specific products that best aligns with your current marketing goals and target audience.', 'upgrade-store') . '</p>',
            ]
        );


        add_settings_section(
            'upgrade_store_gallery_api_section',
            '',
            '',
            'upgrade_store_gallery'
        );
        add_settings_field(
            'upgrade_store_gallery_enable_gallery_type',
            esc_html__('Gallery Type', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_gallery',
            'upgrade_store_gallery_api_section',
            [
                'label_for' => 'gallery_enable_gallery_type',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Override Existing Gallery Type', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_gallery',
                'title' => esc_html__('Gallery Type', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Override your existing gallery type and use of the built ones that comes with Upgrade Store.', 'upgrade-store') . '</p>',
            ]
        );
        add_settings_field(
            'upgrade_store_gallery_select_gallery_type',
            esc_html__('Select Gallery Type', 'upgrade-store'),
            [$this, 'upgrade_store_image_select'],
            'upgrade_store_gallery',
            'upgrade_store_gallery_api_section',
            [
                'label_for' => 'gallery_select_gallery_type',
                'class' => 'upgrade_store_row sub-element',
                'element_class' => 'image-select-inline',
                'default' => 'type-1',
                'options' => [
                    'type-1' => plugin_dir_url(__DIR__) . 'admin/images/gallery-layout-1.png',
                    'type-2' => plugin_dir_url(__DIR__) . 'admin/images/gallery-layout-2.png',
                    'type-3' => plugin_dir_url(__DIR__) . 'admin/images/gallery-layout-3.png',
                    'type-4' => plugin_dir_url(__DIR__) . 'admin/images/gallery-layout-4.png',
                    'type-5' => plugin_dir_url(__DIR__) . 'admin/images/gallery-layout-5.png',
                    'type-6' => plugin_dir_url(__DIR__) . 'admin/images/gallery-layout-6.png',
                    'type-7' => plugin_dir_url(__DIR__) . 'admin/images/gallery-layout-7.png',
                    'type-8' => plugin_dir_url(__DIR__) . 'admin/images/gallery-layout-8.png',
                    'type-9' => plugin_dir_url(__DIR__) . 'admin/images/gallery-layout-9.png',
                    'type-10' => plugin_dir_url(__DIR__) . 'admin/images/gallery-layout-10.png',
                ],
                'hints' => esc_html__('Select Gallery Type', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_gallery',
                'title' => esc_html__('Select Gallery Type', 'upgrade-store'),
                //'description' => '<p>' . esc_html__('No description.', 'upgrade-store') . '</p>',
            ]
        );
        add_settings_field(
            'upgrade_store_gallery_enable_gallery_lock',
            esc_html__('Gallery Copy Lock', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_gallery',
            'upgrade_store_gallery_api_section',
            [
                'label_for' => 'gallery_enable_gallery_lock',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Disable right click for gallery', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_gallery',
                'title' => esc_html__('Gallery Copy Lock', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Disable right click and gallery images secure.', 'upgrade-store') . '</p>',
            ]
        );
        add_settings_field(
            'upgrade_store_gallery_enable_for_quickview',
            esc_html__('Gallery Type for Quickview', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_gallery',
            'upgrade_store_gallery_api_section',
            [
                'label_for' => 'gallery_enable_for_quickview',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Apply selected gallery for quickview.', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_gallery',
                'title' => esc_html__('Gallery Type for Quickview', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Enable gallery type for quickview in the shop page.', 'upgrade-store') . '</p>',
            ]
        );
        add_settings_field(
            'upgrade_store_gallery_enable_specific_product',
            esc_html__('Specific Product', 'upgrade-store'),
            [$this, 'upgrade_store_switch'],
            'upgrade_store_gallery',
            'upgrade_store_gallery_api_section',
            [
                'label_for' => 'gallery_enable_specific_product',
                'class' => 'upgrade_store_row',
                'element_class' => 'switcher',
                'default' => '1',
                'hints' => esc_html__('Enable gallery type for specific product', 'upgrade-store'),
                'meta_key' => 'upgrade_store_api_gallery',
                'title' => esc_html__('Specific Product', 'upgrade-store'),
                'description' => '<p>' . esc_html__('Add gallery type for specific product from the edit page.', 'upgrade-store') . '</p>',
            ]
        );
    }
    public function upgrade_store_group($args)
    {
        global $wpdb;
        $meta_key_exist = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}options WHERE option_name=%s;",
                array(
                    $args['meta_key']
                )
            ),
        );
        $options = (get_option($args['meta_key'])) ? get_option($args['meta_key']) : [];
        $default = ($meta_key_exist) ? (isset($options[$args['label_for']]) ? $options[$args['label_for']] : '') : '';
?>
        <div class="upgrade-store-setting-unit group-setting-unit">
            <div class="title-wrap">
                <?php if (isset($args["title"])) : ?>
                    <label class="position-relative">
                        <?php echo esc_html($args['title']) ?>
                        <?php if (isset($args["hints"]) && $args['hints']) : ?>
                            <span class="tooltip hint--bottom" aria-label="<?php echo esc_html($args['hints']) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                        <?php endif ?>
                    </label>
                <?php endif ?>
                <?php if (isset($args['description'])) : ?>
                    <div class="description"><?php echo wp_kses_post($args['description']) ?></div>
                <?php endif ?>
            </div>
            <?php if (isset($args['elements']) && sizeof($args['elements'])) : ?>
                <div class="group-unit-wrap">
                    <?php foreach ($args['elements'] as $key => $element) : ?>
                        <div class="unit unit-<?php echo esc_html($key) ?> <?php echo esc_html(@$element['class']) ?>">
                            <div class="title-wrap">
                                <?php if (isset($element["title"])) : ?>
                                    <label class="position-relative">
                                        <?php echo esc_html($element['title']) ?>
                                        <?php if (isset($element["hints"]) && $element['hints']) : ?>
                                            <span class="tooltip hint--bottom" aria-label="<?php echo esc_html($element['hints']) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                                        <?php endif ?>
                                    </label>
                                <?php endif ?>
                                <?php if (isset($element["description"])) : ?>
                                    <div class="description"><?php echo wp_kses_post($element['description']) ?></div>
                                <?php endif ?>
                            </div>
                            <div class="position-relative">
                                <input name="<?php echo esc_html($args['meta_key']) . '[' . esc_html($args['label_for']) . ']' . '[' . esc_html($element['label_for']) . ']' ?>" type="<?php echo isset($element['type']) ? esc_html($element['type']) : 'text' ?>" value="<?php echo isset($default[$element['label_for']]) ? esc_html($default[$element['label_for']]) : '' ?>" placeholder="<?php echo isset($args['placeholder']) ? esc_html($args['placeholder']) : '' ?>">
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <input name="<?php echo esc_html($args['meta_key']) . '[option_name]' ?>" type="hidden" class="upgrade-store-option-name" value="<?php echo esc_html($args['meta_key']) ?>">
        </div>
    <?php
    }
    public function upgrade_store_text($args)
    {
        global $wpdb;
        $meta_key_exist = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}options WHERE option_name=%s;",
                array(
                    $args['meta_key']
                )
            ),
        );
        $options = (get_option($args['meta_key'])) ? get_option($args['meta_key']) : [];
        $default = ($meta_key_exist) ? (isset($options[$args['label_for']]) ? $options[$args['label_for']] : '') : $args['default'];
    ?>
        <div class="upgrade-store-setting-unit text-setting-unit">
            <div class="title-wrap">
                <?php if (isset($args["title"])) : ?>
                    <label class="position-relative">
                        <?php echo esc_html($args['title']) ?>
                        <?php if (isset($args["hints"]) && $args['hints']) : ?>
                            <span class="tooltip hint--bottom" aria-label="<?php echo esc_html($args['hints']) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                        <?php endif ?>
                    </label>
                <?php endif ?>
                <?php if (isset($args['description'])) : ?>
                    <div class="description"><?php echo wp_kses_post($args['description']) ?></div>
                <?php endif ?>
            </div>
            <div class="position-relative <?php echo esc_html(@$args['element_class']); ?>">
                <input name="<?php echo esc_html($args['meta_key']) . '[' . esc_html($args['label_for']) . ']' ?>" type="<?php echo isset($args['type']) ? esc_html($args['type']) : 'text' ?>" value="<?php echo esc_html($default) ?>" placeholder="<?php echo isset($args['placeholder']) ? esc_html($args['placeholder']) : '' ?>">
                <input name="<?php echo esc_html($args['meta_key']) . '[option_name]' ?>" type="hidden" class="upgrade-store-option-name" value="<?php echo esc_html($args['meta_key']) ?>">
            </div>
        </div>
    <?php
    }

    public function upgrade_store_image($args)
    {

        global $wpdb;
        $meta_key_exist = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}options WHERE option_name=%s;",
                array(
                    $args['meta_key']
                )
            ),
        );
        $options = (get_option($args['meta_key'])) ? get_option($args['meta_key']) : [];
        $default = ($meta_key_exist) ? (isset($options[$args['label_for']]) ? $options[$args['label_for']] : '') : $args['default'];
        //$default = $args['default'];
    ?>
        <div class="upgrade-store-setting-unit image-uploader-unit">
            <div class="title-wrap">
                <?php if (isset($args["title"])) : ?>
                    <label class="position-relative">
                        <?php echo esc_html($args['title']) ?>
                        <?php if (isset($args["hints"]) && $args['hints']) : ?>
                            <span class="tooltip hint--bottom" aria-label="<?php echo esc_html($args['hints']) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                        <?php endif ?>
                    </label>
                <?php endif ?>
                <?php if (isset($args['description'])) : ?>
                    <div class="description"><?php echo wp_kses_post($args['description']) ?></div>
                <?php endif ?>
            </div>
            <div class="position-relative <?php echo esc_html(@$args['element_class']); ?>">
                <div class="image-uploader">
                    <div class="file-name <?php if (isset($default['id']) && $default['id']) echo 'with-close-button' ?>">
                        <?php if (isset($default['id']) && $default['id']) : ?>
                            <span class="gallery" data-fancybox="gallery-<?php echo esc_html(wp_rand(0, 999)) ?>" data-src="<?php echo esc_url($default['url']) ?>">
                                <?php echo wp_get_attachment_image($default['id'], 'thumbnail', false, array('class' => 'option-image')) ?>
                            </span>
                        <?php else : ?>
                            <span class="gallery">

                                <img src="<?php echo esc_url(plugin_dir_url(__DIR__) . 'admin/images/no_image_available.png'); ?>" alt="" class="option-image">
                            </span>
                        <?php endif ?>
                        <span class="remove-image" data-default="<?php echo esc_url(plugin_dir_url(__DIR__) . 'admin/images/no_image_available.png'); ?>"></span>
                    </div>
                    <div class="file-detail">
                        <input name="<?php echo esc_html($args['meta_key']) . '[' . esc_html($args['label_for']) . ']' ?>[url]" type="hidden" id="<?php echo esc_html($args['label_for']) ?>-url" value="<?php echo (isset($default['url']) && $default['url']) ? esc_url($default['url']) : '' ?>" class="imageUrl" />

                        <input name="<?php echo esc_html($args['meta_key']) . '[' . esc_html($args['label_for']) . ']' ?>[id]" type="hidden" id="<?php echo esc_html($args['label_for']) ?>-id" value="<?php echo (isset($default['id']) && $default['id']) ? esc_html($default['id']) : '' ?>" class="imageId" />

                        <input name="<?php echo esc_html($args['meta_key']) . '[' . esc_html($args['label_for']) . ']' ?>[name]" type="hidden" id="<?php echo esc_html($args['label_for']) ?>-name" value="<?php echo (isset($default['name']) && $default['name']) ? esc_html($default['name']) : '' ?>" class="imageName" />
                        <?php if (isset($args['upload-help-text'])) : ?>
                            <div class="upload-help-text"><?php echo wp_kses_post($args['upload-help-text']) ?></div>
                        <?php endif ?>
                        <button class="button button-primary image-uploader-button single-image-uploader-button"><?php echo esc_html__("Upload Image", 'upgrade-store') ?></button>
                    </div>

                </div>
                <input name="<?php echo esc_html($args['meta_key']) . '[option_name]' ?>" type="hidden" class="upgrade-store-option-name" value="<?php echo esc_html($args['meta_key']) ?>">
            </div>
        </div>
    <?php
    }
    public function upgrade_store_hidden($args)
    {
    ?>

        <div class="position-relative <?php echo esc_html(@$args['element_class']); ?>">
            <input name="<?php echo esc_html($args['meta_key']) . '[' . esc_html($args['label_for']) . ']' ?>" type="hidden" value="<?php echo esc_html($args['default']) ?>">
            <input name="<?php echo esc_html($args['meta_key']) . '[option_name]' ?>" type="hidden" class="upgrade-store-option-name" value="<?php echo esc_html($args['meta_key']) ?>">
        </div>

    <?php
    }

    public function upgrade_store_switch($args)
    {
        global $wpdb;
        $meta_key_exist = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}options WHERE option_name=%s;",
                array(
                    $args['meta_key']
                )
            ),
        );
        $options = (get_option($args['meta_key'])) ? get_option($args['meta_key']) : [];
        $default = ($meta_key_exist) ? (isset($options[$args['label_for']]) ? 1 : 0) : $args['default'];
    ?>
        <div class="upgrade-store-setting-unit switch-setting-unit">
            <div class="title-wrap">
                <?php if (isset($args["title"])) : ?>
                    <label class="position-relative">
                        <?php echo esc_html($args['title']) ?>
                        <?php if (isset($args["hints"]) && $args['hints']) : ?>
                            <span class="tooltip hint--bottom" aria-label="<?php echo esc_html($args['hints']) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                        <?php endif ?>
                    </label>
                <?php endif ?>
                <?php if (isset($args['description'])) : ?>
                    <div class="description"><?php echo wp_kses_post($args['description']) ?></div>
                <?php endif ?>
            </div>
            <div class="position-relative <?php echo esc_html(@$args['element_class']); ?>">

                <label for="<?php echo esc_html($args['label_for']); ?>">
                    <input type="checkbox" name="<?php echo esc_html($args['meta_key']) ?>[<?php echo esc_html($args['label_for']); ?>]" id="<?php echo esc_html($args['label_for']); ?>" value="1" <?php echo isset($default) ? (checked($default, 1, false)) : (''); ?>>
                    <em data-on="on" data-off="off"></em>
                    <span></span>
                </label>
                <input name="<?php echo esc_html($args['meta_key']) . '[option_name]' ?>" type="hidden" class="upgrade-store-option-name" value="<?php echo esc_html($args['meta_key']) ?>">
            </div>
        </div>
    <?php
    }

    public function upgrade_store_image_select($args)
    {
        global $wpdb;
        $meta_key_exist = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}options WHERE option_name=%s;",
                array(
                    $args['meta_key']
                )
            ),
        );
        $options = (get_option($args['meta_key'])) ? get_option($args['meta_key']) : [];
        $default = ($meta_key_exist) ? (isset($options[$args['label_for']]) ? $options[$args['label_for']] : $args['default']) : $args['default'];
    ?>
        <div class="upgrade-store-setting-unit image-select-setting-unit">
            <div class="title-wrap">
                <?php if (isset($args["title"])) : ?>
                    <label class="position-relative">
                        <?php echo esc_html($args['title']) ?>
                        <?php if (isset($args["hints"]) && $args['hints']) : ?>
                            <span class="tooltip hint--bottom" aria-label="<?php echo esc_html($args['hints']) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                        <?php endif ?>
                    </label>
                <?php endif ?>
                <?php if (isset($args['description'])) : ?>
                    <div class="description"><?php echo wp_kses_post($args['description']) ?></div>
                <?php endif ?>
            </div>
            <div class="position-relative <?php echo esc_html(@$args['element_class']); ?>">
                <div class="image-select-wrapper">
                    <?php foreach ($args['options'] as $key => $value) : ?>
                        <div class="image-select-unit">
                            <input class="<?php echo esc_html($args['label_for']); ?> <?php echo esc_html($args['label_for']) . '-' . esc_html($key); ?>" name="<?php echo esc_html($args['meta_key']) ?>[<?php echo esc_html($args['label_for']); ?>]" id="<?php echo esc_html($args['label_for']) . '-' . esc_html($key); ?>" type="radio" value="<?php echo esc_html($key) ?>" <?php echo isset($default) ? (checked($default, $key, false)) : (''); ?>>
                            <label for="<?php echo esc_html($args['label_for']) . '-' . esc_html($key); ?>"><span></span> <img src="<?php echo esc_url($value) ?>" /></label>

                        </div>
                    <?php endforeach ?>
                </div>
                <input name="<?php echo esc_html($args['meta_key']) . '[option_name]' ?>" type="hidden" class="upgrade-store-option-name" value="<?php echo esc_html($args['meta_key']) ?>">
            </div>
        </div>
    <?php
    }

    public function upgrade_store_radio($args)
    {
        global $wpdb;
        $meta_key_exist = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}options WHERE option_name=%s;",
                array(
                    $args['meta_key']
                )
            ),
        );
        $options = (get_option($args['meta_key'])) ? get_option($args['meta_key']) : [];
        $default = ($meta_key_exist) ? (isset($options[$args['label_for']]) ? $options[$args['label_for']] : $args['default']) : $args['default'];
    ?>
        <div class="upgrade-store-setting-unit radio-setting-unit">
            <div class="title-wrap">
                <?php if (isset($args["title"])) : ?>
                    <label class="position-relative">
                        <?php echo esc_html($args['title']) ?>
                        <?php if (isset($args["hints"]) && $args['hints']) : ?>
                            <span class="tooltip hint--bottom" aria-label="<?php echo esc_html($args['hints']) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                        <?php endif ?>
                    </label>
                <?php endif ?>
                <?php if (isset($args['description'])) : ?>
                    <div class="description"><?php echo wp_kses_post($args['description']) ?></div>
                <?php endif ?>
            </div>
            <div class="position-relative <?php echo esc_html(@$args['element_class']); ?>">
                <div class="radio-wrapper">
                    <?php foreach ($args['options'] as $key => $value) : ?>
                        <div class="radio-unit">
                            <input class="<?php echo esc_html($args['label_for']); ?> <?php echo esc_html($args['label_for']) . '-' . esc_html($key); ?>" name="<?php echo esc_html($args['meta_key']) ?>[<?php echo esc_html($args['label_for']); ?>]" id="<?php echo esc_html($args['label_for']) . '-' . esc_html($key); ?>" type="radio" value="<?php echo esc_html($key) ?>" <?php echo isset($default) ? (checked($default, $key, false)) : (''); ?>>
                            <label for="<?php echo esc_html($args['label_for']) . '-' . esc_html($key); ?>"><span></span> <?php echo esc_html($value) ?></label>

                        </div>
                    <?php endforeach ?>
                </div>
                <input name="<?php echo esc_html($args['meta_key']) . '[option_name]' ?>" type="hidden" class="upgrade-store-option-name" value="<?php echo esc_html($args['meta_key']) ?>">
            </div>
        </div>
    <?php
    }

    public function upgrade_store_select($args)
    {
        global $wpdb;
        $meta_key_exist = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}options WHERE option_name=%s;",
                array(
                    $args['meta_key']
                )
            ),
        );
        $options = (get_option($args['meta_key'])) ? get_option($args['meta_key']) : [];
        $default = ($meta_key_exist) ? (isset($options[$args['label_for']]) ? $options[$args['label_for']] : '') : $args['default'];
    ?>
        <div class="upgrade-store-setting-unit select-setting-unit">
            <div class="title-wrap">
                <?php if (isset($args["title"])) : ?>
                    <label class="position-relative">
                        <?php echo esc_html($args['title']) ?>
                        <?php if (isset($args['hints']) && $args['hints']) : ?>
                            <span class="tooltip hint--bottom" aria-label="<?php echo esc_html($args['hints']) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                        <?php endif ?>
                    </label>
                <?php endif ?>
                <?php if (isset($args['description'])) : ?>
                    <div class="description"><?php echo wp_kses_post($args['description']) ?></div>
                <?php endif ?>
            </div>
            <div class="position-relative <?php echo esc_html(@$args['element_class']); ?>">
                <select name="<?php echo esc_html($args['meta_key']) . '[' . esc_html($args['label_for']) . ']' ?>">
                    <?php if (isset($args['blank'])) : ?>
                        <option value=""><?php echo esc_html($args['blank']) ?></option>
                    <?php endif; ?>
                    <?php foreach ($args['options'] as $key => $value) : ?>
                        <option value="<?php echo esc_html($key) ?>" <?php echo isset($default) ? (selected($default, $key, false)) : (''); ?>><?php echo esc_html($value) ?></option>
                    <?php endforeach ?>
                </select>
                <input name="<?php echo esc_html($args['meta_key']) . '[option_name]' ?>" type="hidden" class="upgrade-store-option-name" value="<?php echo esc_html($args['meta_key']) ?>">
            </div>
        </div>
    <?php
    }
    public function upgrade_store_multi_select($args)
    {
        global $wpdb;
        $meta_key_exist = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}options WHERE option_name=%s;",
                array(
                    $args['meta_key']
                )
            ),
        );
        $options = (get_option($args['meta_key'])) ? get_option($args['meta_key']) : [];
        $default = ($meta_key_exist) ? (isset($options[$args['label_for']]) ? $options[$args['label_for']] : []) : $args['default'];
    ?>
        <div class="upgrade-store-setting-unit multiple-select-setting-unit">
            <div class="title-wrap">
                <?php if (isset($args["title"])) : ?>
                    <label class="position-relative">
                        <?php echo esc_html($args['title']) ?>
                        <?php if (isset($args["hints"]) && $args['hints']) : ?>
                            <span class="tooltip hint--bottom" aria-label="<?php echo esc_html($args['hints']) ?>"><i class="dashicons dashicons-editor-help"></i></span>
                        <?php endif ?>
                    </label>
                <?php endif ?>
                <?php if (isset($args['description'])) : ?>
                    <div class="description"><?php echo wp_kses_post($args['description']) ?></div>
                <?php endif ?>
            </div>
            <div class="position-relative <?php echo esc_html(@$args['element_class']); ?>">
                <select name="<?php echo esc_html($args['meta_key']) . '[' . esc_html($args['label_for']) . '][]' ?>" multiple>
                    <?php if (isset($args["blank"]) && $args['blank']) : ?>
                        <option value=""><?php echo esc_html($args['blank']) ?></option>
                    <?php endif; ?>
                    <?php foreach ($args['options'] as $key => $value) : ?>
                        <option value="<?php echo esc_html($key) ?>" <?php echo in_array($key, $default) ? 'selected' : ''; ?>><?php echo esc_html($value) ?></option>
                    <?php endforeach ?>
                </select>
                <input name="<?php echo esc_html($args['meta_key']) . '[option_name]' ?>" type="hidden" class="upgrade-store-option-name" value="<?php echo esc_html($args['meta_key']) ?>">
            </div>
        </div>
<?php
    }
    public function get_terms($taxonomy = 'category')
    {
        global $wpdb;
        $output = $all_taxonomies = array();

        $all_taxonomies = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT {$wpdb->prefix}term_taxonomy.term_id, {$wpdb->prefix}term_taxonomy.taxonomy, {$wpdb->prefix}terms.name, {$wpdb->prefix}terms.slug, {$wpdb->prefix}term_taxonomy.description, {$wpdb->prefix}term_taxonomy.parent, {$wpdb->prefix}term_taxonomy.count, {$wpdb->prefix}terms.term_group FROM {$wpdb->prefix}term_taxonomy INNER JOIN {$wpdb->prefix}terms ON {$wpdb->prefix}term_taxonomy.term_id={$wpdb->prefix}terms.term_id WHERE {$wpdb->prefix}term_taxonomy.taxonomy = %s",
                array(
                    $taxonomy
                )
            ),
            ARRAY_A
        );
        //        $all_taxonomies = $this->get_cache_terms( $taxonomy );
        if ($all_taxonomies && sizeof($all_taxonomies)) {
            foreach ($all_taxonomies as $key => $value) {
                if ($value["taxonomy"] == $taxonomy) {
                    $output[$value['term_id']] = $value['name'];
                }
            }
        }
        return $output;
    }

    public function get_cache_terms($taxonomy = 'category')
    {
        global $wpdb;
        $cache_key = 'cache_data_of_' . $taxonomy;
        $_taxonomies = wp_cache_get($cache_key);
        if (false === $_taxonomies) {
            $_taxonomies = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT {$wpdb->prefix}term_taxonomy.term_id, {$wpdb->prefix}term_taxonomy.taxonomy, {$wpdb->prefix}terms.name, {$wpdb->prefix}terms.slug, {$wpdb->prefix}term_taxonomy.description, {$wpdb->prefix}term_taxonomy.parent, {$wpdb->prefix}term_taxonomy.count, {$wpdb->prefix}terms.term_group FROM {$wpdb->prefix}term_taxonomy INNER JOIN {$wpdb->prefix}terms ON {$wpdb->prefix}term_taxonomy.term_id={$wpdb->prefix}terms.term_id WHERE {$wpdb->prefix}term_taxonomy.taxonomy = %s",
                    array(
                        $taxonomy
                    )
                ),
                ARRAY_A
            );
            wp_cache_set($cache_key, $_taxonomies);
        }

        return $_taxonomies;
    }
}
