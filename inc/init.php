<?php

  // Initialize!
  add_action( 'after_setup_theme', 'gelatinisima_init', 1 );

  // After setup theme
  function gelatinisima_init() {

    // Head cleanup
    add_action('init', 'gelatinisima_head_cleanup');

    // Scripts and styles
    add_action( 'wp_enqueue_scripts', 'gelatinisima_assets', 999 );

    // Theme support
    add_action( 'after_setup_theme', 'gelatinisima_theme_support' );

    // Add sidebars
    add_action( 'widgets_init', 'gelatinisima_register_sidebars' );

  }

  // Enqueue assets for the frontend
  function gelatinisima_assets() {
    
    if ( ! is_admin () ) {

      // Asset format (css and js files)
      $asset = get_stylesheet_directory_uri() . '/%2$s/%1$s.%2$s';

      // Register main styles
      wp_register_style( 'gelatinisima_style', sprintf( $asset, 'style', 'css' ) );
      // Register Arvo font style 
      wp_register_style( 'gelatinisima_arvo', "http://fonts.googleapis.com/css?family=Arvo" );
      
      // Enqueue main styles
      wp_enqueue_style( 'gelatinisima_style' );
      // Enqueue Arvo font
      wp_enqueue_style( 'gelatinisima_arvo' );

      
      // Register bootstrap scripts
      wp_register_script( 'bootstrap', get_stylesheet_directory_uri() . '/components/bootstrap/dist/js/bootstrap.min.js', array( 'jquery' ), false, true );
      // Register main scripts
      wp_register_script( 'gelatinisima_script', sprintf( $asset, 'main', 'js' ), array( 'jquery', 'bootstrap' ), false, true );

      // Enqueue bootstrap scripts
      wp_enqueue_script( 'bootstrap' );
      // Enqueue main scripts
      wp_enqueue_script( 'gelatinisima_script' );

    }

  }

  // Hook for theme support
  function gelatinisima_theme_support() {

    // Add menus support
    add_theme_support( 'menus' );

    // Register primary menu
    register_nav_menus( array( 'primary' => 'Principal' ) );

  }

  // Hook for clean head
  function gelatinisima_head_cleanup(){

    // Rsd link
    remove_action( 'wp_head', 'rsd_link' );                               
    // Windows live writer
    remove_action( 'wp_head', 'wlwmanifest_link' );                       
    // Index link
    remove_action( 'wp_head', 'index_rel_link' );                         
    // Previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            
    // Start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             
    // Links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
    // WP version
    remove_action( 'wp_head', 'wp_generator' );

  }

?>
