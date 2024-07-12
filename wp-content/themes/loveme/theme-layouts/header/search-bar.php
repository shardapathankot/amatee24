<?php
$loveme_id    = ( isset( $post ) ) ? $post->ID : 0;
$loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
$loveme_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $loveme_id;
$loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox', true);

// Header Style
if ( $loveme_meta ) {
  $loveme_header_design  = $loveme_meta['select_header_design'];
} else {
  $loveme_header_design  = cs_get_option( 'select_header_design' );
}

if ( $loveme_header_design === 'default' ) {
  $loveme_header_design_actual  = cs_get_option( 'select_header_design' );
} else {
  $loveme_header_design_actual = ( $loveme_header_design ) ? $loveme_header_design : cs_get_option('select_header_design');
}
$loveme_header_design_actual = $loveme_header_design_actual ? $loveme_header_design_actual : 'style_one';

$loveme_cart_widget  = cs_get_option( 'loveme_cart_widget' );
$loveme_search  = cs_get_option( 'loveme_header_search' );

?>
<!--<div class="col-lg-2 col-md-2 col-2">
  <div class="header-search-form-wrapper header-right">
    <?php
      if ( !$loveme_search ) { ?>
      <div class="cart-search-contact">
          <button class="search-toggle-btn"><i class="fi flaticon-search"></i></button>
          <div class="header-search-form">
              <form method="get" action="<?php echo esc_url( home_url('/') ); ?>" class="form" >
                  <div>
                      <input type="text" name="s" class="form-control" placeholder="<?php echo esc_attr__( 'Search here','loveme' ); ?>">
                      <button type="submit"><i class="fi flaticon-search"></i></button>
                  </div>
              </form>
          </div>
      </div>
    <?php } 
    if ( $loveme_cart_widget && class_exists( 'WooCommerce' ) ) {
      get_template_part( 'theme-layouts/header/top','cart' );
    }
    ?>
  </div>
</div>-->
