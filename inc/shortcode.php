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

	if ( $atts['name'] != 'empty' ) {

		$post = get_page_by_title( $atts['name'], OBJECT, 'custom-swipebox' );


		if ( $post->post_status === 'publish' ) {

			$postID = $post->ID;

			$images = get_post_meta( $postID, 'swipebox_image', true );

			$displaylist = '<div class="w3ls-gallery-grids">';

				foreach ($images as $image => $value) {

					$image = get_post( $value['id'] );
					$caption = ( !empty( $image->post_excerpt ) ) ? $image->post_excerpt : 'Please set the caption of this image!';
					$alt = ( !empty(get_post_meta( $value['id'], '_wp_attachment_image_alt', true ) ) ) ? get_post_meta( $value['id'], '_wp_attachment_image_alt', true ) : 'You can set the alt on the image on media post type.';

					$displaylist .= '<div class="col-md-4 gal-grid">';
						$displaylist .= '<div class="gal-img">';
							$displaylist .= '<a href="' . esc_url( $value['src'] ) . '" class="b-link-stripe b-animate-go swipebox">';
								$displaylist .= '<div class="item item-type-double">';
									$displaylist .= '<div class="item-hover">';
										$displaylist .= '<div class="item-info">';
											$displaylist .= '<div class="line"></div>';
											$displaylist .= '<div class="headline">Style Decor</div>';
											$displaylist .= '<div class="line"></div>';
										$displaylist .= '</div>';
										$displaylist .= '<div class="mask"></div>';
									$displaylist .= '</div>';
									$displaylist .= '<div class="item-img"><img src="' . wp_get_attachment_image_src( $value['id'] )[0] . '" alt="' . esc_html__( $alt ) . '"></div>';
								$displaylist .= '</div>';
							$displaylist .= '</a>';
							$displaylist .= '<p>' . esc_html__( $caption ) . '</p>';
						$displaylist .= '</div>';
					$displaylist .= '</div>';

				}

			$displaylist .= '</div>';

			wp_enqueue_style( 'swipebox-css' );
			wp_enqueue_script( 'swipebox-script' );
			wp_enqueue_script( 'custom-swipebox-script' );

			return $displaylist;

		} else {
			return 'Swipebox status must be publish.';
		}

	} else {
		return 'Invalid shortcode. Please check it. Copy the shortcode provided from this link <a href="#">Link</a>';
	}

}

add_shortcode( 'swipebox', 'csb_shortcode' );