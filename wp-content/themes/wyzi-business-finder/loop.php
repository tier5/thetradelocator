<?php
/**
 *
 * The main loop template
 *
 * @package wyz
 */

global $template_type;

if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();

		$is_sticky = is_sticky() && is_home() && ! is_paged();

		if ( $is_sticky ) {
			get_template_part( 'templates/post/post', "sticky$template_type" );
		} else {
			get_template_part( 'templates/post/post', $template_type );
		}
	endwhile;
	wyz_pagination();
	comments_template( '', true );
} else {
	get_template_part( 'content', 'none' );
}?>
