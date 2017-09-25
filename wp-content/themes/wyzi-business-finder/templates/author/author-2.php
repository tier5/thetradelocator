<?php global $template_type;?>
<div class="page-area section pt-90 pb-90">
	<div class="container">
		<div class="row">
		
			<?php get_template_part( 'sidebar/left-sidebar' ); ?>

			<div class="blogs<?php if ( 'full-width' === wyz_get_option( 'sidebar-layout' ) ) { ?> col-lg-12 col-md-12 col-xs-12"<?php } elseif ( 'off' == wyz_get_option( 'resp' ) ) { ?> col-xs-8<?php } else { ?> col-lg-9 col-md-8 col-xs-12<?php } ?>">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) :
						the_post();
						get_template_part( 'templates/search/search-content', $template_type );
					endwhile;
					wyz_pagination();
				} else {
					get_template_part( 'content', 'none' );
				}
				?>
			</div>

			<?php get_template_part( 'sidebar/right-sidebar' ); ?>

		</div>
	</div>
</div>
