<?php
/* Template Name: Websites*/
get_header();

$is_loggedin = is_user_logged_in()? "Login":"Not";

if($_REQUEST["plan"] == "basic") {

	wcgod_create_subscription(get_option("edit_basic_web_plan"));
}

if($_REQUEST["plan"] == "ultimate") {

	wcgod_create_subscription(get_option("edit_unlimited_web_plan"));
}
?>
<div class="margin-bottom-100">
	<div class="container">
		<div class="row">
		<div id="plans_wrapper">
			<div class="basic_plan" id="plans_leftcolumn">
				<h3>Basic Website</h3>
				<ul>
					<li>Excellent Responsive Website</li>
					<li>Upto 5 Dynamic Pages</li>
					<li>Content Management System</li>
					<li>Google SEO Friendly</li>
					<li>Meta Tags for Each Page</li>
					<li>Social Bookmarks</li>
					<li>JQuery Banner</li>
					<li>Contact Form</li>
					<li>Photo Gallery</li>
				</ul>
				<button type="button" class="wyz-button orange" id="basicPlan">£90pm <i class="fa fa-angle-right" aria-hidden="true"></i></button><br><br>
				<form id="basic_plan_form" action="" method="post">
					<input type="hidden" name="plan" value="basic">
				</form>
			</div>
			
			<div class="ultimate_plan" id="plans_rightcolumn">
				<h3>Unlimited Website</h3>
				<ul>
					<li>Excellent Responsive Website</li>
					<li>Unlimited Dynamic Pages</li>
					<li>Content Management System</li>
					<li>Google SEO Friendly</li>
					<li>Unlimited Meta Tags</li>
					<li>Social Bookmarks</li>
					<li>JQuery Banner</li>
					<li>Contact Form</li>
					<li>Photo Gallery</li>
				</ul>
				<button type="button" class="wyz-button orange" id="unlimitedPlan">£199pm <i class="fa fa-angle-right" aria-hidden="true"></i></button><br><br>
				<form id="ultimate_plan_form" action="" method="post">
					<input type="hidden" name="plan" value="ultimate">
				</form>
			</div>
			
			</div>
		</div>
	</div>
	<script type="text/javascript">
	/* Basic plan script */
		var handler = StripeCheckout.configure({
			  key: "<?php echo (get_option('edit_check_mode')=='Live')? get_option("edit_live_api_key") : get_option("edit_test_api_key"); ?>",
			  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
			  locale: 'auto',
			  token: function(token) {
			    // You can access the token ID with `token.id`.
			    // Get the token ID to your server-side code for use.
			    
			    jQuery("#basic_plan_form").submit();
			  }
			});

			document.getElementById('basicPlan').addEventListener('click', function(e) {

				var check_logged_in = "<?php echo $is_loggedin; ?>";
				
				if(check_logged_in == "Not") {
					jQuery(".basic_plan").append('<span class="basic error">Please login</span>');
					jQuery(".error").fadeOut("slow");
				} else {
					// Open Checkout with further options:
					handler.open({
						name: 'The Trade Locator',
						description: 'Subscribtion for business owner',
						zipCode: false,
						amount: 9000,
						currency:"GBP"
					});
			  	}
			  e.preventDefault();
			});

			// Close Checkout on page navigation:
			window.addEventListener('popstate', function() {

			handler.close();

			});
		/* Basic plan script End */

		/* Unlimited plan script */
			var handlerUnlimited = StripeCheckout.configure({
			  key: "<?php echo (get_option('edit_check_mode')=='Live')? get_option("edit_live_api_key") : get_option("edit_test_api_key"); ?>",
			  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
			  locale: 'auto',
			  token: function(token) {
			    // You can access the token ID with `token.id`.
			    // Get the token ID to your server-side code for use.
			    
			    jQuery("#ultimate_plan_form").submit();
			  }
			});

			document.getElementById('unlimitedPlan').addEventListener('click', function(e) {

				var check_logged_in = "<?php echo $is_loggedin; ?>";
				
				if(check_logged_in == "Not") {
					jQuery(".ultimate_plan").append('<span class="basic error">Please login</span>');
					jQuery(".error").fadeOut("slow");
				} else {

					// Open Checkout with further options:
					handlerUnlimited.open({
						name: 'The Trade Locator',
						description: 'Subscribtion for business owner',
						zipCode: false,
						amount: 19900,
						currency:"GBP"
					});
			  	}
			  e.preventDefault();
			});

			// Close Checkout on page navigation:
			window.addEventListener('popstate', function() {

			handlerUnlimited.close();

			});
		/* Unlimited plan script End */	
	</script>
</div>		
<?php get_footer(); ?>