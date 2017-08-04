<?php

/*

@package Custom Swipebox

======================================================
	CUSTOM SWIPEBOX CPT ADD CUSTOM META BOX FIELDS
======================================================

*/

?>



<div class="metabox-wrapper" id="test">
	<div class="image-holder" id="swipebox-image">

		<?php 
			$data =  get_post_meta( $post->ID, 'swipebox_image', true );
			if ( !empty($data) ) { ?>
				<ul class="clearfix">
			<?php
				for ($i=0; $i < count($data); $i++) {
				$caption = wp_get_attachment_caption( $data[$i]['id'] );
			?>
					<li>
						<?php echo wp_get_attachment_image( $data[$i]['id'] ); ?>
						<p><?php echo ( !empty( $caption ) ) ? $caption : 'Please input a caption on the image' ?></p>
					</li>
		<?php 	} ?>
				</ul>
		<?php
			}
		?>
	</div>
	<input type="hidden" id="img-hidden-field" name="swipebox_image">
	<input type="button" id="img-upload-button" class="button" value="Add Image">
	<input type="button" id="img-delete-button" class="button" value="Remove Image">
</div>