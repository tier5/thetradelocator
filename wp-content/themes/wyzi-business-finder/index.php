<?php
/**
 * The main template file.
 *
 * @package wyz
 */

get_header();


global $template_type;
get_template_part( 'templates/blog/blog', $template_type );
?>


<?php get_footer(); ?>
