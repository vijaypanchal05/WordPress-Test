<?php
/**
 * Section Client
 */
 $customppl_lite_client_cat = get_theme_mod('customppl_lite_client_cat');
 if($customppl_lite_client_cat){
  $customppl_lite_client_args = array(
        'post_type' => 'post',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'category_name' => $customppl_lite_client_cat
      );
      $customppl_lite_client_query = new WP_Query($customppl_lite_client_args);
  if($customppl_lite_client_query->have_posts()):
    ?>
    <div class="ak-container">
        <div class="client-logos">
            <div class="client-logo-wrap">
                <?php
                    while($customppl_lite_client_query->have_posts()):
                        $customppl_lite_client_query->the_post();
                        $customppl_lite_client_logo_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'customppl-client-logo');
                        $customppl_lite_client_logo_url = $customppl_lite_client_logo_src[0];
                        if($customppl_lite_client_logo_url){
                            ?>
                                <div class="client-contents wow fadeInUp">
                                    <div class="client-logo-image">
                                        <img src="<?php echo esc_url($customppl_lite_client_logo_url); ?>" alt="<?php the_title_attribute() ?>" title="<?php the_title_attribute() ?>" />
                                    </div>
                                </div>
                            <?php
                        }
                    endwhile; wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
    <?php
  endif;
 }