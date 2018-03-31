<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package customppl lite
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php 
    $customppl_lite_top_footer_enable = get_theme_mod('customppl_lite_top_footer_enable');
    $customppl_lite_top_footer_logo = get_theme_mod('customppl_lite_top_footer_logo');
    $customppl_lite_top_footer_desc = get_theme_mod('customppl_lite_top_footer_description');
    if($customppl_lite_top_footer_enable){ ?>
       
        <div class="top-footer wow fadeInUp">
            <div class="ak-container">
                <?php if($customppl_lite_top_footer_logo){ ?><div class="footer-logo"><img src="<?php echo esc_url($customppl_lite_top_footer_logo); ?>" alt="<?php esc_attr_e('Footer Logo','customppl-lite'); ?>" title="<?php esc_attr_e('Footer Logo','customppl-lite'); ?>" /></div><?php } ?>
                <?php if($customppl_lite_top_footer_desc) { ?><div class="top-footer-desc"><?php echo wp_kses_post($customppl_lite_top_footer_desc); ?></div><?php } ?>
                <div class="social-icons">
                    <?php do_action('customppl_lite_header_social_link_acrion'); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if(is_active_sidebar('customppl-lite-footer-1') || is_active_sidebar('customppl-lite-footer-2') || is_active_sidebar('customppl-lite-footer-3')){ ?>
        <div class="bottom-footer">
            <div class="ak-container">
                <div class="bottom-footer-wrapper clearfix">
                    <?php if(is_active_sidebar('customppl-lite-footer-1')){
                        ?>
                            <div class="footer-1">
                                <?php dynamic_sidebar('customppl-lite-footer-1'); ?>
                            </div>
                        <?php
                    } ?>
                    <?php if(is_active_sidebar('customppl-lite-footer-2')){
                        ?>
                            <div class="footer-2">
                                <?php dynamic_sidebar('customppl-lite-footer-2'); ?>
                            </div>
                        <?php
                    } ?>
                    <?php if(is_active_sidebar('customppl-lite-footer-3')){
                        ?>
                            <div class="footer-3">
                                <?php dynamic_sidebar('customppl-lite-footer-3'); ?>
                            </div>
                        <?php
                    } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    
    <?php $customppl_lite_footer_text = get_theme_mod('customppl_lite_footer_text'); ?>
		<div class="site-info">
            <div class="ak-container">
    			<span class="footer-text">
                    <?php 
                    if( !empty($customppl_lite_footer_text)){
                        echo wp_kses_post($customppl_lite_footer_text) . " | "; 
                    } ?>                    
                </span>
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>