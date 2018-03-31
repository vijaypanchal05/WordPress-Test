<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * author
 *
 * Created by ShineTheme
 *
 */
get_header();
$current_user_upage = get_user_by( 'slug', get_query_var( 'author_name' ) );
$role               = $current_user_upage->roles[0];
$user_meta          = get_user_meta( $current_user_upage->ID );
$user_meta          = array_filter( array_map( function ( $a ) {
	return $a[0];
}, $user_meta ) );

$arr_service = [];
if ( STUser_f::_check_service_available_partner( 'st_hotel', $current_user_upage->ID ) ) {
	array_push( $arr_service, 'st_hotel' );
}
if ( STUser_f::_check_service_available_partner( 'st_tours', $current_user_upage->ID ) ) {
	array_push( $arr_service, 'st_tours' );
}
if ( STUser_f::_check_service_available_partner( 'st_activity', $current_user_upage->ID ) ) {
	array_push( $arr_service, 'st_activity' );
}
if ( STUser_f::_check_service_available_partner( 'st_cars', $current_user_upage->ID ) ) {
	array_push( $arr_service, 'st_cars' );
}
if ( STUser_f::_check_service_available_partner( 'st_rental', $current_user_upage->ID ) ) {
	array_push( $arr_service, 'st_rental' );
}
if ( STUser_f::_check_service_available_partner( 'st_flight', $current_user_upage->ID ) ) {
	array_push( $arr_service, 'st_flight' );
}
if ( ! empty( $arr_service ) ) {
	$active_tab = STInput::get( 'service', $arr_service[0] );
}

