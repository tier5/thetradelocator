<?php
/**
 * The search form
 *
 * @package wyz
 */

?>

<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url() ); ?>/">
	<span><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php esc_html_e( 'search something', 'wyzi-business-finder' );?>" /></span>
	<button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
</form>
