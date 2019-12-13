<?php
/**
 * This is the front page.
 *
 * @package procede
 */

get_header();

$container = get_theme_mod( 'understrap_container_type' );

$testimonials = ( metadata_exists( 'post', get_the_ID(), 'testimonials' ) ? get_post_meta( get_the_ID(), 'testimonials', true ) : false );

$testimonial_args = array(
  'posts_per_page' => -1,
  'nopaging' => true,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'post_type' => 'cpt-testimonials',
  'post_status' => 'publish',
  'post__in' => $testimonials,
);

$testimonials_query = new WP_Query( $testimonial_args );

$testimonials_section_background_color = ( metadata_exists( 'post', get_the_ID(), 'testimonials_section_background_color' ) ? get_post_meta( get_the_ID(), 'testimonials_section_background_color', true ) : 'light' );
$testimonials_section_background_color_class = sprintf( 'bg-%s', $testimonials_section_background_color );

$featured_customers = get_post_meta( get_the_ID(), 'featured_customers', true );

?>
<?php while ( have_posts() ) : the_post(); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php get_template_part( 'partials/partial', 'hero' ); ?>

	<?php the_content(); ?>

	<?php
	if ( class_exists('Advanced_Custom_Fields_Partials') ) {
		$partials = new Advanced_Custom_Fields_Partials( $container );
		$partials->repeater( 'page_sections' );
	}
	?>

	<?php if ( $testimonials_query->have_posts() ) : $i = 0; ?>
	<section id="home_testimonials" class="section-row-w-columns <?php echo $testimonials_section_background_color_class; ?>">
		<a class="anchor" name="anchor-home_testimonials"></a>
		<div class="container">
			<div class="row " data-cols="2">
				<div class="testimonial-column col-12">
					<h2><?php _e( 'Testimonials', 'procede' ); ?></h2>
					<div class="carousel mb-2" id="carousel-8aec0799" data-interval="5000" data-keyboard="true" data-pause="false" data-ride="false" data-wrap="true">
						<div class="carousel-inner">
							<?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?>
								<?php // get_template_part( 'loop-templates/content', 'testimonial' ); ?>
								<?php include( locate_template( 'loop-templates/content-testimonial.php', false, false ) ); ?>
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
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-12 text-center">
					<p>
						<a href="/customer-center/#anchor-testimonials" id="button-21388679" class="btn btn-outline-primary"><span>View More Testimonials</span></a>
					</p>
				</div>
			</div>
		</div>
	</section>
	<?php endif; wp_reset_query(); ?>

	<?php if ( $featured_customers ) : ?>
	<section class="section-row-w-columns" id="featured_customers">
		<a class="anchor" name="anchor-featured-customers"></a>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 text-center">
					<h2 class="section-title">Featured Customers</h2>
				</div>
			</div>
			<div class="row justify-content-center align-items-center" data-cols="<?php echo $featured_customers; ?>">
				<?php for ($i = 0; $i < $featured_customers; $i++ ) { ?>
					<div class="col-12 col-md-6 col-xl-3 text-center">
						<p>
							<a href="<?php echo get_post_meta( get_the_ID(), 'featured_customers_' . $i . '_customer_link', true ); ?>" class="btn btn-image">
								<span>
									<?php echo wp_get_attachment_image( get_post_meta( get_the_ID(), 'featured_customers_' . $i . '_customer_image', true ), 'large', false, array( 'class' => 'img-fluids' ) ); ?>
								</span>
							</a>
						</p>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

</article>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
