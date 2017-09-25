<?php
/**
 * Theme filters.
 *
 * @package wyz.
 */


define('BSF_PRODUCTS_NOTICES', false);

/**
 * Cusomize the display of the 'read more' link.
 */
function wyz_modify_read_more_link() {
	global $post;
	$pos = strpos( $post->post_content, '<!--more-->' );
	if (  $pos ) {
		return '<p>' . nl2br( substr( $post->post_content , 0, $pos ) ) . ' [...]</p><a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html__( 'read more', 'wyzi-business-finder' ) . '</a>';
	}
}
add_filter( 'the_excerpt', 'wyz_modify_read_more_link' );

/**
 * Replaces the excerpt "more" text by a link.
 */
function wyz_new_excerpt_more() {
	global $post;
	return ' [...]<a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="read-more">' .
			esc_html__( 'read more', 'wyzi-business-finder' ) . '<span class="screen-reader-text">' .
			get_the_title( get_the_ID() ) . '</span></a>';
}
add_filter( 'excerpt_more', 'wyz_new_excerpt_more' );
add_filter( 'comment_text_rss', 'wp_filter_nohtml_kses' );
add_filter( 'comment_excerpt', 'wp_filter_nohtml_kses' );

/**
 * Display map metaboxes on page creation in backend.
 */
function wyz_display_page_title_metabox() {
	$prefix = 'wyz_';
	$wyz_cmb_page_title = new_cmb2_box( array(
		'id' => $prefix . 'page_title_meta',
		'title' => esc_html__( 'Display page title', 'wyzi-business-finder' ),
		'object_types' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true,
	) );

	$wyz_cmb_page_title->add_field( array(
		'name' => esc_html__( 'Hide page title on this page?', 'wyzi-business-finder' ),
		'id'   => $prefix . 'page_title',
		'type' => 'checkbox',
		'std' => 1,
	) );
}
add_filter( 'cmb2_init', 'wyz_display_page_title_metabox' );


/**
 * Make Menu Seethrough metaboxes.
 */
function wyz_seethrough_menu_metabox() {
	$template_type = wyz_get_theme_template();
	$prefix = 'wyz_';
	if ( 2 == $template_type ) {
	$menu_seethrough = new_cmb2_box( array(
		'id' => $prefix . 'seethrough_menu_meta',
		'title' => esc_html__( 'See-through Menu', 'wyzi-business-finder' ),
		'object_types' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true,
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Make Menu See-Through on this page?', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_menu',
		'type' => 'checkbox',
		'std' => 1,
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Menu Background color', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_bg_color',
		'desc' => esc_html__( 'Click "Clear" to make the menu background transparent', 'wyzi-business-finder' ),
		'type' => 'colorpicker',
		'default' => '',
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Mobile Menu Background color', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_mobile_bg_color',
		'type' => 'colorpicker',
		'default' => '',
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Menu Borders color', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_border_color',
		'desc' => esc_html__( 'Click "Clear" to make the menu background transparent', 'wyzi-business-finder' ),
		'type' => 'colorpicker',
		'default' => '',
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Font color', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_font_color',
		'type' => 'colorpicker',
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Mobile Font color', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_mobile_font_color',
		'type' => 'colorpicker',
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Submenu Font color', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_submenu_font_color',
		'type' => 'colorpicker',
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Submenu background color', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_submenu_bg_color',
		'type' => 'colorpicker',
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Font Hover color', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_font_hover_color',
		'type' => 'colorpicker',
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Active Font color', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_font_active_color',
		'type' => 'colorpicker',
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Mobile Active Font color', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_mobile_font_active_color',
		'type' => 'colorpicker',
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Box Shadow', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_shadow',
		'type' => 'checkbox',
		'std' => 1,
	) );

	$menu_seethrough->add_field( array(
		'name' => esc_html__( 'Alternate Logo', 'wyzi-business-finder' ),
		'desc'    => esc_html__( 'This logo appears on this page only, defaults to the site\'s logo', 'wyzi-business-finder' ),
		'id'   => $prefix . 'seethrough_logo',
		'type'    => 'file',
		// Optional:
		'options' => array( 'url' => false ),
		'text'    => array(
			'add_upload_file_text' => esc_html__( 'Add Logo', 'wyzi-business-finder' ),
		),
	));
	}

}
add_filter( 'cmb2_init', 'wyz_seethrough_menu_metabox' );


/**
 * Add 'highlight' class to prev and nxt links in pagination.
 */
function wyz_posts_link_attributes() {
	return 'class="highlight"';
}
add_filter( 'next_posts_link_attributes', 'wyz_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'wyz_posts_link_attributes' );

/**
 * Adds 'highlight' class to prev and nxt links in pagination.
 *
 * @param string $title current page title.
 */
function wyz_filter_pagetitle( $title ) {
	if ( ! is_single() ) {
	    return esc_html( get_bloginfo( 'name' ) );
	}

	global $wp_query;

	if ( isset( $wp_query->post->post_title ) ) {
	    return $wp_query->post->post_title;
	}

	return $title;
}
add_filter( 'wp_title', 'wyz_filter_pagetitle' );


/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 */
function wyz_add_editor_styles() {
    add_editor_style( WYZ_CSS_URI . '/editor-style.css' );
}
add_action( 'init', 'wyz_add_editor_styles' );




/**
 * Display comment form's textarea at the bottom.
 *
 * @param array $fields form fields.
 */
function wyz_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'wyz_move_comment_field_to_bottom' );

/**
 * CMB2 field slider override http jquery-ui.css script include with https
 */
function wyz_jquery_ui_script_override() {
	if ( is_ssl() ) {
		wp_deregister_style( 'slider_ui' );
		wp_register_style( 'slider_ui', 'https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css', array(), '1.0' );
	}
}
add_filter( 'cmb2_render_own_slider',  'wyz_jquery_ui_script_override', 10, 0 );

?>
