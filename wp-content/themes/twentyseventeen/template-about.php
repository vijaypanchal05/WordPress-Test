<?php
/**
 * Template Name: Aboutus
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Aliro
 * @since Aliro 1.0
 */
get_header(); ?>


<?php
add_filter('the_content', 'add_content_ads_post');

function add_content_ads_post($content){
    if (is_single() && 'ads' == get_post_type()) {

        function this_shortcode($atts){
            $this_is_my_id = get_the_ID();
            // Here the problem, the ID is template_post_type ID!
            // Not the ads ID!
            extract(shortcode_atts(array(
             'cf' => '',
            ),$atts));

            $my_custom_field = get_field($cf, $this_is_my_id);
            return $my_custom_field;
            }
        add_shortcode('extractcf', 'this_shortcode');
        // Shortcode is: [extractcf cf='my_custom_field']

        // this is my template
        $args = array('p' => 1693, 'post_type'=>'template_post_type', 'limit'=> '1');
        $loop = new WP_Query($args);
        $loop->the_post();
        $content_plus = the_content();
        wp_reset_query();
        wp_reset_postdata();

    return $content.$content_plus;
    }
return $content;
}
?>


<?php get_footer(); ?>