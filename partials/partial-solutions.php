<?php
/**
 * Solutions Card Deck
 *
 * @return html
 */

$solutions_options = get_post_meta( get_the_ID(), 'available_solutions', true );

$count = count( $solutions_options );

$solutions = array();

foreach ( $solutions_options as $key => $solution ) {
  $solutions[ $solution ]['title'] = get_option( 'options_solutions_' . $solution . '_title' );
  $solutions[ $solution ]['image'] = get_option( 'options_solutions_' . $solution . '_image' );
  $solutions[ $solution ]['copy'] = get_option( 'options_solutions_' . $solution . '_copy' );
  $solutions[ $solution ]['link'] = get_option( 'options_solutions_' . $solution . '_link' );
}


?>

<?php if ( $count ) : ?>
<section class="section-row-w-columns bg-white " id="solutions_cards">
  <a class="anchor" name="anchor-solutions_cards"></a>
  <div class="container">
    <div class="row card-deck icon-cards justify-content-center" data-cols="3">
      <?php foreach ( $solutions as $key => $solution ) { ?>
        <div class="card text-center px-0 py-1 card-<?php echo $key; ?>">
          <div class="card-header icon-header pb-0">
            <?php echo wp_get_attachment_image( $solution['image'] ); ?>
          </div>
          <div class="card-body pb-0">
            <h3 class="mb-2"><?php echo $solution['title']; ?></h3>
            <?php echo apply_filters( 'the_content', $solution['copy'] ); ?>
          </div>
          <a href="<?php echo get_permalink( $solution['link'] ); ?>" class="btn btn-link btn-learn-more stretched-link card-footer pb-1"><span>Learn More <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php

wp_reset_query();
