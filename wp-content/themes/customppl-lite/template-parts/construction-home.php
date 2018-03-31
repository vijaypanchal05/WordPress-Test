<?php
/**
 * Template Name: customppl Home
 */
 get_header();
    $customppl_lite_enable_sections = customppl_lite_enable_disable_section();
    if($customppl_lite_enable_sections){
        foreach($customppl_lite_enable_sections as $customppl_lite_enable_section){
            if( $customppl_lite_enable_section['section'] == 'shop') {
                if(class_exists('woocommerce')) { 
            ?>
                <section id="<?php echo esc_attr($customppl_lite_enable_section['id']); ?>" class="<?php echo esc_attr($customppl_lite_enable_section['section']).'_section'; ?>">
                    <?php
                        get_template_part('template-parts/section',$customppl_lite_enable_section['section']);
                    ?>                
                </section>
            <?php
                }
            } else {
            ?>
                <section id="<?php echo esc_attr($customppl_lite_enable_section['id']); ?>" class="<?php echo esc_attr($customppl_lite_enable_section['section']).'_section'; ?>">
                    <?php
                        get_template_part('template-parts/section',$customppl_lite_enable_section['section']);
                    ?>                
                </section>
            <?php
            }
        }
    }
 get_footer();