?>
<?php //if (in_array($role, )) : ?>
    <div class="container">
        <h1 class="author-page-title">
			<?php
			echo __( 'Partner Information', ST_TEXTDOMAIN );
			?>
        </h1>
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
            <div class="author-description"><?php the_author_meta( 'description' ); ?></div>
		<?php endif; ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="<?php echo apply_filters( 'st_blog_sidebar', 'right' ) == 'no' ? 'col-sm-12' : 'col-sm-9'; ?>">
                <div class="author-info-wrapper">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="author-info-meta">
								<?php
								echo st_get_profile_avatar( $current_user_upage->ID, '' );
								?>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <h4><strong><?php echo esc_html( $current_user_upage->display_name ) ?></strong></h4>
							<?php
							$admin_packages = STAdminPackages::get_inst();
							$order          = $admin_packages->get_order_by_partner( $current_user_upage->ID );
							$enable         = $admin_packages->enabled_membership();
							if ( $enable ):
								if ( $order ):
                                    if($order->status == 'completed') {
                                        ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/membership.png"
                                             alt="<?php echo TravelHelper::get_alt_image(); ?>"
                                             class="heading-image img-responsive img-mbp" width="200px">
                                        <h3 class="uppercase color-main">
                                            <strong><?php echo esc_html($order->package_name); ?></strong></h3><br/>
                                        <?php
                                    }
								endif;
							endif;
							?>
                            <p>
								<?php echo st_get_language( 'user_member_since' ) . mysql2date( ' M Y', $current_user_upage->data->user_registered ); ?>
                                -
								<?php
								$author_obj = ST_Author::inst();
								echo '( ' . $author_obj->st_get_time_membership( $current_user_upage->data->user_registered ) . ' )';
								?>
                            </p>
                            <ul class="author-list-info">
								<?php if ( isset( $user_meta['st_is_check_show_info'] ) && $user_meta['st_is_check_show_info'] == 'on' ): ?>
                                    <li>
                                        <i class="fa fa-envelope input-icon"></i> <?php echo '<strong>' . __( 'Email: ', ST_TEXTDOMAIN ) . '</strong>' . $current_user_upage->user_email; ?>
                                    </li>
									<?php if ( isset( $user_meta['st_phone'] ) ) { ?>
										<?php if ( $user_meta['st_phone'] != '' ) { ?>
                                            <li><i class="fa fa-phone"
                                                   aria-hidden="true"></i> <?php echo '<strong>' . __( 'Phone: ', ST_TEXTDOMAIN ) . '</strong>' . $user_meta['st_phone']; ?>
                                            </li>
										<?php } ?>
									<?php } ?>
									<?php if ( isset( $user_meta['st_paypal_email'] ) ) { ?>
										<?php if ( $user_meta['st_paypal_email'] != '' ) { ?>
                                            <li>
                                                <i class="fa fa-money input-icon"></i> <?php echo '<strong>' . __( 'Email Paypal: ', ST_TEXTDOMAIN ) . '</strong>' . $user_meta['st_paypal_email']; ?>
                                            </li>
										<?php } ?>
									<?php } ?>
								<?php endif; ?>
								<?php if ( isset( $user_meta['st_airport'] ) ): ?>
									<?php if ( $user_meta['st_airport'] != '' ) { ?>
                                        <li>
                                            <i class="fa fa-plane input-icon"></i> <?php echo '<strong>' . __( 'Home Airport: ', ST_TEXTDOMAIN ) . '</strong>' . $user_meta['st_airport']; ?>
                                        </li>
									<?php } ?>
								<?php endif; ?>
								<?php if ( isset( $user_meta['st_address'] ) || isset( $user_meta['st_city'] ) || isset( $user_meta['st_country'] ) ): ?>
                                    <li><i class="fa fa-map-marker" aria-hidden="true"></i>
										<?php
										$address = '';
										echo '<strong>' . __( 'Address: ', ST_TEXTDOMAIN ) . '</strong>';
										if ( isset( $user_meta['st_address'] ) ) {
											$address .= $user_meta['st_address'];
										}
										if ( isset( $user_meta['st_city'] ) ) {
											$address .= ', ' . $user_meta['st_city'];
										}
										if ( isset( $user_meta['st_country'] ) ) {
											$address .= ', ' . $user_meta['st_country'];
										}
										echo $address;
										?>
                                    </li>
								<?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="author-services">
                    <h4><?php echo __( "Partner's Service", ST_TEXTDOMAIN ); ?></h4>
                    <hr/>
					<?php if ( ! empty( $arr_service ) ) { ?>
                        <ul class="nav nav-tabs" id="">
							<?php
							foreach ( $arr_service as $k => $v ) {
								if ( STUser_f::_check_service_available_partner( $v, $current_user_upage->ID ) ) {
									?>
                                    <li class="<?php echo $active_tab == $v ? 'active' : ''; ?>"><a
                                                href="?service=<?php echo $v; ?>"
                                                aria-expanded="true"><?php
											switch ( $v ) {
												case "st_hotel":
													echo __( 'Hotel', ST_TEXTDOMAIN );
													break;
												case "st_tours":
													echo __( 'Tour', ST_TEXTDOMAIN );
													break;
												case "st_activity":
													echo __( 'Activity', ST_TEXTDOMAIN );
													break;
												case "st_cars":
													echo __( 'Car', ST_TEXTDOMAIN );
													break;
												case "st_rental":
													echo __( 'Rental', ST_TEXTDOMAIN );
													break;
												case "st_flight":
													echo __( 'Flight', ST_TEXTDOMAIN );
													break;
											}

											?></a></li>
									<?php
								}
							}
							?>
                            <li class="<?php echo $active_tab == 'st_review' ? 'active' : ''; ?>"><a
                                        href="?service=st_review"
                                        aria-expanded="true"><?php echo __( 'Reviews', ST_TEXTDOMAIN ); ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in author-sv-list" id="tab-all">
								<?php
								$service = STInput::get( 'service', $arr_service[0] );
								$paged   = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
								$author  = $current_user_upage->ID;
								$args    = array(
									'post_type'      => $service,
									'post_status'    => 'publish',
									'author'         => $author,
									'posts_per_page' => 10,
									'paged'          => $paged
								);
								$query   = new WP_Query( $args );

								if ( $query->have_posts() ) {
									switch ( $service ) {
										case "st_hotel":
											echo '<ul class="booking-list loop-hotel style_list">';
											break;
										case "st_tours":
											echo '<ul class="booking-list loop-tours style_list">';
											break;
										case "st_activity":
											echo '<ul class="booking-list loop-activities style_list">';
											break;
										case "st_cars":
											echo '<ul class="booking-list loop-cars style_list">';
											break;
										case "st_rental":
											echo '<ul class="booking-list loop-rental style_list">';
											break;
										case "st_flight":
											echo '<ul class="booking-list loop-rental style_list">';
											break;
									}
									while ( $query->have_posts() ) {
										$query->the_post();
										switch ( $service ) {
											case "st_hotel":
												echo st()->load_template( 'hotel/loop', 'list' );
												break;
											case "st_tours":
												echo st()->load_template( 'tours/elements/loop/loop-1', null, array( 'tour_id' => get_the_ID() ) );
												break;
											case "st_activity":
												echo st()->load_template( 'activity/elements/loop/loop-1', false );
												break;
											case "st_cars":
												echo st()->load_template( 'cars/elements/loop/loop-1' );
												break;
											case "st_rental":
												echo st()->load_template( 'rental/loop', 'list', array('taxonomy' => ''));
												break;
											case "st_flight":
												echo st()->load_template( 'user/loop/loop', 'flight-upage' );
												break;
										}
									}
									echo "</ul>";
								} else {
									if ( $service != 'st_review' ) {
										echo '<h5>' . __( 'No data', ST_TEXTDOMAIN ) . '</h5>';
									} else {
										echo st()->load_template( 'user/profile-page/list_review', false, array(
											'current_user_upage' => $current_user_upage,
											'arr_service'        => $arr_service
										) );
									}
								};
								wp_reset_postdata();
								//wp_reset_query();
								?>
                                <br/>
                                <div class="pull-left author-pag">
									<?php st_paging_nav( null, $query ) ?>
                                </div>
                            </div>
                        </div>
						<?php
					} else {
						echo __( 'No partner services!', ST_TEXTDOMAIN );
					}
					?>
                </div>
            </div>
            <!-- Sidebar here -->
            <div class="col-sm-3 col-xs-12">
                <aside class=''>
					<?php
					$author_query_id = array(
						'author'         => $current_user_upage->ID,
						'post_type'      => $arr_service,
						'posts_per_page' => '-1',
						'post_status'    => 'publish'
					);

					$a_query = new WP_Query( $author_query_id );
					$arr_id  = [];
					while ( $a_query->have_posts() ) {
						$a_query->the_post();
						array_push( $arr_id, get_the_ID() );
					}
					wp_reset_postdata();

					$review_data       = STReview::data_comment_author_page( $arr_id, 'st_reviews' );
					$total_review_core = 0;
					$arr_c_rate        = [];
					if ( ! empty( $review_data ) ) {
						foreach ( $review_data as $kkk => $vvv ) {
							$comment_rate = get_comment_meta( $vvv['comment_ID'], 'comment_rate', true );
							array_push( $arr_c_rate, $comment_rate );
							$total_review_core = $total_review_core + $comment_rate;
						}

						foreach ( $arr_c_rate as $k => $v ) {
							if ( $v == 0 || $v == '' ) {
								unset( $arr_c_rate[ $k ] );
							}
						}

						$avg_rating = round( array_sum( $arr_c_rate ) / count( $arr_c_rate ), 1 );
					}

					if ( ! empty( $review_data ) ) {
						?>
                        <div class="author-review-box">
                            <h4><?php echo __( 'Average rating', ST_TEXTDOMAIN ); ?></h4>
                            <p class="author-review-score">
                                <span class="author-review-number"><?php echo $avg_rating; ?></span>
                                <span class="author-review-number-total">/5</span>
                            </p>
                            <div class="author-start-rating">
                                <div class="stm-star-rating">
                                    <div class="inner">
                                        <div class="stm-star-rating-upper"
                                             style="width:<?php echo $avg_rating / 5 * 100; ?>%;"></div>
                                        <div class="stm-star-rating-lower"></div>
                                    </div>
                                </div>
                            </div>
                            <p class="author-review-label">
								<?php printf( __( '(Based on %s ratings.)', ST_TEXTDOMAIN ), count( $review_data ) ); ?>
                            </p>
                        </div>
					<?php } else {
						?>
                        <div class="author-review-box">
                            <h4><?php echo __( 'No Reviews', ST_TEXTDOMAIN ); ?></h4>
                        </div>
						<?php
					} ?>
					<?php echo st()->load_template( 'user/profile-page/contact-form', false, array( 'current_user' => $current_user_upage ) ); ?>
                </aside>
            </div>
            <!-- End sidebar -->
        </div>
    </div>
<?php //endif; ?>
<?php
get_footer(); ?>