<?php
/**
 * Template Name: Solutions Pages
 *
 * @package procede
 */

get_header();

$container = get_theme_mod( 'understrap_container_type' );

$bg = null;

if ( has_post_thumbnail() ) {
  $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
  $bg = sprintf( 'style="background-image:url(%1$s);"', $featured_img_url );
}

$show_hero_overlay = ( metadata_exists( 'post', get_the_ID(), 'hero_image_settings_overlay' ) ? get_post_meta( get_the_ID(), 'hero_image_settings_overlay', true ) : 1 );

$hero_text = ( metadata_exists( 'post', get_the_ID(), 'solutions_page_sections_hero_copy' ) ? get_post_meta( get_the_ID(), 'solutions_page_sections_hero_copy', true ) : '' );

?>

<article <?php post_class( 'solutions-page' ); ?> id="post-<?php the_ID(); ?>">
	<?php while ( have_posts() ) : the_post(); ?>

		<section id="header-wrapper" class="wrapper wrapper-hero bg-light" <?php echo $bg; ?>>
			<?php if ( has_post_thumbnail() ) : ?>
				<img width="1920" src="<?php echo $featured_img_url; ?>" class="wp-post-image hidden" alt="" sizes="(max-width: 1920px) 100vw, 1920px">
			<?php endif; ?>
			<div id="header-hero-content-wrapper" class="<?php echo $show_hero_overlay ? 'overlay-show' : 'overlay-hide'; ?>" data-overlay="<?php echo $show_hero_overlay; ?>">
				<div class="<?php echo esc_attr( $container ); ?>" id="header-hero-content-container">
					<div class="row">
						<div class="col">
							<header class="page-header">
								<?php echo apply_filters( 'the_content', $hero_text ); ?>
							</header>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
		$solutions_page_sections_intro_background_image = get_post_meta( get_the_ID(), 'solutions_page_sections_intro_background_image', true );
		$solutions_page_sections_intro_background_image_style = $solutions_page_sections_intro_background_image ? sprintf( 'style="background-image:url(%s);"', wp_get_attachment_image_url( $solutions_page_sections_intro_background_image, 'full', false ) ) : '';
		?>
		<section id="section_solutions-intro" class="bg-light" <?php echo $solutions_page_sections_intro_background_image_style; ?>>
			<div class="container">
				<div class="row">
					<div class="col">
						<?php echo wp_get_attachment_image( get_post_meta( get_the_ID(), 'solutions_page_sections_intro_image', true ), 'large', false, array( 'class' => 'float-right img-thumbnail ml-lg-2' ) ); ?>
						<h2 class="section-title"><?php echo get_post_meta( get_the_ID(), 'solutions_page_sections_intro_title', true ); ?></h2>
						<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'solutions_page_sections_intro_copy', true ) ); ?>
					</div>
				</div>
			</div>
		</section>

		<?php
		$solutions_page_sections_highlights_highlight_items = get_post_meta( get_the_ID(), 'solutions_page_sections_highlights_highlight_items', true );
		if ( $solutions_page_sections_highlights_highlight_items > 0 ) :
		?>
		<section id="section_solutions-highlights" class="bg-white">
			<div class="container">
				<div class="row">
					<div class="col">
						<h2 class="section-title text-center mb-4"><?php echo get_post_meta( get_the_ID(), 'solutions_page_sections_highlights_title', true ); ?></h2>
					</div>
				</div>
				<div class="row align-items-stretch justify-content-center">
					<div class="col-12 col-md-10 col-lg-9 col-xl-8">
						<div class="row">
							<?php for ( $i = 0; $i < $solutions_page_sections_highlights_highlight_items; $i++ ) { ?>
								<div class="col-12 col-lg-6">
									<div class="media checklist">
										<?php echo wp_get_attachment_image( get_post_meta( get_the_ID(), 'solutions_page_sections_highlights_highlight_items_' . $i . '_icon', true ), 'thumbnail', false, array( 'class' => 'media-checklist-icon' ) ); ?>
										<div class="media-body">
											<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'solutions_page_sections_highlights_highlight_items_' . $i . '_copy', true ) ); ?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php
		$testimonials = ( metadata_exists( 'post', get_the_ID(), 'solutions_page_sections_testimonials_testimonials' ) ? get_post_meta( get_the_ID(), 'solutions_page_sections_testimonials_testimonials', true ) : false );
		$testimonial_args = array(
			'posts_per_page' => -1,
			'nopaging' => true,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'cpt-testimonials',
			'post_status' => 'publish',
			'post__in' => $testimonials,
		);

		?>
		<?php if ( $testimonials ) : ?>
		<section id="section_testimonials" class="section-row-w-columns bg-white">
			<a class="anchor" name="anchor-section_testimonials"></a>
			<div class="container">
				<div class="row">
					<div class="col">
						<h2 class="section-title text-center mb-4"><?php echo get_post_meta( get_the_ID(), 'solutions_page_sections_testimonials_title', true ); ?></h2>
					</div>
				</div>
				<?php $testimonials_query = new WP_Query( $testimonial_args ); if ( $testimonials_query->have_posts() ) : $i = 0; ?>
				<div class="row justify-content-center">
					<div class="testimonial-column col-12 col-md-10 col-lg-9 col-xl-7">
						<div class="carousel mb-2" id="carousel-8aec0799" data-interval="5000" data-keyboard="true" data-pause="false" data-ride="false" data-wrap="true">
							<div class="carousel-inner">
								<?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?>
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
				<?php endif; wp_reset_query(); ?>
				<?php
				$solutions_page_sections_testimonials_cta = get_post_meta( get_the_ID(), 'solutions_page_sections_testimonials_cta', true );
				if ( $solutions_page_sections_testimonials_cta ) : ?>
				<div class="row justify-content-center">
					<div class="col-12 text-center">
						<p>
							<a href="<?php echo $solutions_page_sections_testimonials_cta['url'] ?>" class="btn btn-primary" target="<?php echo $solutions_page_sections_testimonials_cta['target']; ?>"><span><?php echo $solutions_page_sections_testimonials_cta['title']; ?></span></a>
						</p>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</section>
		<?php endif; ?>

		<?php
		$solutions_page_sections_additional_solutions_checklist_items = get_post_meta( get_the_ID(), 'solutions_page_sections_additional_solutions_checklist_items', true );
		if ( $solutions_page_sections_additional_solutions_checklist_items ) : ?>
		<section id="section_additional-solutions" class="bg-light">
			<div class="container">
				<div class="row">
					<div class="col">
						<h2 class="section-title text-center mb-4"><?php echo get_post_meta( get_the_ID(), 'solutions_page_sections_additional_solutions_title', true ); ?></h2>
					</div>
				</div>
				<div class="row justify-content-between">
					<?php for ( $i = 0; $i < $solutions_page_sections_additional_solutions_checklist_items; $i++ ) { ?>
						<div class="solution col-12 col-md-6 col-lg-4">
							<div class="text-center">
								<?php echo wp_get_attachment_image( get_post_meta( get_the_ID(), 'solutions_page_sections_additional_solutions_checklist_items_' . $i . '_icon', true ), 'thumbnail', false, array( 'class' => 'solution-icon' ) ); ?>
								<h3 class="solution-title"><?php echo get_post_meta( get_the_ID(), 'solutions_page_sections_additional_solutions_checklist_items_' . $i . '_title', true ); ?></h3>
								<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'solutions_page_sections_additional_solutions_checklist_items_' . $i . '_copy', true ) ); ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php
		$solutions_page_sections_grouped_content_group = get_post_meta( get_the_ID(), 'solutions_page_sections_grouped_content_group', true );
		?>
		<section id="section_grouped-solutions-content" class="bg-secondary">
			<div class="container">
				<?php for ( $i = 0; $i < $solutions_page_sections_grouped_content_group; $i++) { ?>
					<div class="row solution-group-wrapper">
						<div class="col">
							<div class="row align-items-end">
								<div class="col text-left">
									<h2 class="section-title"><?php echo get_post_meta( get_the_ID(), 'solutions_page_sections_grouped_content_group_' . $i . '_title', true ); ?></h2>
								</div>
								<div class="col text-right">
									<?php
									$solutions_page_sections_grouped_content_group_link = get_post_meta( get_the_ID(), 'solutions_page_sections_grouped_content_group_' . $i . '_link', true );
									?>
									<a href="<?php echo $solutions_page_sections_grouped_content_group_link['url']; ?>" class="section-link" target="<?php echo $solutions_page_sections_grouped_content_group_link['target']; ?>"><?php _e( 'Learn More', 'procede' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
								</div>
								<div class="col-12">
									<hr class="bg-primary"/>
								</div>
							</div>
							<?php
							$solutions_page_sections_grouped_content_group_items = get_post_meta( get_the_ID(), 'solutions_page_sections_grouped_content_group_' . $i . '_items', true );
							?>
							<div class="row justify-content-between">
								<?php for ( $j = 0; $j < $solutions_page_sections_grouped_content_group_items; $j++) { ?>
									<div class="solution-wrapper col-12 col-md-6 col-lg-4">
										<h3 class="solution-title"><?php echo get_post_meta( get_the_ID(), 'solutions_page_sections_grouped_content_group_' . $i . '_items_' . $j . '_title', true ); ?></h3>
										<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'solutions_page_sections_grouped_content_group_' . $i . '_items_' . $j . '_copy', true ) ); ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</section>

		<?php
		$solutions_page_sections_related_solutions_available_solutions = get_post_meta( get_the_ID(), 'solutions_page_sections_related_solutions_available_solutions', true );
		$solutions_page_sections_related_solutions_available_solutions_count = count( $solutions_page_sections_related_solutions_available_solutions );
		$related_solutions = array();

		foreach ( $solutions_page_sections_related_solutions_available_solutions as $key => $solution ) {
			$related_solutions[ $solution ]['title'] = get_option( 'options_solutions_' . $solution . '_title' );
			$related_solutions[ $solution ]['image'] = get_option( 'options_solutions_' . $solution . '_image' );
			$related_solutions[ $solution ]['image_hover'] = get_option( 'options_solutions_' . $solution . '_image_hover' ) ? get_option( 'options_solutions_' . $solution . '_image_hover' ) : get_option( 'options_solutions_' . $solution . '_image' );
			$related_solutions[ $solution ]['copy'] = get_option( 'options_solutions_' . $solution . '_copy' );
			$related_solutions[ $solution ]['link'] = get_option( 'options_solutions_' . $solution . '_link' );
		}
		?>
		<?php if ( $solutions_page_sections_related_solutions_available_solutions_count ) : ?>
		<section class="section-row-w-columns bg-white pb-0" id="section_related-solutions">
			<a class="anchor" name="anchor-solutions_cards"></a>
			<div class="container">
				<div class="row">
					<div class="col">
						<h2 class="section-title text-center mb-4">Optimizing Every Department In Your Dealership</h2>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<?php foreach ( $related_solutions as $key => $solution ) { ?>
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

	<?php endwhile; // end of the loop. ?>
</article><!-- #post-## -->

<?php get_footer(); ?>
