<?php
/**
 * Featured Post
 *
 * Gets the latest Sticky post.or if none, the latest Featured (category) post.
 *
 * @return html
 */

$form_id = get_option( 'options_contact_form_id' );
$form_shortcode = sprintf( '[gravityform id="%1$s" ajax="true" title="false" description="false"]', $form_id );

$testimonials = ( metadata_exists( 'post', get_the_ID(), 'testimonials' ) ? get_post_meta( get_the_ID(), 'testimonials', true ) : false );

$args = array(
  'posts_per_page' => -1,
  'nopaging' => true,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'post_type' => 'cpt-testimonials',
  'post_status' => 'publish',
  'post__in' => $testimonials,
);

$testimonials_query = new WP_Query( $args );

?>
<section id="section-testimonials" class="section-row-w-columns section-split-cols bg-light">
  <a class="anchor" name="anchor-testimonials"></a>
  <div class="container-fluid">
    <div class="row " data-cols="2">
      <?php if ( $testimonials_query->have_posts() ) : $i = 0; ?>
        <?php if ( $form_id ) : ?>
          <div class="testimonial-column col-12 col-split col-split-md-6 p-2 p-lg-5 text-center bg-light col-split-start">
        <?php else : ?>
          <div class="testimonial-column col-12 col-md-10 col-lg-8 text-center bg-light">
        <?php endif; ?>
          <h2>Testimonials</h2>
          <div class="carousel mb-2" id="carousel-8aec0799" data-interval="5000" data-keyboard="true" data-pause="false" data-ride="false" data-wrap="true">
            <div class="carousel-inner">
              <?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?>
                <?php
                $provided_by  = get_post_meta( get_the_ID(), 'testimonial_provided_by', true );
                $job_title    = get_post_meta( get_the_ID(), 'testimonial_job_title', true );
                $dealership   = get_post_meta( get_the_ID(), 'testimonial_dealership', true );
                $citation     = ( $job_title || $dealership ) ? sprintf( '<cite title="Source Title">%1$s%2$s%3$s</cite>', $job_title, ( ( $job_title && $dealership ) ? ' at ' : '' ), $dealership ) : false;
                ?>
                <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                  <blockquote class="blockquote text-center">
                    <?php the_content(); ?>
                    <footer class="blockquote-footer">
                      <?php if ( has_post_thumbnail() ) { ?>
                        <span class="bf-left">
                          <?php echo get_the_post_thumbnail(); ?>
                        </span>
                      <?php } ?>
                      <span class="bf-right text-left">
                        <?php echo $provided_by; ?>
                        <?php echo ( $provided_by && $citation ) ? '<br>' : ''; ?>
                        <?php echo $citation; ?>
                      </span>
                    </footer>
                  </blockquote>
                </div>
              <?php $i++; endwhile; ?>
            </div>
            <div>
              <a class="carousel-control-prev" href="#carousel-8aec0799" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel-8aec0799" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
          <p>
            <a href="/customer-center/#anchor-testimonials" id="button-b8e5a2f3" class="btn btn-outline-primary">
              <span>View More Testimonials</span>
            </a>
          </p>
        </div>
      <?php endif; ?>
      <?php if ( $form_id ) : ?>
        <div class="col-12 col-split col-split-md-6 p-1 p-lg-5 bg-primary col-split-end" style="background-image:url(/wp-content/uploads/2018/10/greenbackground.png);background-repeat:no-repeat;background-size:cover;background-position:center;">
          <div class="row justify-content-center">
            <div class="text-white text-center col-12 col-xl-8 mb-2">
              <h2>Contact Us</h2>
              <p class="mb-2">Faster. Smarter. Simple. Learn how our Excede can transform your dealership business.</p>
              <?php echo do_shortcode( $form_shortcode ); ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php

wp_reset_query();
