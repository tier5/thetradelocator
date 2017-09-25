<?php
/**
 * Register sidebars.
 */
function wyz_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Default Sidebar', 'wyzi-business-finder' ),
		'id' => 'wyz-default-sidebar',
		'description' => esc_html__( 'The default sidebar appears on the default page templates', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Right Sidebar', 'wyzi-business-finder' ),
		'id' => 'wyz-right-sidebar',
		'description' => esc_html__( 'Appears on the right sidebar page templates', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Left Sidebar', 'wyzi-business-finder' ),
		'id' => 'wyz-left-sidebar',
		'description' => esc_html__( 'Appears on the Left page templates', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Shop Sidebar', 'wyzi-business-finder' ),
		'id' => 'wyz-shop-sidebar',
		'description' => esc_html__( 'Appears on the Shop page template', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Contact Sidebar', 'wyzi-business-finder' ),
		'id' => 'wyz-contact-sidebar',
		'description' => esc_html__( 'Appears on the Contact page templates', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer 1', 'wyzi-business-finder' ),
		'id' => 'wyz-footer-1-sb',
		'description' => esc_html__( 'contains widgets to be displayed in 1st footer area', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer 2', 'wyzi-business-finder' ),
		'id' => 'wyz-footer-2-sb',
		'description' => esc_html__( 'contains widgets to be displayed in 2nd footer area', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Fotter 3', 'wyzi-business-finder' ),
		'id' => 'wyz-footer-3-sb',
		'description' => esc_html__( 'contains widgets to be displayed in 3rd footer area', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer 4', 'wyzi-business-finder' ),
		'id' => 'wyz-footer-4-sb',
		'description' => esc_html__( 'contains widgets to be displayed in 4th footer area', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Business Listing Sidebar', 'wyzi-business-finder' ),
		'id' => 'wyz-business-listing-sb',
		'description' => esc_html__( 'Shown on Business Listing template', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Business Categories', 'wyzi-business-finder' ),
		'id' => 'wyz-business-categories-sb',
		'description' => esc_html__( 'Shown on Categories/Tags Businesses List', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Single Business', 'wyzi-business-finder' ),
		'id' => 'wyz-single-business-sb',
		'description' => esc_html__( 'Shown on the single business page', 'wyzi-business-finder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

add_action( 'widgets_init', 'wyz_widgets_init' );
?>
