<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package procede
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

$page_header_type = get_post_meta( get_the_ID(), 'page_header_type', true );

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php
		// if ( class_exists('Advanced_Custom_Fields_Partials') ) {
		// 	$partials = new Advanced_Custom_Fields_Partials( $container );
		// 	if ( $partials->get_field( 'page_header_type' ) ) {
		// 		$partials->acf_partial_page_header( $partials->get_field( 'page_header_type' ) );
		// 	}
		// }
		?>

		<?php get_template_part( 'partials/partial', 'hero' ); ?>

		<?php the_formatted_content(); ?>

		<?php
		if ( class_exists('Advanced_Custom_Fields_Partials') ) {
			$partials->repeater( 'page_sections' );
		}
		?>

	<?php endwhile; // end of the loop. ?>

</article><!-- #post-## -->

<?php get_footer(); ?>
