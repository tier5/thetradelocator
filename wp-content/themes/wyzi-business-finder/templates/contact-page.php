<?php
/**
 * Template Name: Contact
 *
 * @package wyz
 */

get_header();

$template_type = wyz_get_theme_template();

get_template_part( 'templates/layouts/contact/contact', $template_type );

get_footer(); ?>
