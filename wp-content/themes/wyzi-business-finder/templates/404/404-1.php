<div class="page-404 text-center">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">

			<?php $ttl = wyz_get_option( '404_title' );
			echo '<h1>';
			if ( '' !== $ttl ) {
			  echo esc_html( $ttl );
			} else {
				esc_html_e( 'Error 404', 'wyzi-business-finder' );
			}
			echo '</h1><p>';

			$cont = wyz_get_option( '404_textarea' );

			if ( '' !== $cont ) {
				echo wp_kses_post( $cont );
			} else {
				esc_html_e( 'ERROR PAGE - WHAT YOU ARE LOOKING FOR IS NOT HERE', 'wyzi-business-finder' );
			} 
			wyz_no_content_search_form();

			?>
				
			</div>

		</div>

	</div>

</div>
