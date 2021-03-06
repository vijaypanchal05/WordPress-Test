<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User create room
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'bootstrap-datepicker.js' ); 
wp_enqueue_script( 'bootstrap-datepicker-lang.js' ); 
wp_enqueue_script('st_post_select_ajax');
wp_enqueue_style('st_post_select_ajax');
wp_enqueue_script( 'user_upload.js' );

/*if( STUser_f::st_check_edit_partner(STInput::request('id')) == false ){
    return false;
}*/
$post_id = STInput::request('id');
$title = $content = $excerpt = "";
if(!empty($post_id)){
    $post = get_post( $post_id );
    $title = $post->post_title;
    $content = $post->post_content;
    $excerpt = $post->post_excerpt;
}

if(empty($post_id)){

    //=== Validate package
    $admin_packages = STAdminPackages::get_inst();
    $author = get_current_user_id();
    $count_item_publish = $admin_packages->count_item_can_public($author);
    if($admin_packages->enabled_membership() && $admin_packages->get_user_role() == 'partner'){
        if( $count_item_publish !== 'unlimited' && $count_item_publish<= 0){
            $user_link = get_permalink( );
            echo '<div class="alert alert-warning mt20">'. __('You can not create a new item. Your items can be created is ', ST_TEXTDOMAIN). $admin_packages->count_item_package($author) .'. '.'<a href="'.TravelHelper::get_user_dashboared_link($user_link, 'setting').'" target="_blank">'.__('More Details', ST_TEXTDOMAIN).'</a>'.'</div>';
            return false;
        }
    }

}

?>
<?php $validator= STUser_f::$validator; ?>
<div class="st-create">
    <h2 class="pull-left">
        <?php if(!empty($post_id)){?>
            <?php _e("Edit Hotel Room",ST_TEXTDOMAIN) ?>
        <?php }else{ ?>
            <?php _e("Add Hotel Room",ST_TEXTDOMAIN) ?>
        <?php } ?>
    </h2>
    <?php if(!empty($post_id)){  ?>
        <a target="_blank" href="<?php echo get_the_permalink($post_id) ?>" class="btn btn-default pull-right"><?php _e("Preview",ST_TEXTDOMAIN) ?></a>
    <?php }else{ ?>
        <span class="btn btn-default pull-right btn_save_and_preview"><?php _e("Save & Preview",ST_TEXTDOMAIN) ?></span>
    <?php } ?>
