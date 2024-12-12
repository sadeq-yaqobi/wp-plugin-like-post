<?php

add_action('wp_ajax_lbs_unlike_post', 'lbs_unlike_post');
add_action('wp_ajax_nopriv_lbs_unlike_post', 'lbs_unlike_post');

function lbs_unlike_post()
{
    // Security: Verify nonce token
    if (!isset($_POST['_nonce']) || !wp_verify_nonce($_POST['_nonce'])) {
        wp_send_json([
            'error' => true,
            'message' => 'access denied',
        ], 403);
    }
    $user_id = intval(sanitize_text_field($_POST['userID']));
    $post_id = intval(sanitize_text_field($_POST['postID']));
    if (!is_user_logged_in()) {
        wp_send_json([
            'error' => true,
            'message' => 'برای حذف لایک مطلب ابتدا در سایت وارد شوید.'
        ], 401);
    }
    if (!lbs_is_user_exist($user_id)) {
        wp_send_json([
            'error' => true,
            'message' => 'کاربر نامعتبر است.'
        ], 401);
    }
    if (!lbs_is_post_exist_published($post_id)) {
        wp_send_json([
            'error' => true,
            'message' => 'مطلب موجود نیست یا منتشر نشده است.'
        ], 401);
    }


    lbs_remove_from_user_meta_unliked_post_id($post_id, $user_id);
    lbs_remove_from_post_meta_user_id_unliked_post($post_id, $user_id);
    $like_number = lbs_post_like_counter($post_id);

    wp_send_json([
        'success' => true,
        'message' => ' لایک شما حذف شد.',
        'like_number' => $like_number
    ], 200);

}


function lbs_remove_from_user_meta_unliked_post_id($post_id, $user_id)
{
    if (metadata_exists('user', $user_id, '_lbs_post_ids_user_liked')) {

        $current_post_ids = get_user_meta($user_id, '_lbs_post_ids_user_liked', true);
        $current_post_ids = array_diff($current_post_ids, [$post_id]);

        update_user_meta($user_id, '_lbs_post_ids_user_liked', $current_post_ids);
    }
}

function lbs_remove_from_post_meta_user_id_unliked_post($post_id, $user_id)
{
    if (metadata_exists('post', $post_id, '_lbs_user_ids_liked_post')) {

        $current_user_ids = get_post_meta($post_id, '_lbs_user_ids_liked_post', true);
        $current_user_ids=array_diff($current_user_ids,[$user_id]);

        update_post_meta($post_id, '_lbs_user_ids_liked_post', $current_user_ids);
    }
}

