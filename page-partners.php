<?php
/**
 * Template name: Partners Page
 *
 * @package procede
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

$page_header_type = get_post_meta( get_the_ID(), 'page_header_type', true );

$partners_category_array = array(
  'asset-condition-management',
  'consulting-recruitment',
  'customer-relationship-management',
  'document-archiving',
  'online-vehicle-sales',
  'parts-management',
  'payment-processing-taxation',
  'service-management',
  'telematics-dispatch-systems'
);

?>

<?php while ( have_posts() ) : the_post(); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <section class="section-row-w-columns bg-light text-center">
    <a class="anchor" name="anchor-certified-partners-copy"></a>
    <div class="container"><!-- .container -->
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h1 class="section-title">Certified Partners</h1>
        </div>
      </div>
      <div class="row " data-cols="1">
        <div class=" col-12 col-md-8 offset-md-2">
          <?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'partners_page_certified_partners_copy', true ) ); ?>
        </div>
      </div>
    </div><!-- /.container -->
  </section>

  <section class="section section-certified-partners bg-white">
    <a class="anchor" name="anchor-certified-partners"></a>
    <div class="container">
      <div class="row justify-content-center" data-cols="1">
        <div class=" col-12 col-md-8 offset-md-2 mb-2">
          <h3>Our growing list of Certified Partners includes:</h3>
        </div>
      </div>
      <?php procede_partners_cards( 'certified-partners' ); ?>
    </div>
  </section>

  <section class="section-row-w-columns text-center pb-0">
    <a class="anchor" name="anchor-alliance-partners-copy"></a>
    <div class="container"><!-- .container -->
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h2 class="section-title">Alliance Partners</h2>
        </div>
      </div>
      <div class="row " data-cols="1">
        <div class=" col-12 col-md-8 offset-md-2">
          <?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'partners_page_alliance_partners_copy', true ) ); ?>
        </div>
      </div>
    </div><!-- /.container -->
  </section>

  <section class="section section-alliance-partners">
    <a class="anchor" name="anchor-alliance-partners"></a>
    <div class="container">
      <?php procede_partners_cards( 'alliance-partners' ); ?>
    </div>
  </section>

  <section class="section-row-w-columns bg-light text-center">
    <a class="anchor" name="anchor-partner-with-us"></a>
    <div class="container"><!-- .container -->
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h2 class="section-title">Partner With Us</h2>
        </div>
      </div>
      <div class="row " data-cols="1">
        <div class=" col-12 col-md-8 offset-md-2">
          <?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'partners_page_partner_with_us_copy', true ) ); ?>
        </div>
      </div>
    </div><!-- /.container -->
  </section>

</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
