<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours info
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'st-qtip' );
//check is booking with modal
$st_is_booking_modal = apply_filters('st_is_booking_modal',false);

$type_tour = get_post_meta(get_the_ID(),'type_tour',true);

$max_people = get_post_meta(get_the_ID(), 'max_people', true);
$max_select = 0;
if($max_people == '' || $max_people == '0' || !is_numeric($max_people)){
    $max_select = 20;
}else{
    $max_select = $max_people;
}
//Old message position
//echo STTemplate::message();
?>
<?php 
    
    $tour_show_calendar = st()->get_option('tour_show_calendar', 'on');
    $tour_show_calendar_below = st()->get_option('tour_show_calendar_below', 'off');
    if($tour_show_calendar == 'on' && $tour_show_calendar_below == 'off'):
?>
<div class='tour_show_caledar_below_off'>
<?php echo st()->load_template('tours/elements/tour_calendar'); ?>
</div>
<?php endif; ?>
<div class="package-info-wrapper" style="width: 100%">
    <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
    <div class="row">

        <div class="col-md-6">
            <div class="package-info clearfix">
                <i class="fa fa-info"></i>
                <span class="head"><?php _e('Tour type',ST_TEXTDOMAIN) ?>: </span>
                <span><?php if($type_tour == 'daily_tour') echo __('Daily Tour', ST_TEXTDOMAIN); else echo __('Specific Date', ST_TEXTDOMAIN) ?></span>
            </div>    
            <?php if($type_tour == 'daily_tour'){ ?>
                <div class="package-info clearfix">
                    <i class="fa fa-calendar"></i>
                    <span class="head"><?php _e('Duration',ST_TEXTDOMAIN) ?>: </span>
                    <?php
                    echo STTour::get_duration_unit();                   
                    
                    ?>
                </div>
            <?php } ?>
            <div class="package-info clearfix">
                <?php $max_people = get_post_meta(get_the_ID(),'max_people', true) ?>
                <i class="fa fa-user"></i>
                <span class="head"><?php st_the_language('tour_max_people') ?>: </span>
                <?php 
                    if( !$max_people || $max_people == 0 ){
                        $max_people = __('Unlimited', ST_TEXTDOMAIN);
                    }
                    echo esc_html($max_people) 
                ?>
            </div>

            <div class="package-info clearfix">
                <i class="fa fa-location-arrow"></i>
                <span class="head"><?php st_the_language('tour_location') ?>: </span>
                <?php echo TravelHelper::locationHtml(get_the_ID()); ?>
            </div>
            <div class="package-info clearfix">
                <i class="fa fa-star"></i>
                <span class="head"><?php st_the_language('tour_rate') ?>:</span>
                <ul class="icon-group booking-item-rating-stars">
                    <?php
                    $avg = STReview::get_avg_rate();
                    echo TravelHelper::rate_to_string($avg);
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div id="cover-starttime">
                <span class="over-starttime-helper"></span>
                <img src="<?php echo get_template_directory_uri().'/img/loading-filter-ajax.gif'; ?>" />
            </div>
            <?php echo STTemplate::message(); ?>
            <div class="package-book-now-button">
                <form id="form-booking-inpage" method="post" action="" >
                    <input type="hidden" name="action" value="tours_add_to_cart" >
                    <input type="hidden" name="item_id" value="<?php echo get_the_ID()?>">
                    <input type="hidden" name="type_tour" value="<?php echo esc_html($type_tour) ?>">
                    <div class="div_book">
                        <?php $check_in = STInput::request('check_in', ''); ?>
                        <?php $check_out = STInput::request('check_out', ''); ?>
                        <?php 
                            if($tour_show_calendar == 'on'):
                        ?>
                            <div class="row ">
                                <div class="col-xs-12 col-sm-12">
                                    <strong><?php _e('Departure date',ST_TEXTDOMAIN)?>: </strong>
                                    
                                    <input placeholder ="<?php echo __("Select a day in the calendar", ST_TEXTDOMAIN) ; ?>" id="check_in" type="text" name="check_in" value="<?php echo $check_in; ?>" readonly="readonly" class="form-control">
                                </div>
                                <div class="col-xs-12 col-sm-6 mt10">
                                    <strong><?php _e('Return date',ST_TEXTDOMAIN)?>: </strong>
                                    
                                    <input id="check_out" type="text" name="check_out" value="<?php echo $check_out; ?>" readonly="readonly" class="form-control">
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-xs-12 mb5">
                                    <a href="#list_tour_item" id="select-a-tour" class="btn btn-primary"><?php echo __('Select a day', ST_TEXTDOMAIN); ?></a>
                                </div>
                                <div class="col-xs-12 mb5" style="display: none">
                                    <strong><?php _e('Departure date',ST_TEXTDOMAIN)?>: </strong>
                                    <input placeholder ="<?php echo __("Select a day in the calendar", ST_TEXTDOMAIN) ; ?>" id="check_in" type="text" name="check_in" value="<?php echo $check_in; ?>" readonly="readonly" class="form-control">
                                </div>
                                <div class="col-xs-12 mb5" style="display: none">
                                    <strong><?php _e('Return date',ST_TEXTDOMAIN)?>: </strong>
                                    <input id="check_out" type="text" name="check_out" value="<?php echo $check_out; ?>" readonly="readonly" class="form-control">
                                </div>
                            </div>
                            <div id="list_tour_item" data-type-tour="<?php echo $type_tour; ?>" style="display: none; width: 500px; height: auto;">
                                <div id="single-tour-calendar">
                                    <?php echo st()->load_template('tours/elements/tour_calendar'); ?>
                                    <style>
                                        .qtip{
                                            max-width: 250px !important;
                                        }
                                    </style>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        /**
                         * @since 2.0.0
                         * Add select starttime for tour booking
                         * Check starttime tour booking
                         * Half single layour
                         */
                        $starttime_value = STInput::request('starttime_tour', '');
                        ?>

                        <input type="hidden" data-starttime="<?php echo $starttime_value; ?>" data-checkin="<?php echo $check_in; ?>" data-checkout="<?php echo $check_out; ?>" data-tourid="<?php echo get_the_ID(); ?>" id="starttime_hidden_load_form" />
                        <div class="mt10" id="starttime_box" <?php echo $starttime_value != '' ? '' : 'style="display: none;"' ?>>
                            <strong><?php _e('Start time',ST_TEXTDOMAIN)?>: </strong>
                            <select class="form-control st_tour_starttime" name="starttime_tour" id="starttime_tour"></select>
                        </div>


                            <div class="row mt10">
                                <?php if(get_post_meta(get_the_ID(),'hide_adult_in_booking_form',true) != 'on'): ?>
                                <div class="col-xs-12 col-sm-4">
                                    <strong><?php _e('Adults',ST_TEXTDOMAIN)?>: </strong>
                                    <select class="form-control st_tour_adult" name="adult_number" required>
                                        <?php for($i = 0; $i <= $max_select; $i++){
                                            $is_select = '';
                                            if(STInput::request('adult_number') == $i){
                                                $is_select = 'selected="selected"';
                                            }
                                            echo  "<option {$is_select} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <?php endif ?>
                                <?php if(get_post_meta(get_the_ID(),'hide_children_in_booking_form',true) != 'on'): ?>
                                <div class="col-xs-12 col-sm-4">
                                    <strong><?php _e('Children',ST_TEXTDOMAIN)?>: </strong>
                                    <select class="form-control st_tour_children" name="child_number" required>
                                        <?php for($i = 0; $i <= $max_select; $i++){
                                            $is_select = '';
                                            if(STInput::request('child_number') == $i){
                                                $is_select = 'selected="selected"';
                                            }
                                            echo  "<option {$is_select} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <?php endif ?>
                                <?php if(get_post_meta(get_the_ID(),'hide_infant_in_booking_form',true) != 'on'): ?>
                                <div class="col-xs-12 col-sm-4">
                                    <strong><?php _e('Infant',ST_TEXTDOMAIN)?>: </strong>
                                    <select class="form-control st_tour_infant" name="infant_number" required>
                                        <?php for($i = 0; $i <= $max_select; $i++){
                                            $is_select = '';
                                            if(STInput::request('infant_number') == $i){
                                                $is_select = 'selected="selected"';
                                            }
                                            echo  "<option {$is_select} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <?php endif ?>
                            </div>
                            <?php  $extra_price = get_post_meta(get_the_ID(), 'extra_price', true); ?>
                            <?php if(is_array($extra_price) && count($extra_price)): ?>
                                <?php $extra = STInput::request("extra_price");
                                if(!empty($extra['value'])){
                                    $extra_value = $extra['value'];
                                }
                                ?>
                                <label><?php echo __('Extra', ST_TEXTDOMAIN); ?></label>
                                <table class="table">
                                    <?php foreach($extra_price as $key => $val): ?>
                                        <tr>
                                            <td width="80%">
                                                <label for="field-<?php echo $val['extra_name']; ?>" class="ml20 mt5"><?php echo $val['title'].' ('.TravelHelper::format_money($val['extra_price']).')'; ?></label>
                                                <input type="hidden" name="extra_price[price][<?php echo $val['extra_name']; ?>]" value="<?php echo $val['extra_price']; ?>">
                                                <input type="hidden" name="extra_price[title][<?php echo $val['extra_name']; ?>]" value="<?php echo $val['title']; ?>">
                                            </td>
                                            <td width="20%">
                                                <select  style="width: 100px" class="form-control app" name="extra_price[value][<?php echo $val['extra_name']; ?>]" id="field-<?php echo $val['extra_name']; ?>">
                                                    <?php
                                                    $max_item = intval($val['extra_max_number']);
                                                    if($max_item <= 0) $max_item = 1;
                                                    for($i = 0; $i <= $max_item; $i++):
                                                        $check = "";
                                                        if(!empty($extra_value[$val['extra_name']]) and $i == $extra_value[$val['extra_name']]){
                                                            $check = "selected";
                                                        }
                                                        ?>
                                                        <option <?php echo esc_html($check) ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            <?php endif; ?>
                            <input type="hidden" name="adult_price" id="adult_price">
                            <input type="hidden" name="child_price" id="child_price">
                            <input type="hidden" name="infant_price" id="infant_price">
						<div class="message_box mt10"></div>
                        <div class="div_btn_book_tour">
                            <?php if($st_is_booking_modal){ 
                                
                            ?>
                                <a data-target="#tour_booking_<?php the_ID() ?>" class="btn btn-primary btn-st-add-cart" data-effect="mfp-zoom-out" ><?php st_the_language('book_now') ?> <i class="fa fa-spinner fa-spin"></i></a>
                            <?php }else{ ?>
                            <?php echo STTour::tour_external_booking_submit();?>                                
                            <?php } ?>
                            <?php echo st()->load_template('user/html/html_add_wishlist',null,array("title"=>'','class'=>'')) ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
    if($tour_show_calendar == 'on' && $tour_show_calendar_below == 'on'):
?>
<div class='tour_show_caledar_below_on'>
<?php echo st()->load_template('tours/elements/tour_calendar'); ?>
</div>
<?php endif; ?>
<?php
if($st_is_booking_modal){?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="tour_booking_<?php echo get_the_ID()?>">
        <?php echo st()->load_template('tours/modal_booking');?>
    </div>

<?php }?>