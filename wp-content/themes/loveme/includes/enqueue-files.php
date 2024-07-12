<?php
/*
 * All CSS and JS files are enqueued from this file
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Enqueue Files for FrontEnd
 */
function loveme_google_font_url() {
    $font_url = '';
    if ( 'off' !== esc_html__( 'on', 'loveme' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Cormorant Garamond:wght@300;400;500;600;700&display=swap' ), "//fonts.googleapis.com/css2" );
    }
     return str_replace( array("%3A","%40", "%3B", "%26", "%3D"), array(":", "@", ";", "&", "="), $font_url );
}

if ( ! function_exists( 'loveme_scripts_styles' ) ) {
  function loveme_scripts_styles() {

    // Styles
    wp_enqueue_style( 'themify-icons', LOVEME_CSS .'/themify-icons.css', array(), '4.6.3', 'all' );
    wp_enqueue_style( 'flaticon', LOVEME_CSS .'/flaticon.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'bootstrap', LOVEME_CSS .'/bootstrap.min.css', array(), '5.0.1', 'all' );
    wp_enqueue_style( 'animate', LOVEME_CSS .'/animate.css', array(), '3.5.1', 'all' );
    wp_enqueue_style( 'odometer', LOVEME_CSS .'/odometer.css', array(), '0.4.8', 'all' );
    wp_enqueue_style( 'owl-carousel', LOVEME_CSS .'/owl.carousel.css', array(), '2.3.4', 'all' );
    wp_enqueue_style( 'owl-theme', LOVEME_CSS .'/owl.theme.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'slick', LOVEME_CSS .'/slick.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'swiper', LOVEME_CSS .'/swiper.min.css', array(), '4.0.7', 'all' );
    wp_enqueue_style( 'slick-theme', LOVEME_CSS .'/slick-theme.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'owl-transitions', LOVEME_CSS .'/owl.transitions.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'fancybox', LOVEME_CSS .'/fancybox.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'magnific-popup', LOVEME_CSS .'/magnific-popup.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'loveme-style', LOVEME_CSS .'/styles.css', array(), LOVEME_VERSION, 'all' );
    wp_enqueue_style( 'element', LOVEME_CSS .'/elements.css', array(), LOVEME_VERSION, 'all' );
    if ( !function_exists('cs_framework_init') ) {
      wp_enqueue_style('loveme-default-style', get_template_directory_uri() . '/style.css', array(),  LOVEME_VERSION, 'all' );
    }
    wp_enqueue_style( 'loveme-default-google-fonts', esc_url( loveme_google_font_url() ), array(), LOVEME_VERSION, 'all' );
    // Scripts
    wp_enqueue_script( 'bootstrap', LOVEME_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), '5.0.1', true );
    wp_enqueue_script( 'imagesloaded');
    wp_enqueue_script( 'isotope', LOVEME_SCRIPTS . '/isotope.min.js', array( 'jquery' ), '2.2.2', true );
    wp_enqueue_script( 'countdown', LOVEME_SCRIPTS . '/countdown.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'fancybox', LOVEME_SCRIPTS . '/fancybox.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'instafeed', LOVEME_SCRIPTS . '/instafeed.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'circle-progress', LOVEME_SCRIPTS . '/circle-progress.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'masonry');
    wp_enqueue_script( 'owl-carousel', LOVEME_SCRIPTS . '/owl-carousel.js', array( 'jquery' ), '2.3.4', true );
    wp_enqueue_script( 'jquery-easing', LOVEME_SCRIPTS . '/jquery-easing.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'wow', LOVEME_SCRIPTS . '/wow.min.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'odometer', LOVEME_SCRIPTS . '/odometer.min.js', array( 'jquery' ), '0.4.8', true );
    wp_enqueue_script( 'magnific-popup', LOVEME_SCRIPTS . '/magnific-popup.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'slick-slider', LOVEME_SCRIPTS . '/slick-slider.js', array( 'jquery' ), '1.6.0', true );
    wp_enqueue_script( 'swiper', LOVEME_SCRIPTS . '/swiper.min.js', array( 'jquery' ), '4.0.7', true );
    wp_enqueue_script( 'wc-quantity-increment', LOVEME_SCRIPTS . '/wc-quantity-increment.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'loveme-scripts', LOVEME_SCRIPTS . '/scripts.js', array( 'jquery' ), LOVEME_VERSION, true );
    // Comments
    wp_enqueue_script( 'loveme-inline-validate', LOVEME_SCRIPTS . '/jquery.validate.min.js', array( 'jquery' ), '1.9.0', true );
    wp_add_inline_script( 'loveme-validate', 'jQuery(document).ready(function($) {$("#commentform").validate({rules: {author: {required: true,minlength: 2},email: {required: true,email: true},comment: {required: true,minlength: 10}}});});' );

    // Responsive Active
    $loveme_viewport = cs_get_option('theme_responsive');
    if( !$loveme_viewport ) {
      wp_enqueue_style( 'loveme-responsive', LOVEME_CSS .'/responsive.css', array(), LOVEME_VERSION, 'all' );
    }

    // Adds support for pages with threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'loveme_scripts_styles' );
}

/**
 * Enqueue Files for BackEnd
 */
if ( ! function_exists( 'loveme_admin_scripts_styles' ) ) {
  function loveme_admin_scripts_styles() {

    wp_enqueue_style( 'loveme-admin-main', LOVEME_CSS . '/admin-styles.css', true );
    wp_enqueue_style( 'flaticon', LOVEME_CSS . '/flaticon.css', true );
    wp_enqueue_style( 'themify-icons', LOVEME_CSS . '/themify-icons.css', true );
    wp_enqueue_script( 'loveme-admin-scripts', LOVEME_SCRIPTS . '/admin-scripts.js', true );

  }
  add_action( 'admin_enqueue_scripts', 'loveme_admin_scripts_styles' );
}
