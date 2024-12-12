<?php
function lbs_like_post_admin_layout()
{

    if (!current_user_can('manage_options')) {
        return;
    }
    if (isset($_GET['setting-update'])) {
        add_settings_error('setting', 'setting-message', 'تنظیمات ذخیره گردید.', 'success');
    }
    settings_errors('setting-message');

    ?>
    <div class="lbs-wrap">
        <form action="options.php" method="post">
            <h1><?php echo esc_html(get_admin_page_title()) ?></h1>
            <?php
            settings_fields('like-post'); // Output security fields
            do_settings_sections('like-post-html');// Output setting sections
//            DebugHelper::dump(get_option('_like_post'));

            // Submit Button
            echo '<div class="submit-wrapper lbs-submit-wrapper">';
            submit_button('ذخیره تغییرات', 'primary large');
            echo '</div>';
            ?>
        </form>
    </div>

    <?php
}

// Initialize plugin settings and fields
function lbs_setting_init()
{

    register_setting('like-post', '_like_post', 'lbs_form_sanitize_input');

    // Add settings section
    add_settings_section('lbs_settings_section', '', '', 'like-post-html');
    // Add settings fields for information that need to customize plugin features
    add_settings_field('lbs_settings_field', '', 'lbs_render_html', 'like-post-html', 'lbs_settings_section');
}

add_action('admin_init', 'lbs_setting_init');

function lbs_render_html()
{
    $lbs_setting = get_option('_like_post')

    ?>
    <div class="lbs-element-wrapper">

        <label for="bg_color">رنگ پس‌زمینه</label>
        <input id="bg_color" type="color" name="_like_post[_lbs_bg_color]"
               value="<?php lbs_get_input_value($lbs_setting['_lbs_bg_color']); ?>">

        <label for="border_radius">انحنای گوشه‌ها</label>
        <div class="lbs-border-radius-wrapper lbs-range-group">
            <input type="range" id="border_radius" name="_like_post[_lbs_border_radius]" min="0" max="100"
                   value="<?php lbs_get_input_value($lbs_setting['_lbs_border_radius'], '5'); ?>">
            <output class="lbs-border-radius-output lbs-output-group"></output>
        </div>

        <label for="position_type">نحوه نمایش</label>
        <select name="_like_post[_lbs_position_type]" id="position_type">
            <option value="static" class="static" <?php selected($lbs_setting['_lbs_position_type'], 'static') ?> >
                ثابت
            </option>
            <option value="fixed" class="fixed" <?php selected($lbs_setting['_lbs_position_type'], 'fixed') ?>>شناور
            </option>
        </select>


        <div class="fixed-position-option d-none">
            <div class="lbs-flex-row lbs-fixed-position-wrapper">
                <div class="lbs-flex-column">
                    <label for="x_position">محل نمایش افقی</label>
                    <select name="_like_post[_lbs_x_position]" id="x_position">
                        <option value="right" class="right" <?php selected($lbs_setting['_lbs_x_position'], 'right') ?>>
                            سمت راست
                            مطلب
                            (پیش
                            فرض)
                        </option>
                        <option value="left" class="left" <?php selected($lbs_setting['_lbs_x_position'], 'left') ?>>سمت
                            چپ مطلب
                        </option>
                    </select>
                </div>
                <div class="lbs-flex-column lbs-unit-type">
                    <label for="x_unit_type">برحسب</label>
                    <div class="lbs-flex-row">
                        <div class="lbs-radio-group">
                            <label for="x_pixel">پیکسل</label>
                            <input type="radio" id="x_pixel" name="_like_post[_lbs_x_unit_type]" value="px" <?php checked($lbs_setting['_lbs_x_unit_type'],'px')?>>
                        </div>
                        <div class="lbs-radio-group">
                            <label for="x_percent">درصد</label>
                            <input type="radio" id="x_percent" name="_like_post[_lbs_x_unit_type]" value="%" <?php checked($lbs_setting['_lbs_x_unit_type'],'%')?>>
                        </div>
                    </div>
                </div>

                <div class="lbs-flex-column lbs-offset-range">
                    <label for="x_offset" id="x_label"></label>
                    <div class="lbs-range-group">
                        <input type="range" id="x_offset" name="_like_post[_lbs_x_offset]" min="-1000" max="1000"
                               value="<?php lbs_get_input_value($lbs_setting['_lbs_x_offset'], ''); ?>">
                        <span class="lbs-output-group"><span class="x-unit"></span><output class="lbs-x-offset-output"></output></span>
                    </div>
                </div>
            </div>

            <div class="lbs-flex-row lbs-fixed-position-wrapper">
                <div class="lbs-flex-column">
                    <label for="y_position">محل نمایش عمودی</label>
                    <select name="_like_post[_lbs_y_position]" id="y_position">
                        <option value="top" class="top" <?php selected($lbs_setting['_lbs_y_position'], 'top') ?>>بالا
                            (پیش
                            فرض)
                        </option>
                        <option value="bottom"
                                class="bottom" <?php selected($lbs_setting['_lbs_y_position'], 'bottom') ?>>پایین
                        </option>
                    </select>
                </div>

                <div class="lbs-flex-column lbs-unit-type">
                    <label for="y_unit_type">برحسب</label>
                    <div class="lbs-flex-row">
                        <div class="lbs-radio-group">
                            <label for="y_pixel">پیکسل</label>
                            <input type="radio" id="y_pixel" name="_like_post[_lbs_y_unit_type]" value="px" <?php checked($lbs_setting['_lbs_y_unit_type'],'px')?>>
                        </div>
                        <div class="lbs-radio-group">
                            <label for="y_percent">درصد</label>
                            <input type="radio" id="y_percent" name="_like_post[_lbs_y_unit_type]" value="%" <?php checked($lbs_setting['_lbs_y_unit_type'],'%')?>>
                        </div>
                    </div>
                </div>

                <div class="lbs-flex-column lbs-offset-range">
                    <label for="y_offset" id="y_label"></label>
                    <div class="lbs-range-group">
                        <input type="range" id="y_offset" name="_like_post[_lbs_y_offset]" min="-1000" max="1000"
                               value="<?php lbs_get_input_value($lbs_setting['_lbs_y_offset'], ''); ?>">
                        <span class="lbs-output-group"><span class="y-unit"></span><output class="lbs-y-offset-output"></output></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

//get input value
function lbs_get_input_value($value, $default_value = '')
{
    echo isset($value) ? esc_attr($value) : $default_value;
}

// sanitize inputs
function lbs_form_sanitize_input($input)
{
    $input['_lbs_bg_color'] = sanitize_text_field($input['_lbs_bg_color']);
    $input['_lbs_border_radius'] = sanitize_text_field($input['_lbs_border_radius']);

    $input['_lbs_position_type'] = sanitize_text_field($input['_lbs_position_type']);
    $input['_lbs_x_position'] = sanitize_text_field($input['_lbs_x_position']);

    $input['_lbs_x_unit_type'] = sanitize_text_field($input['_lbs_x_unit_type']);
    $input['_lbs_x_offset'] = sanitize_text_field($input['_lbs_x_offset']);

    $input['_lbs_y_position'] = sanitize_text_field($input['_lbs_y_position']);
    $input['_lbs_y_unit_type'] = sanitize_text_field($input['_lbs_y_unit_type']);
    $input['_lbs_y_offset'] = sanitize_text_field($input['_lbs_y_offset']);

    return $input;
}
