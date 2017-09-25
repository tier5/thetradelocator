<?php 

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	wp_die('No cheating');
}

require_once( plugin_dir_path( __FILE__ ) . '/header.php' );

if ( ! class_exists( 'WYZIHeader' ) ) { 

	class WYZIHeader extends WYZIHeaderParent {

		private $is_seethrough = false;
		private $bg_color = '';
		private $mobile_bg_color = '';
		private $shadow = '';
		private $border_color = '';
		private $font_color ='';
		private $mobile_font_color ='';
		private $submenu_font_color ='';
		private $submenu_bg_color ='';
		private $font_hover_color ='';
		private $font_active_color ='';
		private $mobile_font_active_color ='';
		private $logo =  '';
		private $header_template = '';

		public function __construct( $WUA ) {
			 parent::__construct( $WUA );
			$this->is_seethrough = 'on' == get_post_meta( get_the_ID(), 'wyz_seethrough_menu', true );
			$id = get_the_ID();
			$this->header_template = wyz_get_option( 'header-layout2' );
			if ( $this->is_seethrough ) {
				$this->bg_color = get_post_meta( $id, 'wyz_seethrough_bg_color', true );
				$this->mobile_bg_color = get_post_meta( $id, 'wyz_seethrough_mobile_bg_color', true );
				$this->shadow = get_post_meta( $id, 'wyz_seethrough_shadow', true );
				if ( '' == $this->bg_color ) $this->bg_color = 'transparent';
				$this->border_color = get_post_meta( $id, 'wyz_seethrough_border_color', true );
				if ( '' == $this->border_color ) $this->border_color = 'transparent';
				$this->font_color =  get_post_meta( $id, 'wyz_seethrough_font_color', true );
				$this->mobile_font_color =  get_post_meta( $id, 'wyz_seethrough_mobile_font_color', true );
				$this->submenu_font_color =  get_post_meta( $id, 'wyz_seethrough_submenu_font_color', true );
				$this->submenu_bg_color =  get_post_meta( $id, 'wyz_seethrough_submenu_bg_color', true );
				$this->font_hover_color =  get_post_meta( $id, 'wyz_seethrough_font_hover_color', true );
				$this->font_active_color =  get_post_meta( $id, 'wyz_seethrough_font_active_color', true );
				$this->mobile_font_active_color =  get_post_meta( $id, 'wyz_seethrough_mobile_font_active_color', true );
				$this->logo =  get_post_meta( $id, 'wyz_seethrough_logo', true );
				if ( $this->logo == '' )
					$this->logo = wyz_get_option( 'header-logo-upload' );
			} else
				$this->logo = wyz_get_option( 'header-logo-upload' );
			if ( '' == $this->header_template )
				$this->header_template = 'header1';
		}

		public function start() {
			if ( $this->is_seethrough ) {
				$has_mobile_style = '' != $this->mobile_bg_color || '' != $this->mobile_font_color || '' != $this->mobile_font_active_color;
				echo '<style>';
				if ( '' != $this->bg_color ) echo '.header-bottom, .sub-menu { background-color: ' . $this->bg_color . ';}';
				if ( '' != $this->submenu_bg_color ) echo '.sub-menu { background-color: ' . $this->submenu_bg_color . ';}';
				if ( 'on' != $this->shadow ) echo '.header-bottom, .main-menu li:hover > ul.sub-menu { box-shadow: none;}';
				if ( $this->font_color != '' )
					echo '.main-menu > ul > li > a, .main-menu > ul > li .fa, .header-links a, .sub-menu li a, .mean-nav > ul > li > a, .mean-nav ul li li a, .mean-nav ul li li li a, .meanmenu-reveal .fa { color: ' . $this->font_color . ';}';
				if ( $this->submenu_font_color != '' )
					echo '.sub-menu li a{ color: ' . $this->submenu_font_color . ';}';
				if ( $this->font_hover_color != '' )
					echo '.main-menu > ul > li:hover > a,.header-links a:hover i,.main-menu > ul > li > a:hover .fa, .main-menu > ul > li > a:hover, .main-menu > ul > li > a:hover ~ .fa,  .header-links a:hover, .sub-menu li:hover > a { color: ' . $this->font_hover_color . ';}';
				if ( $this->font_active_color != '' )
					echo '.main-menu > ul > li.current-menu-item > a,.main-menu > ul > li.current-menu-item > a .fa { color: ' . $this->font_active_color . ';}';
				if ( '' != $this->border_color )
					echo '.header-links, .header-logo {border-color: ' . $this->border_color . ';}';
				if ( $has_mobile_style ) {
					echo '@media only screen and (max-width: 767px){';
					if ( '' != $this->mobile_font_color ) echo '.mean-nav > ul > li > a, .mean-nav ul li li a, .mean-nav ul li li li a, .meanmenu-reveal .fa { color: ' . $this->mobile_font_color . ';}';
					if ( '' != $mobile_font_active_color ) echo '.mean-nav > ul > li.current-menu-item > a,.mean-nav > ul > li.current-menu-item > a .fa { color: ' . $this->mobile_font_active_color . ';}';
					if ( '' != $this->mobile_bg_color ) echo '.header-bottom, .sub-menu { background-color: ' . $this->mobile_bg_color . ';}';
					echo '}';
				}
				echo '</style>';
			}
			echo '<header class="header-area section';
			if ( $this->is_seethrough ) {
				echo ' header-seethrough';
				if ( is_admin_bar_showing() )
					echo ' header-admin-bar';
			}
			echo '">';
		}

		public function close() {
			echo '</header>';
		}


		public function the_subheader() {

			if ( $this->can_have_subheader() ) { ?>
			<!-- page subheader
			============================================ -->
			<div class="page-banner-area section" style="background-image: url(<?php echo wyz_get_option( 'subheader-bg-upload' );?>);">
				<div class="container">
					<div class="row">
						<div class="page-banner col-xs-12">
							<h3><?php $this->the_page_title();?></h3>
						</div>
						<?php if ( ! is_search() ) {
							echo '<div class="col-xs-12">' . wyz_breadcrumbs() . '</div>';
						}
						if ( class_exists( 'WyzUserAccount' ) ) {
							$this->WYZ_USER_ACCOUNT->the_points_status( false );
						}
						?>
					</div>
				</div>
			</div>
			<?php } elseif ( is_page() && 'on' != get_post_meta( get_the_ID(), 'wyz_page_title', true ) ) { ?>
			<div class="page-banner-area section" style="background-image: url(<?php echo wyz_get_option( 'subheader-bg-upload' );?>);">
				<div class="container">
					<div class="row">
						<div class="page-banner col-xs-12" >
							<h3><?php if ( is_page( 'signup' ) && isset( $_GET['action'] ) && 'login' == $_GET['action'] ) {
									echo esc_html__( 'Sign In', 'wyzi-business-finder' );
								} elseif ( isset( $_GET['reset-pass'] ) ) {
									esc_html_e( 'Reset Password', 'wyzi-business-finder' );
								}else {
									 the_title( '', '' );
							}?></h3>
						</div><div class="col-xs-12">
						<?php echo wyz_breadcrumbs();?>
						</div>
					</div>
				</div>
			</div><?php
			}
		}


		private function the_login_menu( $position ) {
			switch ( $position ) {
				case 'center':
				
				 if ( ! is_user_logged_in() ) {?>
				<div class="header-top-center text-center <?php echo 'off' == wyz_get_option( 'resp' ) ? 'col-xs-4' : 'col-sm-4';?>">
					<ul class="login-register">
						<li><a href="<?php echo home_url( '/signup/?action=login' )?>"><?php esc_html_e( 'Login', 'wyzi-business-finder' );?></a> / <a href="<?php echo home_url( '/signup/' )?>"><?php esc_html_e( 'Register', 'wyzi-business-finder' );?></a></li>
					</ul>
				</div>
				<?php }
				break;

				case 'top-right':?>
				<div class="header-top-right text-right col-sm-6">
					<div class="row">
				<?php if ( ! is_user_logged_in() ) {?>
						<ul class="login-menu">
							<li><a href="<?php echo home_url( '/signup/?action=login' )?>"><?php esc_html_e( 'Login', 'wyzi-business-finder' );?></a> / <a href="<?php echo home_url( '/signup/' )?>"><?php esc_html_e( 'Register', 'wyzi-business-finder' );?></a></li>
						</ul>
				<?php } else { 
					$user_id = get_current_user_id();
					$macc_title =  esc_html__( 'my account', 'wyzi-business-finder' );
					$cur_mnu_itm = ( is_page( 'user-account' ) ? ' current-menu-item' : '' );
					$macc_select = wyz_get_option( 'login-btn-content-type' );
					$current_user = get_userdata($user_id);
					switch ( $macc_select ) {
						case 'firstname':
							$macc_title = $current_user->first_name;
							break;
						case 'lastname':
							$macc_title = $current_user->last_name;
							break;
						case 'username':
							$macc_title = $current_user->user_login;
							break;
						case 'custom-text':
							$macc_title = esc_html( wyz_get_option( 'login-btn-custom-text' ) );
							break;
					}?>
            	<a href="<?php echo esc_url( home_url( '/user-account/' ) );?>" class="user-logged-in"><?php echo get_avatar( $user_id, 30, false, $macc_title );?><span><?php echo sprintf( esc_html__( 'Welcome %s', 'wyzi-business-finder' ), $macc_title );?></span></a>
            	<a href="<?php echo wp_logout_url();?>" class="logout-link fadeInDown action-btn"><?php esc_html_e( 'Logout', 'wyzi-business-finder' );?></a>
            	
            	<?php } ?>
					</div>
				</div>
				
				<?php break;

				case 'top-left':?>
				<div class="header-top-left text-left col-sm-6"><div class="row">
				<?php if ( has_nav_menu( 'login' ) ) {
					wp_nav_menu( array(
						'menu_id' => 'login-menu',
						'container' => false,
						'theme_location' => 'login',
						'link_before'    => '<span>',
						'link_after'     => '</span>',
					) );
				}?>
				</div></div>
				<?php
				break;

				case 'right': ?>
					<div class="header-top-right text-right">
						<div class="row">
							<?php 
							if ( is_user_logged_in() ) {
								$user_id = get_current_user_id();
								$macc_title =  esc_html__( 'my account', 'wyzi-business-finder' );
								$cur_mnu_itm = ( is_page( 'user-account' ) ? ' current-menu-item' : '' );
								$macc_select = wyz_get_option( 'login-btn-content-type' );
								$current_user = get_userdata($user_id);
								switch ( $macc_select ) {
									case 'firstname':
										$macc_title = $current_user->first_name;
										break;
									case 'lastname':
										$macc_title = $current_user->last_name;
										break;
									case 'username':
										$macc_title = $current_user->user_login;
										break;
									case 'custom-text':
										$macc_title = esc_html( wyz_get_option( 'login-btn-custom-text' ) );
										break;
								}?>
	                    	<a href="<?php echo esc_url( home_url( '/user-account/' ) );?>" class="user-logged-in"><?php echo get_avatar( $user_id, 30, false, $macc_title );?><span><?php echo sprintf( esc_html__( 'Welcome %s', 'wyzi-business-finder' ), $macc_title );?></span></a>
	                    	<a href="<?php echo wp_logout_url();?>" class="logout-link fadeInDown action-btn"><?php esc_html_e( 'Logout', 'wyzi-business-finder' );?></a>
	                    	
	                    	<?php } else { ?>
	                    		<span class="float-right"><?php esc_html_e( 'Welcome User', 'wyzi-business-finder' );?></span>
							<?php } if ( 'off' != wyz_get_option( 'header_search_form' ) ) { ?>
								<div class="search-form2"><?php get_search_form( true );?></div>
							<?php }?>
	                    </div>
	                </div>
	                <?php
					break;
			}
		}


		protected function the_main_menu() {
			?>
			<!-- Main Menu -->
			<div class="main-menu-container <?php echo ( 'header2' == $this->header_template ? ' float-left' : ' float-right' );?> text-center">
				<?php if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'menu_id' => 'main-menu',
						'container' => 'nav',
						'theme_location' => 'primary',
						'container_class' => 'main-menu',
					) );
				}?>
				<div class="col-xs-12">
				<?php $this->the_mobile_menu();?>
				</div>
			</div>
			<?php
		}

		private function the_mobile_menu() {
			if ( 'off' != wyz_get_option( 'resp' ) ) {?>
			<!-- Mobile Menu -->
			<div class="mobile-menu hidden-lg hidden-md hidden-sm">
				<nav id="mobile-navigation">
					<?php if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array(
							'menu_id' => 'mobile-main-menu',
							'container' => false,
							'theme_location' => 'primary',
						) );
					}?>
				</nav>
			</div>
			<?php }
			/*if ( 'off' != wyz_get_option( 'resp' ) ) {
				echo '<div class="mobile-menu"></div>';
			}*/
		}

		public function the_utility_bar() {
			if ( 'on' != wyz_get_option( 'utility-bar-onoff' ) ) {
				return;
			}
			?>
			<!-- Header Top -->
			<div class="header-top section">
				<div class="container-fluid">
					<div class="row">

						<!-- Header Top Left -->
						<?php
						$num = wyz_get_option( 'contact-number' );
						$sup_txt = wyz_get_option( 'support-text' );
						$sup_link = wyz_get_option( 'support-link' );?>

				
						<div class="header-top-left text-left <?php echo 'off' == wyz_get_option( 'resp' ) ? 'col-xs-4' : 'col-sm-4';?>">
							<p class="call-us">
								<?php if ( '' !== $sup_txt ) {
									if ( '' != $sup_link )
										echo '<a href="' . esc_url( $sup_link ) . '">' . esc_html( $sup_txt ) . '</a>';
									else
										echo esc_html( $sup_txt );
								} 
								if ( '' !== $num ) {
									echo esc_html( $num );
								}
								?>
							</p>
						</div>


						<?php $this->the_login_menu('center');?>
						
						<?php $cont_class = is_user_logged_in() ? '8' : '4';?>
						<!-- Header Top Right -->
						<div class="header-top-right text-right <?php echo 'off' == wyz_get_option( 'resp' ) ? "col-xs-$cont_class" : "col-sm-$cont_class";?>">
							<?php $this->the_login_menu('right');?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		private function the_logo() {
			$class = 'header1' == $this->header_template ? "text-left col-md-2 col-sm-3 col-xs-6" : "text-left col-md-4 col-sm-6 col-xs-12"; ?>
			<!-- Header Logo -->
			<div class="<?php echo $class;?>">
				<div class="header-logo">
					<a href="<?php echo esc_url( home_url( '/' ) );?>">
					<?php if ( '' !== $this->logo ) { ?>
						<img src="<?php echo esc_url( $this->logo );?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
					<?php } else {?>
						<div id="logo-ttl-cont">
							<h3><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h3>
						</div>
					<?php } ?>
					</a>
				</div>
			</div>
			<?php
		}


		public function the_main_header() { 
			if ( 'on' == wyz_get_option( 'header-login-menu' ) ) { ?>
			<div class="header-top-login-menu section hidden-xs">
				<?php $this->the_login_menu( 'top-left' ); ?>
				<?php $this->the_login_menu( 'top-right' ); ?>
				<div class="clear"></div>
			</div>
			 <?php }
			if ( 'header2' == $this->header_template ) { ?>
			<div class="header-acgbtb text-center section">
				<div class="container-fluid">
					<div class="row">
						<div class="acgbtb">
							<div class="acgbtb-content float-right text-right col-sm-6 col-xs-12">
							<?php echo wyz_get_option( 'acgbtb_right_content2' );?>
							</div>
							<?php $this->the_logo();?>
						</div>
					</div>
				</div>
			</div>

			<?php }?>
			<div class="header-bottom text-center section">
				<div class="container-fluid">
					<div class="row">

						<?php 
						if ( 'header1' == $this->header_template )
							$this->the_logo();
						
						$pref = is_user_logged_in() ? '' :'non-';
						if ( 'on' == wyz_get_option( $pref.'logged-menu-right-link')){
							$link_to = wyz_get_option($pref.'logged-menu-right-link-to');
							$link = '';
							if ( 'page' == $link_to ){
								$link = get_permalink( wyz_get_option($pref.'logged-menu-right-link-page'));
								if (!$link)$link='#';
							}elseif('link'==$link_to)
								$link = esc_url(wyz_get_option($pref.'logged-menu-right-link-link'));
							elseif(is_user_logged_in()&&'add-business'==$link_to && class_exists('WyzQueryVars'))
								$link = add_query_arg( WyzQueryVars::AddNewBusiness, true, home_url( '/user-account') );
							$link_label = wyz_get_option($pref.'logged-menu-right-link-label');?>
						
						<div class="text-right col-md-2 col-sm-s float-right hidden-xs">
							<div class="header-links">
								<a href="<?php echo $link; ?>"><i class="fa fa-paper-plane-o"></i><span><?php echo $link_label; ?></span></a>
							</div>
						</div>

						<?php } ?>


						<!-- Main Menu -->
						<?php $this->the_main_menu();?>

					</div>
				</div>
			</div>
			<?php
		}

	}
}