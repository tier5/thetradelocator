<?php
/**
 * Right Sidebar template
 *
 * @package wyz
 */

if ( 'right-sidebar' === wyz_get_option( 'sidebar-layout' ) ) :?>
	
	<div class="sidebar-container<?php if ( 'off' == wyz_get_option( 'resp' ) ) { ?> col-xs-4 <?php } else { ?> col-lg-3 col-md-4 col-xs-12<?php } ?>">
			
		<?php if ( is_active_sidebar( 'wyz-default-sidebar' ) ) : ?>

			<div class="widget-area sidebar-widget-area" role="complementary">
				
				<?php dynamic_sidebar( 'wyz-default-sidebar' ); ?>
			
			</div>

		<?php endif; ?>

	</div>
<?php endif; ?>
