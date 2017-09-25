<div class="blog-page-area margin-bottom-100 margin-top-50">
	<div class="container">
		<div class="row">
		
			<?php get_template_part( 'sidebar/left-sidebar' ); ?>

			<div class="blogs<?php if ( 'full-width' === wyz_get_option( 'sidebar-layout' ) ) { ?> col-lg-12 col-md-12 col-xs-12"<?php } elseif ( 'off' == wyz_get_option( 'resp' ) ) { ?> col-xs-8<?php } else { ?> col-lg-9 col-md-8 col-xs-12<?php } ?>">

				<?php get_template_part( 'loop' ); ?>

			</div>

			<?php get_template_part( 'sidebar/right-sidebar' ); ?>

		</div>
	</div>
</div>