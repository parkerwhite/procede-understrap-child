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


/**
 * Partners grid
 */
if ( ! function_exists( 'procede_partners_row' ) ) {
	function procede_partners_row( $taxonomy1, $taxonomy2 = false ) {
		$term = get_term_by('slug', $taxonomy1, 'cpt-partner-categories');
		$args = array(
			'posts_per_page'  => -1,
			'orderby'         => 'menu_order',
			'post_type'       => 'cpt-partners',
			'post_status'     => 'publish',
			'tax_query'       => array(
				array(
					'taxonomy' => 'cpt-partner-categories',
					'terms'    => $taxonomy1,
					'field'    => 'slug',
				),
			),
		);
		if ( $taxonomy2 ) {
			$args['tax_query']['relation'] = 'AND';
			$args['tax_query'][] = array(
				'taxonomy' => 'cpt-partner-categories',
				'terms'    => $taxonomy2,
				'field'    => 'slug',
			);
		}
		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) : ?>
			<div class="row justify-content-center align-items-center mb-3">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="col-12 text-center">
						<h3 class="partner-category-title mb-2"><?php echo $term->name; ?></h3>
					</div>
					<div class="col-6 col-md-4 col-lg-3 mb-1">
						<?php
						if ( has_post_thumbnail( get_the_ID() ) ) {
							$featured_img_str = get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-featured', 'alt' => get_the_title() ) );
							echo do_shortcode( sprintf( '[button target="modal" page-id="%1$s" class="btn-link"]%2$s[/button]', get_the_ID(), $featured_img_str ) );
						} else {
							echo sprintf( '<h4>%s</h4>', get_the_title() );
						}
						?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif;

		echo ob_get_clean();

		wp_reset_query();

	}
}


