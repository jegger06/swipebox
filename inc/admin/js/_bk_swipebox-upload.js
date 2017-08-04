var addBtn = document.getElementById('img-upload-button'),
	deleteBtn = document.getElementById('img-delete-button'),
	img = document.getElementById('swipebox-image'),
	hidden = document.getElementById('img-hidden-field'),
	customUploader = wp.media({
		title: 'Select Swipebox Image',
		button: {
			text: 'Use this Image'
		},
		multiple: false
	});

var toggleVisibility = function( action ) {

	if ( action === 'ADD' ) {
		addBtn.style.display = 'none';
		deleteBtn.style.display = 'block';
		img.setAttribute('style', 'width: 100%');
	} else {
		addBtn.style.display = '';
		deleteBtn.style.display = 'none';
		img.removeAttribute('style');
	}

}

addBtn.addEventListener('click', function() {

	if ( customUploader ) {
		customUploader.open();
	}

});

customUploader.on('select', function() {
	var attachment = customUploader.state().get('selection').first().toJSON();
	img.setAttribute('src', attachment.url);
	hidden.setAttribute('value', JSON.stringify( [ { id: attachment.id, url: attachment.url } ] ));
	toggleVisibility( 'ADD' );
});

deleteBtn.addEventListener('click', function() {
	img.removeAttribute('src');
	hidden.removeAttribute('value');
	toggleVisibility( 'DELETE' );
});

window.addEventListener('DOMContentLoaded', function() {
	if ( swipeboxUploads.imageData == '' || swipeboxUploads.imageData.length == 0 ) {
		toggleVisibility( 'DELETE' );
	} else {
		img.setAttribute('src', swipeboxUploads.imageData.src);
		hidden.setAttribute('value', JSON.stringify( [ swipeboxUploads.imageData ] ) );
		toggleVisibility( 'ADD' );

	}
	
});