</div>
<div class="msg">
    <?php echo STTemplate::message() ?>
    <?php echo STUser_f::get_msg(); ?>
    <?php echo STUser_f::get_control_data(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data" id="st_form_add_partner">
    <?php wp_nonce_field('user_setting','st_update_room'); ?>

    <div class="form-group form-group-icon-left">
        
        <label for="title" class="head_bol"><?php echo __('Title', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">*</span>:</label>
        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
        <input id="title" name="st_title" type="text" placeholder="<?php st_the_language('user_create_room_title') ?>" class="form-control" value="<?php echo stripslashes(STInput::request("st_title",$title)) ?>">
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_title'),'danger') ?></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label for="st_content" class="head_bol"><?php  st_the_language('user_create_room_content') ?> <span class="text-small text-danger">*</span>:</label>
        <?php wp_editor( stripslashes(STInput::request("st_content",$content)) ,'st_content'); ?>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_content'),'danger') ?></div>
    </div>
    <div class="form-group">
        <label for="desc" class="head_bol"><?php _e("Room description",ST_TEXTDOMAIN) ?> <span class="text-small text-danger">*</span>:</label>
        <textarea id="desc" rows="6" name="st_desc" class="form-control"><?php echo stripslashes(STInput::request("st_desc",$excerpt)) ?></textarea>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_desc'),'danger') ?></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label class="head_bol"><?php _e("Featured image",ST_TEXTDOMAIN) ?> <span class="text-small text-danger">*</span>:</label>
        <div class="upload-wrapper upload-partner-wrapper">
            <button class="upload-button-partner btn btn-primary btn-sm" data-uploader_title="<?php _e('Select a image to upload', ST_TEXTDOMAIN); ?>" data-uploader_button_text="<?php _e('Use this image', ST_TEXTDOMAIN); ?>"><?php echo __('Upload', ST_TEXTDOMAIN); ?></button>
            <div class="upload-items">
                <?php 
                    $thumbnail = STInput::request('id_featured_image', get_post_thumbnail_id( $post_id ));
                    $thumbnail_url = wp_get_attachment_url( $thumbnail );
                    if( !empty( $thumbnail_url ) ):
                ?>
                <div class="upload-item">
                    <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo TravelHelper::get_alt_image(); ?>" class="frontend-image img-responsive">
                    <a href="javascript: void(0);" class="delete">&times;</a>
                </div>
                <?php endif; ?>
            </div>
            <input type="hidden" class="save-image-id" name="id_featured_image" value="<?php echo $thumbnail; ?>">
        </div>
        <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('featured_image'),'danger') ?></div>
    </div>
    <div class="tabbable tabs_partner">
        <ul class="nav nav-tabs" id="">
            <li class="active"><a href="#tab-location-setting" data-toggle="tab"><?php _e("Location Settings",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-general" data-toggle="tab"><?php _e("General",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-room-price" data-toggle="tab"><?php _e("Room Price",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-room-facility" data-toggle="tab"><?php _e("Room Facility",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-other-facility" data-toggle="tab"><?php _e("Other Facility",ST_TEXTDOMAIN) ?></a></li>
			<li><a href="#tab-cancel-booking" data-toggle="tab"><?php _e('Cancel Booking',ST_TEXTDOMAIN) ?></a></li>
            <?php $st_is_woocommerce_checkout=apply_filters('st_is_woocommerce_checkout',false);
            if(!$st_is_woocommerce_checkout):?>
                <li><a href="#tab-payment" data-toggle="tab"><?php _e("Payment Settings",ST_TEXTDOMAIN) ?></a></li>
            <?php endif ?>
            <?php if(!empty($post_id)){ ?>
            <li><a href="#availablility_tab" data-toggle="tab"><?php _e("Availability",ST_TEXTDOMAIN) ?></a></li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-location-setting">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="multi_location"><?php _e('Location', ST_TEXTDOMAIN); ?>:</label>

                            <div id="setting_multi_location" class="location-front">
                                <?php
                                $html_location = TravelHelper::treeLocationHtml();
                                $post_id = STInput::request('id','');

                                $multi_location = get_post_meta( $post_id, 'multi_location', true );
                                if( !empty( $multi_location ) && !is_array( $multi_location ) ){
                                    $multi_location = explode(',', $multi_location);
                                }
                                if( empty( $multi_location ) ){
                                    $multi_location = array('');
                                }
                                ?>
                                <div class="form-group st-select-loction">
                                    <input placeholder="<?php echo __('Type to search', ST_TEXTDOMAIN); ?>" type="text" class="widefat form-control" name="search" value="">
                                    <div class="list-location-wrapper">
                                        <?php
                                        if(is_array($html_location) && count($html_location)):
                                            foreach($html_location as $key => $location):
                                                ?>
                                                <div data-name="<?php echo $location['parent_name']; ?>" class="item" style="margin-left: <?php echo $location['level'].'px;'; ?> margin-bottom: 5px;">
                                                    <label for="<?php echo 'location-'.$location['ID']; ?>">
                                                        <input <?php if(in_array('_'.$location['ID'].'_', $multi_location)) echo 'checked'; ?>  id="<?php echo 'location-'.$location['ID']; ?>" type="checkbox" name="multi_location[]" value="<?php echo '_'.$location['ID'].'_'; ?>">
                                                        <span><?php echo $location['post_title']; ?></span>
                                                    </label>
                                                </div>
                                            <?php  endforeach; endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('multi_location'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-12 partner_map">
                        <div class="form-group form-group-icon-left">

                            <label for="address"><?php _e('Real room address', ST_TEXTDOMAIN); ?>:</label>
                            <i class="fa fa-home input-icon input-icon-hightlight"></i>
                            <input id="address" name="address" type="text"
                                   placeholder="<?php st_the_language( 'user_create_car_address' ) ?>" class="form-control" value="<?php echo STInput::request("address",get_post_meta( $post_id , 'address' , true)); ?>">

                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('address'),'danger') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-general">
                <div class="row">
                    <?php
                    $taxonomies = (get_object_taxonomies('hotel_room'));
                    if (is_array($taxonomies) and !empty($taxonomies)){
                        foreach ($taxonomies as $key => $value) {
                            ?>
                            <div class="col-md-12">
                                <?php
                                $category = STUser_f::get_list_taxonomy($value);
                                $taxonomy_tmp = get_taxonomy( $value );
                                $taxonomy_label =  ($taxonomy_tmp->label );
                                $taxonomy_name =  ($taxonomy_tmp->name );
                                if(!empty($category)):
                                    ?>
                                    <div class="form-group form-group-icon-left">
                                        <label for="check_all"> <?php echo esc_html($taxonomy_label); ?>:</label>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="checkbox-inline checkbox-stroke">
                                                    <label for="check_all">
                                                        <i class="fa fa-cogs"></i>
                                                        <input name="check_all" class="i-check check_all" type="checkbox"  /><?php _e("All",ST_TEXTDOMAIN) ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php foreach($category as $k=>$v):
                                                $icon = get_tax_meta($k,'st_icon');
                                                $icon = TravelHelper::handle_icon($icon);
                                                $check = '';
                                                if(STUser_f::st_check_post_term_partner( $post_id  ,$value , $k) == true ){
                                                    $check = 'checked';
                                                }
                                                ?>
                                                <div class="col-md-3">
                                                    <div class="checkbox-inline checkbox-stroke">
                                                        <label for="taxonomy">
                                                            <i class="<?php echo esc_html($icon) ?>"></i>
                                                            <input name="taxonomy[]" class="i-check item_tanoxomy" type="checkbox" <?php echo esc_html($check) ?> value="<?php echo esc_attr($k.','.$taxonomy_name) ?>" /><?php echo esc_html($v) ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                        <?php
                        }
                    } else { ?>
                        <input name="no_taxonomy" type="hidden" value="no_taxonomy">
                    <?php } ?>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            <label for="room_parent"><?php _e('Select the hotel own this room', ST_TEXTDOMAIN); ?></label>
                            <?php $room_parent = STInput::request('room_parent',get_post_meta($post_id , 'room_parent' ,true)); ?>
                            <input type="text" name="room_parent" placeholder="<?php _e('Select the hotel own this room', ST_TEXTDOMAIN); ?>" data-pl-name="<?php echo get_the_title($room_parent) ?>" data-pl-desc="" value="<?php echo esc_html($room_parent) ?>" id="room_parent" class="st_post_select_ajax" data-author="<?php echo esc_attr($data->ID)?>" data-post-type="st_hotel" style="width: 100%">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('room_parent'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="number_room"><?php _e('Number of this room', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">*</span></label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="number_room" name="number_room" placeholder="<?php _e('Number of this room', ST_TEXTDOMAIN); ?>" type="text" min="1" value="<?php echo STInput::request('number_room',get_post_meta( $post_id , 'number_room' , true)); ?>"  class="form-control number" >
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('number_room'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class='form-group form-group-icon-left'>
                            
                            <label for="st_custom_layout"><?php _e( "Room single layout" , ST_TEXTDOMAIN ) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $layout = st_get_layout('hotel_room');
                            if(!empty($layout) and is_array($layout)):
                                ?>
                                <select class='form-control' name='st_custom_layout' id="st_custom_layout">
                                    <?php
                                    $st_custom_layout = STInput::request('st_custom_layout',get_post_meta($post_id , 'st_custom_layout' , true));
                                    foreach($layout as $k=>$v):
                                        if($st_custom_layout == $v['value']) $check = "selected"; else $check = '';
                                        echo '<option '.$check.' value='.$v['value'].'>'.$v['label'].'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="id_gallery"><?php _e( "Room gallery" , ST_TEXTDOMAIN ) ?> <span class="text-small text-danger">*</span>:</label>
                            <div class="upload-wrapper upload-mul-partner-wrapper">
                            <?php 
                                $gallery = STInput::request('id_gallery', get_post_meta( $post_id, 'gallery', true ));
                                $gallery_arr = explode( ',', $gallery);
                                $gallery_arr = array_filter($gallery_arr, function($value){ return $value != '';});
                            ?>
                                <div class="clearfix">
                                    <button class="mr5 upload-button-partner-multi btn btn-primary btn-sm" data-uploader_title="<?php _e('Select a image to upload', ST_TEXTDOMAIN); ?>" data-uploader_button_text="<?php _e('Use this image', ST_TEXTDOMAIN); ?>"><?php echo __('Upload', ST_TEXTDOMAIN); ?></button>
                                    <?php 
                                    if( !empty( $gallery_arr)):
                                    ?>
                                        <button class=" btn btn-primary btn-sm delete-gallery"><?php echo __('Delete', ST_TEXTDOMAIN); ?></button>
                                    <?php endif; ?>
                                </div>
                                <div class="upload-items">
                                    <?php 
                                        
                                        if( !empty( $gallery_arr ) ):
                                            foreach( $gallery_arr as $image):
                                                $gallery_url = wp_get_attachment_url( $image );
                                    ?>
                                    <div class="upload-item">
                                        <img src="<?php echo $gallery_url; ?>" alt="<?php echo TravelHelper::get_alt_image(); ?>" class="frontend-image img-responsive">
                                    </div>
                                    <?php endforeach; endif; ?>
                                </div>
                                <input type="hidden" class="save-image-id" name="id_gallery" value="<?php echo $gallery; ?>">
                            </div>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('gallery'),'danger') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-room-price">
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group">
                            <label for=""><?php echo __('Allow customer can booking full day', ST_TEXTDOMAIN); ?></label>
                            <?php $is_auto_caculate = STInput::request('allow_full_day',get_post_meta($post_id  ,'allow_full_day' ,true)); ?>
                            <select name="allow_full_day" id="allow_full_day" class="form-control">
                                <option <?php if($is_auto_caculate == "on") echo "selected"?> value="on"><?php echo __('On', ST_TEXTDOMAIN); ?></option>
                                <option <?php if($is_auto_caculate == "off") echo "selected"?> value="off"><?php echo __('Off', ST_TEXTDOMAIN); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="price"><?php _e("Pricing",ST_TEXTDOMAIN) ?> <span class="text-small text-danger">*</span>:</label>
                            <i class="fa fa-money input-icon input-icon-hightlight"></i>
                            <input id="price" name="price" type="text" placeholder="<?php _e('Pricing', ST_TEXTDOMAIN); ?>" class="form-control number" value="<?php echo STInput::request('price',get_post_meta($post_id , 'price' , true )) ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('price'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="discount_rate"><?php _e("Discount rating",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="discount_rate" name="discount_rate" type="text" placeholder="<?php _e("Discount rating",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('discount_rate',get_post_meta($post_id , 'discount_rate' , true )) ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('discount_rate'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            <label for="deposit_payment_status"><?php _e("Deposit options",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $deposit_payment_status = STInput::request('deposit_payment_status',get_post_meta($post_id ,'deposit_payment_status',true)) ?>
                            <select class="form-control deposit_payment_status" name="deposit_payment_status" id="deposit_payment_status">
                                <option value=""><?php _e("Disallow Deposit",ST_TEXTDOMAIN) ?></option>
                                <option value="percent" <?php if($deposit_payment_status == 'percent') echo 'selected' ?>><?php _e("Deposit by percent",ST_TEXTDOMAIN) ?></option>
                                <!--<option value="amount" <?php /*if($deposit_payment_status == 'amount') echo 'selected' */?>><?php /*_e("Deposit by amount",ST_TEXTDOMAIN) */?></option>-->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 data_deposit_payment_status">
                        <div class="form-group form-group-icon-left">
                            <label for="deposit_payment_amount"><?php _e("Deposit Payment Amount",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs  input-icon input-icon-hightlight"></i>
                            <input id="deposit_payment_amount" name="deposit_payment_amount" type="text" placeholder="<?php _e("Deposit amount",ST_TEXTDOMAIN) ?>" class="form-control number" value="<?php echo STInput::request('deposit_payment_amount',get_post_meta($post_id ,'deposit_payment_amount',true)) ?>">
                            <?php $partner_commission = st()->get_option('partner_commission','0'); ?>
                            <i><?php echo sprintf(esc_html__("The deposit amount must be greater than %s the commission",ST_TEXTDOMAIN),$partner_commission."%") ?></i>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('deposit_payment_amount'),'danger') ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="extra"><?php _e("Extra pricing",ST_TEXTDOMAIN) ?>:</label>
                        </div>
                    </div>
                    <div class="content_extra_price col-md-6">
                        <div class="list-properties">
                        <?php if(!empty($post_id)){ ?>
                            <?php
                            $extra = get_post_meta($post_id, 'extra_price', true);
                            if(is_array($extra) && count($extra)):
                                foreach($extra as $key => $val):
                                    ?>
                                    <div class="property-item tab-item">
                                        <a href="javascript: void(0);" class="delete-tab-item btn btn-danger">x</a>
                                        <div class="tab-title"><?php echo esc_html($val['title']); ?></div>
                                        <div class="tab-content">
                                            <div class="row">
                                                <div class="col-xs-12 mb10">
                                                    <div class="form-group">
                                                        <label for="policy_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
                                                        <input id="" name="extra[title][]" type="text" class="tab-content-title form-control" value="<?php echo esc_html($val['title']); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group form-group-icon-left">

                                                        <label for="extra_name"><?php _e("Name",ST_TEXTDOMAIN) ?></label>
                                                        <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                                                        <input value="<?php echo esc_html($val['extra_name']); ?>" id="extra_name" name="extra[extra_name][]" type="text" placeholder="<?php _e("Name",ST_TEXTDOMAIN) ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group form-group-icon-left">

                                                        <label for="extra_max_number"><?php _e("Max Of Number",ST_TEXTDOMAIN) ?></label>
                                                        <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                                                        <input value="<?php echo esc_html($val['extra_max_number']); ?>" id="extra_max_number"  name="extra[extra_max_number][]" type="text" placeholder="<?php _e("Max of number",ST_TEXTDOMAIN) ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group form-group-icon-left">

                                                        <label for="extra_price"><?php _e("Price",ST_TEXTDOMAIN) ?></label>
                                                        <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                                                        <input value="<?php echo esc_html($val['extra_price']); ?>" id="extra_price"  name="extra[extra_price][]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; endif; ?>
                        <?php }else{ ?>
                            <?php
                            $extra = isset($_POST['extra']) ? $_POST['extra'] : '';
                            if(isset($extra['title']) && count($extra['title'])):
                                foreach($extra['title'] as $key => $val):
                                    ?>
                                    <div class="property-item tab-item">
                                        <a href="javascript: void(0);" class="delete-tab-item btn btn-danger">x</a>
                                        <div class="tab-title"><?php echo esc_html($val); ?></div>
                                        <div class="tab-content">
                                            <div class="row">
                                                <div class="col-xs-12 mb10">
                                                    <div class="form-group">
                                                        <label for="policy_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
                                                        <input id="" name="extra[title][]" type="text" class="tab-content-title form-control" value="<?php echo esc_html($val); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group form-group-icon-left">
                                                        <label for="extra_name"><?php _e("Name",ST_TEXTDOMAIN) ?></label>
                                                        <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                                                        <input value="<?php echo esc_html($extra['extra_name'][$key]); ?>" id="extra_name" data-date-format="yyyy-mm-dd" name="extra[extra_name][]" type="text" placeholder="<?php _e("Name",ST_TEXTDOMAIN) ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group form-group-icon-left">
                                                        <label for="extra_max_number"><?php _e("Max Of Number",ST_TEXTDOMAIN) ?></label>
                                                        <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                                                        <input value="<?php echo esc_html($extra['extra_max_number'][$key]); ?>" id="extra_max_number" data-date-format="yyyy-mm-dd" name="extra[extra_max_number][]" type="text" placeholder="<?php _e("Max of number",ST_TEXTDOMAIN) ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group form-group-icon-left">
                                                        <label for="extra_price"><?php _e("Price",ST_TEXTDOMAIN) ?></label>
                                                        <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                                                        <input value="<?php echo esc_html($extra['extra_price'][$key]); ?>" id="extra_price" data-date-format="yyyy-mm-dd" name="extra[extra_price][]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; endif; ?>
                        <?php } ?>
                        </div>
                        <a href="javascript:void(0);" class="btn btn-primary add-list-item mt10" data-get-html="#list-item-extraprice">+</a>
                    </div>
                    <div class="col-md-12 div_btn_add_custom">
                        <div class="form-group form-group-icon-left">
                            <button id="btn_add_extra_price" class="btn btn-info" type="button"><?php _e("Add Extra",ST_TEXTDOMAIN) ?></button>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-room-facility">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="adult_number"><?php st_the_language('user_create_room_adults_number') ?> <span class="text-small text-danger">*</span>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="adult_number" name="adult_number" type="text" min="1" value="<?php echo STInput::request('adult_number',get_post_meta( $post_id , 'adult_number' , true)); ?>"  class="form-control number">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('adult_number'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="children_number"><?php st_the_language('user_create_room_children_number') ?> <span class="text-small text-danger">*</span>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="children_number" name="children_number" type="text" min="1" value="<?php echo STInput::request('children_number',get_post_meta( $post_id , 'children_number' , true)); ?>"  class="form-control number">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('children_number'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="bed_number"><?php st_the_language('user_create_room_beds_number') ?> <span class="text-small text-danger">*</span>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="bed_number" name="bed_number" type="text" min="1" class="form-control number" value="<?php echo STInput::request('bed_number',get_post_meta( $post_id , 'bed_number' , true)); ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('bed_number'),'danger') ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="room_footage"><?php _e("Room Footage (square feet)",ST_TEXTDOMAIN)?> <span class="text-small text-danger">*</span>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <input id="room_footage" name="room_footage" type="text"  placeholder="<?php st_the_language('user_create_room_room_footage')?>" class="form-control number" value="<?php echo STInput::request('room_footage',get_post_meta( $post_id , 'room_footage' , true)); ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('room_footage'),'danger') ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            
                            <label for="st_room_external_booking"><?php _e("External Booking",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                            <?php $st_room_external_booking = STInput::request('st_room_external_booking',get_post_meta($post_id , 'st_room_external_booking' , true)) ?>
                            <select class="form-control st_room_external_booking" name="st_room_external_booking" id="st_room_external_booking">
                                <option value="off" <?php if($st_room_external_booking == 'off') echo 'selected'; ?> ><?php _e("No",ST_TEXTDOMAIN) ?></option>
                                <option value="on" <?php if($st_room_external_booking == 'on') echo 'selected'; ?> ><?php _e("Yes",ST_TEXTDOMAIN) ?></option>
                            </select>
                        </div>
                    </div>
                    <div class='col-md-6 data_st_room_external_booking'>
                        <div class="form-group form-group-icon-left">
                            
                            <label for="st_room_external_booking_link"><?php _e("External booking URL",ST_TEXTDOMAIN) ?>:</label>
                            <i class="fa fa-link  input-icon input-icon-hightlight"></i>
                            <input id="st_room_external_booking_link" name="st_room_external_booking_link" type="text" placeholder="<?php _e("Eg: https://domain.com") ?>" class="form-control" value="<?php echo STInput::request('st_room_external_booking_link',get_post_meta( $post_id , 'st_room_external_booking_link' , true)); ?>">
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_room_external_booking_link'),'danger') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-other-facility">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label for="add_Ffacility"><?php _e("Add a Facility",ST_TEXTDOMAIN) ?>:</label>
                        </div>
                    </div>
                    <div class="content_data_add_new_facility col-xs-12 col-md-6">
                        <div class="list-properties">
                        <?php if(!empty($post_id)){ ?>
                            <?php $add_new_facility = get_post_meta($post_id,'add_new_facility',true);
                            if(!empty($add_new_facility) and is_array($add_new_facility)):
                                foreach($add_new_facility as $k=>$v){
                                    ?>
                                    <div class="property-item tab-item">
                                        <a href="javascript: void(0);" class="delete-tab-item btn btn-danger">x</a>
                                        <div class="tab-title"><?php echo esc_html($v['title']) ?></div>
                                        <div class="tab-content">
                                            <div class="row">
                                                <div class="col-xs-12 mb10">
                                                    <div class="form-group">
                                                        <label for="policy_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
                                                        <input id="" name="add_new_facility_title[]" type="text" class="tab-content-title form-control" value="<?php echo esc_html($v['title']) ?>">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 mb10">
                                                    <label for="add_new_facility_value"><?php _e( "Value" , ST_TEXTDOMAIN ) ?></label>
                                                    <input type="text" name="add_new_facility_value[]" placeholder="<?php _e( "Value" , ST_TEXTDOMAIN ) ?>" class="form-control" value="<?php echo esc_html($v['facility_value']) ?>">
                                                </div>
                                                <div class="col-xs-12 mb10">
                                                    <label for="add_new_facility_icon"><?php _e( "Icon" , ST_TEXTDOMAIN ) ?></label>
                                                    <input type="text" name="add_new_facility_icon[]" class="form-control st_icon_picker" value="<?php if(!empty($v['facility_icon'])) echo esc_html($v['facility_icon']) ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            endif; ?>
                        <?php }else{ ?>
                            <?php
                            $add_new_facility_title = STInput::request('add_new_facility_title');
                            $add_new_facility_value = STInput::request('add_new_facility_value');
                            $add_new_facility_icon = STInput::request('add_new_facility_icon');
                            if(!empty($add_new_facility_title)){
                                foreach($add_new_facility_title as $k=>$v){
                                    if(!empty($v) and !empty($add_new_facility_value[ $k ])) {
                                        ?>
                                        <div class="property-item tab-item">
                                            <a href="javascript: void(0);" class="delete-tab-item btn btn-danger">x</a>
                                            <div class="tab-title"><?php echo esc_attr($v) ?></div>
                                            <div class="tab-content">
                                                <div class="row">
                                                    <div class="col-xs-12 mb10">
                                                        <div class="form-group">
                                                            <label for="policy_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
                                                            <input id="" name="add_new_facility_title[]" type="text" class="tab-content-title form-control" value="<?php echo esc_attr($v) ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 mb10">
                                                        <label for="add_new_facility_value"><?php _e( "Value" , ST_TEXTDOMAIN ) ?></label>
                                                        <input type="text" name="add_new_facility_value[]" class="form-control" placeholder="<?php _e( "Value" , ST_TEXTDOMAIN ) ?>" value="<?php echo esc_attr($add_new_facility_value[$k]) ?>">
                                                    </div>
                                                    <div class="col-xs-12 mb10">
                                                        <label for="add_new_facility_icon"><?php _e( "Icon" , ST_TEXTDOMAIN ) ?></label>
                                                        <input type="text" id="" name="add_new_facility_icon[]" placeholder="<?php _e("(eg: fa-facebook)",ST_TEXTDOMAIN) ?>" class="form-control st_icon_picker" value="<?php echo esc_attr($add_new_facility_icon[$k]) ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        <?php } ?>
                        </div>
                         <a href="javascript:void(0);" class="btn btn-primary add-list-item mt10" data-get-html="#list-item-facility">+</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="room_description"><?php _e("Description",ST_TEXTDOMAIN) ?>:</label>
                            <textarea id="room_description" rows="6" name="room_description" class="form-control"><?php echo STInput::request('room_description',get_post_meta( $post_id , 'room_description' , true)); ?></textarea>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('room_description'),'danger') ?></div>
                        </div>
                    </div>
                </div>
            </div>
			<?php echo st()->load_template('user/tabs/cancel-booking',FALSE,array('validator'=>$validator)) ?>
            <div class="tab-pane fade" id="tab-payment">
                <?php
                $data_paypment = STPaymentGateways::get_payment_gateways();
                if (!empty($data_paypment) and is_array($data_paypment)) {
                    foreach( $data_paypment as $k => $v ) {
                        $is_enable  = (st()->get_option('pm_gway_'.$k.'_enable'));
                        if ($is_enable =='off') {}else   {
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-icon-left">
                                        <label for="is_meta_payment_gateway_<?php echo esc_attr($k) ?>"><?php echo esc_html($v->get_name()) ?>:</label>
                                        <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                                        <?php $is_pay = STInput::request('is_meta_payment_gateway_'.$k,get_post_meta($post_id , 'is_meta_payment_gateway_'.$k , true)) ?>
                                        <select class="form-control" name="is_meta_payment_gateway_<?php echo esc_attr($k) ?>" id="is_meta_payment_gateway_<?php echo esc_attr($k) ?>">
                                            <option <?php if($is_pay == 'on') echo "selected"; ?> value="on"><?php _e( "Yes" , ST_TEXTDOMAIN ) ?></option>
                                            <option <?php if($is_pay == 'off') echo "selected"; ?> value="off"><?php _e( "No" , ST_TEXTDOMAIN ) ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                }
                ?>
            </div>
            <?php if(!empty($post_id)){ ?>
                <div class="tab-pane fade" id="availablility_tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-icon-left">
                                <label for="default_state"><?php _e("Availability",ST_TEXTDOMAIN) ?>:</label>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-3">
                                    <div class="form-group">
                                        <label for="default_state"><?php echo __('Default state') ?></label>
                                        <select name="default_state" id="default_state" class="form-control">
                                            <option value="available" selected="selected"><?php echo __('Available', ST_TEXTDOMAIN) ?></option>
                                            <option value="not_available"><?php echo __('Not available', ST_TEXTDOMAIN) ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php echo st()->load_template('availability/form'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="text-center div_btn_submit">

        <?php if(!empty($post_id)){?>
            <input name="btn_update_post_type_room" id="btn_insert_post_type_room" type="submit"  class="btn btn-primary btn-lg btn_partner_submit_form" value="<?php _e("UPDATE ROOM HOTEL",ST_TEXTDOMAIN) ?>">
        <?php }else{ ?>
            <input  type="hidden"  class="save_and_preview" name="save_and_preview" value="false">
            <input  type="hidden" id=""  class="" name="action_partner" value="add_partner">
            <input name="btn_insert_post_type_room" id="btn_insert_post_type_room" type="submit"  class="btn btn-primary btn-lg btn_partner_submit_form"  disabled value="<?php _e("SUBMIT ROOM",ST_TEXTDOMAIN) ?>">
        <?php } ?>




    </div>
</form>

<div class="data_price_html" style="display: none">
    <div class="item">
        <div class="col-md-4">
            <div class="form-group form-group-icon-left">
                
                <label for="st_start_date"><?php _e("Start Date",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <input id="st_start_date" data-date-format="yyyy-mm-dd" name="st_start_date[]" type="text" placeholder="<?php _e("Start Date",ST_TEXTDOMAIN) ?>" class="form-control date-pick">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group form-group-icon-left">
                
                <label for="st_end_date"><?php _e("End Date",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <input id="st_end_date" data-date-format="yyyy-mm-dd" name="st_end_date[]" type="text" placeholder="<?php _e("End Date",ST_TEXTDOMAIN) ?>" class="form-control date-pick">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-group-icon-left">
                
                <label for="st_price"><?php _e("Price",ST_TEXTDOMAIN) ?></label>
                <i class="fa fa-money input-icon input-icon-hightlight"></i>
                <input id="st_price" name="st_price[]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="form-control number">
            </div>
        </div>
        <div class="col-md-1">
            <input name="st_priority[]" value="0" type="hidden" class="">
            <input name="st_price_type[]" value="default" type="hidden" class="">
            <input name="st_status[]" value="1" type="hidden" class="">
            <div class="btn btn-danger btn_del_price_custom" style="margin-top: 27px">X</div>
        </div>
    </div>
</div>
<!-- Template -->
<div class="paid_options_html">
    <div class="paid_options_item" style="display: none;">
        <div class="col-md-5">
            <label for="paid_options_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
            <input type="text" name="paid_options_title[]" placeholder="<?php _e( "Title" , ST_TEXTDOMAIN ) ?>" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="paid_options_value"><?php _e( "Value" , ST_TEXTDOMAIN ) ?></label>
            <input type="text" name="paid_options_value[]" placeholder="<?php _e( "Value" , ST_TEXTDOMAIN ) ?>" class="form-control">
        </div>
        <div class="col-md-1">
            <div class="form-group form-group-icon-left">
                <div class="btn btn-danger btn_del_custom_partner" style="margin-top: 27px">
                    X
                </div>
            </div>
        </div>
    </div>
</div>
<div id="list-item-extraprice" style="display: none">
    <div class="property-item tab-item">
        <a href="javascript: void(0);" class="delete-tab-item btn btn-danger">x</a>
        <div class="tab-title">&nbsp;</div>
        <div class="tab-content">
            <div class="row">
                <div class="col-xs-12 mb10">
                    <div class="form-group">
                        <label for="policy_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
                        <input id="" name="extra[title][]" type="text" class="tab-content-title form-control" value="">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group form-group-icon-left">
                        <label for="extra_name"><?php _e("Name",ST_TEXTDOMAIN) ?></label>
                        <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                        <input value="" id="extra_name" data-date-format="yyyy-mm-dd" name="extra[extra_name][]" type="text" placeholder="<?php _e("Name",ST_TEXTDOMAIN) ?>" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group form-group-icon-left">
                        <label for="extra_max_number"><?php _e("Max Of Number",ST_TEXTDOMAIN) ?></label>
                        <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                        <input value="" id="extra_max_number" data-date-format="yyyy-mm-dd" name="extra[extra_max_number][]" type="text" placeholder="<?php _e("Max of number",ST_TEXTDOMAIN) ?>" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group form-group-icon-left">
                        <label for="extra_price"><?php _e("Price",ST_TEXTDOMAIN) ?></label>
                        <i class="fa fa-file-text input-icon input-icon-hightlight"></i>
                        <input value="" id="extra_price" data-date-format="yyyy-mm-dd" name="extra[extra_price][]" type="text" placeholder="<?php _e("Price",ST_TEXTDOMAIN) ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
<div id="list-item-facility" style="display: none">
    <div class="property-item tab-item">
        <a href="javascript: void(0);" class="delete-tab-item btn btn-danger">x</a>
        <div class="tab-title">&nbsp;</div>
        <div class="tab-content">
            <div class="row">
                <div class="col-xs-12 mb10">
                    <div class="form-group">
                        <label for="policy_title"><?php _e( "Title" , ST_TEXTDOMAIN ) ?></label>
                        <input id="" name="add_new_facility_title[]" type="text" class="tab-content-title form-control" value="">
                    </div>
                </div>
                <div class="col-xs-12 mb10">
                    <label for="add_new_facility_value"><?php _e( "Value" , ST_TEXTDOMAIN ) ?></label>
                    <input type="text" name="add_new_facility_value[]" class="form-control" placeholder="<?php _e( "Value" , ST_TEXTDOMAIN ) ?>" value="">
                </div>
                <div class="col-xs-12 mb10">
                    <label for="add_new_facility_icon"><?php _e( "Icon" , ST_TEXTDOMAIN ) ?></label>
                    <input type="text" id="" name="add_new_facility_icon[]" placeholder="<?php _e("(eg: fa-facebook)",ST_TEXTDOMAIN) ?>" class="form-control st_icon_picker" value="">
                </div>
            </div>
        </div>
    </div>
</div>