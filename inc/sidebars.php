<?php

  function gelatinisima_register_sidebars() {

    // Register main sidebar
    register_sidebar(array(
      'id'            => 'main-sidebar',
      'name'          => 'Barra principal',
      'description'   => 'Barra lateral principal',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="h4 lead widget-title">',
      'after_title'   => '</h4>'
    ));

    // Register home sidebar
    register_sidebar(array(
      'id'            => 'home-sidebar',
      'name'          => 'Barra en portada',
      'description'   => 'Barra inferior en la portada'
    ));

  }

?>
