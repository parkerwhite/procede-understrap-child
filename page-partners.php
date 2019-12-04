<?php
/**
 * Template name: Partners Page
 *
 * @package fareverse
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

$page_header_type = get_post_meta( get_the_ID(), 'page_header_type', true );

?>

<?php while ( have_posts() ) : the_post(); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <section class="section-row-w-columns bg-light text-center pb-0">
    <a class="anchor" name="anchor-certified-partners-copy"></a>
    <div class="container"><!-- .container -->
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h2 class="section-title">Certified Partners</h2>
        </div>
      </div>
      <div class="row " data-cols="1">
        <div class=" col-12 col-md-8 offset-md-2">
          <?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'partners_page_certified_partners_copy', true ) ); ?>
        </div>
      </div>
    </div><!-- /.container -->
  </section>

  <section class="section section-certified-partners bg-light">
    <a class="anchor" name="anchor-certified-partners"></a>
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <?php
        $certified_partners_args = array(
          'posts_per_page'  => -1,
          'orderby'         => 'menu_order',
          'post_type'       => 'cpt-partners',
          'post_status'     => 'publish',
          'tax_query'       => array(
            array(
              'taxonomy' => 'cpt-partner-categories',
              'terms'    => 'certified-partners',
              'field'    => 'slug',
            ),
          ),
        );

        $certified_partners_query = new WP_Query( $certified_partners_args );

        if ( $certified_partners_query->have_posts() ) : while ( $certified_partners_query->have_posts() ) : $certified_partners_query->the_post();
        ?>
          <div class="col-6 col-md-4 col-lg-3 mb-1">
            <?php
            if ( has_post_thumbnail( get_the_ID() ) ) {
              $featured_img_str = get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-featured', 'alt' => get_the_title() ) );
              echo do_shortcode( sprintf( '[button target="modal" page-id="%1$s" class="btn-link"]%2$s[/button]', get_the_ID(), $featured_img_str ) );
            } else {
              echo sprintf( '<h2>%s</h2>', get_the_title() );
            }
            ?>
          </div>
        <?php endwhile; endif; wp_reset_query(); ?>
      </div>
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
      <div class="row justify-content-center align-items-center">
        <?php
        $alliance_partners_args = array(
          'posts_per_page'  => -1,
          'orderby'         => 'menu_order',
          'post_type'       => 'cpt-partners',
          'post_status'     => 'publish',
          'tax_query'       => array(
            array(
              'taxonomy' => 'cpt-partner-categories',
              'terms'    => 'alliance-partners',
              'field'    => 'slug',
            ),
          ),
        );

        $alliance_partners_query = new WP_Query( $alliance_partners_args );

        if ( $alliance_partners_query->have_posts() ) : while ( $alliance_partners_query->have_posts() ) : $alliance_partners_query->the_post();
        ?>
          <div class="col-6 col-md-4 col-lg-3 mb-1">
            <?php
            if ( has_post_thumbnail( get_the_ID() ) ) {
              $featured_img_str = get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-featured', 'alt' => get_the_title() ) );
              echo do_shortcode( sprintf( '[button target="modal" page-id="%1$s" class="btn-link"]%2$s[/button]', get_the_ID(), $featured_img_str ) );
            } else {
              echo sprintf( '<h2>%s</h2>', get_the_title() );
            }
            ?>
          </div>
        <?php endwhile; endif; wp_reset_query(); ?>
      </div>
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

  <section class="section-row-w-columns text-center">
    <a class="anchor" name="anchor-excede-api"></a>
    <div class="container"><!-- .container -->
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h2 class="section-title">Excede API</h2>
        </div>
      </div>
      <div class="row " data-cols="1">
        <div class=" col-12 col-md-8 offset-md-2">
          <?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'partners_page_excede_api_copy', true ) ); ?>
        </div>
      </div>
    </div><!-- /.container -->
  </section>

</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
