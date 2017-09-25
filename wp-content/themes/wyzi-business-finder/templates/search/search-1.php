<div class="blog-page-area margin-bottom-100 margin-top-50">
	<div class="container">
		<div class="row">
			<?php get_template_part( 'sidebar/left-sidebar' ); ?>

			<div class="blogs<?php if ( 'full-width' === wyz_get_option( 'sidebar-layout' ) ) { ?> col-lg-12 col-md-12 col-xs-12"<?php } elseif ( 'off' == wyz_get_option( 'resp' ) ) { ?> col-xs-8<?php } else { ?> col-lg-9 col-md-8 col-xs-12<?php } ?>">

				<?php if ( '' !== trim( get_search_query() ) ) :
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							if( 'product' == get_post_type() )
								get_template_part( 'content', 'product' );
							else
								get_template_part( 'content', 'search' );
						endwhile;
						wyz_pagination();
					else :
						get_template_part( 'content', 'none' );
					endif;

				else :
					get_template_part( 'content', 'empty-search' );
				endif;?>

			</div>

			<?php get_template_part( 'sidebar/right-sidebar' ); ?>

		</div>
	</div>
</div>
