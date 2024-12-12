<?php
add_action('admin_menu','lbs_register_options');

function lbs_register_options()
{
    add_options_page(
        'تنظیمات پلاگین لایک',
        'لایک پست',
        'manage_options',
        'like_post_setting',
        'lbs_like_post_admin_layout' //it was implemented in view/admin/setting.php
    );
}

include_once LBS_PLUGIN_VIEW . 'admin/setting.php';
