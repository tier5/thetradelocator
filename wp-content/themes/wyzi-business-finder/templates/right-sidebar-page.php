<?php
/**
 * Template Name: Right Sidebar
 *
 * @package wyz
 */

get_header();

$template_type = wyz_get_theme_template();

get_template_part( 'templates/layouts/right-sidebar/right-sidebar', $template_type );

get_footer(); ?>
