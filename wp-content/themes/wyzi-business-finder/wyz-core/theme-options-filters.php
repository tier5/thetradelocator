<?php
/**
 * Option tree filters
 *
 * @package wyz
 */

/**
 * Filters for theme options' typograohy.
 *
 * @param array   $array Holds data to be filtered.
 * @param integer $field_id Is the is of the ot item.
 */
function wyz_typography_fields( $array, $field_id ) {

	/* only run the filter where the field ID is 'menu_font'  */
	if ( 0 === strpos( $field_id, 'menu-font' ) || 0 === strpos( $field_id, 'logo-font' ) ) {
		$array = array( 'font-size', 'font-style', 'font-weight' );
	} elseif ( 0 === strpos( $field_id, 'strip-font' ) ) { // Only run the filter where the field ID is 'menu_font'.
		$array = array( 'font-size' );
	} elseif ( 0 === strpos( $field_id, 'wyz-typography' ) ) {
		$array = array( 'font-size','font-style', 'font-family','font-color','letter-spacing' );
	} elseif ( 0 === strpos( $field_id, 'h1-typography' ) ) {
		$array = array( 'font-size','font-family','font-style','font-color' );
	} elseif ( 0 === strpos( $field_id, 'h2-typography' ) ) {
		$array = array( 'font-size','font-family','font-style','font-color' );
	} elseif ( 0 === strpos( $field_id, 'h3-typography' ) ) {
		$array = array( 'font-size','font-family','font-style','font-color' );
	} elseif ( 0 === strpos( $field_id, 'h4-typography' ) ) {
		$array = array( 'font-size','font-family','font-style','font-color' );
	} elseif ( 0 === strpos( $field_id, 'h5-typography' ) ) {
		$array = array( 'font-size','font-family','font-style','font-color' );
	} elseif ( 0 === strpos( $field_id, 'h6-typography' ) ) {
		$array = array( 'font-size','font-family','font-style','font-color' );
	}
	return $array;
}
add_filter( 'ot_recognized_typography_fields','wyz_typography_fields', 10, 2 );

/**
 * Filters for theme options' dimension field.
 *
 * @param array   $array Holds data to be filtered.
 * @param integer $field_id Is the is of the ot item.
 */
function wyz_dimension_fields( $array, $field_id  ) {
	if ( 0 === strpos( $field_id, 'nice-scroll-scrollbar-width' ) ) {
		$array = array( 'width' );
	}
	return $array;
}
add_filter( 'ot_recognized_dimension_fields','wyz_dimension_fields', 10, 2 );

/**
 * Filters for theme options' social links.
 *
 * @param array $args Holds data to be filtered.
 */
function wyz_new_socials( $args ) {
	foreach ( $args as $social ) {
		if (
		'Facebook' === $social['name']
		|| 'Twitter' === $social['name']
		|| 'Google+' === $social['name']
		|| 'LinkedIn' === $social['name']
		) {
			$new_args[] = $social;
		}
	}

	return $new_args;
}
add_filter( 'ot_type_social_links_defaults', 'wyz_new_socials' );

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_theme_options_parent_slug', '__return_false' );

/**
 * Change the title of the theme options admin page.
 */
function wyz_ot_options_title() {
	return esc_html__( 'WYZI Options','wyzi-business-finder' ); 
}
add_filter( 'ot_theme_options_page_title', 'wyz_ot_options_title' );

/**
 * Change the menu title of the theme options admin page.
 */
function wyz_ot_options_menu_title() {
	return esc_html__( 'WYZI Options','wyzi-business-finder' );
}
add_filter( 'ot_theme_options_menu_title', 'wyz_ot_options_menu_title' );

/**
 * Change the menu icon of the theme options admin page.
 */
function wyz_ot_options_menu_icon() {
	return WYZ_THEME_URI . '/images/wyz-options.png';
}
add_filter( 'ot_theme_options_icon_url', 'wyz_ot_options_menu_icon' );

/**
 * Change the menu order of the theme options admin page.
 */
function wyz_ot_options_menu_ind() {
	return 57;
}
add_filter( 'ot_theme_options_position', 'wyz_ot_options_menu_ind' );
?>
