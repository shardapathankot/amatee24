<?php
add_action( 'wp_enqueue_scripts', 'loveme_enqueue_styles' );
function loveme_enqueue_styles() {
  $parent_style = 'loveme-style';
  wp_enqueue_style( $parent_style, get_template_directory_uri() . '/assets/css/styles.css', array('themify-icons', 'flaticon', 'bootstrap', 'animate','owl-carousel','owl-theme', 'slick', 'slick-theme','owl-transitions','fancybox','fancybox') );
  wp_enqueue_style( 'loveme-child',
      get_stylesheet_directory_uri() . '/style.css',
      array( $parent_style ),
      wp_get_theme()->get('Version')
    );
}
if( ! function_exists( 'loveme_child_theme_language_setup' ) ) {
  function loveme_child_theme_language_setup(){
    load_theme_textdomain( 'loveme-child', get_template_directory() . '/languages' );
  }
  add_action('after_setup_theme', 'loveme_child_theme_language_setup');
}