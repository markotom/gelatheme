<?php 

  // Initialize
  require get_template_directory() . '/inc/init.php';

  // Navigation
  require get_template_directory() . '/inc/navigation.php';

  // Sidebars
  require get_template_directory() . '/inc/sidebars.php';

  // Jelly Post Type
  require get_template_directory() . '/inc/jelly_post_type.php';


  // Web development purposes
  if ( $_SERVER["SERVER_ADDR"] == '127.0.0.1' ) {

    // Set livereload only in the front end
    if ( ! is_admin() ) {

      add_action('init', 'register_livereload');

      function register_livereload() {
        
        // Register livereload script (Take a look to Gruntfile.js for more info)
        wp_register_script( 'livereload', 'http://localhost:35729/livereload.js' );
        
        // Enqueue livereload script
        wp_enqueue_script( 'livereload' );

      }

    }

  }


?>
