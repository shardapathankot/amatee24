<?php
  // Metabox
  $loveme_id    = ( isset( $post ) ) ? $post->ID : 0;
  $loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
  $loveme_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $loveme_id;
  $loveme_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $loveme_id : false;
  $loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox', true );

  // Header Style
  if ( $loveme_meta ) {
    $loveme_header_design  = $loveme_meta['select_header_design'];
    $loveme_sticky_header = isset( $loveme_meta['sticky_header'] ) ? $loveme_meta['sticky_header'] : '' ;
    $loveme_search = isset( $loveme_meta['loveme_search'] ) ? $loveme_meta['loveme_search'] : '';
  } else {
    $loveme_header_design  = cs_get_option( 'select_header_design' );
    $loveme_sticky_header  = cs_get_option( 'sticky_header' );
    $loveme_search  = cs_get_option( 'loveme_search' );
  }

  $loveme_cart_widget  = cs_get_option( 'loveme_cart_widget' );

  if ( $loveme_header_design === 'default' ) {
    $loveme_header_design_actual  = cs_get_option( 'select_header_design' );
  } else {
    $loveme_header_design_actual = ( $loveme_header_design ) ? $loveme_header_design : cs_get_option('select_header_design');
  }
  $loveme_header_design_actual = $loveme_header_design_actual ? $loveme_header_design_actual : 'style_one';

  if ( $loveme_meta && $loveme_header_design !== 'default') {
   $loveme_search = isset( $loveme_meta['loveme_search'] ) ? $loveme_meta['loveme_search'] : '';
  } else {
    $loveme_search  = cs_get_option( 'loveme_search' );
  }

  if ( $loveme_cart_widget ) {
    $cart_class = 'has-cart ';
  } else {
    $cart_class = 'not-has-cart ';
  }
  if ( $loveme_search ) {
   $search_class = 'not-has-search ';
  } else {
    $search_class = 'has-search ';
  }
  if ( has_nav_menu( 'primary' ) ) {
     $menu_padding = ' has-menu ';
  } else {
     $menu_padding = ' dont-has-menu ';
  }
  if ($loveme_meta) {
    $loveme_choose_menu = $loveme_meta['choose_menu'];
  } else { $loveme_choose_menu = ''; }
  $loveme_choose_menu = $loveme_choose_menu ? $loveme_choose_menu : '';

?>
<!-- Navigation & Search -->
 <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-3 col-3 d-lg-none dl-block">
          <div class="mobail-menu">
              <button type="button" class="navbar-toggler open-btn">
                  <span class="sr-only"><?php echo esc_html__( 'Toggle navigation','loveme' ) ?></span>
                  <span class="icon-bar first-angle"></span>
                  <span class="icon-bar middle-angle"></span>
                  <span class="icon-bar last-angle"></span>
              </button>
          </div>
      </div>
      <div class="col-lg-2 col-md-6 col-6"><!-- Start of Logo -->
          <div class="navbar-header">
            <?php get_template_part( 'theme-layouts/header/logo' ); ?>
          </div>
      </div>
      <div class="col-lg-10 col-md-1 col-1"><!-- Start of nav-collapse -->
        <div id="navbar" class="collapse navbar-collapse navigation-holder <?php echo esc_attr( $menu_padding.$cart_class.$search_class ); ?>">
            <button class="menu-close"><i class="ti-close"></i></button>
            <?php
              wp_nav_menu(
                array(
                  'menu'              => 'primary',
                  'theme_location'    => 'primary',
                  'container'         => '',
                  'container_class'   => '',
                  'container_id'      => '',
                  'menu'              => $loveme_choose_menu,
                  'menu_class'        => 'nav navbar-nav menu nav-menu mb-2 mb-lg-0',
                  'fallback_cb'       => '__return_false',
                )
              );
            ?>
        </div><!-- end of nav-collapse -->
      </div>
      <?php get_template_part( 'theme-layouts/header/search','bar' ); ?>
    </div><!-- end of row -->
  </div><!-- end of container -->


