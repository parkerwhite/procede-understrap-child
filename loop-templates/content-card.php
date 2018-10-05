<?php
/**
 * Partial template for Cards used in card-decks
 *
 * @package fareverse
 */

?>

<article <?php post_class( array( 'card' ) ); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>

		<?php $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>

		<div class="card-header">

			<img src="<?php echo $featured_img_url; ?>" alt="" class="object-fit-cover card-img-top">

		</div>

	<?php endif; ?>

	<div class="card-body">

		<?php the_title( '<h5 class="card-title">', '</h5>' ); ?>

		<?php
		if ( has_excerpt() ) {
			echo get_the_excerpt();
		} else {
			echo wp_trim_words( get_the_content(), 50, '...' );
		}
		?>

	</div><!-- .card-body -->

	<div class="card-footer text-right">

		<a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary"><?php _e( 'Read More', 'understrap' ); ?></a>

	</div><!-- .card-footer -->

</article><!-- #post-## -->
