<?php
/**
 * Theme Functions
 *
 * @package wyz
 * @author WzTechno
 * @link http://www.wztechno.com
 */
define( 'WYZ_THEME_DIR', get_template_directory() );
define( 'WYZ_THEME_URI', get_template_directory_uri() );
define( 'WYZ_CSS_DIR', WYZ_THEME_DIR . '/css' );
define( 'WYZ_CSS_URI', WYZ_THEME_URI . '/css' );
define( 'WYZ_IMPORT_DIR', WYZ_THEME_DIR . '/auto-import' );
define( 'WYZ_IMPORT_URI', WYZ_THEME_DIR . '/auto-import' );
define( 'WYZ_TEMPLATES_DIR', WYZ_THEME_DIR . '/templates' );
define('ULTIMATE_NO_EDIT_PAGE_NOTICE', true);
define('ULTIMATE_NO_PLUGIN_PAGE_NOTICE', true);

/*
===========================================================================
 * Loads theme options files
=========================================================================
*/

require_once( WYZ_THEME_DIR . '/includes/theme-options.php' );

/*
===========================================================================
 * Add theme supports
===========================================================================
*/

add_action( 'after_setup_theme', 'wyz_after_theme_setup' );

/**
 * Add theme supports and includes one-click importer.
 */
function wyz_after_theme_setup() {
	global $wp_version, $content_width;
	if ( version_compare( $wp_version, '3.0', '>=' ) ) {
		add_theme_support( 'automatic-feed-links' );
	}
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	if ( ! isset( $content_width ) ) {
		$set_width = wyz_get_option( 'content-width' );
		if ( ! isset( $set_width ) || empty( $set_width ) ) {
			$content_width = 1140;
		} else {
			$content_width = esc_html( $set_width );
		}
	}

	if ( ! function_exists( '_wp_render_title_tag' ) ) {
		/**
		 * Displays title in page header.
		 */
		function wyz_render_title() {?>
			<title><?php wp_title();?></title>
		<?php }
		add_action( 'wp_head', 'wyz_render_title' );
	} else {
		add_theme_support( 'title-tag' );
	}
	add_theme_support( 'custom-background' );
	add_theme_support( 'custom-logo' );

    load_theme_textdomain( 'wyzi-business-finder', WYZ_THEME_DIR . '/languages' );

	require WYZ_IMPORT_URI . '/wyz-importer.php';
}

require_once( WYZ_THEME_DIR . '/wyz-core/wyz-hooks.php' );
require_once( WYZ_THEME_DIR . '/wyz-core/server-status.php' );

// Register Custom Navigation Walker.
require_once( WYZ_THEME_DIR . '/includes/wp_bootstrap_navwalker.php' );


if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'wyzi-business-finder' ),
		'footer' => esc_html__( 'Footer Menu', 'wyzi-business-finder' ),
		'login' => esc_html__( 'Login Menu', 'wyzi-business-finder' ),
	) );
}

// Get headers.
require_once( WYZ_TEMPLATES_DIR . '/headers/header-factory.php' );

// Get footers.
require_once( WYZ_TEMPLATES_DIR . '/footers/footer-factory.php' );

// Get sidebars.
require_once( WYZ_THEME_DIR . '/sidebar/register-sidebars.php' );

// Filter for theme options.
require_once( WYZ_THEME_DIR . '/wyz-core/theme-options-filters.php' );

// Get wizy core functions.
require_once( WYZ_THEME_DIR . '/wyz-core/wyz-core-functions.php' );

// Register required plugins.
require_once( WYZ_THEME_DIR . '/TGMPA/setup.php' );

// Specify the number of Items per shop page in Woocommerce
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 8;' ), 20 );


function wcgod_add_our_script() {

	wp_register_script( 'ajax-js', get_template_directory_uri(). '/js/get.cart.content.total.js', array( 'jquery' ), '', true );

		wp_localize_script( 'ajax-js', 'ajax_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'home' => home_url(), 'template_folder' => get_template_directory_uri(), 'stripe_test_key' => get_option('edit_test_api_key'), 'stripe_mode' => get_option('edit_check_mode'), 'stripe_live_key' => get_option('edit_live_api_key') ) );
	wp_enqueue_script( 'ajax-js' );
	
	
}
add_action( 'wp_enqueue_scripts', 'wcgod_add_our_script' );

function wcgod_cart_content_ajax_function() {

	global $woocommerce;
	$cart_contents_count = $woocommerce->cart->cart_contents_count+1;
	echo $cart_contents_count;
	wp_die();
}
add_action("wp_ajax_wcgod_cart_content_ajax_function","wcgod_cart_content_ajax_function");
add_action("wp_ajax_nopriv_wcgod_cart_content_ajax_function","wcgod_cart_content_ajax_function");



function wcgod_autoLoginUser($user_id){
$user = get_user_by( 'id', $user_id );
if( $user ) {
wp_set_current_user( $user_id, $user->user_login );
wp_set_auth_cookie( $user_id );
do_action( 'wp_login', $user->user_login, $user);
}
}

/**
* Adding Stripe Options page
*/
require_once get_template_directory()."/includes/stripe-options.php";


?>
