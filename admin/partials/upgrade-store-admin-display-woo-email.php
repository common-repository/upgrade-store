<?php
// If this file is called directly, abort.
if (!defined('WPINC')) die;

if (!current_user_can('manage_options')) {
    return;
}
?>
<div class="upgrade-store-settings-wrapper">
    <form class="tab-options" action='options.php' method='post'>
        <div class="wrapper">
            <div class="part-title">
                <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            </div>
            <div class="part-options">
                <?php
                settings_fields('upgrade_store_woo_email');
                do_settings_sections('upgrade_store_woo_email');
                ?>
            </div>
        </div>
        <?php submit_button(); ?>

    </form>
</div>