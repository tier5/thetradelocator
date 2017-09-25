<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package wyz
 */

?>
<div class="page-no-results text-center">
		<h1><?php esc_html_e( 'Nothing Found', 'wyzi-business-finder' ); ?></h1>
	
		<p>
			<?php if ( is_search() ) : ?>
				<?php  esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wyzi-business-finder' );?>

			<?php else : ?>
				<?php  esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wyzi-business-finder' ); ?>
			<?php endif; ?>

			<?php wyz_no_content_search_form();?>
		</p>
</div>
