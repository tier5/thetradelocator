<?php
/**
 * Archive page template
 *
 * @package wyz
 */

get_header();

global $template_type;

get_template_part( 'templates/single/single', $template_type );?>

<?php get_footer();
