<?php 

/*
 * Parent header template
 */
// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	wp_die('No cheating');
}

if ( ! class_exists( 'WYZIHeaderParent' ) ) { 

	abstract class WYZIHeaderParent {

		protected $WYZ_USER_ACCOUNT;

		public function __construct( $WUA ) {
			$this->WYZ_USER_ACCOUNT = $WUA;
		}


		/*---------------------------------
		/*  	Abstract functions
		/* To be overriden by child clases
		/*--------------------------------*/
		public abstract function start();
		public abstract function close();
		public abstract function the_subheader();
		protected abstract function the_main_menu();
		public abstract function the_utility_bar();
		public abstract function the_main_header();



		protected function can_have_subheader() {
			return ! is_singular( 'wyz_business' ) && ! is_singular( 'wyz_offers' ) && ! is_404() &&  ( ! is_page() || is_page( 'user-account' ) || filter_input( INPUT_GET, 'location' ) );
		}

		protected function the_page_title() {
			if ( is_front_page() && 0 == get_option( 'page_on_front' ) ) {
				$blog_ttl = esc_html( wyz_get_option( 'blog-title' ) );
				echo '' != $blog_ttl ? $blog_ttl : esc_html__( 'Blog', 'wyzi-business-finder' );
			} elseif ( is_category() ) {
				echo sprintf( esc_html__( 'Categories Archives: %s', 'wyzi-business-finder' ), esc_html( single_cat_title( '', false ) ) );
			} elseif ( is_tag() ) {
				echo sprintf( esc_html__( 'Tag: %s', 'wyzi-business-finder' ), esc_html( single_tag_title( '', false ) ) );
			} elseif ( is_author() ) {
				echo sprintf( esc_html__( 'All Posts by %s', 'wyzi-business-finder' ), esc_html( get_the_author() ) );
			} elseif ( is_day() ) {
				echo sprintf( esc_html__( 'Day: %s', 'wyzi-business-finder' ), get_the_date( get_option( 'date_format' ) ) );
			} elseif ( is_month() ) {
				echo sprintf( esc_html__( 'Month: %s', 'wyzi-business-finder' ), get_the_date( 'M, Y' ) );
			} elseif ( is_year() ) {
				echo sprintf( esc_html__( 'Year: %s', 'wyzi-business-finder' ), get_the_date( 'Y' ) );
			} elseif ( is_tax( 'wyz_business_category' ) ) {
				global $wp_query;
				$term = $wp_query->queried_object;
				echo sprintf( esc_html__( "%s Category: %s", 'wyzi-business-finder' ), WYZ_BUSINESS_CPT, esc_html( $term->name ) );
				if ( '' !== $term->description ) {
					echo '<div class="wyz-subscript">' . esc_html( $term->description ) . '</div>';
				}
			} elseif( is_tax( 'offer-categories' ) ) {
			    global $wp_query;
				$term = $wp_query->queried_object;
				echo sprintf( esc_html__( "%s Category: %s", 'wyzi-business-finder' ), WYZ_OFFERS_CPT, esc_html( $term->name ) );
				if ( '' !== $term->description ) {
					echo '<div class="wyz-subscript">' . esc_html( $term->description ) . '</div>';
				}
			} elseif ( is_tax( 'wyz_business_tag' ) ) {
				echo sprintf( esc_html__( '%s Tag', 'wyzi-business-finder' ), WYZ_BUSINESS_CPT );
			} elseif ( is_tax( 'wyz_offers_tag' ) ) {
				echo sprintf( esc_html__( '%s Tag', 'wyzi-business-finder' ), WYZ_OFFERS_CPT );
			} elseif ( is_post_type_archive( 'wyz_business' ) ) {
				echo sprintf( esc_html__( 'All %s', 'wyzi-business-finder' ), get_option( 'wyz_business_plural_name', 'Businesses' ) );
			} elseif ( is_post_type_archive( 'wyz_offers' ) ) {
				echo sprintf( esc_html__( 'All %s', 'wyzi-business-finder' ), get_option( 'wyz_offer_plural_name', 'Offers' ) );
			} elseif ( is_search() ) {
				echo esc_html__( 'SEARCH RESULTS FOR: ', 'wyzi-business-finder' ) . esc_html( get_search_query( false ) );
			} elseif (  isset( $_GET['location'] ) ) {
				echo esc_html( get_the_title( $_GET['location'] ) );
			} elseif ( isset( $_GET['reset-pass'] ) ) {
				esc_html_e( 'Reset Password', 'wyzi-business-finder' );
			} elseif( is_home() ) {
				echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) );
			} elseif( class_exists( 'WooCommerce' ) && is_shop() ) {
				woocommerce_page_title();
			} elseif ( is_tax('dc_vendor_shop') ) {
				echo '';
			} elseif( $this->WYZ_USER_ACCOUNT ) {
				echo $this->WYZ_USER_ACCOUNT->the_page_title();
			} else {
				esc_html( the_title( '', '' ) );
			}
		}
	}
}