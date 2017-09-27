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
	
});