<?php 

	global $post; 
	$post_id = $post->ID;
	if(is_page_template( 'template-user.php' )){
		$post_id = isset($_GET['id']) ? (int)$_GET['id']: 0;
	}
	if(empty($post_id)){
		return;
	}
?>
<?php 
	$args = [
		'post_type' => 'hotel_room',
		'posts_per_page' => -1,
		'meta_query' => [
			[
				'key' => 'room_parent',
				'value' => $post_id,
				'compare' => '='
			]
		]
	];

	$rooms = [];
	$query = new WP_Query($args);
	while($query->have_posts()): $query->the_post();
		$rooms[] = [
			'id' => get_the_ID(),
			'name' => get_the_title()
		];
?>

<?php endwhile; wp_reset_postdata(); 
?>
<div class="change-date-inventory" data-post-id="<?php echo esc_attr($post_id ); ?>">
	<select name="change_month_inventory" id="" class="form-control" style="display: inline-block; width: auto !important;">
		<option value=""><?php echo __('month', ST_TEXTDOMAIN); ?></option>
		<?php 
			for($i = 1; $i<= 12; $i++):
		?>
		<option value="<?php echo esc_attr( sprintf("%02d", $i)); ?>"><?php echo $i; ?></option>
		<?php endfor; ?>
	</select>
	<select name="change_year_inventory" id="" class="form-control" style="display: inline-block; width: auto !important;">
		<option value=""><?php echo __('year', ST_TEXTDOMAIN); ?></option>
		<?php 
			$y = date('Y');
			for($i = $y; $i<= $y + 10; $i++):
		?>
		<option value="<?php echo esc_attr($i); ?>"><?php echo $i; ?></option>
		<?php endfor; ?>
	</select>
	<button class="button button-primary btn btn-primary" name="change"><?php echo __('View', ST_TEXTDOMAIN); ?></button>
	<img class="spinner" style="display: none; float: none; visibility: visible;" src="<?php echo admin_url( '/images/spinner.gif' ); ?>" alt="spinner">
</div>	
<div class="gantt" data-rooms="<?php echo esc_attr(json_encode($rooms)); ?>"></div>