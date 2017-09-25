<?php
/**
 * The template part for displaying results in search pages
 *
 * @package wyz
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	global $template_type;

	if ( 'wyz_business' === get_post_type() && class_exists('WyzBusinessPost') ) {

		if ( 1 == $template_type ) {

			echo WyzBusinessPost::wyz_create_business();
		}
		elseif ( 2 == $template_type ) {
			$grid_alias = wyz_get_option( 'listing_search_ess_grid' );
			if ( '' != $grid_alias )
				echo do_shortcode( '[ess_grid alias="' . $grid_alias .'" posts='.get_the_ID().']' );
		}

	} else {
		get_template_part( 'templates/search/search-content', $template_type );
	}
	?>

</div>
