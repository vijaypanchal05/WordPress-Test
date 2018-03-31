<?php
/**
 * Portfolio Section
 */
 $customppl_lite_portfolio_section_title = get_theme_mod('customppl_lite_portfolio_title');
 $customppl_lite_portfolio_section_sub_title = get_theme_mod('customppl_lite_portfolio_sub_title');
 $customppl_lite_portfolio_cat = get_theme_mod('customppl_lite_portfolio_cat');
 if($customppl_lite_portfolio_section_title || $customppl_lite_portfolio_section_sub_title || $customppl_lite_portfolio_cat){
    ?>
        <div class="portfolio-wrap-contents">
            <?php if($customppl_lite_portfolio_section_title || $customppl_lite_portfolio_section_sub_title){ ?>
                <div class="ak-container">
                    <div class="section-title-sub-wrap wow fadeInUp">
                        <?php if($customppl_lite_portfolio_section_title){ ?><div class="section-title"><h5><?php echo esc_html($customppl_lite_portfolio_section_title); ?></h5></div><?php } ?>
                        <?php if($customppl_lite_portfolio_section_sub_title) { ?><div class="section-sub-title"><h2><?php echo esc_html($customppl_lite_portfolio_section_sub_title); ?></h2></div><?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php
            if($customppl_lite_portfolio_cat){
                $customppl_lite_portfolio_args = array(
                    'post_type' => 'post',
                    'order' => 'DESC',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'category_name' => $customppl_lite_portfolio_cat
                );
                $customppl_lite_portfolio_query = new WP_Query($customppl_lite_portfolio_args);
                if($customppl_lite_portfolio_query->have_posts()):
                    ?>
                        <div class="portfoli-works wow fadeInUp">
                            <div id="portfolio-workd-wrap" class="owl-carousel">
                                <?php while($customppl_lite_portfolio_query->have_posts()):
                                        $customppl_lite_portfolio_query->the_post();
                                        $customppl_lite_portfolio_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'customppl-portfolio-image');
                                        $customppl_lite_portfolio_image_url = $customppl_lite_portfolio_image_src[0]; 
                                        if($customppl_lite_portfolio_image_url || get_the_title()){?>
                                                <a href="<?php the_permalink() ?>">
                                                    <div class="images-content">
                                                        <?php if($customppl_lite_portfolio_image_url){ ?><div class="image-wrap"><img src="<?php echo esc_url($customppl_lite_portfolio_image_url); ?>" /></div><?php } ?>
                                                        <?php if(get_the_title()){ ?><div class="work-title"><h3><?php the_title(); ?></h3></div><?php } ?>
                                                    </div>
                                                </a>
                                            
                                        <?php } ?>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    <?php
                endif;
            }
            ?>
        </div>
    <?php
 }