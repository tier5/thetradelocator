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

	
	jQuery("#subscribtion, input[name=wyz_user_pass_confirm]").on("change", function(){
		var second_option = jQuery(this).val();
		
		if( second_option == "business_owner"){
			
			jQuery(".stripe_subs").remove();
			jQuery("#stripe_subs_form").remove();
			jQuery("#subscribtion").parent().closest('div').append('<div class="stripe_subs"><button type="button" class="wyz-button orange" id="customButton">SIGN UP <i class="fa fa-angle-right" aria-hidden="true"></i></button></div>');
			jQuery(".register-form").append('<form id="stripe_subs_form" action="'+ajax_params.home+'/create-subscription" method="POST"><input type="hidden" class="ttl_stripe_uname" name="ttl_stripe_uname"><input type="hidden" class="ttl_stripe_email" name="ttl_stripe_email"><input type="hidden" class="ttl_stripe_password" name="ttl_stripe_password"></form>');
			var handler = StripeCheckout.configure({
			  key: ajax_params.stripe_test_key,
			  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
			  locale: 'auto',
			  token: function(token) {
			    // You can access the token ID with `token.id`.
			    // Get the token ID to your server-side code for use.
			    jQuery("#stripe_subs_form").submit();
			  }
			});

			document.getElementById('customButton').addEventListener('click', function(e) {

				
				if(jQuery("input[name=wyz_user_register]").val() == "") {
					jQuery("input[name=wyz_user_register]").parent().closest('div').append("<span class='error'>Enter Username</span>");
				} else if(jQuery("input[name=wyz_user_email]").val() == "" ) {
					jQuery("input[name=wyz_user_email]").parent().closest('div').append("<span class='error'>Enter Email</span>");
				} else if(!isValidEmailAddress(jQuery("input[name=wyz_user_email]").val())) {
					jQuery("input[name=wyz_user_email]").parent().closest('div').append("<span class='error'> Enter Valid Email</span>");
				} else if(jQuery("input[name=wyz_user_first]").val() == "") {
					jQuery("input[name=wyz_user_first]").parent().closest('div').append("<span class='error'>Enter First name</span>");
				} else if(jQuery("input[name=wyz_user_last]").val() == "") {
					jQuery("input[name=wyz_user_last]").parent().closest('div').append("<span class='error'>Enter Last name</span>");
				} else if(jQuery("input[name=wyz_user_pass]").val() == "") {
					jQuery("input[name=wyz_user_pass]").parent().closest('div').append("<span class='error'>Enter Password</span>");
				} else if(jQuery("input[name=wyz_user_pass_confirm]").val() == "") {
					jQuery("input[name=wyz_user_pass_confirm]").parent().closest('div').append("<span class='error'>Enter Confirm Password</span>");
				} else {

					// Open Checkout with further options:
					handler.open({
						name: 'The Trade Locator',
						description: 'Subscribtion for business owner',
						zipCode: false,
						amount: 4500,
						currency:"GBP"
					});

				}
			 
			  
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

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};