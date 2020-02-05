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
if ( ! function_exists( 'procede_partners_cards' ) ) {
	function procede_partners_cards( $taxonomy ) {
		$args = array(
			'posts_per_page'  => -1,
			'orderby'         => 'menu_order',
			'post_type'       => 'cpt-partners',
			'post_status'     => 'publish',
			'tax_query'       => array(
				array(
					'taxonomy' => 'cpt-partner-categories',
					'terms'    => $taxonomy,
					'field'    => 'slug',
				),
			),
		);
		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) : ?>
			<div class="row justify-content-center card-deck partners-card-deck" data-cols="4">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-1 p-0">
						<div class="card">
							<div class="card-body">
								<?php $terms = get_the_terms( get_the_ID(), 'cpt-partner-categories' ); ?>
								<?php
								if ( has_post_thumbnail( get_the_ID() ) ) {
									echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-featured', 'alt' => get_the_title() ) );
								} else {
									echo sprintf( '<h4>%s</h4>', get_the_title() );
								}
								?>
							</div>
							<div class="card-footer">
								<h4 class="partner-category-title"><?php echo filtered_terms_str( $terms, $taxonomy ); ?></h4>
							</div>
							<?php echo do_shortcode( sprintf( '[button target="modal" page-id="%1$s" class="btn-link"]%2$s[/button]', get_the_ID(), '' ) ); ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif;

		echo ob_get_clean();

		wp_reset_query();

	}
}

if ( ! function_exists( 'filtered_terms_str' ) ) {
	function filtered_terms_str( $terms, $filter ) {
		$new_terms_arr = array();
		$filtered_array = array_filter($terms, function ($term) use ($filter) {
			return ($term->slug !== $filter);
		});
		foreach ( $filtered_array as $term ) {
			$new_terms_arr[] = $term->name;
		}
		return implode( ", ", $new_terms_arr );
	}
}

/**
 * Integrations Partners grid
 */
if ( ! function_exists( 'procede_integrations_partners_cards' ) ) {
	function procede_integrations_partners_cards() {
		$args = array(
			'posts_per_page'  => -1,
			'orderby'         => 'title',
			'order'						=> 'ASC',
			'post_type'       => 'cpt-integrations',
			'post_status'     => 'publish',
		);
		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) : ?>
			<div class="row card-deck integrations-partners-card-deck" data-cols="4">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-1 p-0">
						<div class="card">
							<div class="card-body">
								<?php
								if ( has_post_thumbnail( get_the_ID() ) ) {
									echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-featured', 'alt' => get_the_title() ) );
								} else {
									echo sprintf( '<h4>%s</h4>', get_the_title() );
								}
								?>
							</div>
							<?php /* echo do_shortcode( sprintf( '[button target="modal" page-id="%1$s" class="btn-link"]%2$s[/button]', get_the_ID(), '&nbsp;' ) ); // Modal if needed */ ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif;

		echo ob_get_clean();

		wp_reset_query();

	}
}

