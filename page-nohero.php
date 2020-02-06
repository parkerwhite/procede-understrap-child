<?php
/**
 * Template name: "No Hero" Page
 *
 * @package procede
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

$page_header_type = get_post_meta( get_the_ID(), 'page_header_type', true );

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php the_formatted_content(); ?>

		<?php
		if ( class_exists('Advanced_Custom_Fields_Partials') ) {
			$partials = new Advanced_Custom_Fields_Partials( $container );
			$partials->repeater( 'page_sections' );
		}
		?>

	<?php endwhile; // end of the loop. ?>

</article><!-- #post-## -->

<?php get_footer(); ?>
