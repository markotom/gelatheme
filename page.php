<?php get_header(); ?>

<div class="container">
  <div class="row">  
    <div class="col-md-12">
      <?php
        // Start the Loop.
        while ( have_posts() ) : the_post();

          // Include the page content template.
          get_template_part( 'content', 'page' );

        endwhile;
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
