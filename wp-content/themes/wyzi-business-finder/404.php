<?php
/**
 * 404 page template
 *
 * @package wyz
 */

get_header(); 

global $template_type;

get_template_part( 'templates/404/404', $template_type );

get_footer(); ?>
