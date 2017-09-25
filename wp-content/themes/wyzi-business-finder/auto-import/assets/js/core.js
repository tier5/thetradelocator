jQuery(function($){
	
	var attachments_per_query=3;
	
	$('.wyz_importer_start').click(function(e){
		e.preventDefault();
		
		$('.wyz_importer_start').unbind('click').attr('disabled','disabled');
		
		var import_attachments=$(this).data('import-attachments');
		
		$('#wyz_import_status').show();

		var whichDemo = $('#wyz_which_demo').val();
		
		if(import_attachments) {
			
			$('#wyz_status_text').html('Importing media files...');
			
			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: {
					wyz_which_demo : whichDemo,
					action: 'wyz_demo_import',
					wyz_importing_action: 'start'
				},
				dataType: 'json'
			}).success(function(data){
			
				if(data.attachments) {
					var start_from=parseInt(data['last_attachment_index']) + 1;
					wyz_process(data, start_from, wyz_others, whichDemo);
				} else {
					wyz_others(whichDemo);
				}
				
			});
			
		} else {
			wyz_others(whichDemo);
		}
	});
	
	function wyz_process(data, start_from, finished_callback,whichDemo) {

		if(start_from < data.attachments.length) {
			
			$('#wyz_progress').show();
			var w=start_from > 0 ? start_from / data.attachments.length : 0;
			w*=100;
			$('#wyz_progress_bar').css('width', w + '%' );
			$('#wyz_progress_text').html(start_from + ' / ' + data.attachments.length);
			
			var last=start_from + attachments_per_query;
			if(last > data.attachments.length)
				last=data.attachments.length;
			var	attachments=data.attachments.slice(start_from, last);
			if(attachments.length) {
				
				$.ajax({
					type: "POST",
					url: ajaxurl,
					data: {
						action: 'wyz_demo_import',
						wyz_importing_action: 'process_attachments',
						wyz_which_demo: whichDemo,
						data: {
							common: data.common,
							attachments: attachments,
							first_attachment_index: start_from
						}
					},
					dataType: 'json'
				}).success(function(){
					wyz_process(data, start_from + attachments_per_query, finished_callback, whichDemo);
				});
				
			}
			
		} else {
			$('#wyz_progress').hide();
			
			finished_callback(whichDemo);
		}
		
	}
	
	function wyz_others(whichDemo) {
		
		$('#wyz_status_text').html('Importing posts, pages, menus, etc...');
		
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
				action: 'wyz_demo_import',
				wyz_which_demo: whichDemo,
				wyz_importing_action: 'process_other'
			},
			dataType: 'json'
		}).success(function(data){
			if(data.error == 0) {
				document.location=document.location+'&import_completed=true';
			} else {
				$('#wyz_status_text').html('An error has occured');
				$('#wyz_spinner').hide();
			}
		});
	}
		
});