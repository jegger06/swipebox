<?php

/*

@package Custom Swipebox
===============================
	Creating the shortcode
===============================

*/


// Reference for the shortcode
// $postID = get_page_by_title( {post_name}, OBJECT, 'custom-swipebox' );

function csb_shortcode( $atts, $content = NULL ) {

	$atts = shortcode_atts(
		array(
			'name' => 'empty'
		),
		$atts
	);
	
	if ( $atts['name'] != 'empty' && $atts['name'] != '' ) {

		$post = get_page_by_path( $atts['name'], OBJECT, 'custom-swipebox' );

		if ( $post->post_status === 'publish' ) {

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
							$displaylist .= $srcset;
						$displaylist .= '</a>';
					$displaylist .= '</li>';

				}

			$displaylist .= '</ul>';

			return $displaylist;

		} else {

			echo '<pre>';
			echo var_dump(is_null( $post ));
			die();

			if ( is_null( $post ) ) {

				return '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Invalid swipebox name. Please check it.</div>';

			} else {

				return '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Swipebox status must be publish.</div>';

			}

		}

	} else {

		return '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Invalid shortcode. Please fill in the swipebox name.</div>';

	}

}

add_shortcode( 'swipebox', 'csb_shortcode' );