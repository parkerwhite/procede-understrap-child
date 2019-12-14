<?php
/*
  Class Name: Advanced Custom Fields (ACF) Bootstrap Builder
  Description: Bootstrap layout using advanced custom fields.
  Version: 1.0
  Author: Tim Spinks
  Author URI: https://www.parkerwhite.com/
*/

class ACF_Bootstrap_Builder {

	private $bytes = 4;
	private $container = 'container';
	private $the_ID;
	private $debug = false;

	public function __construct( $container = 'container' ) {
    $this->container = $container;
    $this->the_ID = get_the_ID();
    if ( defined('WP_DEBUG') && true === WP_DEBUG ) {
      $this->debug = true;
    }
    add_filter( 'option_active_plugins', array( $this, 'disable_acf_on_frontend' ), 10, 1 );
	}

	public function __get( $property ) {
		if ( property_exists( $this, $property ) ) {
			return $this->$property;
		}
	}

	public function __set( $property, $value ) {
		if ( property_exists( $this, $property ) ) {
			$this->$property = $value;
		}
		return $this;
	}

	/**
	 * Disable ACF on Frontend
	 *
	 * Why would we want to disable front-end ACF? For speed and to prevent things
	 * from breaking if the plugin ever gets disabled. Check out these articles
	 * [here](https://www.billerickson.net/code/disable-acf-frontend/)
	 * [here](https://www.billerickson.net/advanced-custom-fields-frontend-dependency/)
	 *
	 */
	public function disable_acf_on_frontend( $plugins ) {
		if ( is_admin() ) {
			return $plugins;
		}
		foreach ( $plugins as $i => $plugin ) {
			if ( 'advanced-custom-fields-pro/acf.php' == $plugin ) {
				unset( $plugins[$i] );
			}
		}
		return $plugins;
	}

	/**
	 * Generate rand str
	 */
	public function rand_str() {
		return bin2hex( openssl_random_pseudo_bytes( $this->bytes ) );
	}

	/**
	 * Debug Comment
	 */
	public function debug_comment( $comment ) {
		if ( $this->debug ) {
      print( $comment );
    }
	}

	/**
	 * Get ACF field value
	 *
	 * @param (str) $field    the field name
	 * @param (bool) $esc     whether or not to escape the returned value (default = true)
	 *
	 * @return (str/array) $value
	 */
	public function get_field( $field, $esc = true ) {

		$value = get_post_meta( $this->the_ID, $field, true );

		if ( $esc ) {
			$value = esc_html( $value );
		}

		return $value;
	}

	/**
	 * Bootstrap Builder: Layout
	 */
	public function bootstrap_builder_layout() {
		$rand_str = $this->rand_str();
		$section_count = $this->get_field( 'bootstrap_layout_builder_section', true );

		ob_start();

		for ( $i = 0; $i < $section_count; $i++ ) {
			$section_class = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_class', true );
			$section_id = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_id', true );
			?>

      <?php $this->debug_comment( '<!-- bootstrap_layout_builder_section_' . $i . ' -->' ); ?>

      <section id="<?php echo esc_attr( $section_id ); ?>" class="section-<?php echo $rand_str; ?> <?php echo esc_attr( $section_class ); ?>">

        <a class="anchor" name="anchor-<?php echo $section_id; ?>"></a>

        <div class="<?php echo esc_attr( $this->container ); ?>">

          <?php
					$row_count = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row', true );;
					for ( $j = 0; $j < $row_count; $j++ ) {
						$row_class = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_class', true );
						$row_id = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_id', true );
						?>

            <?php $this->debug_comment( '<!-- bootstrap_layout_builder_section_' . $i . '_row_' . $j . ' -->' ); ?>

            <div id="<?php echo esc_attr( $row_id ); ?>" class="row <?php echo esc_attr( $row_class ); ?>">

              <?php
							$col_count = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column', true );;
							for ( $k = 0; $k < $col_count; $k++ ) {
								$col_class = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_class', true );
								$col_id = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_id', true );
								?>

                <?php $this->debug_comment( '<!-- bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . ' -->' ); ?>

                <div id="<?php echo esc_attr( $col_id ); ?>" class="col <?php echo esc_attr( $col_class ); ?>">

                  <?php
                  $content = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_content', false );
                  $wrap_content = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_wrap_content', true );
                  ?>

                  <?php if ( $wrap_content ) { ?>
                    <div class="<?php echo $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_wrapper_class', true ); ?>">
                  <?php } ?>

                  <?php $this->debug_comment( '<!-- bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_content -->' ); ?>

                  <?php foreach ( $content as $l => $element ) {
                    $this->debug_comment( '<!-- bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_content_' . $l . '_' . $element . ' -->' );
										switch ($element) {
                      case 'button':
												echo $this->get_bootstrap_builder_button( $i, $j, $k, $l );
												break;
                      case 'carousel':
												echo $this->get_bootstrap_builder_carousel( $i, $j, $k, $l );
												break;
											case 'wysiwyg':
											default:
												echo apply_filters( 'the_content', $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_content_' . $l . '_wysiwyg', true ) );
												break;
										}
                  } ?>

                  <?php if ( $wrap_content ) { ?>
                    </div>
                  <?php } ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</section>
		<?php }

		echo ob_get_clean();

		return;

	}

	/**
	 * Bootstrap Builder: Button
	 */
	public function get_bootstrap_builder_button( $i, $j, $k, $l ) {

		$rand_str = $this->rand_str();

    $link_array = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_content_'. $l . '_button', false );
    $button_class = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_content_'. $l . '_button_class', true );

    $button = sprintf( '<a href="%1$s" class="btn btn-%2$s %3$s" target="%4$s">%5$s</a>', $link_array['url'], $rand_str, $button_class, $link_array['target'], $link_array['title'] );

    return $button;
	}

	/**
	 * Bootstrap Builder: Carousel
	 */
	public function get_bootstrap_builder_carousel( $i, $j, $k, $l ) {

		$rand_str = $this->rand_str();

    $slide_count = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_content_'. $l . '_carousel', true );
    $carousel_class = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_content_'. $l . '_carousel_class', true );
		$slides = array();
		for ( $m = 0; $m < $slide_count; $m++ ) {
			$slides[] = $this->get_field( 'bootstrap_layout_builder_section_' . $i . '_row_' . $j . '_column_' . $k . '_content_'. $l . '_carousel_' . $m . '_slide', false );
		}

		$show_controls = true;

    ob_start(); ?>
			<div id="carousel_<?php echo $rand_str; ?>" class="carousel carousel_<?php echo $rand_str; ?> <?php echo $carousel_class; ?>" data-ride="false">
				<div class="carousel-inner text-center">
					<?php foreach ($slides as $key => $slide) { ?>
						<div class="carousel-item <?php echo $key === 0 ? 'active' : ''; ?>">
							<?php echo apply_filters( 'the_content', $slide ); ?>
						</div>
					<?php } ?>
				</div>

        <?php if ( $show_controls ) { ?>
					<a class="carousel-control-prev" href="#carousel_<?php echo $rand_str; ?>" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only"><?php _e( 'Previous' ); ?></span>
					</a>
					<a class="carousel-control-next" href="#carousel_<?php echo $rand_str; ?>" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only"><?php _e( 'Next' ); ?></span>
					</a>
				<?php } ?>

      </div>
    <?php

    return ob_get_clean();
	}

}
