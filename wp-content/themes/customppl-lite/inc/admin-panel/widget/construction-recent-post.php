<?php
/**
 *
 * @package customppl lite
 */
 if(!function_exists('customppl_lite_recent_post_widget')){
add_action('widgets_init', 'customppl_lite_recent_post_widget');

function customppl_lite_recent_post_widget() {
    register_widget('customppl_lite_recent_post');
}
}
if(!class_exists('customppl_lite_recent_post')){
class customppl_lite_recent_post extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'customppl_lite_recent_post', __('customppl : Recent Post', 'customppl-lite'), array(
            'description' => __('Recent Posts', 'customppl-lite')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $customppl_lite_cat_list = customppl_lite_category_list();
        $fields = array(
            'customppl_lite_recent_post_title' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_recent_post_title',
                'customppl_lite_widgets_title' => __('Title', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'text',
            ),
            'customppl_lite_recent_post_cat' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_recent_post_cat',
                'customppl_lite_widgets_title' => __('Recent Post Category', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'select',
                'customppl_lite_widgets_field_options' => $customppl_lite_cat_list,
            ),
            'customppl_lite_recent_post_per_page' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_recent_post_per_page',
                'customppl_lite_widgets_title' => __('Posts Per Page', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'number',
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
        $customppl_lite_recent_post_title = isset($instance['customppl_lite_recent_post_title']) ? $instance['customppl_lite_recent_post_title'] : '';
        $customppl_lite_recent_post_cat = isset($instance['customppl_lite_recent_post_cat']) ? $instance['customppl_lite_recent_post_cat'] : '';
        $customppl_lite_recent_post_per_page = isset($instance['customppl_lite_recent_post_per_page']) ? $instance['customppl_lite_recent_post_per_page'] : '-1';
        echo wp_kses_post($before_widget);
            if($customppl_lite_recent_post_title || $customppl_lite_recent_post_cat){
                if($customppl_lite_recent_post_title){
                    ?>
                        <h2 class="widget-title"><?php echo esc_html($customppl_lite_recent_post_title); ?></h2>
                    <?php
                }
                $customppl_lite_recent_post_args = array(
                        'post_type' => 'post',
                        'order' => 'DESC',
                        'posts_per_page' => $customppl_lite_recent_post_per_page,
                        'post_status' => 'publish',
                        'category_name' => $customppl_lite_recent_post_cat
                    );
                $customppl_lite_recent_post_query = new WP_Query($customppl_lite_recent_post_args);
                if($customppl_lite_recent_post_query->have_posts()):
                    ?>
                    <div class="recent-post-widget">
                        <?php
                        while($customppl_lite_recent_post_query->have_posts()):
                            $customppl_lite_recent_post_query->the_post();
                            $customppl_lite_recent_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'customppl-recent-post-image');
                            $customppl_lite_recent_post_image_url = $customppl_lite_recent_post_image[0];
                            if($customppl_lite_recent_post_image_url || get_the_title()){
                                ?>
                                    <div class="recent-posts-content clearfix">
                                        <?php if($customppl_lite_recent_post_image_url){ ?><div class="image-recent-post"><img src="<?php echo esc_url($customppl_lite_recent_post_image_url) ?>" alt="<?php the_title_attribute() ?>" title="<?php the_title_attribute() ?>" /></div><?php } ?>
                                        <div class="date-title-recent-post">
                                            <?php if(get_the_title()){ ?><span class="recent-post-title"><a href="<?php the_permalink(); ?>"><?php echo esc_attr(wp_trim_words(get_the_title(),'5','...')); ?></a></span><?php } ?>
                                            <span class="recent-post-date"><?php echo esc_attr(get_the_date('d,F,Y')); ?></span>
                                        </div>
                                    </div>
                                <?php
                            }
                        endwhile;
                        //wp_reset_postdata();
                        ?>
                    </div>
                    <?php
                endif;
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