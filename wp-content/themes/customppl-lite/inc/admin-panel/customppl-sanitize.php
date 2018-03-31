<?php
function customppl_lite_sanitize_post_cat_list($input){
    $customppl_lite_cat_list = customppl_lite_category_list();
    if(array_key_exists($input,$customppl_lite_cat_list)){
        return $input;
    }
    else{
        return '';
    }
}
function customppl_lite_sanitize_checkbox($input){
    if($input == 1){
        return 1;
    }
    else{
        return '';
    }
}
function customppl_lite_sanitize_post_select($input){
    $customppl_lite_posts_list = customppl_lite_posts_List();
    if(array_key_exists($input,$customppl_lite_posts_list)){
        return $input;
    }
    else{
        return  '';
    }
}
function customppl_lite_sanitize_font_size($input){
    $customppl_lite_font_size = customppl_lite_font_size();
    if(array_key_exists($input,$customppl_lite_font_size)){
        return $input;
    }
    else{
        return  '';
    }
}
function customppl_lite_sanitize_textarea($input){
    return wp_kses_post(force_balance_tags($input));
}
function customppl_lite_sanitize_iframe($input){
    $customppl_lite_iframe = array(
            'iframe' => array(
                'src' => array(),
                'width' => array(),
                'height' => array(),
                'frameborder' => array(),
                'style' => array(),
                'allowfullscreen' => array(),
            )
        );
        return wp_kses($input,$customppl_lite_iframe);
}