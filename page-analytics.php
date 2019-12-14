<?php
/**
 * Template Name: Analytics Pages
 *
 * @package procede
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<article <?php post_class( 'analytics-page' ); ?> id="post-<?php the_ID(); ?>">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'partials/partial', 'hero' ); ?>

		<?php the_content(); ?>

		<?php

		if ( class_exists('ACF_Bootstrap_Builder') ) {
			$acfbb = new ACF_Bootstrap_Builder( $container );
			$acfbb->bootstrap_builder_layout();
		}

		?>

		<?php get_template_part( 'partials/partial', 'checklist' ); ?>

		<?php get_template_part( 'partials/partial', 'solutions' ); ?>

		<?php get_template_part( 'partials/partial', 'testimonials' ); ?>

	<?php endwhile; // end of the loop. ?>

</article><!-- #post-## -->

<?php get_footer(); ?>
