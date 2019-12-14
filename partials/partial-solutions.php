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
<section class="section-row-w-columns bg-white p-0" id="section_related-solutions">
  <a class="anchor" name="anchor-solutions_cards"></a>
  <div class="container-fluid">
    <div class="row">
      <?php foreach ( $solutions as $key => $solution ) { ?>
        <div class="col-12 col-md-6 col-lg-4 solution solution-col-<?php echo $key; ?>">
          <div class="solution-image-wrapper">
            <?php echo wp_get_attachment_image( $solution['image'], 'full', false, array( 'class' => 'main' ) ); ?>
            <?php echo wp_get_attachment_image( $solution['image_hover'], 'full', false, array( 'class' => 'on-hover' ) ); ?>
          </div>
          <a href="<?php echo get_permalink( $solution['link'] ); ?>" class="link-text stretched-link"><?php echo $solution['title']; ?></a>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php

wp_reset_query();
