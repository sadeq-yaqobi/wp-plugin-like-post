<?php
function lbs_is_user_liked_post($post_id, $user_id): bool
{
    // if there is meta user for key=_lbs_post_ids_user_liked , get that array
    if (metadata_exists('user', $user_id, '_lbs_post_ids_user_liked')) {
        $post_ids_user_liked = get_user_meta($user_id, '_lbs_post_ids_user_liked', true);

        if (in_array($post_id, $post_ids_user_liked)) {
            return true;
        }
    }
    return false;
}

function lbs_post_like_counter(int $post_id): int
{
    // Type-hint and ensure integer input
    $liked_users = get_post_meta($post_id, '_lbs_user_ids_liked_post', true);

    // Ensure we return an integer, even if no likes
    return is_array($liked_users) ? count($liked_users) : 0;
}

function lbs_is_user_exist($user_id): bool
{
    if (!empty($user_id)) {
        $user = get_user($user_id);
        if ($user)
            return true;
        return false;
    }
    return false;
}

function lbs_is_post_exist_published($post_id): bool
{
    if (!empty($post_id)) {
        $post = get_post($post_id);
        if ($post || $post->post_status === 'published')
            return true;
        return false;
    }
    return false;
}
