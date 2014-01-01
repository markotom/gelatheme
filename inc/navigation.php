<?php

  // Primary Nav
  function gelatinisima_primary_nav() {
    wp_nav_menu(array( 
      'theme_location'  => 'primary',
      'container'       => false,
      'depth'           => 1,
      'items_wrap'      => '<ul class="nav">%3$s</ul>',
      'fallback_cb'     => '__return_false'
    ));
  }

  // Override nav menu class to work with Bootstrap
  function gelatinisima_nav_menu_css_class( $classes, $item ) {
    $slug    = sanitize_title( $item->title );
    $classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes );
    $classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );

    $classes = array_unique( $classes );
    return array_filter( $classes );
  }

  add_filter('nav_menu_css_class', 'gelatinisima_nav_menu_css_class', 10, 2);


  // Override Walker Nave Menu
  class Gelatinisima_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
      $output .= "\n<ul class=\"dropdown-menu\">\n";
    }
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
      $item_html = '';
      parent::start_el($item_html, $item, $depth, $args);

      if ($item->is_dropdown && ($depth === 0)) {
        $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html);
        $item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html);
      }
      elseif (stristr($item_html, 'li class="divider')) {
        $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);    
      }
      elseif (stristr($item_html, 'li class="nav-header')) {
        $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
      }   

      $output .= $item_html;
    }
    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
      $element->is_dropdown = !empty($children_elements[$element->ID]);

      if ($element->is_dropdown) {
        if ($depth === 0) {
          $element->classes[] = 'dropdown';
        } elseif ($depth === 1) {
          $element->classes[] = 'dropdown-submenu';
        }
      }

      parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
  }

  // Override nav menu args to work with Bootstrap
  function gelatinisima_nav_menu_args( $args ) {   
      if ( !$args['fallback_cb'] ){
        $args['items_wrap'] = '<ul class="nav nav-tabs nav-stacked %2$s">%3$s</ul>';
        $args['walker'] = new Gelatinisima_Nav_Menu(); 
      }

      if ( $args['fallback_cb'] == 'gelatinisima_nav_menu_args' ) {
        $args['walker'] = new Gelatinisima_Nav_Menu();
      }

      return $args;
  }

  add_filter('wp_nav_menu_args', 'gelatinisima_nav_menu_args');

  // Pagination
  function pagination() {
    global $wpdb, $wp_query;

    $request = $wp_query->request;
    $posts_per_page = intval( get_query_var( 'posts_per_page' ) );
    $paged = intval( get_query_var( 'paged' ) );
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ( $numposts <= $posts_per_page ) { return; }
    if( empty( $paged ) || $paged == 0 ) {
      $paged = 1;
    }
    $pages_to_show = 5;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor( $pages_to_show_minus_1 / 2 );
    $half_page_end = ceil( $pages_to_show_minus_1 / 2 );
    $start_page = $paged - $half_page_start;
    if( $start_page <= 0 ) {
      $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
      $end_page = $start_page + $pages_to_show_minus_1;
    }
    if( $end_page > $max_page ) {
      $start_page = $max_page - $pages_to_show_minus_1;
      $end_page = $max_page;
    }
    if( $start_page <= 0 ) {
      $start_page = 1;
    }
      
    echo '<ul class="pagination">';
    $prevposts = get_previous_posts_link( '« Anterior' );

    if( $prevposts ) {
      echo '<li>' . $prevposts  . '</li>';
    }
    
    for( $i = $start_page; $i <= $end_page; $i++ ) {
      if( $i == $paged ) {
        echo '<li class="active"><a href="#">' . $i . '</a></li>';
      } else {
        echo '<li><a href="' . get_pagenum_link( $i ) . '">' . $i . '</a></li>';
      }
    }

    echo '<li>'; echo next_posts_link( 'Siguiente »' ); echo '</li>';
    echo '</ul></div>';

  }

?>
