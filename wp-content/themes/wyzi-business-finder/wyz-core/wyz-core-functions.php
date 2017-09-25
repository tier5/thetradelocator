<?php
/**
 * WIZY core functions.
 *
 * @package wyz
 */

// Register wyz scripts.
include_once( WYZ_THEME_DIR . '/wyz-core/wyz-register-scripts.php' );

/**
 * Creates breadcrumbs.
 *
 * @return string
 */
function wyz_breadcrumbs() {

	if ( 'on' !== wyz_get_option( 'breadcrumbs' ) ) {
		return '';
	}
	if ( is_404() ) {
		return '<h3 id="entry-title">404</h3>';
	}
	global $post;
	$home_pag_name = esc_html( get_the_title( get_option( 'page_on_front', true ) ) );
	if ( 0 == get_option( 'page_on_front' ) || '' === $home_pag_name ) {
		$home_pag_name = esc_html( wyz_get_option( 'blog-title' ) );
	}

	$trail = '<div class="breadcrumbs float-left clear"><ul class="breadcrumb">';
	$end = '</ul></div>';

	$trail .= '<li><a href="' . get_home_url() . '" >' . $home_pag_name . '</a></li>';
	if ( is_front_page() ) {
		return $trail . $end;
	}
	if ( is_search() ) {
		return $trail . '<li>Search<li>' . $end;
	}
	if ( is_tax() || is_category() || is_tag() ) {
		global $wp_query;
		$term = $wp_query->queried_object;
		if ( is_tax( 'wyz_business_tag' ) ) {
			return $trail . '<li>' . esc_html( get_option( 'wyz_business_old_single_permalink' ) ) . ' ' . esc_html__( 'Tags', 'wyzi-business-finder' ) . '</li><li>'. esc_html( $term->name ) . '</li>' . $end;
		}
		if ( $term->parent ) {
			$p = get_term( $term->parent, 'wyz_business_category' );
			$p_name = $p->name;
			$p_link = get_term_link( $term->parent, 'wyz_business_category' );
			return $trail . '<li><a href="' . $p_link . '">'. $p_name . '</a></li><li>'. $term->name . '</li>' . $end;
		}
		return $trail . '<li>'. $term->name . '</li>' . $end;
	}
	if ( is_author() ) {
		$trail .= '<li><a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '" >' . esc_html( get_page( get_option( 'page_for_posts' ) )->post_title ) . '</a></li>';
		$trail .= '<li>Author: ' . esc_html( get_the_author() ) . '</li>';
		return $trail . $end;
	}
	if ( is_date() ) {
		$trail .= '<li><a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '" >' . esc_html( get_page( get_option( 'page_for_posts' ) )->post_title ) . '</a></li>';
		$trail .= '<li>';
		if ( is_day() ) {
			$trail .= 'Day: ' . get_the_date( get_option( 'date_format' ) );
		} elseif ( is_month() ) {
			$trail .= 'Month: ' . get_the_date( 'M, Y' );
		} elseif ( is_year() ) {
			$trail .= 'Year: ' . get_the_date( 'Y' );
		}
		$trail .= '</li>';
		return $trail . $end;
	}
	if ( is_singular( 'wyz_business_post' ) ) {
		$bus_id = get_post_meta( get_the_ID(), 'business_id', true );
		$trail .= '<li><a href="' . esc_url( get_the_permalink( $bus_id ) ) . '">' . esc_html( get_the_title( $bus_id ) ) . '</a></li>';
		$trail .= '<li>' . esc_html( get_the_title() ) . '</li>';
		return $trail . $end;
	}

	$breadcrumbs = array();

	if ( $post && $post->post_parent ) {

		$parent_id = $post->post_parent;

		while ( $parent_id ) {

			$page = get_page( $parent_id );
			$breadcrumbs[] = '<li><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a></li>';
			$parent_id = $page->post_parent;
		}
		$breadcrumbs = array_reverse( $breadcrumbs );
	}

	foreach ( $breadcrumbs as $crumb ) {
		$trail .= $crumb;
	}

	if ( is_home() || is_singular( 'post' ) ) {
		if ( 0 == get_option( 'page_for_posts' ) ) {
			$trail .= '<li>' . get_the_title() . '</li>';
			return $trail . $end;
		}
		$trail .= '<li><a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '" >' . get_page( get_option( 'page_for_posts' ) )->post_title . '</a></li>';
		if ( is_singular( 'post' ) ) {
			$trail .= '<li>' . get_the_title() . '</li>';
		}
	} elseif ( isset( $_GET['reset-pass'] ) ) {
		$trail .= '<li>' . esc_html__( 'Reset Password', 'wyzi-business-finder' ) . '</li>';
	} elseif ( filter_input( INPUT_GET, 'location' ) && class_exists( 'WyzHelpers' ) ) {
		return $trail . '<li>' . esc_html__( 'Locations', 'wyzi-business-finder' ) . '</li><li>' . get_the_title( $_GET['location'] ) . '</li>' . $end;
	} else {
		global $WYZ_USER_ACCOUNT_TYPE;

		if ( class_exists( 'WyzUserAccount' ) && $WYZ_USER_ACCOUNT_TYPE ) {
			if ( $WYZ_USER_ACCOUNT_TYPE == WyzQueryVars::AddNewBusiness ) {
				$trail .= '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li><li>' . esc_html__( 'New Business', 'wyzi-business-finder' ) . '</li>';
			} elseif ( $WYZ_USER_ACCOUNT_TYPE == WyzQueryVars::EditBusiness ) {
				$trail .= '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li><li>' . esc_html__( 'Edit Business', 'wyzi-business-finder' ) . '</li>';
			} elseif ( $WYZ_USER_ACCOUNT_TYPE == WyzQueryVars::AddNewOffer ) {
				$trail .= '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li><li>' . esc_html__( 'Add New', 'wyzi-business-finder' ) . ' ' . WYZ_OFFERS_CPT . '</li>';
			} elseif ( $WYZ_USER_ACCOUNT_TYPE == WyzQueryVars::EditOffer ) {
				$trail .= '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li><li>' . esc_html__( 'Edit', 'wyzi-business-finder' ) . ' ' . WYZ_OFFERS_CPT . '</li>';
			} elseif ( $WYZ_USER_ACCOUNT_TYPE == WyzQueryVars::ManageBusiness &&
						WyzHelpers::wyz_is_current_user_author( $_GET[ $WYZ_USER_ACCOUNT_TYPE ] ) ) {
				$trail .= '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li><li>' . esc_html__( 'Manage', 'wyzi-business-finder' ) . ' ' . get_the_title( $_GET[ $WYZ_USER_ACCOUNT_TYPE ] ) . '</li>';
			} elseif ( $WYZ_USER_ACCOUNT_TYPE == WyzQueryVars::BusinessCalendar &&
						WyzHelpers::wyz_is_current_user_author( $_GET[ $WYZ_USER_ACCOUNT_TYPE ] ) ) {
				$trail .= '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li><li>' . get_the_title( $_GET[ $WYZ_USER_ACCOUNT_TYPE ] ) . ' ' . esc_html__( 'Calendar', 'wyzi-business-finder' ) . '</li>';
			} else {
				$trail .= '<li>' . esc_html( get_the_title() ) . '</li>';
			}
		} else {
			if ( is_singular( 'wyz_offers' ) ) {
				$bus_id = get_post_meta( get_the_ID(), 'business_id', true );
				if ( is_array( $bus_id ) ) {
					$bus_id = $bus_id[0];
				}
				if ( '' != $bus_id ) {
					$trail .= '<li><a href="' . esc_url( get_the_permalink( $bus_id ) ) . '">' . esc_html( get_the_title( $bus_id ) ) . '</a></li>';
				}
			}
			$trail .= '<li>' . esc_html( get_the_title() ) . '</li>';
		}
	}
	return $trail . $end;
}

