<?php
/**
 * WYZI Featured Slider
 *
 * @package wyz
 */

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	wp_die('No cheating');
}

if( ! class_exists( 'WYZIFeaturedSlider' ) ) {

	class WYZIFeaturedSlider {

		private $slider_attr;

		private static $default_image_path = '';

		public function __construct( $attr ) {
			$this->slider_attr = $attr;
			self::$default_image_path = plugin_dir_url( __FILE__ ) . 'images/featured_default_image.png';
			add_action( 'wp_footer', array( &$this, 'include_slider_script') , 6 );
		}

		public function the_featured_slider() {
			ob_start();
			$sticky_posts = get_option( 'sticky_posts' );
			$no_posts = empty( $sticky_posts );
			if ( ! $no_posts ) {
				$args = array(
					'posts_per_page' => $this->slider_attr['count'],
					'offset' => 0,
					'orderby' => 'date',
					'order' => 'DESC',
					'post_type' => 'wyz_business',
					'post_status' => 'publish',
					'post__in' => $sticky_posts,
				);
				$posts = new WP_Query( $args ); 
				$count = 0;
				?>
			<!-- Featured Places Area Start -->
			<div class="featured-place-area mb-50 section">
				<div class="container">
					<div class="row featured-masonry-grid">
					<?php if ( ! $no_posts ) {
						while ( $posts->have_posts() ) :
							$posts->the_post();
							$id = get_the_ID();
							//$cat = get_the_term_list( $id, 'wyz_business_category', '', ' , ' );
							$rate_nb = get_post_meta( $id, 'wyz_business_rates_count', true );
							$rate_sum = get_post_meta( $id, 'wyz_business_rates_sum', true );
							//$logo_bg = get_post_meta( $id, 'wyz_business_logo_bg', true );
							//$content = wp_strip_all_tags( get_post_meta( $id, 'wyz_business_description', true ) );
							$cntr = get_post_meta( $id, 'wyz_business_country', true );
							$cntr_link = '';
							if ( '' != $cntr && ! empty( $cntr ) ) {
								$cntr_link = get_post_type_archive_link( 'wyz_business' ) . '?location=' . $cntr;
							}
							$cntr = get_the_title( $cntr );
							$image = WyzHelpers::get_image( $id );
							/*if ( strlen( $content ) > 160 ) {
								$content = substr( $content, 0, 160 ) . '...';
							}*/

							if ( 0 == $rate_nb ) {
								$rate = 0;
							} else {
								$rate = number_format( ( $rate_sum ) / $rate_nb, 1 ); 
							} ?>

							<div class="masonry-item col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-30">
								<div class="single-place">
									<div class="image"><img src="<?php echo esc_url( $image );?>" alt=""></div>
									<div class="content fix">
										<p class="location">
											<i class="fa fa-map-marker"></i>
											<span><a href="<?php echo esc_url( $cntr_link );?>"><?php echo esc_html( $cntr );?></a></span>
										</p>
										<p class="rating">
											<?php for( $i=0; $i < $rate; $i++ ) {?>
											<i class="fa fa-star"></i>
											<?php }
											for( $i= $rate; $i <= 5; $i++ ) {?>
											<i class="fa fa-star-o"></i>
											<?php }?>
										</p>
									</div>
									<a href="<?php echo esc_url( get_permalink() );?>" class="link"><i class="fa fa-link"></i></a>
								</div>
							</div>

							<?php 
							$count++;
						endwhile;
					}
					?>
					</div>
				</div>
			</div>

			<?php wp_reset_postdata();
			}
			return ob_get_clean();
		}

		public function include_slider_script() {
			wp_enqueue_script( 'wyz_featured_script' );
		}
	}
}
