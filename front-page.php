<?php
/**
 * This is the front page.
 *
 * @package fareverse
 */

get_header();

$container = get_theme_mod( 'understrap_container_type' );

$page_header_type = get_post_meta( get_the_ID(), 'page_header_type', true );

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php // fareverse_page_header( $page_header_type ); ?>

  <?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'partials/partial', 'hero' ); ?>

    <?php the_content(); ?>

		<?php

		if ( class_exists('Advanced_Custom_Fields_Partials') ) {

			$partials = new Advanced_Custom_Fields_Partials( $container );

			// if ( $partials->get_field( 'page_header_type' ) ) {
			// 	$partials->acf_partial_page_header( $partials->get_field( 'page_header_type' ) );
			// }

			$partials->repeater( 'page_sections' );

		}

		?>

	<?php endwhile; // end of the loop. ?>

</article><!-- #post-## -->

<?php get_footer(); ?>
