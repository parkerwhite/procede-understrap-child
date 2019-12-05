<?php
/**
 * Services Card Deck
 *
 * @return html
 */

$services_options = get_post_meta( get_the_ID(), 'service_options', true );

$count = count( $services_options );

$services = array();

foreach ( $services_options as $key => $service ) {
  $services[ $service ]['image'] = get_option( 'options_services_' . $service . '_image' );
  $services[ $service ]['copy'] = get_option( 'options_services_' . $service . '_copy' );
  $services[ $service ]['link'] = get_option( 'options_services_' . $service . '_link' );
}


?>
<section class="section-row-w-columns bg-white " id="services_cards">
  <a class="anchor" name="anchor-services_cards"></a>
  <div class="container">
    <div class="row card-deck icon-cards justify-content-center" data-cols="<?php echo $count; ?>">
      <?php foreach ( $services as $key => $service ) { ?>
        <div class=" col-12 col-md-6 col-xl-3 card text-center px-0 py-1 card-<?php echo $key; ?>">
          <div class="card-header icon-header pb-0">
            <?php echo wp_get_attachment_image( $service['image'] ); ?>
          </div>
          <div class="card-body pb-0">
            <h3 class="mb-2"><?php echo strtoupper( $key ); ?></h3>
            <?php echo apply_filters( 'the_content', $service['copy'] ); ?>
          </div>
          <a href="<?php echo get_permalink( $service['link'] ); ?>" class="btn btn-link btn-learn-more stretched-link card-footer pb-1"><span>Learn More <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
<?php

wp_reset_query();
