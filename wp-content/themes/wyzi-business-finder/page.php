<?php
/**
 * Single page template
 *
 * @package wyz
 */

get_header();

global $template_type;

get_template_part( 'templates/page/page', $template_type );

get_footer(); ?>
