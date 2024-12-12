<?php
/*Plugin Name: لایک پست
Plugin URI: http://siteyar.net/plugins/
Description: لایک پست
Author: sadeq yaqobi
Version: 1.0.0
License: GPLv2 or later
Author URI: http://siteyar.net/sadeq-yaqobi/ */


#for security
defined('ABSPATH') || exit();

//defined required const
define('LBS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('LBS_PLUGIN_URL', plugin_dir_url(__FILE__));
const LBS_PLUGIN_INC = LBS_PLUGIN_DIR . '_inc/';
const LBS_PLUGIN_VIEW = LBS_PLUGIN_DIR . 'view/';
const LBS_PLUGIN_ASSETS_DIR = LBS_PLUGIN_DIR . 'assets/';
const LBS_PLUGIN_ASSETS_URL = LBS_PLUGIN_URL . 'assets/';

/**
 * Register and enqueue frontend assets
 */
function lbs_register_assets_front() {
    // Register and enqueue CSS
    wp_register_style('lbs-style',LBS_PLUGIN_ASSETS_URL . 'css/front/style.css',[],'1.0.0');
    wp_enqueue_style('lbs-style');

    // Register and enqueue JavaScript
    wp_register_script('jquery-toast', LBS_PLUGIN_ASSETS_URL . 'js/jquery.toast.min.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
    wp_enqueue_script('jquery-toast');
    wp_register_script('lbs-main-js',LBS_PLUGIN_ASSETS_URL . 'js/front/main.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
    wp_enqueue_script('lbs-main-js');
    wp_register_script('lbs-front-ajax',LBS_PLUGIN_ASSETS_URL . 'js/front/front-ajax.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
    wp_enqueue_script('lbs-front-ajax');

    // localize script
    wp_localize_script('lbs-front-ajax', 'lbs_ajax', [
        'lbs_ajaxurl' => admin_url('admin-ajax.php'),
        '_lbs_nonce' => wp_create_nonce()
    ]);
}

function lbs_register_assets_admin() {
    // Register and enqueue CSS
    wp_register_style('lbs-admin-style',LBS_PLUGIN_ASSETS_URL . 'css/admin/admin-style.css',[],'1.0.0');
    wp_enqueue_style('lbs-admin-style');

    // Register and enqueue JavaScript
    wp_register_script('lbs-admin-js',LBS_PLUGIN_ASSETS_URL . 'js/admin/admin-js.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
    wp_enqueue_script('lbs-admin-js');
    wp_register_script('lbs-admin-ajax',LBS_PLUGIN_ASSETS_URL . 'js/admin/admin-ajax.js', ['jquery'], '1.0.0', ['strategy' => 'async', 'in_footer' => true]);
    wp_enqueue_script('lbs-admin-ajax');
}
add_action('wp_enqueue_scripts', 'lbs_register_assets_front');
add_action('admin_enqueue_scripts', 'lbs_register_assets_admin');
//activation and deactivation plugin hooks
function lbs_activation_functions()
{
    lbs_initialize_options_setting();
}

function lbs_deactivation_functions()
{
    lbs_delete_options_setting();
}
register_activation_hook(__FILE__,'lbs_activation_functions');
register_deactivation_hook(__FILE__,'lbs_deactivation_functions');

//including

if (is_admin()) {
    include LBS_PLUGIN_INC . 'admin/menus.php';
}
    include LBS_PLUGIN_INC . 'front/like-post-ajax.php';
    include LBS_PLUGIN_INC . 'front/unlike-post-ajax.php';
    include LBS_PLUGIN_INC . 'front/post-general-functions.php';
    include LBS_PLUGIN_INC . 'database/initialize-delete-options-setting.php';
    include LBS_PLUGIN_VIEW . 'front/like.php';


