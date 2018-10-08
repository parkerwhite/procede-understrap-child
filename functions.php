<?php

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

if (! defined('TEXTDOMAIN') ) {
    define("TEXTDOMAIN", "understrap");
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function register_custom_nav_menus() {
    register_nav_menu( 'mobile', __( 'Mobile Menu', 'understrap' ) );
    register_nav_menu( 'topnav', __( 'Top Navbar', 'understrap' ) );
}
add_action( 'after_setup_theme', 'register_custom_nav_menus' );

add_action('pre_get_posts', 'myprefix_query_offset', 1 );
function myprefix_query_offset(&$query) {

    //Before anything else, make sure this is the right query...
    if ( ! $query->is_home() ) {
        return;
    }

    //First, define your desired offset...
    $offset = 1;
    
    //Next, determine how many posts per page you want (we'll use WordPress's settings)
    $ppp = get_option('posts_per_page');

    //Next, detect and handle pagination...
    if ( $query->is_paged ) {

        //Manually determine page query offset (offset + current page (minus one) x posts per page)
        $page_offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );

        //Apply adjust page offset
        $query->set('offset', $page_offset );

    }
    else {

        //This is the first page. Just use the offset...
        $query->set('offset',$offset);

    }
}

add_filter('found_posts', 'myprefix_adjust_offset_pagination', 1, 2 );
function myprefix_adjust_offset_pagination($found_posts, $query) {

    //Define our offset again...
    $offset = 1;

    //Ensure we're modifying the right query object...
    if ( $query->is_home() ) {
        //Reduce WordPress's found_posts count by the offset... 
        return $found_posts - $offset;
    }
    return $found_posts;
}


/**
 * Initialize theme default settings
 */
// require get_stylesheet_directory() . '/inc/theme-settings.php';

/**
 * Theme setup and custom theme supports.
 */
// require get_stylesheet_directory() . '/inc/setup.php';

/**
 * Register widget area.
 */
require get_stylesheet_directory() . '/inc/widgets.php';

/**
 * Enqueue scripts and styles.
 */
// require get_stylesheet_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Custom pagination for this theme.
 */
// require get_stylesheet_directory() . '/inc/pagination.php';

/**
 * Custom hooks.
 */
require get_stylesheet_directory() . '/inc/hooks.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_stylesheet_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
// require get_stylesheet_directory() . '/inc/customizer.php';

/**
 * Custom Comments file.
 */
// require get_stylesheet_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
// require get_stylesheet_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_stylesheet_directory() . '/inc/class-procede-bootstrap-navwalker.php';

/**
 * Load WooCommerce functions.
 */
// require get_stylesheet_directory() . '/inc/woocommerce.php';

/**
 * Load Editor functions.
 */
// require get_stylesheet_directory() . '/inc/editor.php';

/**
 * Load Advanced Custom Fields Partials.
 */
require get_stylesheet_directory() . '/inc/class-advanced-custom-fields-partials.php';
