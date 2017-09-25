<?php
$prefix = 'wyz_';
global $wpdb;
global $current_user;
wp_get_current_user();
$is_current_user_author = WyzHelpers::wyz_is_current_user_author( $id );
$logged_in_user = is_user_logged_in();
/*$about = get_post_meta( $id, $prefix . 'business_description', true );
$about = preg_replace("/<img[^>]+\>/i", " ", $about);
$about = preg_replace("/<div[^>]+>/", "", $about);
$about = preg_replace("/<\/div[^>]+>/", "", $about);
$about = wp_strip_all_tags( $about );
$about = substr( $about, 0, 150 ) . '<a href="#about" class="read-more" data-toggle="tab">' . esc_html__( 'show more', 'wyzi-business-finder' ) . '</a>';*/

/* Opening/Closing times. */

$days_arr = array();
$days_names = array(
	esc_html__( 'Mon', 'wyzi-business-finder' ),
	esc_html__( 'Tue', 'wyzi-business-finder' ),
	esc_html__( 'Wed', 'wyzi-business-finder' ),
	esc_html__( 'Thu', 'wyzi-business-finder' ),
	esc_html__( 'Fri', 'wyzi-business-finder' ),
	esc_html__( 'Sat', 'wyzi-business-finder' ),
	esc_html__( 'Sun', 'wyzi-business-finder' ),
);
$days_ids = array( 'open_close_monday', 'open_close_tuesday', 'open_close_wednesday',
			'open_close_thursday', 'open_close_friday', 'open_close_saturday', 'open_close_sunday' );
for( $i=0; $i<7; $i++)
	$days_arr[] = WyzHelpers::wyz_set_time( get_post_meta( $id, $prefix . $days_ids[ $i ], true ) );

// Address.
$bldg = get_post_meta( $id, $prefix . 'business_bldg', true );
$street = get_post_meta( $id, $prefix . 'business_street', true );
$city = get_post_meta( $id, $prefix . 'business_city', true );
$country = get_post_meta( $id, $prefix . 'business_country', true );
$country = get_the_title( $country );
$additional_address = get_post_meta( $id, $prefix . 'business_addition_address_line', true );
$address = '';
if ( '' !== $bldg ) {
	$address .= $bldg . ', ';
}
if ( '' !== $street ) {
	$address .=  $street . ', ';
}
if ( '' !== $city ) {
	$address .= $city . ', ';
}
if ( '' !== $country ) {
	$address .= $country . ', ';
}

if ( '' != $address ) {
	$address = substr( $address, 0, strlen( $address ) - 2 );
}
$phone1 = get_post_meta( $id, $prefix . 'business_phone1', true );
$phone2 = get_post_meta( $id, $prefix . 'business_phone2', true );
$author_id = WyzHelpers::wyz_the_business_author_id();

if ( ! WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_phone_2') ) { 
	$phone2 = '';
}

$final_phone = '';
if ( '' === $phone2 ) {
    $final_phone = $phone1;
} elseif ( '' === $phone1 ) {
    $final_phone = $phone2;
} else {
    $final_phone = '<span>' . $phone1 . '</span><span>' . $phone2 . '<span>';
}
$email1 = get_post_meta( $id, $prefix . 'business_email1', true );
$email2 = get_post_meta( $id, $prefix . 'business_email2', true );

if ( ! WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_email_2') ) { 
	$email2 = '';
}

$final_email = '';
if ( '' === $email2 ) {
    $final_email = '<a href="mailto:' . esc_attr( $email1 ) . '" target="_blank">' . esc_html( $email1 ) . '</a>';
} elseif ( '' === $email1 ) {
    $final_email = '<a href="mailto:' . esc_attr( $email2 ) . '" target="_blank">' . esc_html( $email2 ) . '</a>';
} else {
    $final_email = '<a href="mailto:' . esc_attr( $email1 ) . '" target="_blank">' . esc_html( $email1 ) . '</a> / <a href="mailto:' . esc_attr( $email2 ) . '" target="_blank">' . esc_html( $email2 ) . '</a>';
}

