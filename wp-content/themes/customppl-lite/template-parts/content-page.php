<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package customppl lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
$customppl_lite_woocommerce_check = 'true';  
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
  if(!is_cart() && !is_checkout()){
    $customppl_lite_woocommerce_check = '';
  }
}
if($customppl_lite_woocommerce_check){?>
	<header class="entry-header">
    <?php
        $customppl_lite_page_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'customppl-single-page');
        if($customppl_lite_page_image){?><img src="<?php echo esc_url($customppl_lite_page_image[0]) ?>" alt="<?php the_title_attribute()?>" title="<?php the_title_attribute()?>" /><?php } ?>
	   <?php if(get_the_title()){ the_title( '<h1 class="entry-title">', '</h1>' );} ?>
	</header><!-- .entry-header -->
<?php } ?>
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'customppl-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'customppl-lite' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->