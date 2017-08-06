jQuery(document).ready(function($) {

	var errorTitle = 'The post title is required.',
		errorImage = 'Please select atleast one image.';

	$('#post').submit(function(e) {
		if ( $('input[name="post_title"]').val() == '' ) {
			e.preventDefault();
			if ( $('#error_post_title').length == 0 ) {
				$('<div id="error_post_title" class="error_post notice notice-error is-dismissible"><p>' + errorTitle +  '</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>').insertAfter('.wp-header-end');
				
			}
			if ( $('input[name="swipebox_image"]').val() != '' ) {
				$('#error_post_image').slideUp('fast', function() {
					$(this).remove();
				})
			}
		} 

		if ( $('input[name="swipebox_image"]').val() == '' ) {
			e.preventDefault();
			if ( $('#error_post_image').length == 0 ) {
				$('<div id="error_post_image" class="error_post notice notice-error is-dismissible"><p>' + errorImage +  '</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>').insertAfter('.wp-header-end');
			}

			if ( $('input[name="post_title"]').val() != '' ) {
				$('#error_post_title').slideUp('fast', function() {
					$(this).remove();
				})
			}
		}
	});

	$('.wrap').on('click', '.error_post button', function() {
		$(this).parent().slideUp('fast', function() {
			$(this).remove();
		});
		console.log('removed');
	});


});