// Social.
$website = get_post_meta( $id, $prefix . 'business_website', true );
$fb = get_post_meta( $id, $prefix . 'business_facebook', true );
$twitter = get_post_meta( $id, $prefix . 'business_twitter', true );
$youtube = get_post_meta( $id, $prefix . 'business_youtube', true );
$lnkdin = get_post_meta( $id, $prefix . 'business_linkedin', true );
$insta = get_post_meta( $id, $prefix . 'business_instagram', true );
$flickr = get_post_meta( $id, $prefix . 'business_flicker', true );
$gp = get_post_meta( $id, $prefix . 'business_google_plus', true );
$pntrst = get_post_meta( $id, $prefix . 'business_pinterest', true );

$has_social_links = true;
if ( '' === $fb  && '' === $twitter && '' === $youtube && '' === $lnkdin && '' === $insta && '' === $flickr && '' === $gp && '' === $pntrst ) {
    $has_social_links = false;
}

/*$rate_nb = get_post_meta( $id, $prefix . 'business_rates_count', true );
$rate_sum = get_post_meta( $id, $prefix . 'business_rates_sum', true );*/

$no_days_data = true;

for ( $i=0; $i<7; $i++)
	if ( ! empty( $days_arr[ $i ] ) ){
		$no_days_data = false;
		break;
	}
?>




<!-- Business Sidebar -->
<div class="sidebar-wrapper<?php if ( 'off' === wyz_get_option( 'resp' ) ) { ?> col-xs-4 <?php } else { ?> col-lg-4 col-md-5 col-xs-12<?php } ?>">
<?php 
if ( is_sticky() ) {
	echo '<div class="sticky-notice"><span>' . esc_html__( 'featured', 'wyzi-business-finder' ) . '</span></div>';
}
if ( is_active_sidebar( 'wyz-single-business-sb' ) ) :
	dynamic_sidebar( 'wyz-single-business-sb' );
endif;?>
	<?php
	
/*if ( WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_description') ) {
?>
	<!-- About Business Sidebar -->
	<div class="sin-busi-sidebar">
		<div class="about-business-sidebar fix">
			<div class="desc-see-more"><?php //echo $about; ?> </div>
		</div>
	</div>
<?php }*/


if ( WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_contact_information_tab') ) { ?>
		<!-- Contact Business Sidebar -->
	<div class="widget widget_text">
		<h4 class="widget-title"><?php esc_html_e( 'contact info', 'wyzi-business-finder' );?></h4>

		<div class="contact-info-widget">
			<!-- Single Info -->
			<div class="single-info fix">
				<?php if ( WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_address') ) { ?>
				<h5><?php esc_html_e( 'Address', 'wyzi-business-finder' );?></h5>
				<p><?php echo esc_html( $address );
				if ( '' !== $additional_address ) {
					echo esc_html( $additional_address );
				}?></p>
				<?php } ?>
			</div>
			<div class="single-info fix">
			<?php if ( WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_email_1') ) { ?>
				<h5><?php esc_html_e( 'E-mail', 'wyzi-business-finder' );?></h5>
				<p><?php echo esc_html( $final_email ); ?></p>
			<?php }?>
			</div>
			<div class="single-info fix">
			<?php if ( WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_phone_1') ) { ?>
				<h5><?php esc_html_e( 'Phone', 'wyzi-business-finder' );?></h5>
				<p><?php echo esc_html( $final_phone ); ?></p>
			<?php }?>
			</div>
			<div class="single-info fix">
				<?php if ( WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_website_url' ) && '' !== $website ) {?>
				<h5><?php esc_html_e( 'Website', 'wyzi-business-finder' );?></h5>
				<p class="website"><a target="_blank" href="<?php  echo esc_url( $website ); ?>"><?php echo esc_html( $website ); ?></a></p>
				<?php } ?>
			</div>
		</div>
	</div>

<?php }



$all_business_rates = get_post_meta( $id, 'wyz_business_ratings', true );
$args = array(
	'post_type' => 'wyz_business_rating',
	'post__in' => $all_business_rates,
	'posts_per_page' => 3,
	'paged' => $page,
);
$query = new WP_Query( $args );

$first_id = - 1;
if ( $query->have_posts() ) {?>
<!-- Sidebar Widget -->
<div class="widget">
	<!--Widget Title-->
	<h4 class="widget-title"><?php esc_html_e( 'Recent Ratings', 'wyzi-business-finder' );?></h4>
	<!-- Rating Widget -->
	<div class="rating-widget">

	<?php while ( $query->have_posts() ) {
		$query->the_post();
		$first_id = $bus_id;
		echo WyzBusinessRating::wyz_create_rating( get_the_ID(), 2 );
	}
	wp_reset_postdata(); ?>
	</div>
</div>
	<?php
}


