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

if ( ! function_exists( 'modify_the_query' ) ) {
  add_action('pre_get_posts', 'modify_the_query');

  /**
   * Set the number of posts per page to N
   */
  function modify_the_query( $query ) {

    $numposts = 9;
    // if ( ! is_admin() && $query->is_main_query() ) {
    //   $query->set( 'posts_per_page', $numposts );
    // }

    if ( is_home() && $query->is_main_query() ) {
      $query->set( 'ignore_sticky_posts', true );
    }

    return;
  }
}

if ( ! function_exists( 'custom_logo_class' ) ) {
  add_filter( 'get_custom_logo', 'custom_logo_class' );

  /**
   * Add class to custom logo
   */
  function custom_logo_class( $html ) {
      // $html = str_replace( 'custom-logo', 'your-custom-class', $html );
      $html = str_replace( 'custom-logo-link', 'custom-logo-link navbar-brand', $html );

      return $html;
  }
}

if ( ! function_exists( 'remove_br_from_autop' ) ) {
  remove_filter( 'the_content', 'wpautop' );
  add_filter( 'the_content', 'remove_br_from_autop', 10 );

  /**
   * Remove <br> from `wpautop` filter in `the_content`
   */
  function remove_br_from_autop( $content ) {
    $br = false;
    return wpautop( $content, $br );
  }
}
