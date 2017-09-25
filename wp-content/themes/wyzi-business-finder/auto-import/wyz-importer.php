<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

add_action( 'init', 'wyz_check_registration' );

$errors = array();

function wyz_check_registration() {
	global $errors;
	if ( isset( $_POST['wyz_registration_nonce'] ) && wp_verify_nonce( $_POST['wyz_registration_nonce'], 'wyz_registration_nonce_action' ) ) {
		$code = $_POST['wyz_product_registration'];
		if ( empty( $code ) ) {
			delete_option( 'wyz_registration_data' );
			return;
		}

		$url = 'https://api.envato.com/v3/market/buyer/list-purchases?filter_by=wordpress-themes';
		$response = wp_remote_get( esc_url_raw( $url ), array(
			'headers' => array(
				'Authorization' => 'Bearer ' . $code,
			),
			'timeout' => 200,
		    )
		);

		$response_code    = wp_remote_retrieve_response_code( $response );
		$response_message = $response['body'];

		if ( 200 !== $response_code && ! empty( $response_message ) ) {
			$errors[ $response_code ] = $response_message;
			return false;
		}

		if ( 200 !== $response_code ) {
			$errors[ $response_code ] = esc_html__( 'An unknown API error occurred.', 'wyzi-business-finder' );
			return false;
		}

		$return = json_decode( $response_message );
		if ( null === $return ) {
			$errors['api_error'] = esc_html__( 'An unknown API error occurred.', 'wyzi-business-finder' );
			return false;
		}

		$themes = array();
		$valid = false;
		foreach ( $return->results as $theme ) {
			if( $valid = wyz_normalize_theme( $theme->item ) )
				break;
		}

		$reg_data = array( 'valid' => $valid, 'code' => $code );
		update_option( 'wyz_registration_data', $reg_data );
		return;
	}
}


function wyz_normalize_theme( $theme ) {
	$name = ! empty( $theme->name ) ? $theme->name : '';
	return 'Wyzi - Business Finder and Service Provider Booking WordPress Social Look Directory Listing Theme' == $name;
}


function wyz_add_import_page() {
	
	add_management_page(
		esc_html__( 'Demo Content', 'wyzi-business-finder' ),
		esc_html__( 'Demo Content', 'wyzi-business-finder' ),
		'manage_options',
		'wyz_import',
		'wyz_demo_register_page'
	);
	
}
add_action('admin_menu', 'wyz_add_import_page');

function wyz_demo_register_page(){
	$reg_data = get_option( 'wyz_registration_data' );
	if ( empty( $reg_data ) || ! isset( $reg_data['code'] ) || '' == $reg_data['code'] ) {
		wyz_register_page();
		return;
	}

	if ( ! isset( $reg_data['valid'] ) || true != $reg_data['valid'] ) {
		wyz_register_page( $reg_data['code'], false );
		return;	
	}

	wyz_import_page();

}


