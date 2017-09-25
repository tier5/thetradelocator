<?php
/**
 * The template for displaying search results pages.
 *
 * @package wyz
 */

get_header();

global $template_type;

get_template_part( 'templates/search/search', $template_type );

get_footer(); ?>
