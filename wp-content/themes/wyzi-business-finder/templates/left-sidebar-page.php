<?php
/**
 * Template Name: Left Sidebar
 *
 * @package wyz
 */

get_header();

$template_type = wyz_get_theme_template();

get_template_part( 'templates/layouts/left-sidebar/left-sidebar', $template_type );

get_footer(); ?>