function wyz_register_page( $code = '', $valid = false ) {
	?>
	<style>
		.wraapper{
			padding: 30px !important;
			background-color: #fff;
		}
		.wraapper .formm{
			margin: 0 1em;
			padding: 10px 15px;
			width: calc(100% - 2em - 180px);
			height: 40px;
		}
		.wraapper .sub{
			margin: 0;
			background-color: #00aeff;
			width: 150px;
			height: 35px;
		    line-height: 1;
		    border: none;
		    color: #fff;
		}
	</style>
	<div class="wrap"><br/>
		<h2 class="wraapper" style="margin-bottom:10px;"><?php _e('Thank you for choosing WYZI. Your product must be registered to receive demos. The instructions below must be followed exactly.', 'wyzi-business-finder'); ?></h2>

		<div class="container">
			<?php
			global $errors; 
				if ( ! empty( $errors ) ||( ! $valid && ! empty( $code ) ) ) {
					?>
					<div class="wraapper" style="margin-bottom:10px;">
						<h2 style="color: #ff000;">
							<?php esc_html_e( 'Invalid token provided', 'wyzi-business-finder' );?>
						</h2>
					</div>
					<?php
				}
				 /*global $errors;
				if ( ! empty( $errors ) && ( $valid || empty( $code )) ) {
					foreach ($errors as $key => $err) {
						$err = json_decode( $err );
						if ( property_exists( $err, 'message') ) echo '<p style="color: red;">' . $err->message . '</p>';
						else echo '<p style="color: red;">' . $err . '</p>';
					}
				}*/
			?>
			<div class="wraapper" style="border-bottom: 1px solid #ccc;">
				<form id="product-registration-form" method="post">
					<input class="formm" placeholder="<?php esc_html_e( 'Your Token ID, and not your purchase code', 'wyzi-business-finder');?>" type="text" name="wyz_product_registration" value="<?php echo $code;?>">
					<?php wp_nonce_field( 'wyz_registration_nonce_action', 'wyz_registration_nonce' );?>
					<input type="submit" class="sub" value="<?php esc_html_e( 'Submit', 'wyzi-business-finder' );?>"/>
				</form>
			</div>
			<div class="wraapper">
				<h3><?php esc_html_e( 'Instructions For Generating A Token', 'wyzi-business-finder' ); ?></h3>
					<ol>
						<li><?php printf( __( 'Click on this <a href="%1$s" target="_blank">Generate A Personal Token</a> link. <strong>IMPORTANT:</strong> You must be logged into the same Themeforest account that purchased %2$s. If you are logged in already, look in the top menu bar to ensure it is the right account. If you are not logged in, you will be directed to login then directed back to the Create A Token Page.', 'wyzi-business-finder' ), 'https://build.envato.com/create-token/?purchase:download=t&purchase:verify=t&purchase:list=t', 'WYZI' ); ?></li>
						<li><?php _e( 'Enter a name for your token, then check the boxes for <strong>View Your Envato Account Username, Download Your Purchased Items, List Purchases You\'ve Made</strong> and <strong>Verify Purchases You\'ve Made</strong> from the permissions needed section. Check the box to agree to the terms and conditions, then click the <strong>Create Token button</strong>', 'wyzi-business-finder' ); ?></li>
						<li><?php _e( 'A new page will load with a token number in a box. Copy the token number then come back to this registration page and paste it into the field below and click the <strong>Submit</strong> button.', 'wyzi-business-finder' ); ?></li>
						<li><?php esc_html_e( 'You will see a green check mark for success, or a failure message if something went wrong. If it failed, please make sure you followed the steps above correctly.', 'wyzi-business-finder' ); ?></li>
					</ol>
			</div>
		</div>
	</div>
	<?php
}

function wyz_import_page() {

	?>
	<div class="wrap">
		<h2><?php _e('One Click Demo Content Import', 'wyzi-business-finder'); ?></h2>
	<?php if(isset($_GET['import_completed'])) { ?>
		<br/><div class="updated"><p style="font-size:130%"><em><b><?php esc_html_e('Import of demo content completed! Enjoy!','wyzi-business-finder') ?></b></em></p></div>
	<?php } else { ?>
		<div class="updated"><p style="font-size:120%"><em><b><?php esc_html_e( 'Note', 'wyzi-business-finder' );?>:</b> <?php esc_html_e( 'Please, make sure that you\'ve installed all recommended plugins for the Theme, if you want to get correctly working demo.', 'wyzi-business-finder' ); ?></em></p></div>
		<table class="form-table">
			<col width="1%" /><col />
			<tbody>
				<tr>
					<td>
						<select id="wyz_which_demo">
							<option value="business_finder">Wyzi Business Finder</option>
							<option value="service_finder">Wyzi Service Finder</option>
							<option value="real_estate">Wyzi Real Estate</option>
							<option value="listing">Wyzi Listing</option>
						</select>
					</td>
					<td><?php esc_html_e( 'Select which demo you want to import', 'wyzi-business-finder' );?></td>
				</tr>
				<tr>
					<td><input type="button" class="button button-primary wyz_importer_start" data-import-attachments="0" value="<?php _e('Import demo content WITHOUT media files','wyzi-business-finder')?>" /></td>
					<td><?php _e('This is a quick import, which will import all pages, posts, menus, etc. without demo images.', 'wyzi-business-finder') ?></td>
				</tr>
				<tr>
					<td><input type="button" class="button button-primary wyz_importer_start" data-import-attachments="1" value="<?php esc_html_e( 'Import demo content WITH media files','wyzi-business-finder')?>" /></td>
					<td><?php _e('This will import all demo images, but it can take much time to complete an import.', 'wyzi-business-finder' ) ?></td>
				</tr>
			</tbody>
		</table>
		
		<div id="wyz_import_status" style="margin:20px 0;display:none"><span class="spinner is-active" id="wyz_spinner" style="display:inline-block;float:none;margin-top:0;position:relative;top:-2px"></span><span id="wyz_status_text"></span></div>
		<div id="wyz_progress" style="margin:20px 0;display:none;height:30px;line-height:30px;text-align:center;color:#fff;background:#aaa;position:relative;"><div id="wyz_progress_bar" style="width:0;position:absolute;top:0;left:0;bottom:0;background:#2fc600"></div><div id="wyz_progress_text" style="position:relative"></div></div>
	<?php } ?>	
	</div>
	<?php	
	
	echo '<div id="wyz_status"></div>';
	
}

