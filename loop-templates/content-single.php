<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
		<?php
		if ( function_exists( 'bcn_display' ) ) {
			bcn_display();
		}?>
	</div>

	<header class="entry-header">

		<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'object-fit-cover' ) ); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<div class="row">

			<div class="col"><?php understrap_entry_footer(); ?></div>

			<div class="col-12 col-md-auto">
				<span class="social-icons">
					<a href="http://www.linkedin.com/company/procede-software" target="_blank"><i class="fab fa-linkedin-in"></i></a>
					<a href="https://www.youtube.com/channel/UCLV7Lu6pQ5bD9UaSvTYTMBg" target="_blank"><i class="fab fa-youtube"></i></a>
					<a href="https://twitter.com/procedesoftware" target="_blank"><i class="fab fa-twitter"></i></a>
					<a href="http://www.facebook.com/pages/Procede-Software/196114337150947" target="_blank"><i class="fab fa-facebook-f"></i></a>
				</span>
			</div>

		</div>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
