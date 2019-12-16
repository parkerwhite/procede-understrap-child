<?php
/**
 * Solutions Card Deck
 *
 * @return html
 */

$integrations_options = get_post_meta( get_the_ID(), 'available_integrations', true );

$count = count( $integrations_options );

$integrations = array();

foreach ( $integrations_options as $key => $integration ) {
  $integrations[ $integration ]['title'] = get_option( 'options_integrations_' . $integration . '_title' );
  $integrations[ $integration ]['image'] = get_option( 'options_integrations_' . $integration . '_image' );
  $integrations[ $integration ]['copy'] = get_option( 'options_integrations_' . $integration . '_copy' );
  $integrations[ $integration ]['link'] = get_option( 'options_integrations_' . $integration . '_link' );
}


?>

<?php if ( $count ) : ?>
<section class="section-row-w-columns bg-white " id="integrations_cards">
  <a class="anchor" name="anchor-integrations_cards"></a>
  <div class="container">
    <div class="row card-deck icon-cards justify-content-center" data-cols="4">
      <?php foreach ( $integrations as $key => $integration ) { ?>
        <div class="card text-center px-0 py-1 card-<?php echo $key; ?>">
          <?php if ( $integration['image'] ) { ?>
            <div class="card-header icon-header pb-0">
              <?php echo wp_get_attachment_image( $integration['image'] ); ?>
            </div>
          <?php } ?>
          <div class="card-body">
            <h3 class="mb-2"><?php echo $integration['title']; ?></h3>
            <?php echo apply_filters( 'the_content', $integration['copy'] ); ?>
          </div>
          <?php if ( $integration['link'] ) { ?>
            <a href="<?php echo get_permalink( $integration['link'] ); ?>" class="btn btn-link btn-learn-more stretched-link card-footer pb-1"><span>Learn More <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
<section class="section-row-w-columns bg-white pt-0" id="integrations_subtext">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8 col-xl-8">
        <p class="text-center">We also work with many other OEM brands. If you are interested in learning more, please contact <a href="mailto:partners@procedesoftware.com">partners@procedesoftware.com</a>.</p>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php

wp_reset_query();
