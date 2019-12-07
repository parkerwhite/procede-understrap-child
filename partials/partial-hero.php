<?php
/**
 * Partial for adding hero section to archive pages
 */

if ( ! defined( 'ABSPATH' ) || ! get_the_ID() ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );

$bg = null;

if ( has_post_thumbnail() ) {
  $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
  $bg = sprintf( 'style="background-image:url(%1$s);"', $featured_img_url );
}

$show_hero_overlay = ( metadata_exists( 'post', get_the_ID(), 'hero_image_settings_overlay' ) ? get_post_meta( get_the_ID(), 'hero_image_settings_overlay', true ) : 1 );

$hero_text = ( metadata_exists( 'post', get_the_ID(), 'page_hero_copy' ) ? get_post_meta( get_the_ID(), 'page_hero_copy', true ) : '' );

?>

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
