<?php
/**
 * Template Name: Full Width
 *
 * @package wyz
 */

get_header();

$template_type = wyz_get_theme_template();

get_template_part( 'templates/layouts/full-width/full-width', $template_type );

get_footer(); ?>
