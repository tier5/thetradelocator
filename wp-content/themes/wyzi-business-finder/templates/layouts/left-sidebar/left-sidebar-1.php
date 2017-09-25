<?php

global $has_map;?>
<div class="margin-bottom-100<?php if ( ! isset( $has_map ) || ! $has_map ) { echo ' margin-top-50'; }?>">
	<div class="container">
		<div class="row">

			<!--left sidebar -->
			<div class="sidebar-container<?php if ( 'off' === wyz_get_option( 'resp' ) ) { ?> col-xs-4 <?php } else { ?> col-lg-3 col-md-4 col-xs-12<?php } ?>">
				<?php if ( is_active_sidebar( 'wyz-left-sidebar' ) ) : ?>
						<div id="secondary" class="widget-area sidebar-widget-area" role="complementary">
							<?php dynamic_sidebar( 'wyz-left-sidebar' ); ?>
						</div>
				<?php endif; ?>
			</div>

			<div class="<?php if ( 'off' === wyz_get_option( 'resp' ) ) { ?>col-xs-8<?php } else { ?>col-lg-9 col-md-8 col-xs-12<?php } ?>"> 
				
				<?php if ( have_posts() ) :

					the_post(); ?>

					<div <?php post_class( 'page-content' ); ?>>
						<?php the_content();
						wyz_link_pages();?>
					</div>
				<?php endif;
				comments_template(); ?>
			</div>
		</div>
	</div>
</div>
