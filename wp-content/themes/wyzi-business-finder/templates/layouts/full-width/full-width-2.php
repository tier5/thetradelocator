<?php global $has_map;?>

<div class="section pb-90<?php if ( ! isset( $has_map ) || ! $has_map ) { echo ' pt-90'; }?>">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
	<?php if ( have_posts() ) : the_post(); ?>
		
		<div <?php post_class( 'page-content' ); ?>>
				<?php the_content();
				wyz_link_pages();?>
			
		</div>

	<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php comments_template(); ?>
