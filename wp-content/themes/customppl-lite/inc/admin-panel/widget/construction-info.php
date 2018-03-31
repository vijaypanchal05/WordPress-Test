<?php
/**
 *
 * @package customppl lite
 */
 if(!function_exists('customppl_lite_info_widget')){
add_action('widgets_init', 'customppl_lite_info_widget');

function customppl_lite_info_widget() {
    register_widget('customppl_lite_info');
}
}
if(!class_exists('customppl_lite_info')){
class customppl_lite_info extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'customppl_lite_info', __('customppl : Info', 'customppl-lite'), array(
            'description' => __('Footer Info', 'customppl-lite')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'customppl_lite_info_title' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_info_title',
                'customppl_lite_widgets_title' => __('Title', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'text',
            ),
            'customppl_lite_info_title_1' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_info_title_1',
                'customppl_lite_widgets_title' => __('Company Name', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'text',
            ),
            'customppl_lite_info_1' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_info_1',
                'customppl_lite_widgets_title' => __('Location', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'textarea',
            ),
            'customppl_lite_info_title_2' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_info_title_2',
                'customppl_lite_widgets_title' => __('Tel Text', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'text',
            ),
            'customppl_lite_info_2' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_info_2',
                'customppl_lite_widgets_title' => __('Tel Number', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'textarea',
            ),
            'customppl_lite_info_title_3' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_info_title_3',
                'customppl_lite_widgets_title' => __('Email Text', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'text',
            ),
            'customppl_lite_info_3' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_info_3',
                'customppl_lite_widgets_title' => __('Email Address', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'textarea',
            ),
            'customppl_lite_info_title_4' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_info_title_4',
                'customppl_lite_widgets_title' => __('Web Text', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'text',
            ),
            'customppl_lite_info_4' => array(
                'customppl_lite_widgets_name' => 'customppl_lite_info_4',
                'customppl_lite_widgets_title' => __('Web Address', 'customppl-lite'),
                'customppl_lite_widgets_field_type' => 'textarea',
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
        $customppl_lite_info_title = isset($instance['customppl_lite_info_title']) ? $instance['customppl_lite_info_title'] : '';
        $customppl_lite_info_title_1 = isset($instance['customppl_lite_info_title_1']) ? $instance['customppl_lite_info_title_1'] : '';
        $customppl_lite_info_1 = isset($instance['customppl_lite_info_1']) ? $instance['customppl_lite_info_1'] : '';
        $customppl_lite_info_title_2 = isset($instance['customppl_lite_info_title_2']) ? $instance['customppl_lite_info_title_2'] : '';
        $customppl_lite_info_2 = isset($instance['customppl_lite_info_2']) ? $instance['customppl_lite_info_2'] : '';
        $customppl_lite_info_title_3 = isset($instance['customppl_lite_info_title_3']) ? $instance['customppl_lite_info_title_3'] : '';
        $customppl_lite_info_3 = isset($instance['customppl_lite_info_3']) ? $instance['customppl_lite_info_3'] : '';
        $customppl_lite_info_title_4 = isset($instance['customppl_lite_info_title_4']) ? $instance['customppl_lite_info_title_4'] : '';
        $customppl_lite_info_4 = isset($instance['customppl_lite_info_4']) ? $instance['customppl_lite_info_4'] : '';
        echo wp_kses_post($before_widget);
            if($customppl_lite_info_title){ ?><h2 class="widget-title"><?php echo esc_html($customppl_lite_info_title); ?></h2><?php }
            ?>
                <div class="footer-info-widget">
                <?php if($customppl_lite_info_title_1 || $customppl_lite_info_1){ ?>
                    <div class="title-info">
                        <?php if($customppl_lite_info_title_1){ ?><span class="info-footer-title"><?php echo esc_html($customppl_lite_info_title_1); ?></span><?php } ?>
                        <?php if($customppl_lite_info_1){ ?><span class="footer-info"><?php echo wp_kses_post($customppl_lite_info_1); ?></span><?php } ?>
                    </div>
                <?php } ?>
                <?php if($customppl_lite_info_title_2 || $customppl_lite_info_2){ ?>
                    <div class="title-info">
                        <?php if($customppl_lite_info_title_2){ ?><span class="info-footer-title"><?php echo esc_html($customppl_lite_info_title_2); ?></span><?php } ?>
                        <?php if($customppl_lite_info_2){ ?><span class="footer-info"><?php echo wp_kses_post($customppl_lite_info_2); ?></span><?php } ?>
                    </div>
                <?php } ?>
                <?php if($customppl_lite_info_title_3 || $customppl_lite_info_3){ ?>
                    <div class="title-info">
                        <?php if($customppl_lite_info_title_3){ ?><span class="info-footer-title"><?php echo esc_html($customppl_lite_info_title_3); ?></span><?php } ?>
                        <?php if($customppl_lite_info_3){ ?><span class="footer-info"><?php echo wp_kses_post($customppl_lite_info_3); ?></span><?php } ?>
                    </div>
                <?php } ?>
                <?php if($customppl_lite_info_title_4 || $customppl_lite_info_4){ ?>
                    <div class="title-info">
                        <?php if($customppl_lite_info_title_4){ ?><span class="info-footer-title"><?php echo esc_html($customppl_lite_info_title_4); ?></span><?php } ?>
                        <?php if($customppl_lite_info_4){ ?><span class="footer-info"><?php echo wp_kses_post($customppl_lite_info_4); ?></span><?php } ?>
                    </div>
                <?php } ?>
                </div>
            <?php
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