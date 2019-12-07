<?php
/**
 * Checklist
 *
 * @return html
 */

$checklist = get_post_meta( get_the_ID(), 'checklist', true );

if ( $checklist ) : ?>
  <section class="section-checklist bg-white ">
    <a class="anchor" name="anchor-checklist"></a>
    <div class="container">
      <ul class="list-checklist">
        <?php for ( $i = 0; $i < $checklist; $i++ ) { ?>
          <li class="checklist-item">
            <h3 class="pb-1"><?php echo get_post_meta( get_the_ID(), 'checklist_' . $i . '_items_title', true ); ?></h3>
            <?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'checklist_' . $i . '_items_copy', true ) ); ?>
          </li>
        <?php } ?>
      </ul>
    </div>
  </section>
<?php endif;

wp_reset_query();
