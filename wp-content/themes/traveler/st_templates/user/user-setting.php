<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User setting
 *
 * Created by ShineTheme
 *
 */
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$role = $current_user->roles;
$role = array_shift($role);
?>
<div class="st-create">
    <h2  class="pull-left"><?php STUser_f::get_title_account_setting() ?></h2>
</div>
<div class="msg">
    <?php
    if (!empty(STUser_f::$msg_uptp)) {
        STUser_f::get_mess_utp();
    }
    ?>
</div>
<?php 
    $admin_packages = STAdminPackages::get_inst();
    $order = $admin_packages->get_order_by_partner(get_current_user_id());
    $enable = $admin_packages->enabled_membership();
    if($enable && $admin_packages->get_user_role() == 'partner'):
        if( $order ):
?>
<div class="row mb20">
    <div class="col-xs-12">
        <div class="partner-package-info">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="packages-heading">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/membership.png" alt="<?php echo TravelHelper::get_alt_image(); ?>" class="heading-image img-responsive">
                    </div>
                    <h3 class="uppercase color-main"><strong><?php echo esc_html($order->package_name ); ?></strong></h3>
                    <?php
                        $status  = esc_attr($order->status);
                        if( $status == 'incomplete'){
                            echo '<span class="order-status warning">'. $status . '</span>';
                        }elseif($status == 'completed'){
                            echo '<span class="order-status success">'. $status . '</span>';
                        }elseif($status == 'cancelled'){
                            echo '<span class="order-status danger">'. $status . '</span>';
                        }
                    ?>
                    <?php 
                        $can_upgrade = $admin_packages->can_upgrade($user_id);
                        if($can_upgrade):
                            $link = $admin_packages->register_member_page();
                            $link = add_query_arg('upgrade', TravelHelper::st_encrypt($user_id), $link);
                    ?>
                    <br>
                        <a class="mt10 btn btn-primary" href="<?php echo esc_url( $link ); ?>"><?php echo __('Upgrade', ST_TEXTDOMAIN) ?></a>
                    <?php endif; ?>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <h4 class="text-center"><?php echo __('Package Details', ST_TEXTDOMAIN); ?></h4>
                    <div class="mt10 text-center">

                    <?php 
                        $currency = get_post_meta($order->id,'currency', true );
                        $currency = (isset($currency['symbol']))? $currency['symbol']: '';
                    ?>
                        <strong><?php echo __('Price', ST_TEXTDOMAIN); ?>: </strong><?php echo TravelHelper::format_money_raw((float)$order->package_price, $currency); ?>
                    </div>
                    <div class="mt10 text-center">
                        <strong><?php echo __('Time Available', ST_TEXTDOMAIN); ?>: </strong><?php echo $admin_packages->convert_item($order->package_time, true); ?>
                    </div>
                    <div class="mt10 text-center">
                        <strong><?php echo __('Commission', ST_TEXTDOMAIN); ?>: </strong><?php echo esc_attr( $order->package_commission ). '%'; ?>
                    </div>
                    <div class="mt10 text-center">
                        <strong><?php echo __('No. Items can upload', ST_TEXTDOMAIN); ?>: </strong><?php echo esc_attr( $order->package_item_upload ); ?>
                    </div>
                    <div class="mt10 text-center">
                        <strong><?php echo __('No. Items can set Featured', ST_TEXTDOMAIN); ?>: </strong><?php echo esc_attr( $order->package_item_featured ); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <h5 class="text-center"><?php echo __('Activation date', ST_TEXTDOMAIN); ?></h5>
                    <p class="text-center"><strong><?php echo date('Y-m-d', $order->created); ?></strong></p>
                    <h5 class="text-center"><?php echo __('Expiration date', ST_TEXTDOMAIN); ?></h5>
                    <p class="text-center">
                        <strong>
                            <?php 
                            if($order->package_time == 'unlimited'){
                                echo esc_html__('Unlimited',  ST_TEXTDOMAIN);
                            }else{
                                $date = strtotime('+'. (int) $order->package_time . ' days', $order->created);
                                echo date('Y-m-d', $date); 
                            }
                                
                            ?>
                            
                        </strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <?php 
            $item_can_public = $admin_packages->count_item_can_public(get_current_user_id());
            if($item_can_public < 0 ):
        ?>
        <div class="alert alert-warning mt20">
            <?php 
                echo __('<strong>PACKAGE INFORMATIONS:</strong> Some of your items are not published because it exceeds the amount of the package.', ST_TEXTDOMAIN)
            ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php else: ?>
    <div class="row mb20">
        <div class="col-xs-12">
            <div class="partner-package-info">
                <div class="packages-heading">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/membership.png" alt="<?php echo TravelHelper::get_alt_image(); ?>" class="heading-image img-responsive">
                </div>
                <p class="text-warning">
                    <?php echo __('Your account need to register a membership package to continue using.', ST_TEXTDOMAIN); ?>
                </p>
                <a class="btn btn-primary mt10" href="<?php echo esc_url( $admin_packages->register_member_page() ); ?>"><?php echo __('Register', ST_TEXTDOMAIN) ?></a>
            </div>
        </div>  
    </div>    
