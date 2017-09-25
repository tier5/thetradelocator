<?php
/**
 * Recently added businesses slider
 *
 * @package wyz
 */

function wyz_include_rec_add_script() {
	wp_enqueue_script( 'wyz_rec_added_script' );
}
add_action( 'wp_footer', 'wyz_include_rec_add_script', 6 );

$args = array(
	'posts_per_page' => $wyz_rec_add_attr['count'],
	'offset' => 0,
	'orderby' => 'date',
	'order' => 'DESC',
	'post_type' => 'wyz_business',
	'post_status' => 'publish',
);
$posts = new WP_Query( $args ); 
$count = 0;?>

<div class="recently-added-area margin-bottom-50">
		<div class="row"> 
			<!-- Section Title -->
			<div class="section-title col-xs-12 margin-bottom-50">
				<h1><?php echo esc_html( $wyz_rec_add_attr['rec_added_slider_ttl'] );?></h1>
			</div>
			<div class="col-xs-12">
				<!-- Recently Added Slider -->
				<div class="recently-added-slider">
				<?php while ( $posts->have_posts() ) :
					$posts->the_post();
					$id = get_the_ID();
					$cat = get_the_term_list( $id, 'wyz_business_category', '', ' , ' );
					$rate_nb = get_post_meta( $id, 'wyz_business_rates_count', true );
					$rate_sum = get_post_meta( $id, 'wyz_business_rates_sum', true );
					$logo_bg = get_post_meta( $id, 'wyz_business_logo_bg', true );
					$content = wp_strip_all_tags( get_post_meta( $id, 'wyz_business_description', true ) );
					if ( strlen( $content ) > 160 ) {
						$content = WyzHelpers::substring_excerpt( $content, 160 ) . '...';//substr( $content, 0, 160 ) . '...';
					}

					if ( 0 == $rate_nb ) {
						$rate = 0;
					} else {
						$rate = number_format( ( $rate_sum ) / $rate_nb, 1 ); 
					} ?>
					<div class="sin-added-item">

						<a href="<?php echo esc_url( get_permalink() ); ?>" class="image">
							<div class="logo-cont" style="background-color:<?php echo esc_attr( $logo_bg );?>;">


								<div class="dummy"></div>

								<div class="img-container">
									<div class="centerer"></div>
									<?php if ( has_post_thumbnail( $id ) ) {
										echo get_the_post_thumbnail( $id, 'medium' );
									} ?>
								</div>
							</div>
						</a>
						<div class="text fix">
							<div class="ratting fix">
								<?php if ( 0 == $rate_nb ) {
									esc_html_e( 'no ratings yet', 'wyzi-business-finder' ) ;
								} else {
									for ( $i = 0; $i < 5; $i++ ) {
										if ( $rate > 0 ) {
											echo '<i class="fa fa-star"></i>';
											$rate--;
										} else {
											echo '<i class="fa fa-star-o"></i>';
										}
									}
								} ?>
							</div>
							<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
							<p><?php echo $content; ?></p>
							<a href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'READ MORE', 'wyzi-business-finder' );?></a>
						</div>
					</div>

				<?php 
				$count++;
				endwhile;
				wp_reset_postdata();
				?>
				</div>
			</div>
		</div>
</div>
<?php $rec_add_slide_data = array(
	'nav' => $wyz_rec_add_attr['nav'],
	'loop' => $count > 1 ? $wyz_rec_add_attr['loop'] : false,
);
wp_localize_script( 'wyz_rec_added_script', 'recAddSlide', $rec_add_slide_data );?>
