<div class="page-area section pt-90 pb-90">
	<div class="container">
		<div class="row">

			<div class="<?php if ( 'off' === wyz_get_option( 'resp' ) ) { ?>col-xs-9 <?php } else { ?>blogs col-lg-9 col-md-8 col-xs-12<?php } ?>"> 

				<?php if ( have_posts() ) :
					the_post(); ?>

					<div <?php post_class(); ?>>
		
						<div class="page-content">
							<?php the_content();
						 	if ( is_sticky() && is_home() && ! is_paged() ) {
								printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'wyzi-business-finder' ) );
							}
							wp_link_pages( array(
								'before' => '<div class="page-link">' . esc_html__( 'Pages:', 'wyzi-business-finder' ),
								'after' => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'wyzi-business-finder' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) ); ?>
						</div>

						<?php comments_template(); ?>
					</div>
				<?php endif; ?>
			</div>
			
			<!--right sidebar -->
			<div class="sidebar-container<?php if ( 'off' === wyz_get_option( 'resp' ) ) { ?> col-xs-4 <?php } else { ?> col-lg-3 col-md-4 col-xs-12<?php } ?>">
				<!--main-right-column-->
				<?php if ( is_active_sidebar( 'wyz-contact-sidebar' ) ) : ?>
					<div id="secondary" class="widget-area sidebar-wrapper sidebar-widget-area" role="complementary">
						<?php dynamic_sidebar( 'wyz-contact-sidebar' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer(); ?>
