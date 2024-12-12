<?php
function lbs_initialize_options_setting()
{
    $lbs_setting = [
        '_lbs_bg_color' => '#efefef',
        '_lbs_border_radius' => '5',
        '_lbs_position_type' => 'fixed',
        '_lbs_x_position' => 'right',
        '_lbs_x_unit_type' => 'px',
        '_lbs_x_offset'=>'13',
        '_lbs_y_position'=>'top',
        '_lbs_y_unit_type'=>'px',
        '_lbs_y_offset'=>'410',
    ];

    add_option('_like_post', $lbs_setting);
}

function lbs_delete_options_setting()
{
    delete_option('_like_post');
}
