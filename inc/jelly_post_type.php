<?php

  // Register Jelly Post Type
  function jelly_post_type() {

    register_post_type(
      'jelly',
      array(
        'labels' => array(
          'name'                => __( 'Gelatinas' ),
          'singular_name'       => __( 'Gelatina' ),
          'add_new'             => __( 'Añadir nueva' ),
          'add_new_item'        => __( 'Añadir nueva gelatina' ),
          'edit_item'           => __( 'Editar gelatina' ),
          'new_item'            => __( 'Nueva gelatina' ),
          'view_item'           => __( 'Ver gelatina' ),
          'search_items'        => __( 'Buscar gelatinas' ),
          'not_found'           => __( 'No se encontraron gelatinas' ),
          'not_found_in_trash'  => __( 'No se encontraron gelatinas en la papelera' )
        ),
        'description'           => __( 'Gelatinas' ),
        'public'                => true,
        'rewrite' => array(
          'slug' => 'gelatinas',
          'with_front' => false
        ),
        'exclude_from_search'   => false,
        'publicy_queryable'     => true,
        'query_var'             => false,
        'show_ui'               => true,
        'show_in_nav_menus'     => false,
        'register_meta_box_cb'  => 'jelly_meta_boxes',
        'menu_position'         => 20,
        'capabilities' => array(
          'edit_post'           => 'edit_theme_options',
          'edit_posts'          => 'edit_theme_options',
          'edit_others_posts'   => 'edit_theme_options',
          'publish_posts'       => 'edit_theme_options',
          'read_post'           => 'read',
          'read_private_posts'  => 'read',
          'delete_post'         => 'edit_theme_options'
        ),
        'taxonomies'            => array( 'jellies' ),
        'has_archive'           => true,
        'hierarchical'          => false,
        'supports' => array( 'title', 'revisions', 'thumbnail' )
      )
    );

  }

  // Register jelly taxonomies
  function jelly_taxonomies() {

    register_taxonomy('jellies', 'jelly', array(
      'hierarchical' => true,
      'labels' => array(
        'name' => _x( 'Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Categories' ),
        'all_items' => __( 'All Categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' ),
        'menu_name' => __( 'Categories' ),
      ),
      'show_ui' => true,
      'query_var' => true,
      'public' => true,
      'rewrite' => array(
        'slug' => 'gelatinas',
        'with_front' => true,
        'hierarchical' => true
      )
    ));

  }

  // Register jelly meta boxes
  function jelly_meta_boxes() {

    // Add price meta box
    add_meta_box(
      // ID
      'jelly_prices',
      // Title
      'Precios',
      // Callback
      'price_meta_box',
      // Post Type
      'jelly',
      // Context
      'normal'
    );

    // Add price meta box
    add_meta_box(
      // ID
      'jelly_prices_agar',
      // Title
      'Precios (agar-agar)',
      // Callback
      'price_meta_box_agar',
      // Post Type
      'jelly',
      // Context
      'normal'
    );

    // Add gelling meta box
    add_meta_box(
      // ID
      'jelly_gelling',
      // Title
      'Gelificante',
      // Callback
      'gelling_meta_box',
      // Post Type
      'jelly',
      // Context
      'side'
    );

  }

  // Price meta box callback
  function price_meta_box() {

    global $post;

    $nonce = wp_create_nonce( plugin_basename( __FILE__ ) );
    $prices = get_post_meta( $post->ID, 'jelly_prices', true );

    include_once( 'views/jelly_boxes/price.php' );

  }

  // Price meta box callback
  function price_meta_box_agar() {

    global $post;

    $nonce = wp_create_nonce( plugin_basename( __FILE__ ) );
    $prices = get_post_meta( $post->ID, 'jelly_prices_agar', true );

    include_once( 'views/jelly_boxes/price_agar.php' );

  }

  // Gelling meta box callback
  function gelling_meta_box() {

    global $post;

    $nonce = wp_create_nonce( plugin_basename( __FILE__ ) );
    $gelling = get_post_meta( $post->ID, 'jelly_gelling', true );

    include_once( 'views/jelly_boxes/gelling.php' );

  }

  // Save post meta
  function save_meta_boxes( $post_id, $post ) {

    // Only users allowed to edit post
    if ( !current_user_can( 'edit_post', $post->ID ) ) {
      return $post->ID;
    }

    // Save
    if ( $_POST ) {

      // Verify jelly_prices nonce name
      if ( !wp_verify_nonce( $_POST['jelly_prices_nonce'], plugin_basename( __FILE__ ) ) ) {
        return $post->ID;
      }

      // Verify jelly_prices_agar nonce name
      if ( !wp_verify_nonce( $_POST['jelly_prices_agar_nonce'], plugin_basename( __FILE__ ) ) ) {
        return $post->ID;
      }

      // Verify jelly_gelling nonce name
      if ( !wp_verify_nonce( $_POST['jelly_gelling_nonce'], plugin_basename( __FILE__ ) ) ) {
        return $post->ID;
      }

      // Prices (grenetina)
      $sizes = $_POST['jelly_sizes'];
      $prices = $_POST['jelly_prices'];
      $format_prices = array();

      foreach ( $prices as $type => $prices_childs ) {
        foreach ( $prices_childs as $key => $value ) {
          $price = str_replace( '$', '', $value );
          if ( $price ) {
            $format_prices[$type][$key] = money_format( '%i', (double) $price );
          }
        }
      }

      if( get_post_meta( $post->ID, 'jelly_prices', false ) ) {
        update_post_meta( $post->ID, 'jelly_prices', $format_prices );
      } else {
        add_post_meta( $post->ID, 'jelly_prices', $format_prices );
      }

      // Prices (agar)
      $sizes = $_POST['jelly_sizes_2'];
      $prices = $_POST['jelly_prices_agar'];

      foreach ( $prices as $type => $prices_childs ) {
        foreach ( $prices_childs as $key => $value ) {
          $price = str_replace( '$', '', $value );
          if ( $price ) {
            $prices[$type][$key] = money_format( '%i', (double) $price );
          }
        }
      }

      if( get_post_meta( $post->ID, 'jelly_prices_agar', false ) ) {
        update_post_meta( $post->ID, 'jelly_prices_agar', $prices );
      } else {
        add_post_meta( $post->ID, 'jelly_prices_agar', $prices );
      }

      // Gelling
      $gelling = $_POST['jelly_gelling'];
      if( get_post_meta( $post->ID, 'jelly_gelling', false ) ) {
        update_post_meta( $post->ID, 'jelly_gelling', $gelling );
      } else {
        add_post_meta( $post->ID, 'jelly_gelling', $gelling );
      }
      
    }

  }

  // Register Jelly Post Type hook
  add_action( 'init', 'jelly_post_type' );

  // Register taxonomies hook
  add_action( 'init', 'jelly_taxonomies' );

  // Save meta boxes hook
  add_action( 'save_post', 'save_meta_boxes', 1, 2 );

?>
