<?php
/**
 * Template Name: Business Listing
 *
 * @package wyz
 */

get_header();
global $has_map;
// Let register Essential Grid Scripts in this page in case template 2 is chosen
if ( function_exists( 'wyz_get_theme_template' ) ) {
		$template_type = wyz_get_theme_template();

	if ( $template_type == 2 ) {
		if (class_exists('Essential_Grid'))
		Essential_Grid::register_shortcode(array("alias"=>""));
	}	
}

?>
<div class="margin-bottom-100">
	<div class="container">
		<div class="row">

			<!--left sidebar -->
			<?php $sb_template = get_post_meta( get_the_ID(), 'wyz_listing_page_sidebar', true );
			if ( 'left-sidebar' == $sb_template ){?>
			<div class="sidebar-container<?php if ( 'off' === wyz_get_option( 'resp' ) ) { ?> col-xs-4 <?php } else { ?> col-lg-3 col-md-4 col-xs-12<?php } ?>">
				<?php if ( is_active_sidebar( 'wyz-business-listing-sb' ) ) : ?>
						<div id="secondary" class="widget-area sidebar-widget-area" role="complementary">
							<?php dynamic_sidebar( 'wyz-business-listing-sb' ); ?>
						</div>
				<?php endif; ?>
			</div>
			<?php }?>

			<div class="<?php if ( 'full-width' == $sb_template ) { ?>col-lg-12 col-md-12 col-xs-12 listing-no-sidebar<?php } elseif ( 'off' === wyz_get_option( 'resp' ) ) { ?>col-xs-8<?php } else { ?>col-lg-9 col-md-8 col-xs-12 listing-with-sidebar<?php } ?>">

				<div id="business-list" class="animated  fadeInDown"></div>
				
				<?php if ( have_posts() ) :

					the_post(); ?>

					<div <?php post_class( 'page-content' ); ?>>
						<?php the_content();
						wyz_link_pages();?>
					</div>
				<?php endif;
				comments_template(); ?>
			</div>

			<?php if ( 'right-sidebar' == $sb_template ){?>
			<div class="sidebar-container<?php if ( 'off' === wyz_get_option( 'resp' ) ) { ?> col-xs-4 <?php } else { ?> col-lg-3 col-md-4 col-xs-12<?php } ?>">
				<?php if ( is_active_sidebar( 'wyz-business-listing-sb' ) ) : ?>
						<div id="secondary" class="widget-area sidebar-widget-area" role="complementary">
							<?php dynamic_sidebar( 'wyz-business-listing-sb' ); ?>
						</div>
				<?php endif; ?>
			</div>
			<?php }?>

		</div>
	</div>
</div>
<?php get_footer(); ?>
