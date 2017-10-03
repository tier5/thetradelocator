jQuery(document).ready(function(){
	jQuery(".add_to_cart_button").click(function(){
		jQuery.ajax({
			type: "POST",
			url: ajax_params.ajax_url,
			data:{
				action:"wcgod_cart_content_ajax_function",
			}
		})
		.done(function(response) {

			jQuery(".cart-count").html(response);
		})
		.fail(function() {
			//alert( "error" );
			
		})
		.always(function() {
		//alert( "finished" );
		});
	});

	
	jQuery("#subscribtion").on("change", function(){
		var second_option = jQuery(this).val();
		
		if( second_option == "business_owner"){
			
			jQuery(".stripe_subs").remove();
			jQuery("#subscribtion").parent().closest('div').append('<div class="stripe_subs"><form id="stripe_subs_form" action="'+ajax_params.home+'/create-subscription" method="POST"><input type="hidden" class="ttl_stripe_uname" name="ttl_stripe_uname"><input type="hidden" class="ttl_stripe_email" name="ttl_stripe_email"><input type="hidden" class="ttl_stripe_password" name="ttl_stripe_password"><button type="button" class="wyz-button orange" id="customButton">SIGN UP <i class="fa fa-angle-right" aria-hidden="true"></i></button><form></div>');
			
			var handler = StripeCheckout.configure({
			  key: 'pk_test_2mWUf3dtd750Y13Ao6TM3xph',
			  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
			  locale: 'auto',
			  token: function(token) {
			    // You can access the token ID with `token.id`.
			    // Get the token ID to your server-side code for use.
			    jQuery("#stripe_subs_form").submit();
			  }
			});

			document.getElementById('customButton').addEventListener('click', function(e) {
			 
			  // Open Checkout with further options:
			  handler.open({
			    name: 'The Trade Locator',
			    description: 'Subscribtion for business owner',
			    zipCode: false,
			    amount: 4500,
			    currency:"GBP"
			  });
			  e.preventDefault();
			});

			// Close Checkout on page navigation:
			window.addEventListener('popstate', function() {

			  handler.close();

			});

			jQuery(".wyz-button.orange.icon").css("display","none");
			
			var user_name = jQuery("input[name=wyz_user_register]").val();
			var user_email = jQuery("input[name=wyz_user_email]").val();
			var user_pass = jQuery("input[name=wyz_user_pass]").val();
			jQuery(".ttl_stripe_uname").val(user_name);
			jQuery(".ttl_stripe_email").val(user_email);
			jQuery(".ttl_stripe_password").val(user_pass);

			
		} else {
			jQuery(".stripe_subs").remove();
			jQuery(".wyz-button.orange").css("display","block");
		}
	});
});