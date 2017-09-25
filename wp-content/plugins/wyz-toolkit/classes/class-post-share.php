<?php
class WyzPostShare{

	public static function the_js_scripts() {

		$enabled_options = get_option( 'wyz_business_post_social_share' );

		if ( isset( $enabled_options['twitter'] ) ) {?>
			<script>window.twttr = (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0],
			t = window.twttr || {};
			if (d.getElementById(id)) return t;
			js = d.createElement(s);
			js.id = id;
			js.src = "https://platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js, fjs);

			t._e = [];
			t.ready = function(f) {
			t._e.push(f);
			};

			return t;
			}(document, "script", "twitter-wjs"));</script>
		<?php 
		}

		if ( isset( $enabled_options['facebook'] ) ) {?>

			<div id="fb-root"></div>
			<script>
			window.fbAsyncInit = function() {
	          FB.init({
	            appId      : '<?php echo ( function_exists( 'wyz_get_option' ) ? wyz_get_option( 'businesses_fb_app_ID' ) : '' );?>', // App ID
	            status     : true, // check login status
	            cookie     : true, // enable cookies to allow the server to access the session
	            xfbml      : true  // parse XFBML
	          });
	        };

			/*(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));*/

			(function(d){
			var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
			js = d.createElement('script'); js.id = id; js.async = true;
			js.src = "//connect.facebook.net/en_US/all.js";
			d.getElementsByTagName('head')[0].appendChild(js);
			}(document));

			</script>
		<?php
		}

		if ( isset( $enabled_options['google'] ) ) {?>
			<script src="https://apis.google.com/js/platform.js" async defer>{parsetags: 'explicit'}</script>


		<?php
		}

		if ( isset( $enabled_options['linkedin'] ) ) {?>
			<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
		<?php
		}

		if ( isset( $enabled_options['pinterest'] ) ) {?>
			<script async defer data-pin-build="parsePinBtns" src="//assets.pinterest.com/js/pinit.js"></script>
		<?php
		}
	}

	public static function the_share_buttons( $id, $template_type = 1, $echo = true ){
		if ( ! $echo ) ob_start();
		$enabled_options = get_option( 'wyz_business_post_social_share' );
		if ( empty( $enabled_options ) )return;
		if ( $template_type == 1 ) {
			echo '<button class="busi-post-share-btn">' . esc_html__( 'SHARE', 'wyzi-business-finder' ) . '</button>';
		} elseif ( $template_type == 2 ) {
			echo '<a class="busi-post-share-btn" href="#"><i class="fa fa-share-alt"></i><span>' . esc_html__( 'SHARE', 'wyzi-business-finder' ) . '</span></a>';
		}
		echo '<div class="animated fadeInUp business-post-share-cont">';
		self::the_buttons( $id, $enabled_options );
		echo '</div>';
		if ( ! $echo ) return ob_get_clean();
	}

	private static function tthe_buttons( $id ) {
		$enabled_options = get_option( 'wyz_business_post_social_share' );


		if ( isset( $enabled_options['facebook'] ) ) {?>
			<div class="post-share">
				<div class="fb-share-button" data-href="<?php echo get_the_permalink( $id );?>" data-layout="box_count" data-size="large"></div>
				<!--<a href="http://www.facebook.com/sharer.php?u=<?php //echo get_the_permalink( $id );?>">Facebook</a>-->
			</div>
		<?php
		}

		if ( isset( $enabled_options['google'] ) ) {?>
			<div class="post-share">
				<div class="g-plus" data-action="share" data-href="<?php echo get_the_permalink( $id );?>" data-annotation="vertical-bubble" data-width="83"></div>
			</div>
		<?php
		}

		if ( isset( $enabled_options['twitter'] ) ) {?>
			<div class="post-share">
				<a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php esc_url( get_the_excerpt( $id ) );?>" data-size="large">
				<?php esc_html_e( 'Tweet', 'wyzi-business-finder' );?></a>
			</div>
		<?php 
		}


		if ( isset( $enabled_options['linkedin'] ) ) {?>
			<div class="post-share">
			<script type="IN/Share" data-url="<?php echo get_the_permalink( $id );?>" data-counter="top"></script>
			</div>
		<?php
		}

		if ( isset( $enabled_options['pinterest'] ) ) {?>
			<div class="post-share post-share-pin">
				<a data-pin-do="buttonPin" data-pin-count="above" data-pin-save="true" data-pin-tall="true" href="https://www.pinterest.com/pin/create/button/?url=<?php echo get_the_permalink( $id );?>&media=<?php echo get_the_post_thumbnail_url( $id, 'large' )?>&description=<?php get_the_excerpt( $id )?>"></a>
			</div>
		<?php
		}
	}

	private static function the_buttons( $id, $enabled_options ) {
		

		if ( isset( $enabled_options['facebook'] ) ) {?>
			<div class="post-share share-facebook">
				<a href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink( $id );?>" target="_blank">
					<i class="fa fa-facebook" aria-hidden="true"></i>
					<!--<img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />-->
				</a>
			</div>
		<?php
		}

		if ( isset( $enabled_options['google'] ) ) {?>
			<div class="post-share share-google">
				<a href="https://plus.google.com/share?url=<?php echo get_the_permalink( $id );?>" target="_blank">
					<!--<img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />-->
					<i class="fa fa-google" aria-hidden="true"></i>
				</a>
			</div>
		<?php
		}

		if ( isset( $enabled_options['twitter'] ) ) {?>
			<div class="post-share share-twitter">
				<a href="https://twitter.com/share?url=<?php echo get_the_permalink( $id );?>&amp;text=<?php echo esc_url( get_the_excerpt( $id ) );?>&amp;" target="_blank">
        			<!--<img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />-->
        			<i class="fa fa-twitter" aria-hidden="true"></i>
        		</a>
				
			</div>
		<?php 
		}


		if ( isset( $enabled_options['linkedin'] ) ) {?>
			<div class="post-share share-linkedin">
			<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo get_the_permalink( $id );?>" target="_blank">
				<!--<img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />-->
				<i class="fa fa-linkedin" aria-hidden="true"></i>
			</a>
			</div>
		<?php
		}

		if ( isset( $enabled_options['pinterest'] ) ) {?>
			<div class="post-share share-linkedin">
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo get_the_permalink( $id );?>&media=<?php echo get_the_post_thumbnail_url( $id, 'large' )?>&description=<?php get_the_excerpt( $id )?>" class="pin-it-button">
					<!--<img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />-->
					<i class="fa fa-pinterest-p" aria-hidden="true"></i>
				</a>
			</div>
		<?php
		}
	}
}
?>