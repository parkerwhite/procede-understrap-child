<?php
/**
 * Partial template for Cards used in card-decks
 *
 * @package fareverse
 */

?>

<article <?php post_class( array( 'card' ) ); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="card-header">

			<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'object-fit-cover' ) ); ?>

		</div>

	<?php endif; ?>

	<div class="card-body">

		<?php the_title( '<h5 class="card-title">', '</h5>' ); ?>

		<?php
		if ( has_excerpt() ) {
			echo apply_filters( 'the_content', get_the_excerpt() );
		} else {
			echo apply_filters( 'the_content', wp_trim_words( get_the_content(), 50, '...' ) );
		}
		?>

	</div><!-- .card-body -->

	<div class="card-footer text-right">

		<a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary"><?php _e( 'Read More', 'understrap' ); ?></a>

	</div><!-- .card-footer -->

</article><!-- #post-## -->
