<?php global $has_map;?>
<div class="pb-90 <?php if ( ! isset( $has_map ) || ! $has_map ) { echo ' pt-90'; }?>">
	<div class="container">
		<div class="row">

			<div class="<?php if ( 'off' === wyz_get_option( 'resp' ) ) { ?>col-xs-8<?php } else { ?>col-lg-9 col-md-8 col-xs-12<?php } ?>"> 
				
				<?php if ( have_posts() ) :
					the_post(); ?>

					<div <?php post_class( 'page-content' ); ?>>
						<?php the_content();
						wyz_link_pages();?>
					
					</div>
				
				<?php endif; ?>
			
			</div>
			
			<!--right sidebar -->
			<div class="sidebar-wrapper<?php if ( 'off' === wyz_get_option( 'resp' ) ) { ?> col-xs-4 <?php } else { ?> col-lg-3 col-md-4 col-xs-12<?php } ?>">
				<?php if ( is_active_sidebar( 'wyz-right-sidebar' ) ) : ?>
						<div id="secondary" class="widget-area sidebar-widget-area" role="complementary">
							<?php dynamic_sidebar( 'wyz-right-sidebar' ); ?>
						</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
