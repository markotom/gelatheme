<?php get_header(); ?>

<?php

  $sticky = get_option('sticky_posts');

  // Found sticky posts
  if ( $sticky ) {

    // Sort descending
    rsort( $sticky );

    $args = array(
      'post__in' => array_slice( $sticky, 0, 6 ),
      'ignore_sticky_posts' => 1
    );

  // Show last entries if not found sticky posts
  } else {

    $args = array(
      'posts_per_page' => 4,
      'ignore_sticky_posts' => 0
    );

  }

  // Get posts
  query_posts( $args );

?>

<?php if (have_posts()) : ?>
<div id="carousel" class="carousel slide">
  <?php if ( $wp_query->post_count > 1 ) : ?>
  <ol class="carousel-indicators">
    <?php
      for ( $i = 0 ; $i < $wp_query->post_count ; $i++ ) {
        $classes = $i == 0 ? 'active' : '';
        print '<li data-target="#carousel" data-slide-to="' . $i . '" class="' . $classes . '"></li>';
      }
    ?>
  </ol>
  <?php endif; ?>

  <div class="carousel-inner">
    <?php while ( have_posts() ) : the_post(); ?>
    <?php

      $active_item = ( $wp_query->current_post === 0 ) ? 'active' : '';
    ?>
      <div class="item <?php print $active_item; ?>">
        <h2><?php the_title(); ?></h2>
        <div class="lead"><?php the_content(); ?></div>
      </div>
    <?php endwhile; ?>
  </div>

  <?php if ( $wp_query->post_count > 1 ) : ?>
  <a class="left carousel-control" href="#carousel" data-slide="prev">
    <span class="icon-prev"></span>
  </a>
  <a class="right carousel-control" href="#carousel" data-slide="next">
    <span class="icon-next"></span>
  </a>
  <?php endif; ?>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'home-sidebar' ) ) : ?>
<div id="panels">
  <div class="container">
    <div class="row">
      <?php

        $widgets      = wp_get_sidebars_widgets( 'home-sidebar' );
        $widgets_home = $widgets[ 'home-sidebar' ];
        $count        = count( $widgets_home );
        $columns      = 12;
        $column       = $columns / $count;

        register_sidebar(array(
          'id'            => 'home-sidebar',
          'before_widget' => '<div id="%1$s" class="widget %2$s col-md-' . $column . '">',
          'after_widget'  => '</div>',
          'before_title'  => '<h3>',
          'after_title'   => '</h3>'
        ));

        dynamic_sidebar( 'home-sidebar' );

      ?>
    </div>
  </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>
