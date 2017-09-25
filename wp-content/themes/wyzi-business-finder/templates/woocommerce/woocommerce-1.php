<div class="blog-page-area margin-bottom-100 margin-top-50">

	<div class="container">
		<div class="row">

			<?php get_template_part( 'sidebar/left-sidebar-shop' ); ?>

			<div class="<?php if ( 'full-width' === wyz_get_option( 'shop-sidebar-layout' ) ) { ?> col-lg-12 col-md-12 col-xs-12"<?php } elseif ( 'off' == wyz_get_option( 'resp' ) ) { ?> col-xs-8<?php } else { ?> col-lg-9 col-md-8 col-xs-12<?php } ?>">

			<?php woocommerce_content(); ?>
			</div>

			<?php get_template_part( 'sidebar/right-sidebar-shop' ); ?>

		</div>
	</div>
</div>
