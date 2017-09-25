<div class="blog-page-area margin-bottom-100 margin-top-50">

	<div class="container">
		<div class="row">

			<div class="col-md-12">

			<?php if ( have_posts() ) :
				the_post();?>

				<div <?php post_class(); ?>>
					
						<?php the_content(); ?>

						<?php
						global $multipage;
						if ( $multipage ) {
							wp_link_pages( array(
								'before' => '<div class="page-link">' . esc_html__( 'Pages', 'wyzi-business-finder' ) . ':',
								'after' => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'wyzi-business-finder' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) ); 
						}
						?>
				</div>

			<?php endif; ?>
			<?php comments_template(); ?>
			</div>
		</div>
	</div>
</div>
