<?php
/**
 * Understrap Theme Customizer
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'procede_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function procede_theme_customize_register( $wp_customize ) {

		$wp_customize->add_setting( 'procede_footer_logo', array(
			'capability'        => 'edit_theme_options',
		) );

		$custom_logo_args = get_theme_support( 'custom-logo' );
		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'procede_footer_logo', array(
			'label'         => __( 'Footer Logo' ),
			'section'       => 'title_tagline',
			'priority'      => 9,
			'height'        => $custom_logo_args[0]['height'],
			'width'         => $custom_logo_args[0]['width'],
			'flex_height'   => $custom_logo_args[0]['flex-height'],
			'flex_width'    => $custom_logo_args[0]['flex-width'],
			'button_labels' => array(
				'select'       => __( 'Select logo' ),
				'change'       => __( 'Change logo' ),
				'remove'       => __( 'Remove' ),
				'default'      => __( 'Default' ),
				'placeholder'  => __( 'No logo selected' ),
				'frame_title'  => __( 'Select logo' ),
				'frame_button' => __( 'Choose logo' ),
			),
		) ) );


	}
} // endif function_exists( 'procede_theme_customize_register' ).
add_action( 'customize_register', 'procede_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'procede_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function procede_customize_preview_js() {
		wp_enqueue_script( 'understrap_customizer', get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ), '20130508', true
		);
	}
}
add_action( 'customize_preview_init', 'procede_customize_preview_js' );
