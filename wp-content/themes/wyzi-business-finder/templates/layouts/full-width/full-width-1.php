<?php

global $has_map;?>
<div class="margin-bottom-100<?php if ( ! isset( $has_map ) || ! $has_map ) { echo ' margin-top-50'; }?>">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
	<?php if ( have_posts() ) : the_post(); ?>
		
				<div <?php post_class( 'page-content' ); ?>>
						<?php the_content();
						wyz_link_pages();?>
					
				</div>

		<?php endif; ?>
		<?php comments_template(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
