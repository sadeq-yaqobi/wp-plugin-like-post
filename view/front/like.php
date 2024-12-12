<?php
function lbs_like_layout()
{
    $lbs_setting = get_option('_like_post');
    $style =
        'background-color:' . $lbs_setting['_lbs_bg_color'] .
        ';border-radius:' . $lbs_setting['_lbs_border_radius'] .
        'px;position:' . $lbs_setting['_lbs_position_type'] . ';'
        . $lbs_setting['_lbs_x_position'] . ':' . $lbs_setting['_lbs_x_offset'].$lbs_setting['_lbs_x_unit_type']. ';'
        . $lbs_setting['_lbs_y_position'] . ':' . $lbs_setting['_lbs_y_offset'].$lbs_setting['_lbs_y_unit_type']. ';';
    ?>
    <div class="like-container" style="<?php echo $style ?>">
        <div class='middle-wrapper'>
            <div class='like-wrapper'>
                <?php
                $post_id = get_the_ID();
                $user_id = get_current_user_id();
                $like_number = lbs_post_like_counter($post_id);
                $is_post_liked = lbs_is_user_liked_post($post_id, $user_id) ? 'lbs-red-color lbs-liked' : 'lbs-not-liked';
                ?>
                <a class="like-button <?php echo $is_post_liked; ?>" id="lbs_like_button"
                   data-post-id="<?php echo $post_id; ?>"
                   data-user-id="<?php echo $user_id; ?>">
                    <span class="like-counter"><?php echo $like_number ?></span>
                    <span class='like-icon '>
                    <div class='heart-animation-1'></div>
                    <div class='heart-animation-2'></div>
                </span>
                </a>
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('like-post', 'lbs_like_layout');
