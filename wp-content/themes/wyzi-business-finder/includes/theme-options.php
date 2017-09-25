<?php
/**
 * Initialize the custom Theme Options.
 *
 * @package wyz
 */

add_action( 'init', 'wyz_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @since     2.0
 */
function wyz_theme_options() {

	// OptionTree is not loaded yet, or this is not an admin request.
	if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() ) {
		return false;
	}

	/**
	* Get a copy of the saved settings array.
	*/
	$saved_settings = get_option( ot_settings_id(), array() );

	/**
	* Custom settings array that will eventually be
	* passes to the OptionTree Settings API Class.
	*/
	$custom_settings = array(
		'sections' => array(
			array(
				'id' => 'general',
				'title' => esc_html__( 'General', 'wyzi-business-finder' ),
			),
			array(
				'id'          => 'header',
				'title'       => esc_html__( 'Header', 'wyzi-business-finder' ),
			),
			array(
				'id'          => 'typography',
				'title'       => esc_html__( 'Typography', 'wyzi-business-finder' ),
			),
			array(
				'id'          => 'footer',
				'title'       => esc_html__( 'Footer', 'wyzi-business-finder' ),
			),
			array(
				'id'          => 'colors',
				'title'       => esc_html__( 'Background', 'wyzi-business-finder' ),
			),
			array(
				'id'          => 'css-custom',
				'title'       => esc_html__( 'Custom CSS', 'wyzi-business-finder' ),
			),
			array(
				'id'          => 'script-custom',
				'title'       => esc_html__( 'Custom Script', 'wyzi-business-finder' ),
			),
			array(
				'id'          => 'accessories',
				'title'       => esc_html__( 'Accessories', 'wyzi-business-finder' ),
			),
			array(
				'id'          => 'social_links',
				'title'       => esc_html__( 'Social Links', 'wyzi-business-finder' ),
			),
			array(
				'id'          => 'contact',
				'title'       => esc_html__( 'Contact', 'wyzi-business-finder' ),
			),
			array(
				'id'          => 'default-images',
				'title'       => esc_html__( 'Default Images', 'wyzi-business-finder' ),
			),
			array(
			'id'          => '404',
			'title'       => esc_html__( '404 Page', 'wyzi-business-finder' ),
			),
		),
		'settings'        => array(

		// ---------------------------------------------------------
		// GENERAL OPTIONS .
		// Section: general.
		// ---------------------------------------------------------
			array(
				'id'          => 'general-customize',
				'label'       => esc_html__( 'General Options', 'wyzi-business-finder' ),
				'desc'        => '',
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'general',
			),
			array(
				'id'          => 'header-logo-upload',
				'label'       => esc_html__( 'Site Logo', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Choose Logo', 'wyzi-business-finder' ),
				'type'        => 'upload',
				'section'     => 'general',
			),
			array(
				'id'          => 'header-logo-dimensions',
				'label'       => esc_html__( 'Logo Dimensions', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'If logo is available, set its width and height', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'dimension',
				'section'     => 'general',
			),
			array(
				'id'          => 'header-logo-spacing',
				'label'       => esc_html__( 'Logo Spacing', 'wyzi-business-finder' ),
				'desc'        => '',
				'std'         => '',
				'type'        => 'spacing',
				'section'     => 'general',
				'min_max_step'=> array(
									'min' => 0,
									'max' => 100,
									'step' => 1,
								),
			),
			array(
				'id'          => 'logo-font',
				'label'       => esc_html__( 'Title Logo Font', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the font properties of the title when logo image is not set.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'typography',
				'section'     => 'general',
			),
			array(
				'id'          => 'resp',
				'label'       => esc_html__( 'Responsive', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Enable/Disable site responsiveness', 'wyzi-business-finder' ),
				'std'         => 'on',
				'type'        => 'on-off',
				'section'     => 'general',
			),
			array(
				'id'          => 'content-width',
				'label'       => esc_html__( 'Content Width', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the site\'s content width.', 'wyzi-business-finder' ),
				'std'         => '',
				'section'     => 'general',
				'type'        => 'select',
				'condition'   => 'resp:is(off)',
				'choices'     => array(
					array(
						'value'       => '970',
						'label'       => '970px',
					),
					array(
						'value'       => '1140',
						'label'       => '1140px',
					),
					array(
						'value'       => '1260',
						'label'       => '1260px',
					),
					array(
						'value'       => '1400',
						'label'       => '1400px',
					),
				),
			),
			array(
				'id'          => 'blog-title',
				'label'       => esc_html__( 'Blog Title', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Title for front page in case front page displays your latest posts.', 'wyzi-business-finder' ),
				'std'         => 'Blog',
				'type'        => 'text',
				'section'     => 'general',
			),
			array(
				'id'          => 'sidebar-layout',
				'label'       => esc_html__( 'Default Page Layout', 'wyzi-business-finder' ),
				'std'         => 'right-sidebar',
				'type'        => 'radio-image',
				'section'     => 'general',
			),
			array(
				'id'          => 'shop-sidebar-layout',
				'label'       => esc_html__( 'Shop Page Layout', 'wyzi-business-finder' ),
				'std'         => 'right-sidebar',
				'type'        => 'radio-image',
				'section'     => 'general',
			),
			array(
				'id'          => 'resp',
				'label'       => esc_html__( 'Responsive', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Enable/Disable site responsiveness', 'wyzi-business-finder' ),
				'std'         => 'on',
				'type'        => 'on-off',
				'section'     => 'general',
			),
			array(
				'id'          => 'one_page_template',
				'label'       => esc_html__( 'One Page layout', 'wyzi-business-finder' ),
				'type'        => 'on-off',
				'section'     => 'general',
				'desc'		  => esc_html__( 'Enable/disable one page layout', 'wyzi-business-finder' ),
				'std'         => 'off',
				
			),
			array(
				'id'          => 'one-page-business-cpt',
				'label'       => esc_html__( 'Which Business to display as your site\'s landing page', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'custom-post-type-select',
				'section'     => 'general',
				'rows'        => '',
				'post_type'   => 'wyz_business',
				'condition'   => 'one_page_template:is(on)',
			),
			array(
				'id'          => 'wyz_template_type',
				'label'       => esc_html__( 'Site Template', 'wyzi-business-finder' ),
				'type'        => 'select',
				'section'     => 'general',
				'desc'		  => esc_html__( 'Choose which template you want for your site.', 'wyzi-business-finder' ),
				'choices'     => array( 
					array(
						'value'       => '1',
						'label'       => esc_html__( 'Template 1', 'wyzi-business-finder' ),
						'src'         => ''
					),
					array(
						'value'       => '2',
						'label'       => esc_html__( 'Template 2', 'wyzi-business-finder' ),
						'src'         => ''
					),
				),
			),
			array(
				'id'          => 'listing_archives_ess_grid',
				'label'       => esc_html__( 'Listing Archives Essential Grid Alias', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'general',
				'condition'   => 'wyz_template_type:is(2)',
			),
			array(
				'id'          => 'listing_search_ess_grid',
				'label'       => esc_html__( 'Listing Search Essential Grid Alias', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'general',
				'condition'   => 'wyz_template_type:is(2)',
			),
			array(
				'id'          => 'terms-and-cond-on-off',
				'label'       => esc_html__( 'Terms and Conditions', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Display terms and conditions link in sign up page', 'wyzi-business-finder' ),
				'std'         => 'off',
				'type'        => 'on-off',
				'section'     => 'general',
			),
			array(
				'id'          => 'terms-and-conditions',
				'label'       => esc_html( 'Terms and Conditions Text', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The text to display in the terms and coditions notice.', 'wyzi-business-finder' ) . '<br/>' . esc_html__( 'Place the word you want to become a link in between %%.', 'wyzi-business-finder' ),
				'type'        => 'textarea',
				'section'     => 'general',
				'condition'   => 'terms-and-cond-on-off:is(on)',
				'std'         => 'By signing in, you agree to the %Terms and Coditions%.',
				'class'		  => 'fullwidth',
			),

		// ---------------------------------------------------------
		// HEADER OPTIONS .
		// Section: header.
		// ---------------------------------------------------------
			array(
				'id'          => 'menu-customize',
				'label'       => esc_html__( 'Header Options', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Here are the options for customising the menu', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'header',
			),
			array(
				'id'          => 'header-layout',
				'label'       => esc_html__( 'Header Layout', 'wyzi-business-finder' ),
				'std'         => 'header1',
				'type'        => 'radio-image',
				'section'     => 'header',
				'condition'   => 'wyz_template_type:not(2)',
			),
			array(
				'id'          => 'header-layout2',
				'label'       => esc_html__( 'Header Layout', 'wyzi-business-finder' ),
				'std'         => 'header1',
				'type'        => 'radio-image',
				'section'     => 'header',
				'condition'   => 'wyz_template_type:is(2)',
			),
			array(
				'id'          => 'header-login-menu',
				'label'       => esc_html__( 'Header Login Menu', 'wyzi-business-finder' ),
				'std'         => 'off',
				'type'        => 'on-off',
				'section'     => 'header',
				'condition'   => 'wyz_template_type:is(2)',
			),
			array(
				'id'          => 'acgbtb_right_content',
				'label'       => esc_html( 'Header Right Content', 'wyzi-business-finder' ),
				'type'        => 'textarea',
				'section'     => 'header',
				'class'		  => 'fullwidth',
				'condition'   => 'wyz_template_type:is(1),header-layout:is(header3)',
				'operator'   => 'and',
			),
			array(
				'id'          => 'acgbtb_right_content2',
				'label'       => esc_html( 'Header Right Content', 'wyzi-business-finder' ),
				'type'        => 'textarea',
				'section'     => 'header',
				'class'		  => 'fullwidth',
				'condition'   => 'header-layout2:is(header2),wyz_template_type:is(2)',
				'operator'   => 'and',
			),
			array(
				'id'          => 'utility-bar-onoff',
				'label'       => esc_html__( 'Display Utility Bar', 'wyzi-business-finder' ),
				'std'         => 'on',
				'type'        => 'on-off',
				'section'     => 'header',
			),
			array(
				'id'          => 'utility-bar-bg-color',
				'label'       => esc_html__( 'Utility Bar BG color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the background color for the Utility bar.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'header',
				'condition'   => 'utility-bar-onoff:is(on)',
			),
			array(
				'id'          => 'utility-bar-txt-color',
				'label'       => esc_html__( 'Utility Bar Text color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the text color for the Utility bar.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'header',
				'condition'   => 'utility-bar-onoff:is(on)'
			),
			array(
				'id'          => 'support-text',
				'label'       => esc_html__( 'Support Label', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Label for the link that users can click on to get support. Displays in the utility bar', 'wyzi-business-finder' ),
				'std'         => 'Support',
				'type'        => 'text',
				'section'     => 'header',
				'condition'   => 'utility-bar-onoff:is(on)',
			),
			array(
				'id'          => 'support-link',
				'label'       => esc_html__( 'Support Link', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The link that users are taken to when they click on \'Support\'.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'header',
				'condition'   => 'utility-bar-onoff:is(on)',
			),
			array(
				'id'          => 'subheader-bg-upload',
				'label'       => esc_html__( 'Subheader BG Image', 'wyzi-business-finder' ),
				'desc'        => '',
				'type'        => 'upload',
				'section'     => 'header',
				'condition'   => 'wyz_template_type:is(2)',
			),
			array(
				'id'          => 'login-btn-content-type',
				'label'       => esc_html__( 'My Account Button Content', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'What should be displayed inside the \'My Account\' button in the login menuwhen user is logged in', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'select',
				'section'     => 'header',
				'choices'     => array( 
					array(
						'value'       => '',
						'label'       => esc_html__( '-- Choose One --', 'wyzi-business-finder' ),
						'src'         => ''
					),
					array(
						'value'       => 'firstname',
						'label'       => esc_html__( 'User\'s First Name', 'wyzi-business-finder' ),
						'src'         => ''
					),
					array(
						'value'       => 'lastname',
						'label'       => esc_html__( 'User\'s Last Name', 'wyzi-business-finder' ),
						'src'         => ''
					),
					array(
						'value'       => 'username',
						'label'       => esc_html__( 'User\'s UserName', 'wyzi-business-finder' ),
						'src'         => ''
					),
					array(
						'value'       => 'custom-text',
						'label'       => esc_html__( 'Custom text', 'wyzi-business-finder' ),
						'src'         => ''
					),
				)
			),
			array(
				'id'          => 'login-btn-custom-text',
				'label'       => esc_html__( '\'My Account\' Button Custom Text Content', 'wyzi-business-finder' ),
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'header',
				'condition'   => 'login-btn-content-type:is(custom-text)',
			),
			array(
				'id'          => 'menu-bg-color',
				'label'       => esc_html__( 'Menu BG color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the background color for the menu', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'header',
			),
			array(
				'id'          => 'menu-link-default-color',
				'label'       => esc_html__( 'Menu default link color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the default text color', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'header',
			),
			array(
				'id'          => 'menu-item-current-color',
				'label'       => esc_html__( 'Current page menu item color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the text color to current page menu item', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'header',
			),
			array(
				'id'          => 'menu-item-current-bg-color',
				'label'       => esc_html__( 'Current page menu item background color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the background color to current page menu item', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'header',
			),
			array(
				'id'          => 'menu-item-hover-color',
				'label'       => esc_html__( 'Menu item on-hover color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the text color to menu items on hover', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'header',
			),
			array(
				'id'          => 'menu-item-bg-hover-color',
				'label'       => esc_html__( 'Menu item on-hover background color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the background color to menu items on hover', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'header',
			),
			array(
				'id'          => 'menu-font',
				'label'       => esc_html__( 'Menu text font', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the font size, style and weight for the menu links', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'typography',
				'section'     => 'header',
			),
			array(
				'id'          => 'breadcrumbs',
				'label'       => esc_html__( 'Display BreadCrumbs', 'wyzi-business-finder' ),
				'std'         => 'off',
				'type'        => 'on-off',
				'section'     => 'header',
			),
			array(
				'id'          => 'header_search_form',
				'label'       => esc_html__( 'Header Search Form', 'wyzi-business-finder' ),
				'std'         => 'on',
				'type'        => 'on-off',
				'section'     => 'header',
			),

			array(
				'id'          => 'logged-menu-right-link',
				'label'       => esc_html__( 'Right Menu Link For Logged in users', 'wyzi-business-finder' ),
				'std'         => 'off',
				'type'        => 'on-off',
				'section'     => 'header',
			),
			array(
				'id'          => 'logged-menu-right-link-label',
				'label'       => esc_html__( 'Right Menu link Title', 'wyzi-business-finder' ),
				'type'        => 'text',
				'section'     => 'header',
				'condition'   => 'logged-menu-right-link:is(on),wyz_template_type:is(2)',
				'operation'   => 'and'
			),
			array(
				'id'          => 'logged-menu-right-link-to',
				'label'       => esc_html__( 'Link to', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'What does the right menu item link to', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'select',
				'section'     => 'header',

				'condition'   => 'logged-menu-right-link:is(on),wyz_template_type:is(2)',
				'choices'     => array(
					array(
					'value'       => '',
					'label'       => '',
					'src'         => ''
					),
					array(
					'value'       => 'add-business',
					'label'       => esc_html__( 'Add New Listing', 'wyzi-business-finder' ),
					'src'         => ''
					),
					array(
					'value'       => 'page',
					'label'       => esc_html__( 'Page', 'wyzi-business-finder' ),
					'src'         => ''
					),
					array(
					'value'       => 'link',
					'label'       => esc_html__( 'Custom Link', 'wyzi-business-finder' ),
					'src'         => ''
					),
				)
			),
			array(
				'id'          => 'logged-menu-right-link-page',
				'section'     => 'header',
				'label'       => esc_html__( 'Select Page', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'page-select',
				'condition'   => 'logged-menu-right-link-to:is(page),wyz_template_type:is(2)',
			),
			array(
				'id'          => 'logged-menu-right-link-link',
				'label'       => esc_html__( 'Set Link', 'wyzi-business-finder' ),
				'type'        => 'text',
				'section'     => 'header',
				'condition'   => 'logged-menu-right-link-to:is(link),wyz_template_type:is(2),logged-menu-right-link:is(on)',
			),
			/*non logged in*/
			array(
				'id'          => 'non-logged-menu-right-link',
				'label'       => esc_html__( 'Right Menu Link For Non-Logged in users', 'wyzi-business-finder' ),
				'std'         => 'off',
				'type'        => 'on-off',
				'section'     => 'header',
				'condition'   => 'wyz_template_type:is(2)',
			),
			array(
				'id'          => 'non-logged-menu-right-link-label',
				'label'       => esc_html__( 'Right Menu link Title', 'wyzi-business-finder' ),
				'type'        => 'text',
				'section'     => 'header',
				'condition'   => 'non-logged-menu-right-link:is(on),wyz_template_type:is(2)',
				'operation'   => 'and'
			),
			array(
				'id'          => 'non-logged-menu-right-link-to',
				'label'       => esc_html__( 'Link to', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'What does the right menu item link to for non logged in users', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'select',
				'section'     => 'header',
				'condition'   => 'non-logged-menu-right-link:is(on),wyz_template_type:is(2)',
				'choices'     => array(
					array(
					'value'       => '',
					'label'       => '',
					'src'         => ''
					),
					array(
					'value'       => 'page',
					'label'       => esc_html__( 'Page', 'wyzi-business-finder' ),
					'src'         => ''
					),
					array(
					'value'       => 'link',
					'label'       => esc_html__( 'Custom Link', 'wyzi-business-finder' ),
					'src'         => ''
					),
				)
			),
			array(
				'id'          => 'non-logged-menu-right-link-page',
				'section'     => 'header',
				'label'       => esc_html__( 'Select Page', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'page-select',
				'condition'   => 'non-logged-menu-right-link-to:is(page),wyz_template_type:is(2)',
			),
			array(
				'id'          => 'non-logged-menu-right-link-link',
				'label'       => esc_html__( 'Set Link', 'wyzi-business-finder' ),
				'type'        => 'text',
				'section'     => 'header',
				'condition'   => 'non-logged-menu-right-link-to:is(link),wyz_template_type:is(2),non-logged-menu-right-link:is(on)',
			),
		// ---------------------------------------------------------
		// TYPOGRAPHY OPTIONS .
		// Section: typography.
		// ---------------------------------------------------------
			array(
				'id'          => 'theme-typography-customize',
				'label'       => esc_html__( 'Typography Options', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Here you can customise the theme\'s typography', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'typography',
			),
			array(
				'id'          => 'wyz-typography',
				'label'       => esc_html__( 'WYZI Typography', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The Typography of your site', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'typography',
				'section'     => 'typography',
			),
			array(
				'id'          => 'body_google_fonts',
				'label'       => esc_html__( 'WYZI Google Fonts', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Main font family for the site', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'google-fonts',
				'section'     => 'typography',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and'
			),
			array(
				'id'          => 'h1-typography',
				'label'       => esc_html__( 'H1', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Header H1 font', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'typography',
				'section'     => 'typography',
			),
			array(
				'id'          => 'h2-typography',
				'label'       => esc_html__( 'H2', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Header H2 font', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'typography',
				'section'     => 'typography',
			),
			array(
				'id'          => 'h3-typography',
				'label'       => esc_html__( 'H3', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Header H3 font', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'typography',
				'section'     => 'typography',
			),
			array(
				'id'          => 'h4-typography',
				'label'       => esc_html__( 'H4', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Header H4 font', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'typography',
				'section'     => 'typography',
			),
			array(
				'id'          => 'h5-typography',
				'label'       => esc_html__( 'H5', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Header H5 font', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'typography',
				'section'     => 'typography',
			),
			array(
				'id'          => 'h6-typography',
				'label'       => esc_html__( 'H6', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Header H6 font', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'typography',
				'section'     => 'typography',
			),
		// ---------------------------------------------------------
		// FOOTER OPTIONS .
		// Section: footer.
		// ---------------------------------------------------------
			array(
				'id'          => 'footer-customize',
				'label'       => esc_html__( 'Footer Options', 'wyzi-business-finder' ),
				'desc'        => '',
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'footer',
			),
			array(
				'id'          => 'footer-widgets-onoff',
				'label'       => esc_html__( 'Enable footer widget area', 'wyzi-business-finder' ),
				'std'         => 'on',
				'type'        => 'on-off',
				'section'     => 'footer',
			),
			array(
				'id'          => 'footer-layout',
				'label'       => esc_html__( 'Number of Footer Columns', 'wyzi-business-finder' ),
				'std'         => 'four-columns',
				'type'        => 'radio-image',
				'section'     => 'footer',
				'condition'   => 'footer-widgets-onoff:is(on)',
			),
			array(
				'id'          => 'footer-copyrights-onoff',
				'label'       => esc_html__( 'Show Copyrights', 'wyzi-business-finder' ),
				'std'         => 'on',
				'type'        => 'on-off',
				'section'     => 'footer',
			),
			array(
				'id'          => 'copyrights-text',
				'label'       => esc_html__( 'Copyright', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Copyright text. Displays at the left side of the footer.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'footer',
				'condition'   => 'footer-copyrights-onoff:is(on)',
			),
		// ---------------------------------------------------------
		// COLOR OPTIONS .
		// Section: colors.
		// ---------------------------------------------------------
			array(
				'id'          => 'color-customize',
				'label'       => esc_html__( 'Color Options', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Customise your site\'s color options', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'colors',
			),
			array(
				'id'          => 'wyz-background',
				'label'       => esc_html__( 'Site Background', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the background color/image of your site', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'background',
				'section'     => 'colors',
			),
			array(
			'id'          => 'footer-color',
			'label'       => esc_html__( 'Footer background color', 'wyzi-business-finder' ),
			'desc'        => '',
			'std'         => '',
			'type'        => 'colorpicker',
			'section'     => 'colors',
			),
		// ---------------------------------------------------------
		// CUSTOM CSS .
		// Section: css-custom.
		// ---------------------------------------------------------
			array(
				'id'          => 'css-customize',
				'label'       => esc_html__( 'Custom CSS', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Here you can add all your custom css code. This will override the theme\'s current css.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'css-custom',
			),
			array(
				'id'          => 'custom-css',
				'label'       => '',
				'desc'        => '',
				'std'         => '',
				'type'        => 'css',
				'section'     => 'css-custom',
			),
		// ---------------------------------------------------------
		// CUSTOM SCRIPT .
		// Section: script-custom.
		// ---------------------------------------------------------
			array(
				'id'          => 'script-customize',
				'label'       => esc_html__( 'Custom Script', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Here you can add all your custom javascript code (Dont place your code inside script tags)', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'script-custom',
			),
			array(
				'id'          => 'custom-script',
				'label'       => '',
				'desc'        => '',
				'std'         => '',
				'type'        => 'javascript',
				'section'     => 'script-custom',
				'rows'        => '20',
			),
		// ---------------------------------------------------------
		// ACCESSORIES.
		// Section: accessories.
		// ---------------------------------------------------------
			array(
				'id'          => 'accessories-customize',
				'label'       => esc_html__( 'Accessories Options', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Here are the options for all the theme\'s accessory features', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'accessories',
			),
			array(
				'id'          => 'geolocation',
				'label'       => esc_html__( 'Geolocation', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Enable/Disable tracking user\'s location. This allows users to search for businesses within a specific distance.', 'wyzi-business-finder' ),
				'std'         => 'on',
				'type'        => 'on-off',
				'section'     => 'accessories',
			),
			array(
				'id'          => 'sticky-menu',
				'label'       => esc_html__( 'Sticky Menu', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Allow menu to stick to top of the page', 'wyzi-business-finder' ),
				'std'         => 'off',
				'type'        => 'on-off',
				'section'     => 'accessories',
			),
			array(
				'id'          => 'page-loader',
				'label'       => esc_html__( 'Page Loader', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Display an overlay above the screen that fades away when the page loads', 'wyzi-business-finder' ),
				'std'         => 'off',
				'type'        => 'on-off',
				'section'     => 'accessories',
			),
			array(
				'id'          => 'page-loader-color',
				'label'       => esc_html__( 'Page Loader Color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Icon color of the page loader', 'wyzi-business-finder' ),
				'std'         => '#00aeff',
				'type'        => 'colorpicker',
				'section'     => 'accessories',
				'condition'   => 'page-loader:is(on)',
			),
			array(
				'id'          => 'page-loader-bg',
				'label'       => esc_html__( 'Page Loader BG Color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Background color of the page loader', 'wyzi-business-finder' ),
				'std'         => '#fff',
				'type'        => 'colorpicker',
				'section'     => 'accessories',
				'condition'   => 'page-loader:is(on)',
			),
			array(
				'id'          => 'scroll-to-top',
				'label'       => esc_html__( 'Scroll To Top', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Enable/Disable button to scroll to top', 'wyzi-business-finder' ),
				'std'         => 'on',
				'type'        => 'on-off',
				'section'     => 'accessories',
			),
			array(
				'id'          => 'scroll-to-top-color',
				'label'       => esc_html__( 'Scroll Icon color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the color of the scroll to top icon', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'accessories',
				'condition'   => 'scroll-to-top:is(on)',
			),
			array(
				'id'          => 'scroll-to-top-bg-color',
				'label'       => esc_html__( 'Scroll Background color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the background color of the scroll to top icon', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'accessories',
				'condition'   => 'scroll-to-top:is(on)',
			),
			array(
				'id'          => 'scroll-to-top-float',
				'label'       => esc_html__( 'Scroll Icon position', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'on which side you want the icon to be.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'select',
				'section'     => 'accessories',
				'condition'   => 'scroll-to-top:is(on)',
				'choices'     => array(
					array(
						'value'       => 'left',
						'label'       => esc_html__( 'Left', 'wyzi-business-finder' ),
						'src'         => '',
					),
					array(
						'value'       => 'right',
						'label'       => esc_html__( 'Right', 'wyzi-business-finder' ),
						'src'         => '',
					),
				),
			),
			array(
				'id'          => 'disable_pg_metabox',
				'label'       => esc_html__( 'Hide EG/Rev Metaboxes', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Hide Essential Grid and Rev Slider metaboxes from Screen options in page editor', 'wyzi-business-finder' ),
				'type'        => 'on-off',
				'def'		  => 'on',
				'section'     => 'accessories',
				'condition'   => '',
			),
			array(
				'id'          => 'nice-scroll',
				'label'       => esc_html__( 'Nice Scroll', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Enable/Disable nice scroll', 'wyzi-business-finder' ),
				'std'         => 'off',
				'type'        => 'on-off',
				'section'     => 'accessories',
			),
			array(
				'id'          => 'nice-scroll-scrollbar-color',
				'label'       => esc_html__( 'Scrollbar Color', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the color of the scrollbar.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'colorpicker',
				'section'     => 'accessories',
				'condition'   => 'nice-scroll:is(on)',
			),
			array(
				'id'          => 'nice-scroll-scrollbar-width',
				'label'       => esc_html__( 'Scrollbar Border Width', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Set the width of the scrollbar in px.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'dimension',
				'section'     => 'accessories',
				'condition'   => 'nice-scroll:is(on)',
			),
		// ---------------------------------------------------------
		// Social Links OPTIONS.
		// Section: social_links.
		// ---------------------------------------------------------
			array(
				'id'          => 'social-customize',
				'label'       => esc_html__( 'Social Links Options', 'wyzi-business-finder' ),
				'desc'        => '',
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'social_links',
			),
			array(
				'id'          => 'social_twitter',
				'label'       => esc_html__( 'Twitter Link', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The link to your twitter account.<br/>Make sure to have https:// at the beginning of your link.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
			),
			array(
				'id'          => 'social_google-plus',
				'label'       => esc_html__( 'Google+ Link', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The link to your google plus account.<br/>Make sure to have https:// at the beginning of your link.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
			),
			array(
				'id'          => 'social_linkedin',
				'label'       => esc_html__( 'Linkedin Link', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The link to your linkedin account.<br/>Make sure to have https:// at the beginning of your link.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
			),
			array(
				'id'          => 'social_facebook',
				'label'       => esc_html__( 'Facebook Link', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The link to your facebook account.<br/>Make sure to have https:// at the beginning of your link.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
			),
			array(
				'id'          => 'social_youtube-play',
				'label'       => esc_html__( 'Youtube Link', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The link to your Youtube account.<br/>Make sure to have https:// at the beginning of your link.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
			),
			array(
				'id'          => 'social_instagram',
				'label'       => esc_html__( 'Instagram Link', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The link to your Instagram account.<br/>Make sure to have https:// at the beginning of your link.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
			),
			array(
				'id'          => 'social_flickr',
				'label'       => esc_html__( 'Flickr Link', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The link to your Flickr account.<br/>Make sure to have https:// at the beginning of your link.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
			),
			array(
				'id'          => 'social_pinterest-p',
				'label'       => esc_html__( 'Pinterest Link', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The link to your Pinterest account.<br/>Make sure to have https:// at the beginning of your link.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
			),
			array(
				'id'          => 'businesses_fb_app_ID',
				'label'       => esc_html__( 'FaceBook App ID', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Your FaceBook App ID, it is required if you want Facebook Like Box functionality.<br/><a target="_blank" href="https://developers.facebook.com/docs/apps/register">How to get a facebook App ID</a>', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'social_links',
			),
		// ---------------------------------------------------------
		// Contact OPTIONS.
		// Section: contact.
		// ---------------------------------------------------------
			array(
				'id'          => 'contact-customize',
				'label'       => esc_html__( 'Contact Options', 'wyzi-business-finder' ),
				'desc'        => '',
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'contact',
			),
			array(
				'id'          => 'contact-email',
				'label'       => esc_html__( 'Contact Email', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The email to send contact messages to, admin email is default', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'contact',
			),
			array(
				'id'          => 'contact-number',
				'label'       => esc_html__( 'Contact Phone Number', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The phone number that displays in the top social-links bar', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => 'contact',
			),
			array(
				'id'          => 'user-greeting-mail',
				'label'       => esc_html__( 'Client Signup Mail', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The format of the email to send to users upon signup.', 'wyzi-business-finder' ) . '<br/>' . esc_html__( 'Keywords: %USERNAME%,%EMAIL%,%FIRSTNAME%,%LASTNAME%,%SUBSCRIBTION%', 'wyzi-business-finder' ),
				'type'        => 'textarea',
				'section'     => 'contact',
				'std'         => 'Hello %FIRSTNAME%%LASTNAME%,<br/>You are successfully registered.<br/>Your Email: %EMAIL%<br/>Your Subscription Status: %SUBSCRIBTION%<br/>Thank you<br/>',
				'class'		  => 'fullwidth',
			),
			array(
				'id'          => 'business-owner-greeting-mail',
				'label'       => esc_html__( 'Business Owner Signup Mail', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The format of the email to send to business owners upon business registration.', 'wyzi-business-finder' ) . '<br/>' . esc_html__( 'Keywords: %USERNAME%, %FIRSTNAME%, %LASTNAME%, %EMAIL%, %SUBSCRIBTION%,', 'wyzi-business-finder' ),
				'type'        => 'textarea',
				'section'     => 'contact',
				'std'         => 'Hello %FIRSTNAME%%LASTNAME%,<br/>You are successfully registered.<br/>Your Email: %EMAIL%<br/>Your Subscription Status: %SUBSCRIBTION%<br/>Thank you<br/>',
				'class'		  => 'fullwidth',
			),
			array(
				'id'          => 'admin-noice-new-business-email',
				'label'       => esc_html__( 'New Business Submission Admin Notice Mail', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The format of the email to send to the admin upon new business registration.', 'wyzi-business-finder' ) . '<br/>' . esc_html__( 'Keywords: %USERNAME%, %BUSINESSNAME%', 'wyzi-business-finder' ),
				'type'        => 'textarea',
				'section'     => 'contact',
				'std'         => 'New Business submission from user: %USERNAME%, titled: %BUSINESSNAME%.<br/>',
				'class'		  => 'fullwidth',
			),
			array(
				'id'          => 'business-contact-mail',
				'label'       => esc_html__( 'Business Contact Mail', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The format of the email to send to business owners upon Contact.', 'wyzi-business-finder' ) . '<br/>' . esc_html__( 'Keywords: %NAME%,%EMAIL%,%PHONE%,%MESSAGE%, %BUSINESSNAME%', 'wyzi-business-finder' ),
				'type'        => 'textarea',
				'section'     => 'contact',
				'std'		  => 'From %BUSINESSNAME%<br/>New contact email from %NAME%, %EMAIL%:<br/><br/>%MESSAGE%',
				'class'		  => 'fullwidth',
			),
			array(
				'id'          => 'buy-points-mail',
				'label'       => esc_html__( 'Points Purchased Mail', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The format of the email to send to users once they purchase points.', 'wyzi-business-finder' ) . '<br/>' . esc_html__( 'Keywords: %USERNAME%,%POINTS%,%PRICE%', 'wyzi-business-finder' ),
				'type'        => 'textarea',
				'section'     => 'contact',
				'std'		  => 'User %USERNAME% has just purchased %POINTS% points for %PRICE% cash.',
				'class'		  => 'fullwidth',
			),
		// ---------------------------------------------------------
		// Default Images OPTIONS.
		// Section: default-images.
		// ---------------------------------------------------------
			array(
				'id'          => 'def-imgs-lbl',
				'label'       => esc_html__( 'Default Images', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Customise your Default Images', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => 'default-images',
			),
			array(
				'id'          => 'default-business-logo',
				'label'       => esc_html__( 'Default Business Logo', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Image to display in case a business doesn\'t have a logo', 'wyzi-business-finder'),
				'type'        => 'upload',
				'section'     => 'default-images',
			),
			array(
				'id'          => 'default-offer-logo',
				'label'       => esc_html__( 'Default Offer Image', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Image to display in case an Offer doesn\'t have a featured image', 'wyzi-business-finder'),
				'type'        => 'upload',
				'section'     => 'default-images',
			),
			array(
				'id'          => 'default-location-logo',
				'label'       => esc_html__( 'Default Location Image', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Image to display in case a location doesn\'t have a featured Image', 'wyzi-business-finder'),
				'type'        => 'upload',
				'section'     => 'default-images',
			),
		// ---------------------------------------------------------
		// 404 OPTIONS.
		// Section: 404.
		// ---------------------------------------------------------
			array(
				'id'          => '404-customize',
				'label'       => esc_html__( '404 Page Options', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'Customise your 404 page', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'textblock-titled',
				'section'     => '404',
			),
			array(
				'id'          => '404_title',
				'label'       => esc_html__( 'Title', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The title of the 404 page.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'text',
				'section'     => '404',
			),
			array(
				'id'          => '404_textarea',
				'label'       => esc_html__( 'Page Content', 'wyzi-business-finder' ),
				'desc'        => esc_html__( 'The content to display in the 404 page.', 'wyzi-business-finder' ),
				'std'         => '',
				'type'        => 'textarea',
				'section'     => '404',
				'rows'        => '15',
			),
		),
	);

	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		array_push( $custom_settings['settings'],
			array(
				'id'          => 'favicon-upload',
				'label'       => esc_html__( 'Upload Favicon', 'wyzi-business-finder' ),
				'desc'        => sprintf( esc_html__( 'Upload the favicon of the site, recommended dimensions 16x16 and .ico extension', 'wyzi-business-finder' ), apply_filters( 'ot_upload_text', esc_html__( 'Choose Favicon', 'wyzi-business-finder' ) ), 'FTP' ),
				'std'         => '',
				'type'        => 'upload',
				'section'     => 'general',
			)
		);
	}
	// Allow settings to be filtered before saving.
	$custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

	// Settings are not the same update the DB.
	if ( $saved_settings !== $custom_settings ) {
		update_option( ot_settings_id(), $custom_settings );
	}

	// Lets OptionTree know the UI Builder is being overridden.
	global $ot_has_custom_theme_options;
	$ot_has_custom_theme_options = true;
}

/**
 * Register our meta boxes using the ot_register_meta_box() function.
 */
if ( function_exists( 'ot_register_meta_box' ) ) {
	ot_register_meta_box( $custom_settings );
}

/**
 * Style the theme options admin page.
 */
function wyz_theme_options_js() {
	if ( function_exists( 'ot_get_option' ) ) {
		if ( ! wp_script_is( 'wyz-options-js', 'registered' ) || ! wp_style_is( 'wyz-options-style', 'registered' ) ) {
			wp_register_script( 'wyz-options-js', get_template_directory_uri(). '/js/candy-admin.min.js' );
			wp_register_style( 'wyz-options-style', get_template_directory_uri().'/css/candy-admin.css' );
		}
		global $pagenow;

		if ( filter_input( INPUT_GET , 'page' ) && 'ot-theme-options' === filter_input( INPUT_GET , 'page' ) && ( ! wp_script_is( 'wyz-options-js', 'enqueued' ) || ! wp_style_is( 'wyz-options-style', 'enqueued' ) ) ) {
			wp_enqueue_script( 'wyz-options-js' );
			wp_enqueue_style( 'wyz-options-style' );
		}
	}
}
add_action( 'wp_print_scripts', 'wyz_theme_options_js' ,5 );
?>
