<?php
/**
 * About Sectin
*/
$customppl_lite_about_title = get_theme_mod('customppl_lite_about_title');
$customppl_lite_about_sub_title = get_theme_mod('customppl_lite_about_sub_title');
$customppl_lite_about_post = get_theme_mod('customppl_lite_about_post');
$construct_about_args = new WP_Query(array('post_type' => 'post', 'post__in' => array($customppl_lite_about_post)));
if($customppl_lite_about_title || $customppl_lite_about_sub_title || $customppl_lite_about_post){ ?>

        <div class="ak-container">
            <?php if($construct_about_args->have_posts()):
                while($construct_about_args->have_posts()) : 
                $construct_about_args->the_post(); ?>
                
                    <div class="about-content-wrap clearfix">
                        <div class="left-about-content wow fadeInLeft">
                            <?php if($customppl_lite_about_title || $customppl_lite_about_sub_title){ ?>
                                <div class="section-title-sub-wrap">
                                    <?php if($customppl_lite_about_title){ ?><div class="section-title"><h5><?php echo esc_html($customppl_lite_about_title); ?></h5></div><?php } ?>
                                    <?php if($customppl_lite_about_sub_title) { ?><div class="section-sub-title"><h2><?php echo esc_html($customppl_lite_about_sub_title); ?></h2></div><?php } ?>
                                </div>
                            <?php } ?>
                            <?php if(get_the_title() || get_the_content()){ ?>
                            <div class="about-posts">
                                <?php if(get_the_title()){ ?><div class="about-post-title"><a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a></div><?php } ?>
                                <?php if(get_the_content()){ ?><div class="about-post-content"><?php echo esc_attr(wp_trim_words(get_the_content(),'50','...')) ?></div><?php } ?>
                                <span class="about-button"><a href="<?php the_permalink(); ?>"><?php _e('Read More','customppl-lite'); ?></a></span>
                            </div>
                        <?php } ?>
                        </div>
                        <?php
                            $customppl_lite_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'');
                            if($customppl_lite_image_src){
                        ?>
                        <div class="right-about-content wow fadeInRight">
                            <div class="about-image-wrap"><img src="<?php echo esc_url($customppl_lite_image_src[0]); ?>" /></div>
                        </div>
                        <?php } ?>
                    </div>
                    
                <?php endwhile; wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        
<?php }