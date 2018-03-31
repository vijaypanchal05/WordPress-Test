<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 14/07/2015
 * Time: 3:17 CH
 */
$item_data=isset($item['item_meta'])?$item['item_meta']:array(); 
$format=TravelHelper::getDateFormat();

$data_price = $item_data['_st_data_price'];
?>
<ul class="wc-order-item-meta-list">

    <?php if (!empty($item_data['_st_type_tour']) and $item_data['_st_type_tour'] =='daily_tour') :?>
        <?php if(isset($item_data['_st_check_in'])): $data=$item_data['_st_check_in']; ?>
            <li>
                <span class="meta-label"><?php _e('Departure date:',ST_TEXTDOMAIN) ?></span>
                <span class="meta-data">
                    <?php //echo @date_i18n($format.' '.get_option('time_format'),strtotime($data));  
                    echo esc_attr($data . ($item_data['_st_starttime'] != '' ? ' - ' . $item_data['_st_starttime'] : ''));
                    ?>
                </span>
            </li>
            <li>
                <span class="meta-label"><?php _e('Duration:',ST_TEXTDOMAIN) ?></span>
                <span class="meta-data">
                    <?php //echo @date_i18n($format.' '.get_option('time_format'),strtotime($data));  
                    $st_duration = $item_data['_st_duration'];
                    if (!empty($st_duration))
                    {
                        echo esc_attr($st_duration);
                        /*echo esc_html(" ".array_shift($item_data['_st_duration_unit']));
                        if($st_duration > 1) echo " (s)";*/
                    }
                    ?>
                </span>
            </li>
        <?php endif;?>
    <?php endif ; ?>
    <?php if (!empty($item_data['_st_type_tour']) and $item_data['_st_type_tour'] =='specific_date' ):?>
        <?php if(isset($item_data['_st_check_in'])): $data=$item_data['_st_check_in']; ?>
            <li>
                <span class="meta-label"><?php _e('Date:',ST_TEXTDOMAIN) ?></span>
                <span class="meta-data"><?php
                    //echo @date_i18n($format.' '.get_option('time_format'),strtotime($data));
                    echo esc_attr($data);
                    ?>
                    <?php if(isset($item_data['_st_check_out'])){ $data=$item_data['_st_check_out']; ?>
                        &rarr;
                        <?php 
                        //echo @date_i18n($format.' '.get_option('time_format'),strtotime($data));
                        echo esc_attr($data);
                        ?>
                    <?php }?>
                    <?php echo $item_data['_st_starttime'] != '' ? ' - ' . $item_data['_st_starttime'] : ''; ?>
                </span>
            </li>
        <?php endif;?>
    <?php endif ;?>   

        <?php if(isset($item_data['_st_adult_number']) and  $adult = $item_data[ '_st_adult_number' ] and $adult){?>
        <li>
            <span class="meta-label"><?php echo __( 'Adult number:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo esc_html($adult);?>
                x
                <?php 
                if(isset($item_data['_st_adult_price']) ){
                    $adult_price = TravelHelper::convert_money($data_price['adult_price']/$adult);
                    ?>
                <?php echo TravelHelper::format_money_raw($adult_price) ?>
                <?php  } ;?>
            </span>
        </li>
        <?php }?>


        <?php if(isset($item_data['_st_child_number']) and $child=$item_data[ '_st_child_number' ] and $child){?>
        <li>
            <span class="meta-label"><?php echo __( 'Children number:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo esc_html($child)?>
                x
                <?php 
                if(isset($item_data['_st_child_price'])){
                    $child_price = TravelHelper::convert_money($data_price['child_price']/$child);
                    ?>
                <?php echo TravelHelper::format_money_raw($child_price) ?>       
                <?php } ;?>
            </span>
        </li>
        <?php  }?>

        <?php if(isset($item_data['_st_infant_number']) and $infant=$item_data[ '_st_infant_number' ] and $infant){?>
        <li>
            <span class="meta-label"><?php echo __( 'Infant number:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo esc_html($infant)?>
                x
                <?php 
                if(isset($item_data['_st_infant_price'])){
                    $infant_price = TravelHelper::convert_money($data_price['infant_price']/$infant);
                    ?>
                    <?php echo TravelHelper::format_money_raw($infant_price) ?>
                <?php } ;?>
            </span>
        </li>
        <?php  }?>
        <?php if(isset($item_data['_st_extras']) and ($extra_price = $item_data['_st_extra_price'])): $data=$item_data['_st_extras'];?>
            <li>
                <p><?php echo __("Extra prices"  ,ST_TEXTDOMAIN) .": "; ?></p>
                <ul>
                    <?php
                    if(!empty($data['title']) and  is_array($data['title'])){
                        foreach ($data['title'] as $key => $title) { ?>
                            <?php if($data['value'][$key]){ ?>
                                <li style="padding-left: 10px "> <?php echo esc_attr($title) ;?>:
                                    <?php
                                    echo $data['value'][$key] ;?> x <?php echo TravelHelper::format_money($data['price'][$key]) ;
                                    ?>
                                </li>
                            <?php }?>
                        <?php }
                    }
                    ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php  if(isset($item_data['_st_discount_rate'])): $data=$item_data['_st_discount_rate'];?>
            <?php  if (!empty($data)) {?><li><p>
                <?php echo __("Discount"  ,ST_TEXTDOMAIN) .": "; ?>
                <?php echo esc_attr($data) ."%";?>
            <?php } ;?></p></li>
        <?php endif; ?>
        <?php  if(isset($item_data['_line_tax'])): $data=$item_data['_line_tax'];?>
            <?php  if (!empty($data)) {?><li><p>
            <?php echo __("Tax"  ,ST_TEXTDOMAIN) .": "; ?>
            <?php echo TravelHelper::format_money($data) ;?>
        <?php } ;?></p></li>
        <?php endif; ?>
        

</ul>