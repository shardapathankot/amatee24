<?php


// Count Ajax
function loveme_woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>

  <span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>

  <?php
  $fragments['span.cart-count'] = ob_get_clean();

  return $fragments;

}
add_filter('woocommerce_add_to_cart_fragments', 'loveme_woocommerce_header_add_to_cart_fragment');

// Amount Ajax
function loveme_amount_woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
  <span class="total-amount"><?php echo wp_kses( WC()->cart->get_cart_total(), array( 'span' => array( 'class' => array() ) ) ); ?></span>
  <?php

  $fragments['span.total-amount'] = ob_get_clean();

  return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'loveme_amount_woocommerce_header_add_to_cart_fragment');


remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_filter('woocommerce_show_page_title', '__return_false');

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function loveme_woocommerce_products_per_page() {
  $loveme_product_count = cs_get_option('loveme_woo_limit');
  $loveme_product_count = $loveme_product_count ? $loveme_product_count : 8;
  return (int) $loveme_product_count;
}
add_filter( 'loop_shop_per_page', 'loveme_woocommerce_products_per_page' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 */
function loveme_woocommerce_related_products_args( $args ) {
  $loveme_releted_count = cs_get_option('woo_related_limit');
  $defaults = array(
    'posts_per_page' => $loveme_releted_count,
  );
  $args = wp_parse_args( $defaults, $args );
  return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'loveme_woocommerce_related_products_args' );


function loveme_wc_theme_setup()  {
  $loveme_woo_single_related = cs_get_option('woo_single_related');
  $loveme_woo_single_upsell = cs_get_option('woo_single_upsell');
  if ( $loveme_woo_single_related == true ) {
     return remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
  }
  if ( $loveme_woo_single_upsell == true ) {
     return remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
  }

  if( is_woocommerce_activated() && class_exists( 'YITH_WCWL' ) ) {
    add_action('woocommerce_after_shop_loop_item', 'loveme_yith_wcwl_add_to_wishlist_button', 5);
  }

   remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
}
add_action('after_setup_theme','loveme_wc_theme_setup', 10);


  function loveme_yith_wcwl_add_to_wishlist_button() {
    global $product;

    if( ! isset( $product ) ){
      $product = ( isset( $atts['product_id'] ) ) ? wc_get_product( $atts['product_id'] ) : false;
    }

    $label_option = get_option( 'yith_wcwl_add_to_wishlist_text' );
    $label = apply_filters( 'yith_wcwl_button_label', $label_option );
    $browse_wishlist = get_option( 'yith_wcwl_browse_wishlist_text' );

    $default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

    if( ! empty( $default_wishlists ) ){
      $default_wishlist = $default_wishlists[0]['ID'];
    }
    else{
      $default_wishlist = false;
    }
    $wishlist_url = YITH_WCWL()->get_wishlist_url();

  ?>
    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr($product->get_id()); ?>">
      <div class="yith-wcwl-add-button show" style="display:block">
        <a href="<?php echo esc_url(add_query_arg('add_to_wishlist', $product->get_id())); ?>" rel="nofollow" data-product-id="<?php echo esc_attr($product->get_id()); ?>" data-product-type="simple"  data-toggle="Add to Wishlist"  class="add_to_wishlist"><i class="fa fa-heart"></i></a>
      </div>
      <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
          <span class="feedback"><?php echo esc_html__( 'Product added!', 'loveme' ); ?></span>
          <a href="<?php echo esc_url( $wishlist_url ); ?>" class="view-wishlist" rel="nofollow"><?php echo esc_html__( 'View List', 'loveme' ); ?></a>
      </div>
        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
            <span class="feedback"><?php echo esc_html__( 'The product is already in the wishlist!', 'loveme' ); ?></span>
            <a href="<?php echo esc_url( $wishlist_url ); ?>"  class="wishilist-already-added" rel="nofollow"><i class="fa fa-heart"></i></a>
        </div>
        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    </div>
  <?php
}

update_option( 'woocommerce_thumbnail_cropping', 'custom' );
update_option( 'woocommerce_thumbnail_cropping_custom_width', '4' );
update_option( 'woocommerce_thumbnail_cropping_custom_height', '3' );


if (!function_exists('loveme_loop_columns')) {
  function loveme_loop_columns() {
  $woo_product_columns = cs_get_option('woo_product_columns');
  $woo_product_columns = $woo_product_columns ? $woo_product_columns : 3;
    return (int) $woo_product_columns;
  }
}
add_filter('loop_shop_columns', 'loveme_loop_columns');

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function loveme_products_per_page() {
  $loveme_product_count = cs_get_option('theme_woo_limit');
  $loveme_product_count = $loveme_product_count ? $loveme_product_count : 9;
  return (int) $loveme_product_count;
}
add_filter( 'loop_shop_per_page', 'loveme_products_per_page' );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );


