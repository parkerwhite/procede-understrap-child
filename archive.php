<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

$post_type = get_post_type();

?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="home-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<?php if ( $post_type == 'post' ) :

			$args = array(
				'numberposts' => 1,
				'offset' => 0,
				'category' => 0,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'include' => '',
				'exclude' => '',
				'meta_key' => '',
				'meta_value' =>'',
				'post_type' => $post_type,
				'post_status' => 'publish',
				'suppress_filters' => true
			);

			$recent_posts = wp_get_recent_posts( $args, OBJECT );

			?>

			<?php foreach ($recent_posts as $recent_post) : $post_object = get_post( $recent_post->ID ); ?>

				<div class="row mb-2">
					
					<?php if ( has_post_thumbnail( $recent_post->ID ) ) { ?>
						<div class="col-12 col-lg-6 order-12">
							<?php echo get_the_post_thumbnail( $recent_post->ID, 'full', array( 'class' => 'object-fit-cover' ) ); ?>
						</div>
					<?php } ?>

					<div class="col-12 col-lg-6 order-1">
						<h2><?php echo get_the_title( $recent_post->ID ); ?></h2>
						<?php echo apply_filters( 'the_content', wp_trim_words( $post_object->post_content, 50, '...' ) ); ?>
						<p class="text-right"><a href="<?php echo get_permalink( $recent_post->ID ); ?>" class="btn btn-primary"><?php echo __( 'Read More', 'understrap' ); ?></a></p>
					</div>

				</div>

			<?php endforeach; ?>

		<?php endif; ?>

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<?php if ( have_posts() ) : ?>

				<!-- <div class="posts-loop-layout-wrapper">
					<div class="post-loop-layout">
						<a href="#posts-layout" class="post-layout-links" data-layout="list"><i class="fa fa-list" aria-hidden="true"></i></a>
						<a href="#posts-layout" class="post-layout-links" data-layout="grid"><i class="fa fa-th" aria-hidden="true"></i></a>
					</div>
				</div> -->

				<main class="site-main card-deck" id="main" data-cols="3">

						<?php /* Start the Loop */ ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'loop-templates/content', 'card' ); ?>

						<?php endwhile; ?>


				</main><!-- #main -->

				<!-- The pagination component -->
				<?php understrap_pagination(); ?>

			<?php else : ?>

				<div class="row">

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				</div>

			<?php endif; ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
