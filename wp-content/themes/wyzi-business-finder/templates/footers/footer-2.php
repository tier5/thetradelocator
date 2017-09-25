<?php
// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	wp_die('No cheating');
}

if ( ! class_exists( 'WYZIFooter' ) ) { 

	class WYZIFooter {

		public function can_have_footer() {
			global $post;
			return ! ( ( '' !== $post && isset( $post->post_content ) && '' !== $post->post_content && ( has_shortcode( get_the_content(), 'wyz_business_wall' ) ) || ( is_singular( 'wyz_business' ) && 'on' != get_option( 'wyz_enable_business_footer' ) ) ) );
		}

		public function start() {
			echo '<footer class="footer-area section">';
		}

		public function close() {
			echo '</footer>';
		}

		public function the_widget_area() {
			if ( 'on' === wyz_get_option( 'footer-widgets-onoff' ) ) {?>
				<!-- Footer Top
				============================================ -->
				<div class="footer-top section pt-60 pb-10">
					<div class="container">
						<div class="row">
				<?php
				$footer_layout = wyz_get_option( 'footer-layout' );
				if ( 'one-column' === $footer_layout && is_active_sidebar( 'wyz-footer-1-sb' ) ) { ?>
							<div class="footer-widget widget-area mb-50 <?php if ( 'off' == wyz_get_option( 'resp' ) ) { echo 'col-xs-12'; } else { echo 'col-md-12 col-sm-12 col-xs-12'; }?>">
								<?php dynamic_sidebar( 'wyz-footer-1-sb' ); ?>
							</div>
				<?php } elseif ( 'two-columns' === $footer_layout && ( is_active_sidebar( 'wyz-footer-1-sb' ) || is_active_sidebar( 'wyz-footer-2-sb' ) ) ) {
					$resp_class = ( 'off' == wyz_get_option( 'resp' ) ? 'col-xs-6' : 'col-md-6 col-sm-6 col-xs-12' );?>

							<div class="footer-widget widget-area mb-50 <?php echo esc_html( $resp_class );?>">
								<?php dynamic_sidebar( 'wyz-footer-1-sb' ); ?>
							</div>
							<div class="footer-widget widget-area mb-50 <?php echo esc_html( $resp_class );?>">
								<?php dynamic_sidebar( 'wyz-footer-2-sb' ); ?>
							</div>
				<?php } elseif ( 'three-columns' === $footer_layout ) {

					if ( is_active_sidebar( 'wyz-footer-1-sb' ) || is_active_sidebar( 'wyz-footer-2-sb' ) || is_active_sidebar( 'wyz-footer-3-sb' ) ) {
						$resp_class = ( 'off' == wyz_get_option( 'resp' ) ? 'col-xs-4' : 'col-md-4 col-sm-6 col-xs-12' );?>

							<div class="footer-widget widget-area mb-50 <?php echo esc_html( $resp_class );?>">
								<?php dynamic_sidebar( 'wyz-footer-1-sb' ); ?>
							</div>
							<div class="footer-widget widget- mb-50 <?php echo esc_html( $resp_class );?>">
								<?php dynamic_sidebar( 'wyz-footer-2-sb' ); ?>
							</div>
							<div class="footer-widget widget-area mb-50 <?php echo esc_html( $resp_class );?>">
								<?php dynamic_sidebar( 'wyz-footer-3-sb' ); ?>
							</div>
					<?php }
				} elseif ( 'four-columns' === $footer_layout ) {

					if ( is_active_sidebar( 'wyz-footer-1-sb' ) || is_active_sidebar( 'wyz-footer-2-sb' ) || is_active_sidebar( 'wyz-footer-3-sb' ) || is_active_sidebar( 'wyz-footer-4-sb' ) ) { 
						$resp_class = ( 'off' == wyz_get_option( 'resp' ) ? 'col-xs-3' : 'col-md-3 col-sm-6 col-xs-12' )?>

							<div class="footer-widget widget-area mb-50 <?php echo esc_html( $resp_class );?>">
								<?php dynamic_sidebar( 'wyz-footer-1-sb' ); ?>
							</div>
							<div class="footer-widget widget-area mb-50 <?php echo esc_html( $resp_class );?>">
								<?php dynamic_sidebar( 'wyz-footer-2-sb' ); ?>
							</div>
							<div class="footer-widget widget-area mb-50 <?php echo esc_html( $resp_class );?>">
								<?php dynamic_sidebar( 'wyz-footer-3-sb' ); ?>
							</div>
							<div class="footer-widget widget-area mb-50 <?php echo esc_html( $resp_class );?>">
								<?php dynamic_sidebar( 'wyz-footer-4-sb' ); ?>
							</div>
					<?php
					}
				}?>
							
						</div>
					</div>
				</div>

			<?php }
		}

		private function navigations() {
			if ( has_nav_menu( 'footer' ) ) {?>
			<nav class="footer-menu text-center">
				<?php wp_nav_menu( array(
						'theme_location' => 'footer',
					) );?>
			</nav>
			<?php }
		}

		public function the_bottom_area() {
			?>
			<!-- Footer Bottom
			============================================ -->
			<div class="footer-bottom section">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<!-- Footer Menu -->
							<?php $this->navigations();?>
							<div class="col-md-2 col-sm-2"></div>
						</div>
					</div>
				</div>
			</div>
			<?php if ( 'on' === wyz_get_option( 'footer-copyrights-onoff' ) && '' !== wyz_get_option( 'copyrights-text' ) ) {?>
			<div id="copyrights">
				<div class="container">
					<div class="row">
						<div class="footer-bottom-content">
							<div class="col-xs-4">
							</div>
							<div class="col-xs-4">
								<p class="copyrights"><?php echo esc_html( wyz_get_option( 'copyrights-text' ) );?></p>
							</div>
							<div class="col-xs-4 float-right">
								<?php wyz_social_links();?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php }
		}
	}

}