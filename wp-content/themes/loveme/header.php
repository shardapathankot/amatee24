<?php
/*
 * The header for our theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
?><!DOCTYPE html>
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php
$loveme_viewport = cs_get_option( 'theme_responsive' );
if( !$loveme_viewport ) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php } $loveme_all_element_color  = cs_get_customize_option( 'all_element_colors' ); ?>
<meta name="msapplication-TileColor" content="<?php echo esc_attr( $loveme_all_element_color ); ?>">
<meta name="theme-color" content="<?php echo esc_attr( $loveme_all_element_color ); ?>">
<link rel="profile" href="//gmpg.org/xfn/11">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
  // Metabox
  global $post;
  $loveme_id    = ( isset( $post ) ) ? $post->ID : false;
  $loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
  $loveme_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $loveme_id;
  $loveme_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $loveme_id : false;
  $loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox', true );
  // Theme Layout Width
  $loveme_layout_width  = cs_get_option( 'theme_layout_width' );
  $theme_preloder  = cs_get_option( 'theme_preloder' );
  $loveme_layout_width_class = ( $loveme_layout_width === 'container' ) ? 'layout-boxed' : 'layout-full';
  // Header Style
  if ( $loveme_meta ) {
    $loveme_header_design  = $loveme_meta['select_header_design'];
  } else {
    $loveme_header_design  = cs_get_option( 'select_header_design' );
  }

  $loveme_sticky_header  = cs_get_option( 'sticky_header' );

  if ( $loveme_header_design === 'default' ) {
    $loveme_header_design_actual  = cs_get_option( 'select_header_design' );
  } else {
    $loveme_header_design_actual = ( $loveme_header_design ) ? $loveme_header_design : cs_get_option('select_header_design');
  }

  $loveme_header_design_actual = $loveme_header_design_actual ? $loveme_header_design_actual : 'style_one';

  if ( $loveme_header_design_actual == 'style_three' ) {
    $header_class = 'wpo-header-style-3';
  }  elseif ( $loveme_header_design_actual == 'style_two' ) {
    $header_class = 'wpo-header-style-2';
  } else {
    $header_class = 'wpo-header-style-1';
  }

  if ( has_nav_menu( 'primary' ) ) {
     $has_menu = ' has-menu ';
  } else {
     $has_menu = ' dont-has-menu ';
  }

  // Box Style
  $loveme_box_style = isset( $loveme_meta['box_style'] ) ? $loveme_meta['box_style'] : '' ;
  if ( $loveme_box_style ) {
    $box_class = ' wpo-box-style';
  } else {
    $box_class = ' box-style-none';
  }

  if ( $loveme_sticky_header ) {
    $loveme_sticky_header = $loveme_sticky_header ? ' sticky-menu-on ' : '';
  } else {
    $loveme_sticky_header = 'sticky-menu-off';
  }
  // Header Transparent
  if ( $loveme_meta ) {
    $loveme_transparent_header = $loveme_meta['transparency_header'];
    $loveme_transparent_header = $loveme_transparent_header ? ' header-transparent' : ' dont-transparent';
    // Shortcode Banner Type
    $loveme_banner_type = ' '. $loveme_meta['banner_type'];
  } else { $loveme_transparent_header = ' dont-transparent'; $loveme_banner_type = ''; }
  wp_head();
  ?>
  </head>
  <body <?php body_class(); ?>>
     <?php wp_body_open(); ?>
  <div class="page-wrapper <?php echo esc_attr( $loveme_layout_width_class.$box_class ); ?>"> 
  <!-- #loveme-theme-wrapper -->
  <?php if( $theme_preloder ) {
   get_template_part( 'theme-layouts/header/preloder' );
   } ?>
   
   
  <header id="header" class="wpo-site-header <?php echo esc_attr( $header_class ); ?>">
      <?php  get_template_part( 'theme-layouts/header/top','bar' ); ?>
    <nav id="site-navigation" class="navigation navbar navbar-expand-lg navbar-light <?php echo esc_attr( $loveme_sticky_header.$has_menu ); ?>">
      <?php get_template_part( 'theme-layouts/header/menu','bar' ); ?>
    </nav>
  </header>
  
  
  <?php
  // Title Area
  $loveme_need_title_bar = cs_get_option('need_title_bar');
  if ( !$loveme_need_title_bar ) {
    get_template_part( 'theme-layouts/header/title', 'bar' );
  }