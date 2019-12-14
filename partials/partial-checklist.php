<?php
/**
 * Checklist
 *
 * @return html
 */

$checklist_items = get_post_meta( get_the_ID(), 'checklist_items', true );

if ( $checklist_items ) : ?>
  <section class="section-checklist bg-white ">
    <a class="anchor" name="anchor-checklist"></a>
    <div class="container">
      <ul class="list-checklist">
        <?php for ( $i = 0; $i < $checklist_items; $i++ ) { ?>
          <li class="checklist-item">
            <h3 class="pb-1"><?php echo get_post_meta( get_the_ID(), 'checklist_items_' . $i . '_title', true ); ?></h3>
            <?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'checklist_items_' . $i . '_copy', true ) ); ?>
          </li>
        <?php } ?>
      </ul>
    </div>
  </section>
<?php endif;

wp_reset_query();
