<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
    // Page thumbnail and title
    the_title( '<header class="entry-header"><h2 class="entry-title">', '</h2></header><hr><!-- .entry-header -->' );
  ?>

  <div class="entry-content">
    <?php

      // Print the content
      the_content();

      // Edit Link
      edit_post_link( __( 'Edit' ), '<span class="edit-link">', '</span>' );

    ?>
  </div>
</article>