/**
 * Display search form for no content pages.
 */
function wyz_no_content_search_form() {?>
	<div id="wyz-no-content-search" class="text-center">
		<?php get_search_form( true );?>
		<a class="wyz-button blue icon" href="<?php echo esc_url( get_site_url() );?>"><?php esc_html_e( 'Go To Home', 'wyzi-business-finder' );?></a>
	</div>
	<?php
}
/**
 * Display sicial like boxes.
 */
function wyz_social_links() {
	$links = array( 'facebook', 'twitter', 'linkedin', 'google-plus', 'youtube-play', 'flickr', 'pinterest-p', 'instagram' );

	$result = '<span class="header-social-container">';

	foreach ( $links as $link ) {
		$social = wyz_get_option( 'social_' . $link );
		if ( '' !== $social ) {
			$result .= '<a href="' . esc_url( $social ) . '" class="' . esc_attr( $link ) . '" target=_blank ><i class="fa fa-' . esc_attr( $link ) . '"></i></a>';
		}
	}

	$result .= '</span>';

	echo $result;
}

/**
 * Link pages using the <!--nextpage--> tag.
 */
function wyz_link_pages() {
	wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wyzi-business-finder' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span class="page-links-before">',
		'link_after'  => '</span>',
		'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'wyzi-business-finder' ) . ' </span>%',
		'separator'   => '<span class="screen-reader-text">, </span>',
	) );

}


/**
 * Get theme options
 *
 * @param string $option theme option to get.
  */
function wyz_get_option( $option ) {
	if ( function_exists( 'ot_get_option' ) ) {
		return ot_get_option( $option );
	}
	return '';
}


/**
 * Get theme template
 *
 */
function wyz_get_theme_template() {
	$template = 1;
	$template = wyz_get_option( 'wyz_template_type' );
	if ( '' == $template )
		$template = 1;

	return $template;
}


/**
 * Display pagination.
 */
