<?php
/**
 * Footer template
 *
 * @package wyz
 */

?>
<!--[if !IE 7]>
	<style type="text/css">
		#wrap {display:table;height:100%}
	</style>
<![endif]-->

<?php

$footer = new WYZIFooterFactory();
$footer->the_footer();

wp_footer();?>

<?php
global $wpdb;
$query = "SELECT * FROM `wp_postmeta` WHERE `meta_key` LIKE '%wyz_business_website%' AND `post_id`=".get_the_ID();
$result = $wpdb->get_results($query, OBJECT);
$is_website = $result[0]->meta_value;
$is_loggedin = is_user_logged_in()? "Login":"Not";
if(!$_GET["action"] == "login" && is_page("signup")):
$is_signup_page = is_page("signup")? "Signup":"Not";
endif;

if($_GET["action"] == "login" && is_page("signup")):
$is_login_page = is_page("signup")? "Login":"Not";
echo $is_login_page;
endif;
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var no_website ="<?php echo $is_website; ?>";
		var register_now_link = "<?php echo site_url('signup'); ?>";
		var login_check = "<?php echo $is_loggedin; ?>";
		var signup_check = "<?php echo $is_signup_page; ?>";
		var login_page_check = "<?php echo $is_login_page; ?>";
		if(no_website == ""){

			jQuery(".contact-info-sidebar").append('<p class="website"><a target="_blank" href="<?php echo site_url('websites');?>">GET A WEBSITE</a></p>');
		}

		if(login_check == "Not"){	
			jQuery("#login-menu a:first-child").html('LOGIN <i class="fa fa-angle-right" aria-hidden="true"></i>');

			jQuery("#login-menu a:last-child").html('REGISTER NOW <i class="fa fa-angle-right" aria-hidden="true"></i>');

			jQuery("#wyz_registration_form button#submit").html('REGISTER NOW <i class="fa fa-angle-right" aria-hidden="true"></i>');

			jQuery("#wyz_login_submit").html('LOGIN <i class="fa fa-angle-right" aria-hidden="true"></i>');
		}

		if(signup_check == "Signup"){
			jQuery(".section-title h1").html("Register Now");

			/*jQuery(".social-login-container a:first-child").click(function(e){
				if(jQuery("#subscribtion").val() == "") {
					jQuery("#subscribtion").parent().closest('div').append("<span class='error'>Please choose subscription plan</span>");
					jQuery(".error").fadeOut("7000");
					return false;
				}
			});

			jQuery(".social-login-container a:last-child").click(function(e){
				if(jQuery("#subscribtion").val() == "") {
					jQuery("#subscribtion").parent().closest('div').append("<span class='error'>Please choose subscription plan</span>");
					jQuery(".error").fadeOut("7000");
					return false;
				}
			});*/
			jQuery(".social-login-container a:first-child").hide();
			jQuery(".social-login-container a:last-child").hide();
		}

		if(login_page_check == "Login"){
			jQuery(".section-title h1").html("LOGIN TO YOUR ACCOUNT");

			jQuery(".remember-forget-pass").append('<br><lebel>Don\'t have an account?</lebel><a href="'+register_now_link+'">Register Now</a>')

			jQuery(".social-login-container a:first-child").hide();
			jQuery(".social-login-container a:last-child").hide();
		}



	});
</script>
</body>
</html>
