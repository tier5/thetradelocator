<?php
/**
 * The author template file.
 *
 * @package wyz
 */

get_header();

global $template_type;

get_template_part( 'templates/author/author', $template_type );?>

<?php get_footer(); ?>
