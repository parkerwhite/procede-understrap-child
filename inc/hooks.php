<?php
/**
 * Custom hooks.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'understrap_site_info' ) ) {
  /**
   * Add site info hook to WP hook library.
   */
  function understrap_site_info() {
    do_action( 'understrap_site_info' );
  }
}

if ( ! function_exists( 'understrap_add_site_info' ) ) {
  add_action( 'understrap_site_info', 'understrap_add_site_info' );

  /**
   * Add site info content.
   */
  function understrap_add_site_info() {
    $the_theme = wp_get_theme();
    
    $site_info = sprintf(
      '<p>Copyright © %1$d %2$s. All rights reserved. <a href="%3$s">Privacy Policy</a> | <a href="%4$s">Terms of Service</a></p>', date( "Y" ), get_bloginfo( 'name' ), get_privacy_policy_url(), get_permalink( 865 )
    );

    echo apply_filters( 'understrap_site_info_content', $site_info ); // WPCS: XSS ok.
  }
}
