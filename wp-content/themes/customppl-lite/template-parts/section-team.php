<?php
/**
 * Team section
 */
 $customppl_lite_team_section_title = get_theme_mod('customppl_lite_team_title');
 $customppl_lite_team_section_sub_title = get_theme_mod('customppl_lite_team_sub_title');
 if($customppl_lite_team_section_title || $customppl_lite_team_section_sub_title || is_active_sidebar('customppl-lite-team-member')){
 ?>
 <div class="ak-container">
     <?php if($customppl_lite_team_section_title || $customppl_lite_team_section_sub_title){ ?>
        <div class="section-title-sub-wrap wow fadeInUp">
            <?php if($customppl_lite_team_section_title){ ?><div class="section-title"><h5><?php echo esc_html($customppl_lite_team_section_title); ?></h5></div><?php } ?>
            <?php if($customppl_lite_team_section_sub_title) { ?><div class="section-sub-title"><h2><?php echo esc_html($customppl_lite_team_section_sub_title); ?></h2></div><?php } ?>
        </div>
    <?php } ?>
    <?php if(is_active_sidebar('customppl-lite-team-member')){ ?>
            <div class="team-members-contents  clearfix">
                <?php
                    dynamic_sidebar('customppl-lite-team-member');
                ?>
            </div>
    <?php } ?>
 </div>
 <?php
 }