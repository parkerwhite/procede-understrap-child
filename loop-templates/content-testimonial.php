<?php
/**
 * Partial template for Testimonial
 *
 * @package procede
 */

?>

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

