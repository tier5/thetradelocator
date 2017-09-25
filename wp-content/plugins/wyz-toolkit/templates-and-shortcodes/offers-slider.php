<?php
/**
 * Offers slider
 *
 * @package wyz
 */

function wyz_include_off_script() {
	wp_enqueue_script( 'wyz_offers_script' );
}
add_action( 'wp_footer', 'wyz_include_off_script', 6 );

$offer_slide_data = array(
	'nav' => $wyz_offrs_attr['nav'],
	'loop' => $wyz_offrs_attr['loop'],
	'autoHeight' => $wyz_offrs_attr['autoheight'],
);
wp_localize_script( 'wyz_offers_script', 'offerSlide', $offer_slide_data );

$qry_args = array(
	'post_status' => 'publish',
	'post_type' => 'wyz_offers',
	'posts_per_page' => - 1,
);

$all_posts = new WP_Query( $qry_args );
?>
<div class="our-offer-area margin-bottom-50">
	<div class="row">
		<div class="col-xs-12">
			<!-- Offer Slider -->
			<?php 
			// Only show the slider if we have more than 1 offer (bug in owl).
			if ( $all_posts->post_count > 1 ) { ?>
			<div class="our-offer-slider">
			<?php } else { ?>
				<div class="single-owl-carousel">
			<?php }
			if ( class_exists( 'WyzOffer' ) ) {
				while ( $all_posts->have_posts() ) {
					$all_posts->the_post();
					WyzOffer::wyz_the_offer( get_the_ID(), false );
				}
				wp_reset_postdata();
			}
			?>
			</div>
		</div>
	</div>
</div>
