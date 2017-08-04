var addBtn = document.getElementById('img-upload-button'),
	deleteBtn = document.getElementById('img-delete-button'),
	imgHolder = document.getElementById('swipebox-image'),
	hidden = document.getElementById('img-hidden-field'),
	customUploader = wp.media({
		title: 'Select Swipebox Image',
		button: {
			text: 'Use this Image'
		},
		multiple: true,
		library: {
			type: 'image'
		}
	});

var toggleBtns = function( action ) {
	if ( action == 'ADD' ) {
		addBtn.style.display = 'none';
		deleteBtn.style.display = 'block';
	} else {
		addBtn.style.display = 'block';
		deleteBtn.style.display = 'none';
	}
}

addBtn.addEventListener('click', function() {

	if ( customUploader ) {
		customUploader.open();
	}

});

customUploader.on('select', function() {	
	var attachment = customUploader.state().get('selection').toJSON();
	var id = '';
	var comma = '';
	var html = '<ul class="clearfix">';
	for (var i = 0; i < attachment.length; i++) {
		html += '<li><img width="' + attachment[i].sizes.thumbnail.width + '" height="' + attachment[i].sizes.thumbnail.height + '" src="' + attachment[i].sizes.thumbnail.url + '" class="attachment-thumbnail size-thumbnail" alt="" /><p>' + attachment[i].caption + '</p></li>';
		id += '{"id":'+ attachment[i].id +',"src":"'+ attachment[i].url +'"}';
		if ((i + 1) != attachment.length) {
			id += ',';
		}
		
	}
	html += '</ul>';
	imgHolder.innerHTML = html;
	id = '[' + id + ']';
	hidden.setAttribute('value', id);
	toggleBtns( 'ADD' );
});

deleteBtn.addEventListener('click', function() {
	imgHolder.innerHTML = '';
	hidden.removeAttribute('value');
	toggleBtns( 'DELETE' );
});

window.addEventListener('DOMContentLoaded', function() {
	if ( swipeboxUploads.imageData == '' || swipeboxUploads.imageData.length == 0 ) {
		toggleBtns( 'DELETE' );
	} else {
		hidden.setAttribute('value', JSON.stringify( swipeboxUploads.imageData ) );
		toggleBtns( 'ADD' );

	}
});