<?php
/**
 *
 * @package customppl
 */
 if(!function_exists('customppl_lite_team_widget')){
add_action('widgets_init', 'customppl_lite_team_widget');

function customppl_lite_team_widget() {
    register_widget('customppl_lite_team');
}
}
if(!class_exists('customppl_lite_team')){
class customppl_lite_team extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'customppl_lite_team', 'customppl : Team',
             array(
                'description' => __('Team Members', 'customppl-lite')
                )
            );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $customppl_lite_post_list = customppl_lite_posts_List();
        $fields = array(
            'customppl_lite_team_member_post' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_team_member_post',
                'customppl_lite_widgets_title' => __('Team Member Post', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'select',
                'customppl_lite_widgets_field_options' => $customppl_lite_post_list,
            ),
            'customppl_lite_team_member_designation' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_team_member_designation',
                'customppl_lite_widgets_title' => __('Member Designation', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'text',
            ),
            'customppl_lite_team_member_facebook' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_team_member_facebook',
                'customppl_lite_widgets_title' => __('Facebook Link', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'url',
            ),
            'customppl_lite_team_member_twitter' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_team_member_twitter',
                'customppl_lite_widgets_title' => __('Twitter Link', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'url',
            ),
            'customppl_lite_team_member_google' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_team_member_google',
                'customppl_lite_widgets_title' => __('Google Plus Link', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'url',
            ),
            'customppl_lite_team_member_youtube' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_team_member_youtube',
                'customppl_lite_widgets_title' => __('Youtube Link', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'url',
            ),
            'customppl_lite_team_member_instagram' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_team_member_instagram',
                'customppl_lite_widgets_title' => __('Instagram Link', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'url',
            ),
            'customppl_lite_team_member_linkedin' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_team_member_linkedin',
                'customppl_lite_widgets_title' => __('LinkedIn', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'url',
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        $customppl_lite_team_member_post = $instance['customppl_lite_team_member_post'];
        $customppl_lite_member_designatoin = $instance['customppl_lite_team_member_designation'];
        
        $customppl_lite_facebook_link = $instance['customppl_lite_team_member_facebook'];
        $customppl_lite_twitter_link = $instance['customppl_lite_team_member_twitter'];
        $customppl_lite_google_link = $instance['customppl_lite_team_member_google'];
        $customppl_lite_youtube_link = $instance['customppl_lite_team_member_youtube'];
        $customppl_lite_instagram_link = $instance['customppl_lite_team_member_instagram'];
        $customppl_lite_linkedin_link = $instance['customppl_lite_team_member_linkedin'];
        
        echo wp_kses_post($before_widget);
        if($customppl_lite_team_member_post || 
        $customppl_lite_member_designatoin || 
        $customppl_lite_google_link || 
        $customppl_lite_twitter_link || 
        $customppl_lite_facebook_link || 
        $customppl_lite_youtube_link || 
        $customppl_lite_instagram_link || 
        $customppl_lite_linkedin_link){
            
            $customppl_lite_team_posts = new WP_Query(array('post_type' => 'post', 'post__in' => array($customppl_lite_team_member_post)));
            if($customppl_lite_team_posts->have_posts()){
                while($customppl_lite_team_posts->have_posts()){
                    $customppl_lite_team_posts->the_post();
                    $customppl_lite_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'customppl-team-image');
                ?>
                    <div class="team-members wow fadeInUp">
                        <?php if($customppl_lite_image_src[0]){ ?><div class="member-image"><img src="<?php echo esc_url($customppl_lite_image_src[0]); ?>" title="<?php the_title_attribute();?>" alt="<?php the_title_attribute();?>" /></div><?php } ?>
                        <div class="team-sub-wrap">
                            <div class="member-name-designation-social">
                                <?php if(get_the_title()){ ?><div class="member-name"><h5><?php the_title(); ?></h5></div><?php } ?>
                                <?php if($customppl_lite_member_designatoin){ ?><div class="member-designation"><?php echo esc_attr($customppl_lite_member_designatoin); ?></div><?php } ?>
                                <?php if($customppl_lite_google_link || 
                                        $customppl_lite_twitter_link || 
                                        $customppl_lite_facebook_link || 
                                        $customppl_lite_youtube_link || 
                                        $customppl_lite_instagram_link || 
                                        $customppl_lite_linkedin_link){ ?>
                                            <div class="member-social-profile">
                                                <?php if($customppl_lite_facebook_link){ ?><a target="_blank" href="<?php echo esc_url($customppl_lite_facebook_link); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a><?php } ?>
                                                <?php if($customppl_lite_twitter_link){ ?><a target="_blank" href="<?php echo esc_url($customppl_lite_twitter_link); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a><?php } ?>
                                                <?php if($customppl_lite_google_link){ ?><a target="_blank" href="<?php echo esc_url($customppl_lite_google_link); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a><?php } ?>
                                                <?php if($customppl_lite_youtube_link){ ?><a target="_blank" href="<?php echo esc_url($customppl_lite_youtube_link); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a><?php } ?>
                                                <?php if($customppl_lite_instagram_link){ ?><a target="_blank" href="<?php echo esc_url($customppl_lite_instagram_link); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a><?php } ?>
                                                <?php if($customppl_lite_linkedin_link){ ?><a target="_blank" href="<?php echo esc_url($customppl_lite_linkedin_link); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a><?php } ?>
                                            </div>
                                <?php } ?>
                            </div>
                            <?php if(get_the_content()){ ?><div class="member-description"><?php echo esc_attr(wp_trim_words(get_the_content(),'20','...')); ?></div><?php } ?>
                        </div>
                    </div>
            <?php
                }
            }
        }
        
        echo wp_kses_post($after_widget);
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$customppl_lite_widgets_name] = customppl_lite_widgets_updated_field_value($widget_field, $new_instance[$customppl_lite_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	customppl_lite_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $customppl_lite_widgets_field_value = !empty($instance[$customppl_lite_widgets_name]) ? esc_attr($instance[$customppl_lite_widgets_name]) : '';
            customppl_lite_widgets_show_widget_field($this, $widget_field, $customppl_lite_widgets_field_value);
        }
    }

}
}