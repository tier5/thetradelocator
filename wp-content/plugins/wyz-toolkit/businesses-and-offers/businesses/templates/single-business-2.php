<?php

/**
 * Get business map.
 */

$business_data->the_business_map();

//WyzHelpers::wyz_the_business_subheader( $id );
//add_action('init',function(){},99);$bk = new booked_plugin();$bk->plugin_settings_page();
?>

<!-- Business Tab Area
============================================ -->
<div class="page-area section pt-50 pb-90">
	<div class="container">
		<div class="row">

			<?php if ( 'on' == get_option( 'wyz_allow_business_post_edit' ) ) {
				require_once( $business_path . 'forms/post-edit-form.php' );
			}?>


			<!-- Business Content Area -->
			<div class="<?php if ( 'off' === wyz_get_option( 'resp' ) ) { ?> col-xs-8 <?php } else { ?> col-md-8 col-xs-12<?php } ?>">

				<!-- Business Tab List -->
				<div class="wall-tab-list-cont">
				<div class="wall-tab-list mb-50">
					<!-- <a id="tab-prev" class="tab-nav" href="#"><</a>
					<a id="tab-nxt" class="tab-nav" href="#">></a> -->
					<ul id="business-tabs">
						<?php $business_data->the_tabs();?>
					</ul>
				</div>
				</div>

				<div class="wall-tab-content tab-content section">
					<?php $business_data->the_tabs_content(); ?>
				</div>
			</div>
			<!-- Business Sidebar -->
			<?php WyzHelpers::the_business_sidebar( get_the_ID() );?>

		</div>
	</div>
</div>
<?php get_footer(); ?>
