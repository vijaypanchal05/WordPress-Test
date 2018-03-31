<?php
/**
 * CTA Section
 */
 $customppl_lite_cta_title = get_theme_mod('customppl_lite_cta_title');
 $customppl_lite_cta_description = get_theme_mod('customppl_lite_cta_section_description');
 $customppl_lite_cta_button_text = get_theme_mod('customppl_lite_cta_button_text');
 $customppl_lite_cta_button_link = get_theme_mod('customppl_lite_cta_button_link');
 if($customppl_lite_cta_title || $customppl_lite_cta_description || $customppl_lite_cta_button_text || $customppl_lite_cta_button_link){
    ?>
        <div class="ak-container">
            <div class="cta-weap wow fadeInUp">
                <?php if($customppl_lite_cta_title){ ?><div class="title-cta"><?php echo esc_html($customppl_lite_cta_title); ?></div><?php } ?>
                <?php if($customppl_lite_cta_description){ ?><div class="desc-cta"><?php echo wp_kses_post($customppl_lite_cta_description); ?></div><?php } ?>
                <?php if($customppl_lite_cta_button_link){ ?><div class="cta-button"><a href="<?php echo esc_url($customppl_lite_cta_button_link); ?>"><?php echo esc_html($customppl_lite_cta_button_text); ?></a></div><?php } ?>
            </div>
        </div>
    <?php
 }