$business_data->rate_form();


if ( WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_opening_hours') && ! $no_days_data ) {?>
?>
<div class="widget">
	<!--Widget Title-->
	<h4 class="widget-title"><?php echo esc_html( get_option( 'wyz_businesses_open_hrs' ) );?></h4>
	<!-- Opening Time Widget -->
	<div class="open-time-widget">
		<ul>
			<?php
			for( $i=0; $i<7; $i++)

				if ( ! empty( $days_arr[ $i ] ) ) {?>
					<div class="clearfix">
						<li><span class="day"><?php esc_html_e( $days_names[ $i ], 'wyzi-business-finder');?></span>
						<?php foreach ( $days_arr[ $i ] as $key => $value ) {?>
							<?php  echo ( isset( $value['open'] ) ?  esc_html( $value['open'] ) : '' ) . ' - ' . ( isset( $value['close'] ) ?  esc_html( $value['close'] ) : '' ); ?>
						<?php }?></li>
					</div>
					
				<?php }
			?>
		</ul>
	</div>
</div>
<?php
}



if ( WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_business_tags') ) {
	if ( $tags = get_the_term_list( $id, 'wyz_business_tag', '', ', ' ) ) {?>

	<div class="widget">
		<!--Widget Title-->
		<h4 class="widget-title"><?php esc_html_e( 'tags', 'wyzi-business-finder' );?></h4>
			<!-- Tags Widget -->
		<div class="tag-widget fix">
			<?php echo $tags;?>
		</div>
	</div>
<?php }
}


if ( WyzHelpers::wyz_sub_can_bus_owner_do( $author_id,'wyzi_sub_business_show_social_media') && $has_social_links ) {?>
	
	<div class="widget transparent">
		<!-- Social Widget -->
		<div class="social-widget">
		
	<?php if ( isset( $fb ) && ! empty( $fb ) ) { ?>

			<a href="<?php echo WyzHelpers::wyz_link_auth( $fb ); ?>" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a>
	<?php }

	if ( isset( $twitter ) && ! empty( $twitter ) ) { ?>

			<a href="<?php echo WyzHelpers::wyz_link_auth( $twitter ); ?>" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>
	<?php }

	if ( isset( $lnkdin ) && ! empty( $lnkdin ) ) { ?>

			<a href="<?php echo WyzHelpers::wyz_link_auth( $lnkdin ); ?>" class="linkedin" target="_blank"><i class="fa fa-linkedin"></i></a>
	<?php }

	if ( isset( $gp ) && ! empty( $gp ) ) { ?>

			<a href="<?php echo WyzHelpers::wyz_link_auth( $gp ); ?>" class="google-plus" target="_blank"><i class="fa fa-google-plus"></i></a>
	<?php }

	if ( isset( $youtube ) && ! empty( $youtube ) ) { ?>

			<a href="<?php echo WyzHelpers::wyz_link_auth( $youtube ); ?>" class="youtube-play" target="_blank"><i class="fa fa-youtube-play"></i></a>
	<?php }

	if ( isset( $flickr ) && ! empty( $flickr ) ) { ?>

			<a href="<?php echo WyzHelpers::wyz_link_auth( $flickr ); ?>" class="flickr" target="_blank"><i class="fa fa-flickr"></i></a>
	<?php }

	if ( isset( $pntrst ) && ! empty( $pntrst ) ) { ?>

			<a href="<?php echo WyzHelpers::wyz_link_auth( $pntrst ); ?>" class="pinterest-p" target="_blank"><i class="fa fa-pinterest-p"></i></a>
	<?php }

	if ( isset( $insta ) && ! empty( $insta ) ) { ?>

			<a href="<?php echo WyzHelpers::wyz_link_auth( $insta ); ?>" class="instagram" target="_blank"><i class="fa fa-instagram"></i></a>
	<?php } ?>
		</div>
	</div>
<?php }?>

</div>
<?php if ( 'off' != get_option( 'wyz_business_claiming' ) ) {
	echo '<a href="' . home_url( '/claim/?id=' ) . $id .'" class="light-blue-link">' . esc_html__( 'Claim this', 'wyzi-business-finder' ) . ' ' . WYZ_BUSINESS_CPT . '</a>';
}
?>