/*******************************************************/

function wyz_import_scripts( $hook ) {
	if ( 'tools_page_wyz_import' != $hook ) {
		return;
	}
	wp_enqueue_script( 'wyz_import_js', get_template_directory_uri() . '/auto-import/assets/js/core.js' );
}
add_action( 'admin_enqueue_scripts', 'wyz_import_scripts' );


/*******************************************************/

add_action('wp_ajax_wyz_demo_import', 'wyz_ajax_import');

function wyz_ajax_import() {

	if ( ! current_user_can( 'manage_options' ) )
		wp_die();

	if ( get_magic_quotes_gpc() ) {
		$_POST = stripslashes_deep( $_POST );
	}
	
	if( ! isset( $_POST['wyz_importing_action'] ) ) {
		wp_die();
	}

	if ( ini_get( 'max_execution_time' ) < 300 ) {
		set_time_limit( 300 );
	}

	$Import_Data['wyzImport'] = array();
	switch ( $_POST['wyz_which_demo'] ) {
		case 'business_finder':
			$Import_Data['wyzImport']['content'] = WYZ_IMPORT_URI . '/demo_content/business-finder-demo/content.xml';
			$Import_Data['wyzImport']['widgets'] = WYZ_IMPORT_URI . '/demo_content/business-finder-demo/widgets.json';
			$Import_Data['wyzImport']['theme_options'] = WYZ_IMPORT_URI . '/demo_content/business-finder-demo/theme_options.txt';
			$Import_Data['wyzImport']['wyz_wp_options'] = WYZ_IMPORT_URI . '/demo_content/business-finder-demo/wyz-wp-options.txt';
			$Import_Data['wyzImport']['wyz_ess_grid'] = WYZ_IMPORT_URI . '/demo_content/business-finder-demo/ess_grid.json';
			break;
		case 'service_finder':
			$Import_Data['wyzImport']['content'] = WYZ_IMPORT_URI . '/demo_content/service-finder-demo/content.xml';
			$Import_Data['wyzImport']['widgets'] = WYZ_IMPORT_URI . '/demo_content/service-finder-demo/widgets.json';
			$Import_Data['wyzImport']['theme_options'] = WYZ_IMPORT_URI . '/demo_content/service-finder-demo/theme_options.txt';
			$Import_Data['wyzImport']['wyz_wp_options'] = WYZ_IMPORT_URI . '/demo_content/service-finder-demo/wyz-wp-options.txt';
			$Import_Data['wyzImport']['wyz_ess_grid'] = WYZ_IMPORT_URI . '/demo_content/service-finder-demo/ess_grid.json';
			break;
		case 'real_estate':
			$Import_Data['wyzImport']['content'] = WYZ_IMPORT_URI . '/demo_content/real-estate-demo/content.xml';
			$Import_Data['wyzImport']['widgets'] = WYZ_IMPORT_URI . '/demo_content/real-estate-demo/widgets.json';
			$Import_Data['wyzImport']['theme_options'] = WYZ_IMPORT_URI . '/demo_content/real-estate-demo/theme_options.txt';
			$Import_Data['wyzImport']['wyz_wp_options'] = WYZ_IMPORT_URI . '/demo_content/real-estate-demo/wyz-wp-options.txt';
			$Import_Data['wyzImport']['wyz_ess_grid'] = WYZ_IMPORT_URI . '/demo_content/real-estate-demo/ess_grid.json';
			break;
		case 'listing':
			$Import_Data['wyzImport']['content'] = WYZ_IMPORT_URI . '/demo_content/listing-demo/content.xml';
			$Import_Data['wyzImport']['widgets'] = WYZ_IMPORT_URI . '/demo_content/listing-demo/widgets.json';
			$Import_Data['wyzImport']['theme_options'] = WYZ_IMPORT_URI . '/demo_content/listing-demo/theme_options.txt';
			$Import_Data['wyzImport']['wyz_wp_options'] = WYZ_IMPORT_URI . '/demo_content/listing-demo/wyz-wp-options.txt';
			$Import_Data['wyzImport']['wyz_ess_grid'] = WYZ_IMPORT_URI . '/demo_content/listing-demo/ess_grid.json';
			break;
	}
	
	switch( $_POST['wyz_importing_action'] ) {
		
		case 'start':

			$data = array( 'error' => 0 );
			
			if ( ! file_exists( $Import_Data['wyzImport']['content'] ) ) {
				$data['error'] = 1;
				wp_send_json( $data );
			}
					
			if ( ! class_exists( 'WXR_Parser' ) ) {
				require WYZ_IMPORT_URI . '/includes/parsers.php';
			}
		
			$parser = new WXR_Parser();
			$import_data = $parser->parse( $Import_Data['wyzImport']['content'] );
			unset( $parser );

			if ( is_wp_error( $import_data ) ) {
				$data['error'] = 1;
				wp_send_json($data);
			}
			
			$data['common']=array(
				'base_url' => esc_url( $import_data['base_url'] ),
			);
			$data['attachments']=array();
			
			$author = (int) get_current_user_id();
			
			foreach ( $import_data['posts'] as $post ) {

				if( 'attachment' == $post['post_type'] ) {
					
					$post_parent = (int) $post['post_parent'];
					
					$postdata = array(
						'import_id' => $post['post_id'], 'post_author' => $author, 'post_date' => $post['post_date'],
						'post_date_gmt' => $post['post_date_gmt'], 'post_content' => $post['post_content'],
						'post_excerpt' => $post['post_excerpt'], 'post_title' => $post['post_title'],
						'post_status' => $post['status'], 'post_name' => $post['post_name'],
						'comment_status' => $post['comment_status'], 'ping_status' => $post['ping_status'],
						'guid' => $post['guid'], 'post_parent' => $post_parent, 'menu_order' => $post['menu_order'],
						'post_type' => $post['post_type'], 'post_password' => $post['post_password']
					);
					
					$remote_url = ! empty( $post['attachment_url'] ) ? $post['attachment_url'] : $post['guid'];
					
					$postdata['upload_date'] = $post['post_date'];
					if ( isset( $post['postmeta'] ) ) {
						foreach( $post['postmeta'] as $meta ) {
							if ( $meta['key'] == '_wp_attached_file' ) {
								if ( preg_match( '%^[0-9]{4}/[0-9]{2}%', $meta['value'], $matches ) )
									$postdata['upload_date'] = $matches[0];
								break;
							}
						}
					}
					
					$postdata['postmeta']=$post['postmeta'];
					
					$data['attachments'][]=array(
						'data' => $postdata,
						'remote_url' => $remote_url,
					);
					
				}
			}
			
			$data['last_attachment_index'] = -1;
			$variables_dump = get_option( 'wyz_import_process_data');
			if ( ! empty( $variables_dump ) && is_array( $variables_dump ) ) {
				if ( isset( $variables_dump['last_attachment_index'] ) ) {
					$data['last_attachment_index'] = $variables_dump['last_attachment_index'];
				}
			}
			
			wp_send_json($data);
		
		break;
		
		case 'process_attachments':
		
			$ret = array('error' => 0);
			
			if ( isset( $_POST['data']['attachments'] ) ) {
				
				if ( ! defined('WP_LOAD_IMPORTERS') ) {
					define('WP_LOAD_IMPORTERS', true);
				}
				
				if ( ! class_exists('WP_Import') ) {
					include WYZ_IMPORT_URI . '/includes/wordpress-importer.php';
				}

	    		if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) {

					$importer = new WP_Import();
					$importer->base_url = $_POST['data']['common']['base_url'];
					$importer->fetch_attachments = true;
					
					$variables_dump = get_option( 'wyz_import_process_data' );
					if ( ! empty( $variables_dump ) && is_array( $variables_dump ) ) {
						$importer->post_orphans = $variables_dump['post_orphans'];
						$importer->processed_posts = $variables_dump['processed_posts'];
						$importer->url_remap = $variables_dump['url_remap'];
					}
					
					$last_attachment_index=$_POST['data']['first_attachment_index'];

					foreach ( $_POST['data']['attachments'] as $attachment ) {
						
						$post = $attachment['data'];

						$importer->post_orphans[ intval( $post['import_id'] ) ] = (int) $post['post_parent'];
						$post['post_parent'] = 0;
				
						$post_id = $importer->process_attachment( $post, $attachment['remote_url'] );
						
						if ( is_wp_error( $post_id ) ) {
							continue;
						}
						
						$importer->processed_posts[ intval( $post['import_id'] ) ] = (int) $post_id;

						// add/update post meta
						if ( ! empty( $post['postmeta'] ) ) {
							foreach ( $post['postmeta'] as $meta ) {
								$key = $meta['key'];
								$value = false;
			
								if ( '_edit_last' == $key ) {
									continue;
								}
			
								if ( $key ) {
									if ( ! $value ){
										$value = maybe_unserialize( $meta['value'] );
									}
									add_post_meta( $post_id, $key, $value );
								}
							}
						}
												
						$variables_dump['last_attachment_index'] = $last_attachment_index;
						$last_attachment_index++;
						
					}

					$variables_dump['post_orphans'] = $importer->post_orphans;
					$variables_dump['processed_posts'] = $importer->processed_posts;
					$variables_dump['url_remap'] = $importer->url_remap;
					update_option( 'wyz_import_process_data', $variables_dump );
						
						
				}
			}
			
			wp_send_json($ret);
			
		break;
		
		case 'process_other':
		
			$ret = array( 'error' => 0 );
			
			if ( ! file_exists( $Import_Data['wyzImport']['content'] ) ) {
				$ret['error'] = 1;
				wp_send_json( $ret );
			}
			
			if ( ! defined('WP_LOAD_IMPORTERS') ) {
				define('WP_LOAD_IMPORTERS', true);
			}
			
			if ( ! class_exists( 'WP_Import' ) ) {
				include WYZ_IMPORT_URI . '/includes/wordpress-importer.php';
			}

      		if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) {
	
				$importer = new WP_Import();
				$importer->fetch_attachments = false;

				$variables_dump = get_option( 'wyz_import_process_data' );
				if ( ! empty( $variables_dump ) && is_array( $variables_dump ) ) {

					$importer->post_orphans = $variables_dump['post_orphans'];
					$importer->processed_posts = $variables_dump['processed_posts'];
					$importer->url_remap = $variables_dump['url_remap'];

				}
				
								
				ob_start();

				$importer->import( $Import_Data['wyzImport']['content'] );

				ob_end_clean();
				
				update_option( 'wyz_import_process_data', false );


				$locations = get_theme_mod( 'nav_menu_locations' );
				$menus = wp_get_nav_menus();

				if ( $menus ) {
					$theme_menus = array(
						'Login Menu' => 'login',
						'Main Menu' => 'primary',
						'Footer Menu' => 'footer',
					);
					foreach ( $menus as $menu ) {
						if ( isset( $theme_menus[ $menu->name ] ) ) {
							$locations[ $theme_menus[ $menu->name ] ] = $menu->term_id;
						}
					}
				}
	      		set_theme_mod( 'nav_menu_locations', $locations );


				// Import Theme Options
				if( function_exists( 'ot_import_xml' ) ) {

					$file = $Import_Data['wyzImport']['theme_options'];
					// Does the File exist?
					if ( file_exists( $file )  ) {

						// Get file contents and decode
						$data = file_get_contents( $file );
						// Import option tree demo data.
						$options = unserialize( ot_decode( $data ) );

						/* get settings array */
						$settings = get_option( ot_settings_id() );

						/* has options */
						if ( is_array( $options ) ) {

							/* validate options */
							if ( is_array( $settings ) ) {

								foreach( $settings['settings'] as $setting ) {

									if ( isset( $options[$setting['id']] ) ) {

										$content = ot_stripslashes( $options[$setting['id']] );

										$options[$setting['id']] = ot_validate_setting( $content, $setting['type'], $setting['id'] );

									}
								}
							}
							/* update the option tree array */
							update_option( ot_options_id(), $options );
						}
					}
				}

				//Import WYZI Wp Options
				$file = $Import_Data['wyzImport']['wyz_wp_options'];
				// Does the File exist?
				if ( file_exists( $file )  ) {

					// Get file contents
					$data = file_get_contents( $file );
					//remove start and finish indicators
					$data = str_replace("<!*!* START export Code !*!*>\n","",$data );
					$data = str_replace("\n<!*!* END export Code !*!*>","",$data );
					//decode the data
					$data = base64_decode( $data );
					$options = unserialize( $data );

					/* has options */
					if ( is_array( $options ) ) {

						foreach ($options as $key => $value) {
							if ("wyz_business_tabs_order_data" != $key ){
								update_option( $key, $value );
						    }
						}
					}
				}

				//Essencial grid
				if ( file_exists( WP_PLUGIN_DIR.'/essential-grid/essential-grid.php' ) ) :
					if ( ! class_exists( 'Essential_Grid_Import' ) ) {
						require_once( WP_PLUGIN_DIR.'/essential-grid/essential-grid.php');
						require_once( WP_PLUGIN_DIR.'/essential-grid/admin/includes/import.class.php');
					}
					$ess_im = new Essential_Grid_Import();

					$ess_grid = file_get_contents(  $Import_Data['wyzImport']['wyz_ess_grid'] );

					$ess_grid = json_decode($ess_grid,true);

					$skins = $ess_grid['skins'];
					$skin_ids = array();
					foreach($skins as $skin){
						$skin_ids[] = $skin['id'];
					}
					$ess_im->import_skins($skins,$skin_ids);

					$ess_im->import_grids($ess_grid['grids']);
				endif;



				// Widgets
				if ( file_exists( $Import_Data['wyzImport']['widgets'] ) ) {
					
					if ( ! function_exists( 'wie_available_widgets') ) {
						require WYZ_IMPORT_URI . '/includes/widgets-widgets.php';
					}
					if ( ! function_exists( 'wie_import_data' ) ) {
						require WYZ_IMPORT_URI . '/includes/widgets-import.php';
					}
					
					$data = json_decode( file_get_contents( $Import_Data['wyzImport']['widgets'] ) );
					wie_import_data( $data );
				}


				// Set reading options
				$homepage = get_page_by_title( 'Home' );
				if ( $homepage ) {
					update_option( 'page_on_front', $homepage->ID );
					update_option( 'show_on_front', 'page' );
				}

				$blog = get_page_by_title( 'Blog' );
				if ( $blog ) {
					update_option( 'page_for_posts', $blog->ID );
				}

				global $wp_rewrite;
				$wp_rewrite -> set_permalink_structure( '/%postname%/' );
				update_option( 'rewrite_rules', false );
				$wp_rewrite->flush_rules( true );

				update_option('wyz_just_imported','WYZ_JUST_IMPORTED_FLAG' );

			}
		
			wp_send_json($ret);
			
		break;
	}
}