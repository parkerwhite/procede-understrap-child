<?php
/**
 * Featured Post
 *
 * Gets the latest Sticky post.or if none, the latest Featured (category) post.
 *
 * @return html
 */

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
  'posts_per_page' => 1,
  'nopaging' => true,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'post_type' => 'post',
  'post_status' => 'publish',
  'suppress_filters' => true,
  'ignore_sticky_posts' => true
);

$sticky = get_option( 'sticky_posts' );

if ( !empty( $sticky ) ) {
  rsort( $sticky ); // optional: sort the newest IDs first
  $args['post__in'] = $sticky; // override the query
} else {
  $args['category_name'] = 'featured';
}

$featured_post_query = new WP_Query( $args );

ob_start();

if ( $featured_post_query->have_posts() ) : while ( $featured_post_query->have_posts() ) : $featured_post_query->the_post();

?>

<div id="featured-post" class="row row-featured mb-4">
  <div class="col">
    <?php if ( has_post_thumbnail( get_the_ID() ) ) { ?>
      <div class="img-featured-wrapper">
        <?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-featured object-fit-cover' ) ); ?>
      </div>
    <?php } ?>
    <h2><?php the_title(); ?></h2>
    <?php echo apply_filters( 'the_content', wp_trim_words( get_the_content(), 50, '...' ) ); ?>
    <p class="text-right"><a href="<?php echo get_permalink(); ?>" class="btn btn-primary"><?php echo __( 'Read More', 'understrap' ); ?></a></p>
  </div>
</div>

<?php

endwhile; endif;

wp_reset_query();

if ( $paged === 1 ) {
  echo ob_get_clean();
}
