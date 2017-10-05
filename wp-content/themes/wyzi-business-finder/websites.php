<?php
/* Template Name: Websites*/
get_header();
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
				<button type="button" class="wyz-button orange" id="basicPlan">£90pm <i class="fa fa-angle-right" aria-hidden="true"></i></button>
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
				<button type="button" class="wyz-button orange" id="unlimitedPlan">£199pm <i class="fa fa-angle-right" aria-hidden="true"></i></button>
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
			    window.location = "<?php echo home_url(); ?>";
			  }
			});

			document.getElementById('basicPlan').addEventListener('click', function(e) {


					// Open Checkout with further options:
					handler.open({
						name: 'The Trade Locator',
						description: 'Subscribtion for business owner',
						zipCode: false,
						amount: 9000,
						currency:"GBP"
					});
			  
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
			    window.location = "<?php echo home_url(); ?>";
			  }
			});

			document.getElementById('unlimitedPlan').addEventListener('click', function(e) {


					// Open Checkout with further options:
					handlerUnlimited.open({
						name: 'The Trade Locator',
						description: 'Subscribtion for business owner',
						zipCode: false,
						amount: 19900,
						currency:"GBP"
					});
			  
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