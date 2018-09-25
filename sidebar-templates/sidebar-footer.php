<?php
/**
 * Sidebar setup for footer full.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php if ( is_active_sidebar( 'footer' ) ) : ?>

	<?php dynamic_sidebar( 'footer' ); ?>

<?php endif; ?>
