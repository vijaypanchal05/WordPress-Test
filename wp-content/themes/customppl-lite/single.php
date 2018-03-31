<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package customppl lite
 */

get_header();
$customppl_lite_feature_category = get_theme_mod('customppl_lite_feature_cat');
$customppl_lite_feature_cats = get_the_category( get_the_ID() );
foreach($customppl_lite_feature_cats as $customppl_lite_feature_cat){
    $customppl_lite_feature_class = '';
    if($customppl_lite_feature_category == $customppl_lite_feature_cat->slug){
        $customppl_lite_feature_class = 'feature-cat-post';
    }
}
do_action('customppl_lite_header_banner');?>
    <div class="ak-container">
    	<div id="primary" class="content-area <?php echo esc_attr($customppl_lite_feature_class); ?>">
    		<main id="main" class="site-main" role="main">
    
    		<?php
    		while ( have_posts() ) : the_post();
    
    			get_template_part( 'template-parts/content', get_post_format() );
    
    			// If comments are open or we have at least one comment, load up the comment template.
    			if ( comments_open() || get_comments_number() ) :
    				comments_template();
    			endif;
    
    		endwhile; // End of the loop.
    		?>
    
    		</main><!-- #main -->
    	</div><!-- #primary -->
    
<?php
get_sidebar();
?> </div> <?php
get_footer();