function wyz_pagination() {
	if ( is_singular( 'post' ) ) {
		echo '<div class="blog-pagination fix"><ul>';
		
		the_post_navigation( array(
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'wyzi-business-finder' ) . '</span> ' .
							'<li class="next-page float-right">%title</li>',
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'wyzi-business-finder' ) . '</span> ' .
							'<li class="prev-page float-left">%title</li>'
			) );
		echo '</ul></div>';
		return;
	}

	global $wp_query;

	// Stop execution if there's only 1 page.
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	// Add current page to the array.
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	// Add the pages around the current page to the array.
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="blog-pagination fix"><ul>' . "\n";

	// Previous Post Link.
	if ( get_previous_posts_link() ) {
		printf( '<li class="prev-page float-left">%s</li>' . "\n", get_previous_posts_link( '<i class="fa fa-angle-left"> </i>' . esc_html__( 'Previous Page', 'wyzi-business-finder' ) ) );
	}

	// Link to first page, plus ellipses if necessary.
	if ( ! in_array( 1, $links, true ) ) {
		$class = 1 === $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links, true ) ) {
			echo '<li>...</li>';
		}
	}

	//	Link to current page, plus 2 pages in either direction if necessary.
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged === $link ? ' class="active"' : '';
		printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), esc_html( $link ) );
	}

	//	Link to last page, plus ellipses if necessary.
	if ( ! in_array( $max, $links, true ) ) {
		if ( ! in_array( $max - 1, $links, true ) ) {
			echo '<li>...</li>' . "\n";
		}

		$class = $paged === $max ? ' class="active"' : '';
		printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), esc_html( $max ) );
	}

	//	Next Post Link.
	if ( get_next_posts_link() ) {
		printf( '<li class="next-page float-right">%s</li>' . "\n", get_next_posts_link( esc_html__( 'Next Page', 'wyzi-business-finder' ) . '<i class="fa fa-angle-right"></i>' ) );
	}

	echo '</ul></div>' . "\n";

}



/**
 * Return the result of wyz_pagination
 *
 * @return string paginated links
 */
function wyz_get_pagination() {
	$result = '';
	if ( is_singular( 'post' ) ) {
		$result .= '<div class="blog-pagination fix"><ul>';
		
		$result .= get_the_post_navigation( array(
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'wyzi-business-finder' ) . '</span> ' .
							'<li class="next-page float-right">%title</li>',
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'wyzi-business-finder' ) . '</span> ' .
							'<li class="prev-page float-left">%title</li>'
			) );
		$result .= '</ul></div>';
		return $result;
	}

	global $wp_query;

	// Stop execution if there's only 1 page.
	if ( $wp_query->max_num_pages <= 1 ) {
		return '';
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	// Add current page to the array.
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	// Add the pages around the current page to the array.
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	$result .= '<div class="blog-pagination fix"><ul>' . "\n";

	// Previous Post Link.
	if ( get_previous_posts_link() ) {
		$result .= '<li class="prev-page float-left">' . get_previous_posts_link( '<i class="fa fa-angle-left"> </i>' . esc_html__( 'Previous Page', 'wyzi-business-finder' ) ) . '</li>' . "\n";
	}

	// Link to first page, plus ellipses if necessary.
	if ( ! in_array( 1, $links, true ) ) {
		$class = 1 === $paged ? ' class="active"' : '';

		$result .= '<li' . $class . '><a href="' . esc_url( get_pagenum_link( 1 ) ) . '">1</a></li>' . "\n";

		if ( ! in_array( 2, $links, true ) ) {
			$result .= '<li>...</li>';
		}
	}

	//	Link to current page, plus 2 pages in either direction if necessary.
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged === $link ? ' class="active"' : '';
		$result .= '<li><a' . $class . ' href="' . esc_url( get_pagenum_link( $link ) ) . '">' . esc_html( $link ) . '</a></li>' . "\n";
	}

	//	Link to last page, plus ellipses if necessary.
	if ( ! in_array( $max, $links, true ) ) {
		if ( ! in_array( $max - 1, $links, true ) ) {
			$result .= '<li>...</li>' . "\n";
		}

		$class = $paged === $max ? ' class="active"' : '';
		$result .= '<li><a' . $class . ' href="' . esc_url( get_pagenum_link( $max ) ) . '">'. esc_html( $max ) . '</a></li>' . "\n";
	}

	//	Next Post Link.
	if ( get_next_posts_link() ) {
		$result .= '<li class="next-page float-right">' . get_next_posts_link( esc_html__( 'Next Page', 'wyzi-business-finder' ) . '<i class="fa fa-angle-right"></i>' ) . '</li>' . "\n";
	}

	$result .= '</ul></div>' . "\n";
	return $result;
}


/**
 * Get 'user account' page tabs
 *
 */
function wyz_user_account_tabs() {

	if ( class_exists( 'WyzHelpers' ) )
		WyzHelpers::user_account_tabs();
}
?>
