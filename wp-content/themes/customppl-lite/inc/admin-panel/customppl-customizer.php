<?php
add_action('customize_register','customppl_lite_Customizer_Control');
function customppl_lite_Customizer_Control($wp_customize){
    require get_template_directory() . '/inc/admin-panel/customppl-customizer-option.php';
    require get_template_directory() . '/inc/admin-panel/cunstruction-sanitize.php';
    $wp_customize->get_section( 'title_tagline' )->panel = 'customppl_lite_header_panel';  
    $wp_customize->get_section( 'background_image' )->panel = 'customppl_lite_general_panel';
    $wp_customize->get_section( 'colors' )->panel = 'customppl_lite_general_panel';
    $wp_customize->remove_control('display_header_text');
}