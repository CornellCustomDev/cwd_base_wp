<?php

// Generate header slider data
function cwd_base_generate_slide_array() {
  global $post;

  $slider_link_type = get_field( 'slider_link_type' );

  $slide_array = array();

  while ( have_rows( 'header_slides', $post->ID) ) { the_row();
    $slide_img = get_sub_field( 'slide_image' );
    $img_url = $slide_img['sizes']['slider-image'];
    $img_alt = $slide_img['alt'] ?: '';

    if ( $slider_link_type == 'full' ) {
      $slide_link = get_sub_field( 'slide_link' ) ?: '';
    } else {
      $slide_link = '';
    }

    $single_slide = array(
      $img_url,
      get_sub_field( 'slide_title' ),
      get_sub_field( 'slide_body' ),
      $slide_link,
      $img_alt,
      ''
    );

    if ( $slider_link_type == 'button' ) {
      if ( $slide_btn_1 = get_sub_field( 'slide_button_one' ) ) {
        array_push( $single_slide, $slide_btn_1['title'], $slide_btn_1['url']);
      }

      if ( $slide_btn_2 = get_sub_field( 'slide_button_two' ) ) {
        array_push( $single_slide, $slide_btn_2['title'], $slide_btn_2['url']);
      }
    }

    array_push( $slide_array, $single_slide );
  }

  return $slide_array;
}
