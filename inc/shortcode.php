<?php

/*

@package Custom Swipebox
===============================
	Creating the shortcode
===============================

*/

function csb_shortcode( $atts, $content = NULL ) {

	$atts = shortcode_atts(
		array(
			'name' => 'empty'
		),
		$atts
	);
	
	if ( $atts['name'] != 'empty' && $atts['name'] != '' ) {

		$post = get_page_by_path( $atts['name'], OBJECT, 'custom-swipebox' );

		if ( $post->post_status === 'publish' && $post->post_password == '' ) {

			wp_enqueue_style( 'swipebox-css' );
			wp_enqueue_style( 'custom-swipebox-css' );
			wp_enqueue_script( 'swipebox-script' );
			wp_enqueue_script( 'custom-swipebox-script' );

			$postID = $post->ID;

			$images = get_post_meta( $postID, 'swipebox_image', true );

			$displaylist .= '<ul class="swipebox-list clearfix">';

				foreach ($images as $image => $value) {

					$image = get_post( $value['id'] );
					$caption = ( !empty( $image->post_excerpt ) ) ? $image->post_excerpt : 'Please set the caption of this image!';
					$alt = ( !empty(get_post_meta( $value['id'], '_wp_attachment_image_alt', true ) ) ) ? get_post_meta( $value['id'], '_wp_attachment_image_alt', true ) : 'You can set the alt on the image on media post type.';

					$imagemeta = wp_get_attachment_metadata( $value['id'] );

					$imgsrc = '<img src="' . wp_get_attachment_image_src( $value['id'], 'medium' )[0] . '" alt="' . esc_html__( $alt ) . '">';

					$srcset = wp_image_add_srcset_and_sizes( $imgsrc, $imagemeta, $value['id'] );

					$displaylist .= '<li class="col-sm-4">';
						$displaylist .= '<a href="' . esc_url( $value['src'] ) . '" class="swipebox" title="' . esc_html__( $caption ) . '">';
							$displaylist .= '<figure>' . $srcset . '</figure>';
						$displaylist .= '</a>';
					$displaylist .= '</li>';

				}

			$displaylist .= '</ul>';

			return $displaylist;

		} else {

			$args = array(
				'post_type' => 'custom-swipebox',
				'post_name__in' => array( $atts['name'] ),
				'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')
			);

			$query = new WP_Query( $args );

			if ( !is_null( $query->post ) ) {

				if ( $query->post->post_status == 'private' ) {

					$error = 'The swipebox <strong>post visibility</strong> must be on public not on private.';

				} elseif ( $query->post->post_status == 'pending' ) {

					$error = 'The swipebox <strong>post status</strong> must be publish not on pending review.';

				} elseif ( $query->post->post_status == 'draft' ) {

					$error = 'The swipebox <strong>post status</strong> must be publish not on draft.';

				} elseif ( $query->post->post_status == 'publish' && !empty( $query->post->post_password ) ) {

					$error = 'The swipebox <strong>post visibility</strong> must not be password protected.';

				} elseif ( $query->post->post_status == 'trash' ) {

					$error = 'The swipebox <strong>post</strong> must not be in trash.';

				}

			} else {

				$error = 'The swipebox <strong>post</strong> must not be in trash and must be valid.';

			}

			return '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> ' . $error . '</div>';

		}

	} else {

		return '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Invalid <strong>shortcode</strong>. Please fill in the swipebox name.</div>';

	}

}

add_shortcode( 'swipebox', 'csb_shortcode' );