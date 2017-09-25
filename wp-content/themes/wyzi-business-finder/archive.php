<?php
/**
 * The archive template file.
 *
 * @package wyz
 */

get_header();

global $template_type;

get_template_part( 'templates/archive/archive', $template_type );

 get_footer(); ?>
