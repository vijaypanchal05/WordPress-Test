<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package customppl lite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
        $customppl_lite_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'customppl-single-page');
        if($customppl_lite_post_image){
            ?><img src="<?php echo esc_url($customppl_lite_post_image[0]) ?>" alt="<?php the_title_attribute()?>" title="<?php the_title_attribute()?>" /><?php
        }
		if ( !is_single() ) :
			the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<div class="comment-author-date">
                <span class="post-author"><?php  echo esc_url(the_author_posts_link()); ?> </span>
                
                <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_attr(get_the_date('d M Y')); ?></span>
                
                <span class="post-comment"><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o" aria-hidden="true"></i><?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'customppl-lite' ), number_format_i18n( get_comments_number() ) ); ?></a></span>
            </div>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
        if ( is_single() ) :
			the_content();
        else:
            echo apply_filters('the_content' , wp_kses_post(wp_trim_words(get_the_content(),70,'...')));
            ?>
                <a class="read-more" href="<?php the_permalink() ?>"><?php _e('Read More','customppl-lite'); ?><i class="fa fa-angle-right " aria-hidden="true"></i></a>
            <?php
        endif;
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'customppl-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->