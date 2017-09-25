<?php
/**
 * The template for displaying Comments
 *
 * @package wyz
 */

if ( post_password_required() ) {
	return;
}

global $template_type;

get_template_part( 'templates/comments/comments', $template_type );