<?php endif; ?>     
<?php 
    endif;
?>
<div class="row">
    <div class="col-md-5">
        <?php
        if(!empty($_REQUEST['status'])){
            if($_REQUEST['status'] == 'success'){
                echo '<div class="alert alert-'.$_REQUEST['status'].'">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">'.st_get_language('user_update_successfully').'</p>
                      </div>';
            }
            if($_REQUEST['status'] == 'danger'){
                echo '<div class="alert alert-'.$_REQUEST['status'].'">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">'.__("Update not successfully",ST_TEXTDOMAIN).'</p>
                      </div>';
            }
        }
        ?>
        <form method="post" action="" enctype="multipart/form-data">
            <?php wp_nonce_field('user_setting','st_update_user'); ?>
            <input type="hidden" name="id_user" value="<?php echo esc_attr($data->ID) ?>">
            <h4><?php st_the_language('user_personal_infomation') ?></h4>
            <div class="form-group form-group-icon-left">
                <label for="st_name"><?php st_the_language('user_display_name') ?></label><i class="fa fa-user input-icon"></i>
                <input name="st_name" class="form-control" value="<?php echo esc_attr($data->display_name) ?>" type="text" />
            </div>
            <div class="form-group form-group-icon-left">
                <label for="st_email"><?php st_the_language('user_mail') ?></label><i class="fa fa-envelope input-icon"></i>
                <input name="st_email" class="form-control" value="<?php echo esc_attr($data->user_email) ?>" type="text" />
            </div>
            <div class="form-group form-group-icon-left">
                <label for="st_phone"><?php st_the_language('user_phone_number') ?></label><i class="fa fa-phone input-icon"></i>
                <input name="st_phone" class="form-control" value="<?php echo get_user_meta($data->ID , 'st_phone' , true) ?>" type="text" />
            </div>
            <div class="form-group form-group-icon-left">
                <label for="st_paypal_email"><?php esc_html_e("Paypal Email",ST_TEXTDOMAIN) ?></label><i class="fa fa-money input-icon"></i>
                <input name="st_paypal_email" class="form-control" value="<?php echo get_user_meta($data->ID , 'st_paypal_email' , true) ?>" type="text" />
            </div>

            <div class="form-group form-group-icon-left">
                <div class="checkbox">
                    <label for="st_is_check_show_info">
                        <?php
                        $is_check =  get_user_meta($data->ID , 'st_is_check_show_info' , true);
                        if(!empty($is_check)){
                            $is_check = 'checked="checked"';
                        }
                        ?>
                        <input <?php echo esc_attr($is_check); ?> name="st_is_check_show_info" class="i-check" type="checkbox" />
                        <?php st_the_language('show_email_and_phone_number_to_other_account') ?>
                    </label>
                </div>
            </div>
            <div class="form-group form-group-icon-left">
                <label for="id_avatar_user_setting"><?php _e('Avatar',ST_TEXTDOMAIN); ?></label>
                <?php
                $id_img = get_user_meta($user_id , 'st_avatar' , true);
                $url_avatar = "";
                $post_thumbnail_id = wp_get_attachment_image_src($id_img, 'full');
                if(!empty($post_thumbnail_id)){
                    $url_avatar = array_shift($post_thumbnail_id);
                }
                ?>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="st_avatar"  type="file" >
                        </span>
                    </span>
                    <input type="text" readonly="" value="<?php echo esc_url($url_avatar); ?>" class="form-control data_lable">
                </div>
                <input id="id_avatar_user_setting" name="id_avatar" type="hidden" value="<?php echo esc_attr($id_img) ?>">
                <?php
                if(!empty($url_avatar)){
                    echo '<div class="user-profile-avatar user_seting">
                            <img width="300" height="300" class="avatar avatar-300 photo img-thumbnail" src="'.$url_avatar.'" alt="'.TravelHelper::get_alt_image().'">
                            <input name="st_delete_avatar" type="button"  class="btn btn-danger  btn_del_avatar" value="'.st_get_language('user_delete').'">
                          </div>';
                }
                ?>
            </div>
            <div class="gap gap-small"></div>
            <h4><?php st_the_language('user_location') ?></h4>
            <div class="form-group form-group-icon-left">
                <label for="st_airport"><?php st_the_language('user_home_airport') ?></label>
                <i class="fa fa-plane input-icon"></i>
                <input name="st_airport" class="form-control" value="<?php echo get_user_meta($data->ID , 'st_airport' , true) ?>" type="text" />
            </div>
            <div class="form-group">
                <label for="st_address"><?php st_the_language('user_street_address') ?></label>
                <input name="st_address" class="form-control" value="<?php echo get_user_meta($data->ID , 'st_address' , true) ?>" type="text" />
            </div>
            <div class="form-group">
                <label for="st_city"><?php st_the_language('user_city') ?></label>
                <input name="st_city" class="form-control" value="<?php echo get_user_meta($data->ID , 'st_city' , true) ?>" type="text" />
            </div>
            <div class="form-group">
                <label for="st_province"><?php st_the_language('user_state_province_region') ?></label>
                <input name="st_province" class="form-control" value="<?php echo get_user_meta($data->ID , 'st_province' , true) ?>" type="text" />
            </div>
            <div class="form-group">
                <label for="st_zip_code"><?php st_the_language('user_zip_code_postal_code') ?></label>
                <input name="st_zip_code" class="form-control" value="<?php echo get_user_meta($data->ID , 'st_zip_code' , true) ?>" type="text" />
            </div>
            <div class="form-group">
                <label for="st_country"><?php st_the_language('user_country') ?></label>
                <input name="st_country" class="form-control" value="<?php echo get_user_meta($data->ID , 'st_country' , true) ?>" type="text" />
            </div>
            <hr>
            <input name="st_btn_update" type="submit" class="btn btn-primary" value="<?php st_the_language('user_save_changes') ?>">
        </form>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <h4><?php st_the_language('user_change_password') ?></h4>
        <div class="msg">
            <?php
            if(!empty(STUser_f::$msg)){
                echo '<div class="alert alert-'.STUser_f::$msg['status'].'">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">'.STUser_f::$msg['msg'].'</p>
                      </div>';
            }
            ?>
        </div>
        <form method="post" action="">
            <?php wp_nonce_field('user_setting','st_update_pass'); ?>
            <input type="hidden" name="user_login" value="<?php echo esc_attr($data->user_login) ?>">
            <div class="form-group form-group-icon-left">
                <label for="old_pass"><?php st_the_language('user_current_password') ?></label>
                <i class="fa fa-lock input-icon"></i>
                <input name="old_pass" class="form-control" type="password" />
            </div>
            <div class="form-group form-group-icon-left">
                <label for="new_pass"><?php st_the_language('user_new_password') ?></label>
                <i class="fa fa-lock input-icon"></i>
                <input name="new_pass" class="form-control" type="password" />
            </div>
            <div class="form-group form-group-icon-left">
                <label for="new_pass_again"><?php st_the_language('user_new_password_again') ?></label>
                <i class="fa fa-lock input-icon"></i>
                <input name="new_pass_again" class="form-control" type="password" />
            </div>
            <hr />
            <input name="btn_update_pass" class="btn btn-primary" type="submit" value="<?php st_the_language('user_change_password') ?>" />
        </form>
    </div>
</div>