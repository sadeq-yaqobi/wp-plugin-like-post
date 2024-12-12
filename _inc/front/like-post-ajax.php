<?php
add_action('wp_ajax_lbs_like_post', 'lbs_like_post');
add_action('wp_ajax_nopriv_lbs_like_post', 'lbs_like_post');

function lbs_like_post()
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
            'message' => 'برای لایک مطلب ابتدا در سایت وارد شوید.'
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

    lbs_add_to_user_meta_liked_post_id($post_id, $user_id);
    lbs_add_to_post_meta_user_id_liked_post($post_id, $user_id);
    $like_number = lbs_post_like_counter($post_id);

    wp_send_json([
        'success' => true,
        'message' => 'با تشکر لایک شما ثبت شد.',
        'like_number' => $like_number
    ], 200);

}



function lbs_add_to_user_meta_liked_post_id($post_id, $user_id)
{
    if (!metadata_exists('user', $user_id, '_lbs_post_ids_user_liked')) {
        // if there is no meta user for key=_lbs_post_ids_user_liked , creat an array and insert post id in this array
        $post_ids_user_liked[] = $post_id;
        add_user_meta($user_id, '_lbs_post_ids_user_liked', $post_ids_user_liked);
    } else {
        // if there is meta user for key=_lbs_post_ids_user_liked , get that array
        $current_post_ids_user_liked = get_user_meta($user_id, '_lbs_post_ids_user_liked', true);

        // add the new user post id in the array that already exist.
        $current_post_ids_user_liked[] = $post_id;

        //update user meta after above steps
        update_user_meta($user_id, '_lbs_post_ids_user_liked', $current_post_ids_user_liked);
    }
}

function lbs_add_to_post_meta_user_id_liked_post($post_id, $user_id)
{
    if (!metadata_exists('post', $post_id, '_lbs_user_ids_liked_post')) {
        $user_ids_liked_post[] = $user_id;
        add_post_meta($post_id, '_lbs_user_ids_liked_post', $user_ids_liked_post);
    } else {
        $current_user_ids_liked_post = get_post_meta($post_id, '_lbs_user_ids_liked_post', true);
        $current_user_ids_liked_post[] = $user_id;
        update_post_meta($post_id, '_lbs_user_ids_liked_post', $current_user_ids_liked_post);
    }
}

