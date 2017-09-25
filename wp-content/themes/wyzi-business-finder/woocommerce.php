<?php
/**
 * Single page template
 *
 * @package wyz
 */

get_header();


global $template_type;

get_template_part( 'templates/woocommerce/woocommerce', $template_type );

get_footer(); ?>