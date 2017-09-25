<?php
/**
 * Header template
 *
 * @package wyz
 */

?>
<!DOCTYPE html>
<html class="no-js main-html" <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php
	if ( '' !== wyz_get_option( 'favicon-upload' ) && ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) ) { ?>
		<link rel="icon" type="image/x-icon" href="<?php echo esc_url( wyz_get_option( 'favicon-upload' ) );?>">
	<?php }
	 wp_head();?>

</head>

<?php 
// If current page has a map.
global $has_map;
global $WYZ_USER_ACCOUNT;
$has_map  = ( ( is_page_template( array( 'templates/right-sidebar-page.php', 'templates/left-sidebar-page.php', 'templates/full-width-page.php', 'templates/contact-page.php' ) ) && 'map' === get_post_meta( get_the_ID(), 'wyz_page_header_content', true ) ) || is_singular( 'wyz_business' ) || is_singular( 'wyz_offers' ) || is_page_template( 'templates/business-listing-page.php' ) ); ?>

<?php 
// Give the body margin top incase utility bar is showing and page has map.
$body_marg = $has_map && 'on' === wyz_get_option( 'utility-bar-onoff' ) ? 'body-util-marg' : '';
?>
<body <?php body_class(); ?>>

<!-- Header
============================================ -->
<?php 
$header = new WYZIHeaderFactory( $WYZ_USER_ACCOUNT );
$header->the_header();
?>

<!-- Map
============================================ -->
<?php
// Page map.
if( class_exists( 'WyzMap' ) ) {
	if ( $has_map && ! is_singular( 'wyz_business' ) && ! is_singular( 'wyz_offers' ) && class_exists( 'WyzMap' ) ) {
		$def_coor = get_post_meta( get_the_ID(), 'wyz_page_map', true );
		if ( '' === $def_coor || empty( $def_coor ) || '' == $def_coor['latitude'] || '' == $def_coor['longitude'] ) {
			$def_coor = array(
				'latitude' => esc_attr( get_option( 'wyz_businesses_default_lat' ) ),
				'longitude' => esc_attr( get_option( 'wyz_businesses_default_lon' ) ),
				'zoom' => 11,
			);
		}
		if ( is_page_template( 'templates/contact-page.php' ) ) {
			WyzMap::wyz_contact_map( get_the_ID(), get_post_meta( get_the_ID(), 'wyz_contact_page_map', true ) );
		} else {
			WyzMap::wyz_get_global_map( get_the_ID(), $def_coor );
			//WyzMap::listing_global_business_map(get_the_ID(), $def_coor );
		}
	} elseif ( 'image' ==  get_post_meta( get_the_ID(), 'wyz_page_header_content', true ) ) {
		WyzMap::wyz_get_page_header_image( get_the_ID() );
	}
	elseif ( 'revslider' ==  get_post_meta( get_the_ID(), 'wyz_page_header_content', true ) ) {
		$rev_slider = get_post_meta( get_the_ID(), 'wyz_page_header_rev_slider_which', true);

		if ( shortcode_exists("rev_slider") && ! empty( $rev_slider ) ){
			echo( do_shortcode( '[rev_slider ' . $rev_slider.']' ) );
		}
	}
}
?>
<?php if ( 'on' === wyz_get_option( 'scroll-to-top' ) ) {
	echo '<button class="back-to-top"><i class="fa fa-chevron-up"></i> </button>';
}
?>
