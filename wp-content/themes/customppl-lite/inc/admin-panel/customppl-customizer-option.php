<?php
$customppl_lite_cat_list = customppl_lite_category_list();
$customppl_lite_posts_list = customppl_lite_posts_List();
$customppl_lite_font_size = customppl_lite_font_size();
$customppl_lite_fonts = customppl_lite_fonts();
 
 /** Customizers Panels **/
 $wp_customize->add_panel(
    'customppl_lite_general_panel',array(
        'title' => __('General Setting','customppl-lite'),
        'priority' => 2,
    )
 );
 $wp_customize->add_panel(
    'customppl_lite_header_panel',array(
        'title' => __('Header Setting','customppl-lite'),
        'description' => __('All The Header Setting Available Here','customppl-lite'),
        'priority' => 2,
    )
 );
 $wp_customize->add_panel(
    'customppl_lite_home_panel',
    array(
        'title' => __('Home Setting','customppl-lite'),
        'description' => __('All The Setting For Home Sections','customppl-lite'),
        'priority' => 3
    )
 );
 $wp_customize->add_panel(
    'customppl_lite_typography_panel',
    array(
        'title' => __('Typography Setting','customppl-lite'),
        'priority' => 5
    )
 );
 $wp_customize->add_panel(
    'customppl_lite_footer_panel',
    array(
        'title' => __('Footer Setting','customppl-lite'),
        'priority' => 4
    )
 );
 
 /** Customizer Sections **/
 $wp_customize->add_section(
    'customppl_lite_menu_section',
    array(
        'title' => __('Menu Section','customppl-lite'),
        'description' => __('All The Settings For Menu','customppl-lite'),
        'priority' => 3,
        'panel' => 'customppl_lite_header_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_slider_section',
    array(
        'title' => __('Slider Section','customppl-lite'),
        'description' => __('All The Settings For Slider','customppl-lite'),
        'priority' => 5,
        'panel' => 'customppl_lite_header_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_page_section',
    array(
        'title' => __('Inner Page Title Bar Background','customppl-lite'),
        'priority' => 6,
        'panel' => 'customppl_lite_general_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_about_section',
    array(
        'title' => __('About Us Section','customppl-lite'),
        'priority' => 3,
        'panel' => 'customppl_lite_home_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_feature_section',
    array(
        'title' => __('Feature Section','customppl-lite'),
        'priority' => 6,
        'panel' => 'customppl_lite_home_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_team_section',
    array(
        'title' => __('Team Section','customppl-lite'),
        'priority' => 8,
        'panel' => 'customppl_lite_home_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_portfolio_section',
    array(
        'title' => __('Portfolio Section','customppl-lite'),
        'priority' => 10,
        'panel' => 'customppl_lite_home_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_blog_section',
    array(
        'title' => __('Blog Section','customppl-lite'),
        'priority' => 12,
        'panel' => 'customppl_lite_home_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_cta_section',
    array(
        'title' => __('Call To Action Section','customppl-lite'),
        'priority' => 14,
        'panel' => 'customppl_lite_home_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_shop_section',
    array(
        'title' => __('Shop Section','customppl-lite'),
        'priority' => 15,
        'panel' => 'customppl_lite_home_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_testimonial_section',
    array(
        'title' => __('Testimonial Section','customppl-lite'),
        'priority' => 16,
        'panel' => 'customppl_lite_home_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_client_section',
    array(
        'title' => __('Client Section','customppl-lite'),
        'priority' => 18,
        'panel' => 'customppl_lite_home_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_top_footer_section',
    array(
        'title' => __('Top Footer Section','customppl-lite'),
        'priority' => 2,
        'panel' => 'customppl_lite_footer_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_bottom_footer_section',
    array(
        'title' => __('Bottom Footer Section','customppl-lite'),
        'priority' => 4,
        'panel' => 'customppl_lite_footer_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_body_typography_section',
    array(
        'title' => __('Body','customppl-lite'),
        'priority' => 4,
        'panel' => 'customppl_lite_typography_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_h1_typography_section',
    array(
        'title' => __('Heading 1','customppl-lite'),
        'priority' => 5,
        'panel' => 'customppl_lite_typography_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_h2_typography_section',
    array(
        'title' => __('Heading 2','customppl-lite'),
        'priority' => 6,
        'panel' => 'customppl_lite_typography_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_h3_typography_section',
    array(
        'title' => __('Heading 3','customppl-lite'),
        'priority' => 7,
        'panel' => 'customppl_lite_typography_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_h4_typography_section',
    array(
        'title' => __('Heading 4','customppl-lite'),
        'priority' => 8,
        'panel' => 'customppl_lite_typography_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_h5_typography_section',
    array(
        'title' => __('Heading 5','customppl-lite'),
        'priority' => 9,
        'panel' => 'customppl_lite_typography_panel',
        'capability' => 'edit_theme_options',
    )
 );
 $wp_customize->add_section(
    'customppl_lite_h6_typography_section',
    array(
        'title' => __('Heading 6','customppl-lite'),
        'priority' => 10,
        'panel' => 'customppl_lite_typography_panel',
        'capability' => 'edit_theme_options',
    )
 );
  $wp_customize->add_section(
    'customppl_lite_skin_color_section',
    array(
        'title' => __('Template Color','customppl-lite'),
        'priority' => 10,
        'panel' => 'customppl_lite_general_panel',
        'capability' => 'edit_theme_options',
    )
 );
 /** Customizer Settings And Control **/
 $wp_customize->add_setting(
    'customppl_lite_search_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_search_enable',
    array(
        'label' => __('Check Enable Search On Menu','customppl-lite'),
        'priority' => 2,
        'type' => 'checkbox',
        'section' => 'customppl_lite_menu_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_cart_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_cart_enable',
    array(
        'label' => __('Check Enable Cart On Menu (Only works if WooCommerce plugin is activated.)','customppl-lite'),
        'priority' => 4,
        'type' => 'checkbox',
        'section' => 'customppl_lite_menu_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_slider_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_slider_enable',
    array(
        'label' => __('Check Enable Slider','customppl-lite'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'customppl_lite_slider_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_slider_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_post_cat_list',
    )
 );
 $wp_customize->add_control(
    'customppl_lite_slider_cat',
    array(
        'label' => __('Slider Category','customppl-lite'),
        'priority' => 3,
        'type' => 'select',
        'choices' => $customppl_lite_cat_list,
        'section' => 'customppl_lite_slider_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_page_bg_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'customppl_lite_page_bg_image',
           array(
               'label'      => __( 'Inner Page Title Bar Background Image', 'customppl-lite' ),
               'section'    => 'customppl_lite_page_section',
               'settings'   => 'customppl_lite_page_bg_image',
               'priority' => 10,
           )
       )
   );
 $wp_customize->add_setting(
    'customppl_lite_about_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_about_enable',
    array(
        'label' => __('Enable About US','customppl-lite'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'customppl_lite_about_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_about_title',
    array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'=>'postMessage',
    )
 );
 $wp_customize->add_control(
    'customppl_lite_about_title',
    array(
        'label' => __('About Us Section Title','customppl-lite'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'customppl_lite_about_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_about_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_about_sub_title',
    array(
        'label' => __('About Us Section Sub Title','customppl-lite'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'customppl_lite_about_section'
    )
 );
  $wp_customize->add_setting(
    'customppl_lite_about_post',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_post_select',
    )
  );
  $wp_customize->add_control(
    'customppl_lite_about_post',
    array(
        'label' => __('About Us Post','customppl-lite'),
        'type' => 'select',
        'choices' => $customppl_lite_posts_list,
        'section' => 'customppl_lite_about_section',
        'priority' => 10
    )
  );
 $wp_customize->add_setting(
    'customppl_lite_disable_feature_image_frame',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_disable_feature_image_frame',
    array(
        'label' => __('Disable Feature Image Frame','customppl-lite'),
        'type' => 'checkbox',
        'priority' => 12,
        'section' => 'customppl_lite_about_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_feature_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_feature_enable',
    array(
        'label' => __('Enable Feature Section','customppl-lite'),
        'type' => 'checkbox',
        'priority' => '2',
        'section' => 'customppl_lite_feature_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_feature_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_feature_title',
    array(
        'label' => __('Feature Section Title','customppl-lite'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'customppl_lite_feature_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_feature_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_feature_sub_title',
    array(
        'label' => __('Feature Section Sub Title','customppl-lite'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'customppl_lite_feature_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_feature_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_feature_cat',
    array(
        'label' => __('Feature Post Category','customppl-lite'),
        'type' => 'select',
        'choices' => $customppl_lite_cat_list,
        'section' => 'customppl_lite_feature_section',
        'priority' => 8,
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_feature_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'customppl_lite_feature_image',
           array(
               'label'      => __( 'Feature Section Image', 'customppl-lite' ),
               'section'    => 'customppl_lite_feature_section',
               'settings'   => 'customppl_lite_feature_image',
               'priority' => 10,
           )
       )
   );
 $wp_customize->add_setting(
    'customppl_lite_team_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_team_enable',
    array(
        'label' => __('Enable Team','customppl-lite'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'customppl_lite_team_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_team_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_team_title',
    array(
        'label' => __('Team Section Title','customppl-lite'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'customppl_lite_team_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_team_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_team_sub_title',
    array(
        'label' => __('Team Section Sub Title','customppl-lite'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'customppl_lite_team_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_portfolio_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_portfolio_enable',
    array(
        'label' => __('Enable Portfolio','customppl-lite'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'customppl_lite_portfolio_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_portfolio_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_portfolio_title',
    array(
        'label' => __('Portfolio Section Title','customppl-lite'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'customppl_lite_portfolio_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_portfolio_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_portfolio_sub_title',
    array(
        'label' => __('Portfolio Section Sub Title','customppl-lite'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'customppl_lite_portfolio_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_portfolio_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_portfolio_cat',
    array(
        'label' => __('Portfolio Post Category','customppl-lite'),
        'type' => 'select',
        'choices' => $customppl_lite_cat_list,
        'section' => 'customppl_lite_portfolio_section',
        'priority' => 8,
    )
 );
  $wp_customize->add_setting(
    'customppl_lite_blog_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_blog_enable',
    array(
        'label' => __('Enable Bolog Section','customppl-lite'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'customppl_lite_blog_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_blog_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_blog_title',
    array(
        'label' => __('Blog Section Title','customppl-lite'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'customppl_lite_blog_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_blog_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_blog_sub_title',
    array(
        'label' => __('Blog Section Sub Title','customppl-lite'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'customppl_lite_blog_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_blog_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_blog_cat',
    array(
        'label' => __('Blog Post Category','customppl-lite'),
        'type' => 'select',
        'choices' => $customppl_lite_cat_list,
        'section' => 'customppl_lite_blog_section',
        'priority' => 8,
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_cta_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_cta_enable',
    array(
        'label' => __('Enable Call To Action Section','customppl-lite'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'customppl_lite_cta_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_cta_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_cta_title',
    array(
        'label' => __('Call To Action Section Title','customppl-lite'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'customppl_lite_cta_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_cta_section_description',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'customppl_lite_sanitize_textarea'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_cta_section_description',
    array(
        'label' => __('Call To Action Section Description','customppl-lite'),
        'type' => 'textarea',
        'priority' => 6,
        'section' => 'customppl_lite_cta_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_cta_button_text',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_cta_button_text',
    array(
        'label' => __('Call To Action Button Text','customppl-lite'),
        'type' => 'text',
        'priority' => 8,
        'section' => 'customppl_lite_cta_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_cta_button_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_cta_button_link',
    array(
        'label' => __('Call To Action Button Link','customppl-lite'),
        'type' => 'text',
        'priority' =>10,
        'section' => 'customppl_lite_cta_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_cta_bg_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'customppl_lite_cta_bg_image',
           array(
               'label'      => __( 'Section Background Image', 'customppl-lite' ),
               'section'    => 'customppl_lite_cta_section',
               'settings'   => 'customppl_lite_cta_bg_image',
               'priority' => 15,
           )
       )
   );
 $wp_customize->add_setting(
    'customppl_lite_shop_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_shop_enable',
    array(
        'label' => __('Enable Shop Section','customppl-lite'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'customppl_lite_shop_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_shop_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_shop_title',
    array(
        'label' => __('Shop Section Title','customppl-lite'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'customppl_lite_shop_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_shop_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_shop_sub_title',
    array(
        'label' => __('Shop Section Sub Title','customppl-lite'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'customppl_lite_shop_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_testimonial_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_testimonial_enable',
    array(
        'label' => __('Enable Testimonial Section','customppl-lite'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'customppl_lite_testimonial_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_testimonial_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_testimonial_title',
    array(
        'label' => __('Testimonial Section Title','customppl-lite'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'customppl_lite_testimonial_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_testimonial_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_testimonial_sub_title',
    array(
        'label' => __('Testimonial Section Sub Title','customppl-lite'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'customppl_lite_testimonial_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_testimonial_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_testimonial_cat',
    array(
        'label' => __('Testimonial Post Category','customppl-lite'),
        'type' => 'select',
        'choices' => $customppl_lite_cat_list,
        'section' => 'customppl_lite_testimonial_section',
        'priority' => 8,
    )
 );
  $wp_customize->add_setting(
    'customppl_lite_client_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_client_enable',
    array(
        'label' => __('Enable Client Section','customppl-lite'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'customppl_lite_client_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_client_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_client_cat',
    array(
        'label' => __('Client Post Category','customppl-lite'),
        'type' => 'select',
        'choices' => $customppl_lite_cat_list,
        'section' => 'customppl_lite_client_section',
        'priority' => 4,
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_top_footer_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'customppl_lite_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_top_footer_enable',
    array(
        'label' => __('Enable Top Footer Section','customppl-lite'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'customppl_lite_top_footer_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_top_footer_logo',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'customppl_lite_top_footer_logo',
           array(
               'label'      => __( 'Top Footer Logo', 'customppl-lite' ),
               'section'    => 'customppl_lite_top_footer_section',
               'settings'   => 'customppl_lite_top_footer_logo',
               'priority' => 4,
           )
       )
   );
 $wp_customize->add_setting(
    'customppl_lite_top_footer_description',
    array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'customppl_lite_sanitize_textarea'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_top_footer_description',
    array(
        'label' => __('Top Footer Description','customppl-lite'),
        'type' => 'textarea',
        'priority' => 6,
        'section' => 'customppl_lite_top_footer_section'
    )
 );
 
 $wp_customize->add_setting(
    'customppl_lite_facebook_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_facebook_link',
    array(
        'label' => __('Facebook Link','customppl-lite'),
        'type' => 'text',
        'priority' => 8,
        'section' => 'customppl_lite_top_footer_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_twitter_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_twitter_link',
    array(
        'label' => __('Twitter Link','customppl-lite'),
        'type' => 'text',
        'priority' => 10,
        'section' => 'customppl_lite_top_footer_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_youtube_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_youtube_link',
    array(
        'label' => __('Youtube Link','customppl-lite'),
        'type' => 'text',
        'priority' => 12,
        'section' => 'customppl_lite_top_footer_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_pinterest_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_pinterest_link',
    array(
        'label' => __('Pinterest Link','customppl-lite'),
        'type' => 'text',
        'priority' => 14,
        'section' => 'customppl_lite_top_footer_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_instagram_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_instagram_link',
    array(
        'label' => __('Instagram Link','customppl-lite'),
        'type' => 'text',
        'priority' => 16,
        'section' => 'customppl_lite_top_footer_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_linkedin_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_linkedin_link',
    array(
        'label' => __('Linkedin Link','customppl-lite'),
        'type' => 'text',
        'priority' => 18,
        'section' => 'customppl_lite_top_footer_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_googleplus_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_googleplus_link',
    array(
        'label' => __('GooglePlus Link','customppl-lite'),
        'type' => 'text',
        'priority' => 20,
        'section' => 'customppl_lite_top_footer_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_flickr_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_flickr_link',
    array(
        'label' => __('Flickr Link','customppl-lite'),
        'type' => 'text',
        'priority' => 22,
        'section' => 'customppl_lite_top_footer_section'
    )
 );
 $wp_customize->add_setting(
    'customppl_lite_footer_text',
    array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post'
    )
 );
 $wp_customize->add_control(
    'customppl_lite_footer_text',
    array(
        'label' => __('Footer Text','customppl-lite'),
        'type' => 'textarea',
        'priority' => 4,
        'section' => 'customppl_lite_bottom_footer_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_body_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'customppl_lite_sanitize_font_size'
    )
);
 $wp_customize->add_control(
    'customppl_lite_body_font_size',
    array(
        'label' => __('Body Font Size','customppl-lite'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $customppl_lite_font_size,
        'section' => 'customppl_lite_body_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h1_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'customppl_lite_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'customppl_lite_h1_font_size',
    array(
        'label' => __('Heading 1 Font Size','customppl-lite'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $customppl_lite_font_size,
        'section' => 'customppl_lite_h1_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h2_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'customppl_lite_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'customppl_lite_h2_font_size',
    array(
        'label' => __('Heading 2 Font Size','customppl-lite'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $customppl_lite_font_size,
        'section' => 'customppl_lite_h2_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h3_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'customppl_lite_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'customppl_lite_h3_font_size',
    array(
        'label' => __('Heading 3 Font Size','customppl-lite'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $customppl_lite_font_size,
        'section' => 'customppl_lite_h3_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h4_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'customppl_lite_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'customppl_lite_h4_font_size',
    array(
        'label' => __('Heading 4 Font Size','customppl-lite'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $customppl_lite_font_size,
        'section' => 'customppl_lite_h4_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h5_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'customppl_lite_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'customppl_lite_h5_font_size',
    array(
        'label' => __('Heading 5 Font Size','customppl-lite'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $customppl_lite_font_size,
        'section' => 'customppl_lite_h5_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h6_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'customppl_lite_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'customppl_lite_h6_font_size',
    array(
        'label' => __('Heading 6 Font Size','customppl-lite'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $customppl_lite_font_size,
        'section' => 'customppl_lite_h6_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_body_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'customppl_lite_body_font',
    array(
        'label' => __('Body Font','customppl-lite'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $customppl_lite_fonts,
        'section' => 'customppl_lite_body_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h1_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'customppl_lite_h1_font',
    array(
        'label' => __('Heading 1 Font','customppl-lite'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $customppl_lite_fonts,
        'section' => 'customppl_lite_h1_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h2_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'customppl_lite_h2_font',
    array(
        'label' => __('Heading 2 Font','customppl-lite'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $customppl_lite_fonts,
        'section' => 'customppl_lite_h2_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h3_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'customppl_lite_h3_font',
    array(
        'label' => __('Heading 3 Font','customppl-lite'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $customppl_lite_fonts,
        'section' => 'customppl_lite_h3_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h4_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'customppl_lite_h4_font',
    array(
        'label' => __('Heading 4 Font','customppl-lite'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $customppl_lite_fonts,
        'section' => 'customppl_lite_h4_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h5_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'customppl_lite_h5_font',
    array(
        'label' => __('Heading 5 Font','customppl-lite'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $customppl_lite_fonts,
        'section' => 'customppl_lite_h5_typography_section'
    )
 );
$wp_customize->add_setting(
    'customppl_lite_h6_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'customppl_lite_h6_font',
    array(
        'label' => __('Heading 6 Font','customppl-lite'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $customppl_lite_fonts,
        'section' => 'customppl_lite_h6_typography_section'
    )
 );
 
 /** Dynamic Color Options **/
$wp_customize->add_setting( 'customppl_lite_skin_color', array( 'default' => '#FEA100', 'sanitize_callback' => 'sanitize_hex_color' ));

$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'customppl_lite_skin_color', 
    array(
        'label'      => esc_html__( 'Template Color', 'customppl-lite' ),
        'section'    => 'customppl_lite_skin_color_section',
        'settings'   => 'customppl_lite_skin_color',
    ) ) 
);