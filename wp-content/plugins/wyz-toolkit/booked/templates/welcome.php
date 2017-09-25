<div id="booked-welcome-screen">
	<div class="wrap about-wrap">
		<h1><?php echo sprintf(esc_html__('Welcome to %s','wyzi-business-finder'),'Booked '.BOOKED_VERSION); ?></h1>
		<div class="about-text">
			<?php echo sprintf(esc_html__('Thank you for choosing %s! If this is your first time using %s, you will find some helpful "Getting Started" links below. If you just updated the plugin, you can find out what\'s new in the "What\'s New" section below.','wyzi-business-finder'),'Booked','wyzi-business-finder'); ?>
		</div>
		<div class="booked-badge">
			<img src="<?php echo BOOKED_PLUGIN_URL; ?>/templates/images/badge.png">
		</div>
		
		<div id="welcome-panel" class="welcome-panel">
			
			<img src="<?php echo BOOKED_PLUGIN_URL; ?>/templates/images/welcome-banner.jpg" class="booked-welcome-banner">
			
			<div class="welcome-panel-content">
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
					
						<h3><?php esc_html_e('Getting Started','wyzi-business-finder'); ?></h3>
						<ul>
							<li><a href="https://boxystudio.ticksy.com/article/3239/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Installation & Setup Guide','wyzi-business-finder'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
							<li><a href="https://boxystudio.ticksy.com/article/6268/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Custom Calendars','wyzi-business-finder'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
							<li><a href="https://boxystudio.ticksy.com/article/3238/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Default Time Slots','wyzi-business-finder'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
							<li><a href="https://boxystudio.ticksy.com/article/3233/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Custom Time Slots','wyzi-business-finder'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
							<li><a href="https://boxystudio.ticksy.com/article/6267/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Custom Fields','wyzi-business-finder'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
							<li><a href="https://boxystudio.ticksy.com/article/3240/" target="_blank" class="welcome-icon welcome-learn-more"><?php esc_html_e('Shortcodes','wyzi-business-finder'); ?></a>&nbsp;&nbsp;<i class="fa fa-external-link"></i></li>
						</ul>
						<a class="button" style="margin-bottom:15px; margin-top:0;" href="https://boxystudio.ticksy.com/articles/7827/" target="_blank"><?php esc_html_e('View all Guides','wyzi-business-finder'); ?>&nbsp;&nbsp;<i class="fa fa-external-link"></i></a>&nbsp;
						<a class="button button-primary" style="margin-bottom:15px; margin-top:0;" href="<?php echo get_admin_url().'admin.php?page=booked-settings'; ?>"><?php esc_html_e('Get Started','wyzi-business-finder'); ?></a>
						
					</div>
					<div class="welcome-panel-column welcome-panel-last welcome-panel-updates-list">			
						
						<?php echo booked_parse_readme_changelog(); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>