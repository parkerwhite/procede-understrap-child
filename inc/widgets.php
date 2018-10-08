<?php
/**
 * Declaring widgets
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter( 'widget_text', 'do_shortcode' );

add_action( 'widgets_init', 'understrap_widgets_init' );

if ( ! function_exists( 'understrap_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function understrap_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Left Sidebar', 'understrap' ),
			'id'            => 'left-sidebar',
			'description'   => __( 'Left sidebar widget area', 'understrap' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer', 'understrap' ),
			'id'            => 'footer',
			'description'   => __( 'Full sized footer widget with dynamic grid', 'understrap' ),
		    'before_widget'  => '<div id="%1$s" class="footer-widget %2$s col-12 col-md">', 
		    'after_widget'   => '</div><!-- .footer-widget -->', 
		    'before_title'   => '<h4 class="widget-title">', 
		    'after_title'    => '</h4>', 
		) );

	}
} // endif function_exists( 'understrap_widgets_init' ).
