<?php
/* 
 * The template for archive of jellies
 */

  get_header();

?>
<div class="container">
  <div class="row">
    <div class="col-sm-4 col-md-3">
      <ul class="nav nav-pills nav-stacked">
        <?php

          // Get current term
          $current = get_query_var( 'term' );
          // Taxonomy
          $taxonomy = 'jellies';
          // Get terms by taxonomy
          $categories = get_terms( $taxonomy, '' );

          if ( $categories ) {
            foreach ( $categories as $category ) {
              echo '<li '. ( $current === $category->slug ? 'class="active"' : '' ) . '>';
              echo '<a href="' . esc_attr( get_term_link( $category, $taxonomy ) ) . '">' . $category->name . '</a>';
              echo '</li> ';
            }
          }

        ?>
      </ul>
    </div>
    <div class="col-sm-8 col-md-9" role="main">
      <?php if ( have_posts() ) : $i = 0; ?>
        <div class="row">
        <?php while ( have_posts() ) : the_post(); $i++; ?>
        <?php
          // Get ID
          $id = get_the_ID();
          
          // Get title
          $title = get_the_title();
          
          // Get gelling
          $gelling = get_post_meta( $id, 'jelly_gelling', true );
          $gelling = $gelling ? implode( ' y ', $gelling ) : '';

          // Get prices
          $types = array();
          $prices = get_post_meta( $id, 'jelly_prices', true );

          if ( $prices && count( $prices['water'] ) > 0 ) {
            $types[] = 'Agua';
          }

          if ( $prices && count( $prices['milk'] ) > 0 ) {
            $types[] = 'Leche';
          }

          if ( $prices && count( $prices['mousse'] ) > 0 ) {
            $types[] = 'Mousse';
          }

          if ( $prices && count( $prices['wine'] ) > 0 ) {
            $types[] = 'Vino';
          }

          $types = implode(', ', $types);

          // Get image featured
          $image_featured = get_the_post_thumbnail( $id, 'thumbnail', array( 'class' => 'img-thumbnail' ) );

          // Get images attached
          $images = get_children( array(
            'post_parent' => $id,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image'
            )
          );

        ?>

          <?php if ($i % 2 === 1) { ?>
            </div><div class="row">
          <?php } ?>

          <div itemscope itemtype="http://schema.org/IndividualProduct" itemid="#product" class="col-md-6 jelly clearfix">
            
            <?php if( count( $images ) > 0 ) : ?>
            <div id="jelly-carousel-<?php echo $id ?>" class="pull-left carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <?php if( count( $images ) > 1 ) : ?>
              <ol class="carousel-indicators">
                <?php
                  for ( $i = 0; $i < count($images); $i++ ) { 
                    $format = '<li data-target="#jelly-carousel-%d" data-slide-to="%d" class="%s"></li> ';
                    echo sprintf( $format, $id, $i, $i === 0 ? 'active' : '' );
                  }
                ?>
              </ol>
              <?php endif; ?>
              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                <?php

                  // For each image post
                  $i2 = 0; foreach ($images as $attachment_id => $image) : $i2++;

                  // Get image title
                  $img_title = $image->post_title;
                  // Get image description
                  $img_description = $image->post_content;
                  // Get image alt
                  $img_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
                  // If not exist image alt replace with image title
                  $img_alt = empty( $img_alt ) ? $img_title : $img_alt;
                  // Get image url
                  $downsize = image_downsize( $image->ID, 'thumbnail' );
                  $img_src = $downsize[0];

                ?>
                <div class="item <?php echo $i2 === 1 ? 'active ' : '' ?>">
                  <img class="img-thumbnail" alt="<?php echo $title ?>" src="<?php echo $img_src ?>" />
                </div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php elseif( $image_featured ) : ?>
            <div class="pull-left carousel">
              <div class="carousel-inner">
                <?php echo $image_featured; ?>
              </div>
            </div>
            <?php endif; ?>
            <h4><span itemprop="name"><?php echo $title; ?></span></h4>
            <p>
              <span class="label label-primary"><?php echo $types ?></span>
              <span class="label label-default"><?php echo $gelling ?></span>
            </p>
            <a class="btn btn-sm btn-primary" href="https://www.facebook.com/gelatinisima" target="_blank">Ordernar en línea</a>
          </div>

        <?php endwhile; ?>
        </div>
        <?php pagination(); ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
