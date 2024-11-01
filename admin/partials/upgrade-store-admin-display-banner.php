<?php
// If this file is called directly, abort.
if (!defined('WPINC')) die;

if (!current_user_can('manage_options')) {
    return;
}
//if (isset($_GET['settings-updated'])) {
//    add_settings_error('upgrade_store_banner_messages', 'upgrade_store_banner_message', esc_html__('Settings Saved', 'upgrade-store'), 'updated');
//}
//settings_errors('upgrade_store_banner_messages');
?>
<div class="upgrade-store-settings-wrapper upgrade-store-banner-settings-wrapper">
    <form class="tab-options" action='options.php' method='post'>
        <div class="wrapper">
            <div class="part-title">
                <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            </div>
            <div class="part-options">
                <?php
                settings_fields('upgrade_store_banner');
                do_settings_sections('upgrade_store_banner');
                ?>
            </div>
        </div>
        <?php submit_button(); ?>

    </form>
</div>