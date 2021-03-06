<?php
/**
 * Theme basic setup.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );

if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function understrap_all_excerpts_get_more_link( $post_excerpt ) {

		return $post_excerpt . '...';
	}
}

/**
 * ACF Options Page
 */
if( function_exists( 'acf_add_options_page' ) ) {
	$parent = acf_add_options_page( array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	) );

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Archive Settings',
		'menu_title' 	=> 'Archive Settings',
		'parent_slug' 	=> $parent['menu_slug'],
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Services',
		'menu_title' 	=> 'Services',
		'parent_slug' 	=> $parent['menu_slug'],
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Solutions',
		'menu_title' 	=> 'Solutions',
		'parent_slug' 	=> $parent['menu_slug'],
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Integrations',
		'menu_title' 	=> 'Integrations',
		'parent_slug' 	=> $parent['menu_slug'],
	));
}
