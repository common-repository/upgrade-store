<?php
// If this file is called directly, abort.
if (!defined('WPINC')) die;

if (!current_user_can('manage_options')) {
    return;
}
?>
<div class="upgrade-store-settings-wrapper">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
</div>