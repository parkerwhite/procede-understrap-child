<?php
/**
 * Partial template for Cards used in card-decks
 *
 * @package fareverse
 */

$post_type = get_post_type( $post->ID );

?>

<article <?php post_class( array( 'card' ) ); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail( $post->ID ) ) : ?>

		<?php $featured_img_url = get_the_post_thumbnail_url( $post->ID, 'large' ); ?>

		<div class="card-header">

			<img src="<?php echo $featured_img_url; ?>" alt="" class="object-fit-cover card-img-top">

		</div>

	<?php endif; ?>

	<div class="card-body">

		<?php the_title( '<h5 class="card-title">', '</h5>' ); ?>

		<?php if ( has_excerpt() ) { ?>

			<?php echo get_the_excerpt(); ?>

		<?php } elseif ( has_more_tag() ) { ?>

			<?php the_content(); ?>

		<?php } else { ?>

			<?php echo wp_trim_words( get_the_content(), 50, '...' ); ?>

		<?php } ?>

	</div><!-- .card-body -->

	<div class="card-footer text-right">

		<a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary"><?php _e( 'Read More', 'understrap' ); ?></a>

	</div><!-- .card-footer -->

</article><!-- #post-## -->
