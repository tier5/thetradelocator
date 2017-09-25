<?php
// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	wp_die('No cheating');
}

if ( ! class_exists( 'WYZIFooterFactory' ) ) {
	class WYZIFooterFactory {

		public $footer_type;
		private $the_footer = NULL;


		public function __construct() {
			$this->footer_type = wyz_get_theme_template();
			$footer_file_name = 'footer-' . $this->footer_type . '.php';
			require_once( WYZ_TEMPLATES_DIR . '/footers/' . $footer_file_name );
			$this->the_footer = new WYZIFooter();
		}

		public function the_widget_area() {
			$this->the_footer->the_widget_area();
		}

		public function the_bottom_area() {
			$this->the_footer->the_bottom_area();
		}

		public function the_footer() {
			if ( $this->the_footer->can_have_footer() ) {
				$this->the_footer->start();
				$this->the_footer->the_widget_area();
				$this->the_footer->the_bottom_area();
				$this->the_footer->close();
			}
		}
	}
}