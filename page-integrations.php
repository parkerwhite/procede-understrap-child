<?php
/**
 * Template Name: Integrations Pages
 *
 * @package procede
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<article <?php post_class( 'solutions-page' ); ?> id="post-<?php the_ID(); ?>">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'partials/partial', 'hero' ); ?>

		<?php the_content(); ?>

		<?php

		if ( class_exists('Advanced_Custom_Fields_Partials') ) {

			$partials = new Advanced_Custom_Fields_Partials( $container );

			$partials->repeater( 'page_sections' );

		}

		?>

		<?php get_template_part( 'partials/partial', 'checklist' ); ?>

		<?php get_template_part( 'partials/partial', 'integrations' ); ?>

		<?php get_template_part( 'partials/partial', 'testimonials' ); ?>

	<?php endwhile; // end of the loop. ?>

</article><!-- #post-## -->

<?php get_footer(); ?>
