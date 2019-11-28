<?php
/**
 * Partial for adding hero section to archive pages
 */

$container = get_theme_mod( 'understrap_container_type' );

$hero_image_id = get_option( 'options_archive_hero_image' );

if ( $hero_image_id ) {
	$hero_image_url = wp_get_attachment_url( $hero_image_id );
}

$show_hero_overlay = get_option( 'options_archive_hero_overlay', 1 );

$hero_text = get_option( 'options_archive_hero_text' );

?>

<section id="header-wrapper" class="wrapper <?php echo 'wrapper-' . $post_type; ?>">

	<img width="1920" src="<?php echo $hero_image_url; ?>" class="object-fit-cover wp-post-image" alt="" sizes="(max-width: 1920px) 100vw, 1920px">

	<div id="header-hero-content-wrapper" class="<?php echo $show_hero_overlay ? 'overlay-show' : 'overlay-hide'; ?>" data-overlay="<?php echo $show_hero_overlay; ?>">
		<div class="<?php echo esc_attr( $container ); ?>" id="" tabindex="-1">
			<div class="row justify-content-center">
				<div class="col-12 col-md-8 text-center">
					<header class="page-header">
						<?php echo apply_filters( 'the_content', $hero_text ); ?>
					</header><!-- .page-header -->
				</div>
			</div>
		</div><!-- .container -->
	</div><!-- #header-hero-content-wrapper -->

</section>
