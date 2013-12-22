<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<html>
<head>
  <title><?php

    global $paged;

    // Set empty variable
    $page_title = '';

    // Add page numeral if needed
    if ( $paged > 1 ) {
      $page_title = '&lsaquo; ' . sprintf( __( 'Página %s', 'gelatinisima' ), $paged ) . ' |';
    }

    // Add page title
    wp_title( $page_title ? $page_title : '|', true, 'right' );

    // Add sitename
    bloginfo( 'name' );

  ?></title>

  <!-- Set encoding -->
  <meta charset="utf-8">

  <!-- Google Chrome Frame for IE -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <!-- Mobile meta -->
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Pingback -->
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <!-- Wordpress head -->
  <?php wp_head(); ?>
</head>
<body class="home blog">
  <div id="wrap">
    <div class="brightness"></div>

    <!-- Logo -->
    <h1 id="logo">
      <a href="<?php bloginfo('url'); ?>" rel="home">
        <img src="<?php print get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo( 'description' ); ?>" title="<?php bloginfo( 'description' ); ?>">
      </a>
    </h1>

    <!-- Main menu -->
    <nav class="navbar navbar-ribbon" role="navigation">
      <div class="l-triangule-top"></div>
      <div class="l-triangule-bottom"></div>
      <div class="r-triangule-top"></div>
      <div class="r-triangule-bottom"></div>

      <?php gelatinisima_primary_nav(); ?>
    </nav>