update_option( 'woocommerce_thumbnail_cropping_custom_height', '4.25' );

// Count Ajax
function loveme_cart_woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
     <div class="mini-cart-content">
        <button class="mini-cart-close"><i class="ti-close"></i></button>
        <?php if ( ! WC()->cart->is_empty() ) : ?>
          <div class="mini-cart-items">
             <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
              $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
              $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

              if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-item-image">
                    <?php
                      $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                      if ( ! $product_permalink ) {
                        echo wp_kses(  $thumbnail ), array( 'img' => array( 'src' => array(), 'alt' => array() ) );
                      } else {
                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                      }
                    ?>
                </div>
                <div class="mini-cart-item-des">
                     <?php
                      if ( ! $product_permalink ) {
                        echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
                      } else {
                        echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
                      }
                    ?>
                    <span class="mini-cart-item-price">
                    <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                      <span class="mini-cart-item-quantity">
                        <i class="ti-close"></i>
                        <?php echo esc_html( $cart_item['quantity'] ); ?>
                      </span>
                    </span>
                    <?php
                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                          '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="ti-close"></i></a>',
                          esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                          esc_html__( 'Remove this item', 'loveme' ),
                          esc_attr( $product_id ),
                          esc_attr( $_product->get_sku() )
                        ), $cart_item_key );
                      ?>
                </div>
            </div>
            <?php
              }
             }
            ?>
        </div>
        <?php else : 
           $mini_shop_url = wc_get_page_permalink( 'shop' );
          ?>
          <div class="mini-cart-empty">
            <p class="no-products"><?php echo esc_html__('Your basket is empty!.','loveme' ); ?></p>
            <div class="cart-emty-icon">
              <i class="fi flaticon-shopping-cart"></i>
            </div>
            <a href="<?php  echo esc_url( $mini_shop_url ) ?>" class="view-cart-btn s2">
                <?php echo esc_html__('Start Shopping','loveme' ); ?>
            </a>
          </div>
        <?php endif; ?>
        <div class="mini-cart-action clearfix">
            <?php 
            if (! WC()->cart->is_empty() ) {
              $checkout_url = wc_get_page_permalink( 'checkout' );
              $mini_cart_url = wc_get_page_permalink( 'cart' ); 
             ?>
              <span class="mini-checkout-price">
              <?php echo esc_html__('Subtotal: ','loveme' ); ?>
              <span><?php echo WC()->cart->get_cart_total(); ?></span>
              </span>
            
              <a href="<?php echo esc_url( $checkout_url ); ?>" class="view-cart-btn s1">
                <?php echo esc_html__(' Checkout','loveme' ); ?>
              </a>
              <a href="<?php  echo esc_url( $mini_cart_url ) ?>" class="view-cart-btn">
                <?php echo esc_html__('View Cart','loveme' ); ?>
              </a>
            <?php } ?>
        </div>
    </div>

  <?php
  $fragments['div.mini-cart-content'] = ob_get_clean();

  return $fragments;

}
add_filter('woocommerce_add_to_cart_fragments', 'loveme_cart_woocommerce_header_add_to_cart_fragment');




remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
add_action('woocommerce_single_product_summary', 'woocommerce_loveme_single_title',5);

if ( ! function_exists( 'woocommerce_loveme_single_title' ) ) {
   function woocommerce_loveme_single_title() {
     global $product;
     $loveme_woocommerce_section = get_post_meta( get_the_ID(), 'loveme_woocommerce_section', true );
     $loveme_product_title = isset( $loveme_woocommerce_section['loveme_product_title'] ) ? $loveme_woocommerce_section['loveme_product_title'] : '';

?>
    <h2 itemprop="name" class="product_title entry-title"><?php echo esc_html( $loveme_product_title ) ?></h2>
<?php
    }
}


add_filter( 'woocommerce_pagination_args',  'loveme_woo_pagination' );
function loveme_woo_pagination( $args ) {

  $args['prev_text'] = '<i class="fi ti-arrow-left"></i>';
  $args['next_text'] = '<i class="fi ti-arrow-right"></i>';

  return $args;
}

add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 150,
        'height' => 150,
        'crop' => 0,
    );
} );