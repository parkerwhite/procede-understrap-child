<?php
/**
 * Custom Learn More links
 *
 * Add an inline button to content, with customizeable CSS classes, and
 * link to a page by `page-id` or URL.
 *
 * [button class="btn-primary"]My Button[/button]
 *
 * @param array $atts Button attributes
 *
 * @return string Button HTML
 */
function shortcode_learn_more( $atts ) {

	$a = shortcode_atts( array(
		'id'        => '' // link-to page ID
	), $atts );

	ob_start();

	?>

	<a href="<?php echo get_permalink( $a['id'] ); ?>" class="btn btn-link btn-learn-more" ><span>Learn More <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>

	<?php

	return ob_get_clean();

}
add_shortcode( 'learnmore', 'shortcode_learn_more', 10, 1 );