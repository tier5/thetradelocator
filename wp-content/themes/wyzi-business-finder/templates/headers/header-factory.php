<?php

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	wp_die('No cheating');
}

global $template_type;
		
if( ! class_exists( 'WYZIHeaderFactory' ) ) {

	class WYZIHeaderFactory {

		public $header_type;
		private $the_header = NULL;

		private $WYZ_USER_ACCOUNT;



		public function __construct( $WUA ) {
			global $template_type;
			$template_type = wyz_get_theme_template();
			$this->header_type = $template_type;
			$header_file_name = 'header-' . $this->header_type . '.php';
			require_once( WYZ_TEMPLATES_DIR . '/headers/' . $header_file_name );
			$this->WYZ_USER_ACCOUNT = $WUA;
			$this->the_header = new WYZIHeader( $this->WYZ_USER_ACCOUNT );
		}

		public function the_utility_bar() {
			$this->the_header->the_utility_bar();
		}

		public function the_main_header() {
			$this->the_header->the_main_header();
		}

		public function the_subheader() {
			$this->the_header->the_subheader();
		}

		public function the_header() {
			$this->the_header->start();
			$this->the_header->the_utility_bar();
			$this->the_header->the_main_header();
			$this->the_header->the_subheader();
			$this->the_header->close();
		}

	}
}