<?php
	

define('BOOKEDICAL_PLUGIN_DIR', dirname(__FILE__));
define('BOOKEDICAL_VERSION','1.1.0');

$secure_hash = md5( 'booked_ical_feed_' . get_site_url() );
define('BOOKEDICAL_SECURE_HASH',$secure_hash);


if(!class_exists('bookedical_plugin')) {
	class bookedical_plugin {
		
		public function __construct() {
			
			$this->booked_screens = array('booked-feeds');
	
			add_action('init', array(&$this, 'booked_ical_feed') );
			add_action('admin_enqueue_scripts', array(&$this, 'admin_styles'));
			add_action('admin_menu', array(&$this, 'add_feeds_menu'));
		
		}
			
		public function booked_ical_feed(){
			
			if (isset($_GET['booked_ical'])):
				include(BOOKEDICAL_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'calendar-feed.php');
				exit;
			endif;
			
		}
		
		// Add a New Menu Item
		public function add_feeds_menu() {
			add_submenu_page('booked-appointments', __('Calendar Feeds','booked'), __('Calendar Feeds','booked-calendar-feeds'), 'manage_options', 'booked-feeds', array(&$this, 'plugin_feeds_page'));
		}

		// Booked Feeds Page
		public function plugin_feeds_page() {
			if(!current_user_can('manage_options')) {
				wp_die(__('You do not have sufficient permissions to access this page.', 'booked-calendar-feeds'));
			}
			include(sprintf("%s/admin/feeds.php", BOOKEDICAL_PLUGIN_DIR));
		}
		
		public function admin_styles() {
			$current_page = (isset($_GET['page']) ? $_GET['page'] : false);
			$screen = get_current_screen();
			if (in_array($current_page,$this->booked_screens)):
				wp_enqueue_script('booked-font-awesome', '//use.fontawesome.com/'.BOOKED_FA_ID.'.js', array(), BOOKEDICAL_VERSION);
				wp_enqueue_style('booked-admin', BOOKED_PLUGIN_URL . '/css/admin-styles.css', array(), BOOKEDICAL_VERSION);
			endif;
		}

	}
}


add_action('plugins_loaded','init_bookedical');

function init_bookedical(){

	if(class_exists('bookedical_plugin')) {
	
		// instantiate the plugin class
		$bookedical_plugin = new bookedical_plugin();
	
	}

}
