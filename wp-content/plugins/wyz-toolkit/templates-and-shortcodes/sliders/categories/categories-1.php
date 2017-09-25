<?php
/**
 * WYZI Categories Slider
 *
 * @package wyz
 */

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	wp_die('No cheating');
}

if( ! class_exists( 'WYZICategoriesSlider' ) ) {

	class WYZICategoriesSlider {

		private $cat_attr;

		public function __construct( $attr ) {
			$this->cat_attr = $attr;
			add_action( 'wp_footer', array( &$this, 'include_cat_script') , 4 );
			$this->setup_categories();
		}

		private function setup_categories() {
			$business_taxonomy = array();
			$taxonomy = 'wyz_business_category';
			$temp_link;
			$tax_terms = get_terms( $taxonomy, array( 'hide_empty' => false ) );
			$count = 0;

			foreach ( $tax_terms as $obj ) {
				if ( 0 != $obj->parent ) {
					continue;
				}

				$tax_id = intval( $obj->term_id );
				$children = get_term_children( $tax_id, $taxonomy );
				$tax = array();
				$tax['has_children'] = ( ! empty( $children ) ? true : false );
				$tax['name'] = $obj->name;
				$tax['color'] = get_term_meta( $tax_id, 'wyz_business_cat_bg_color', true );
				$temp_link = get_term_link( $obj, $taxonomy );
				$tax['link'] = ( ! is_wp_error( $temp_link ) ? $temp_link : '' );
				$url = wp_get_attachment_url( get_term_meta( $tax_id, 'wyz_business_icon_upload', true ) );
				$tax['img'] = ( false != $url ? $url : '' );
				if ( ! empty( $children ) ) {
					$tx_children = array();
					$tx_all_children = array();
					$child_count = 0;
					$tax['view_all'] = false;
					foreach ( $children as $child ) {
						$child_count++;
						if ( $child_count >4) {
							$tax['view_all'] = true;
							break;
						}
						// Get count of businesses with this category.
						$args = array(
							'post_type' => 'wyz_business',
							'posts_per_page' => '-1',
							'post_status' => array( 'publish' ),
							'fields' => 'ids',
						);

						$args['tax_query'] = array(
							array(
								'taxonomy' => 'wyz_business_category',
								'field'  => 'term_id',
								'terms'  => $child,
							),
						);
						$query = new WP_Query( $args );
						$bus_count = $query->found_posts;

						$temp_child = array();
						$temp_link = get_term_link( $child, $taxonomy );
						$child = get_term_by( 'id', $child, $taxonomy );
						$tx_all_children[] = $child->name;
						$temp_child['name'] = $child->name;
						$temp_child['bus_count'] = $bus_count;
						$temp_child['link'] = ( ! is_wp_error( $temp_link ) ? $temp_link : '' );
						$tx_children[] = $temp_child;
					}
					$tax['children'] = $tx_children;
					$tax['all_children'] = $tx_all_children;
					/*if ( count( $tx_children ) > 4 ) {
						$tax['children']  = array_slice( $tx_children, 0, 4 );
						$tax['view_all'] = true;
					} else {
						
						$tax['view_all'] = false;
					}*/
				}
				$business_taxonomy[] = $tax;
				$count++;
			}

			$cat_slide_data = array(
				'taxs' => $business_taxonomy,
				'nav' => $this->cat_attr['nav'],
				'autoplay' => $this->cat_attr['autoplay'],
				'autoplay_timeout' => $this->cat_attr['autoplay_timeout'],
				'loop' => $count > 1 ? $this->cat_attr['loop'] : false,
				'rows' => $this->cat_attr['rows'],
				'viewAll' => esc_html__( 'View All', 'wyzi-business-finder' ),
				'columns' => $this->cat_attr['columns'],
			);

			wp_localize_script( 'wyz_categories_script', 'catSlide', $cat_slide_data );
		}


		public function include_cat_script() {
			wp_enqueue_script( 'wyz_categories_script' );
		}

		public function the_categories_slider() {
			ob_start();
			?>
			<div class="category-search-area margin-bottom-50">
				<div class="row">
					<!-- Section Title & Search -->
					<div class="section-title section-title-search col-xs-12 margin-bottom-100">
						<h1><?php echo esc_html( $this->cat_attr['cat_slider_ttl'] );?></h1>
						<div class="wyz-search-form float-right">
							<input id="categories-search-text" type="text" placeholder="<?php esc_html_e( 'categories', 'wyzi-business-finder' );?>" name="q" />
							<button id="categories-search-submit"><i class="fa fa-search"></i></button>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="category-search-slider">
						</div>
					</div>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}
	}
}