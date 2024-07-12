<?php
// Metabox
global $post;
$loveme_id    = ( isset( $post ) ) ? $post->ID : false;
$loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
$loveme_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $loveme_id;
$loveme_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('service') ) ? $loveme_id : false;
$loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox', true );
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

$loveme_logo = cs_get_option( 'loveme_logo' );
$loveme_trlogo = cs_get_option( 'loveme_trlogo' );

$logo_url = wp_get_attachment_url( $loveme_logo );
$logo_alt = get_post_meta( $loveme_logo, '_wp_attachment_image_alt', true );

$trlogo_url = wp_get_attachment_url( $loveme_trlogo );
$trlogo_alt = get_post_meta( $loveme_trlogo, '_wp_attachment_image_alt', true );

if ( $logo_url ) {
  $logo_url = $logo_url;
} else {
 $logo_url = LOVEME_IMAGES.'/logo.svg';
}

if ( $trlogo_url ) {
  $trlogo_url = $trlogo_url;
} else {
 $trlogo_url = LOVEME_IMAGES.'/tr-logo.svg';
}


if ( $loveme_header_design_actual == 'style_three' ) {
  $loveme_logo_url = $trlogo_url;
  $loveme_logo_alt = $trlogo_alt;
} else {
  $loveme_logo_url = $logo_url;
  $loveme_logo_alt = $logo_alt;
}

if ( has_nav_menu( 'primary' ) ) {
  $logo_padding = ' has_menu ';
}
else {
   $logo_padding = ' dont_has_menu ';
}


// Logo Spacings
// Logo Spacings
$loveme_logo_width = cs_get_option( 'loveme_logo_width' );
$loveme_brand_logo_top = cs_get_option( 'loveme_logo_top' );
$loveme_brand_logo_bottom = cs_get_option( 'loveme_logo_bottom' );
if ( $loveme_brand_logo_top ) {
  $loveme_brand_logo_top = 'padding-top:'. loveme_check_px( $loveme_brand_logo_top ) .';';
} else { $loveme_brand_logo_top = ''; }
if ( $loveme_brand_logo_bottom ) {
  $loveme_brand_logo_bottom = 'padding-bottom:'. loveme_check_px( $loveme_brand_logo_bottom ) .';';
} else { $loveme_brand_logo_bottom = ''; }
if ( $loveme_logo_width ) {
  $loveme_logo_width = 'max-width:'. loveme_check_px( $loveme_logo_width ) .';';
} else { $loveme_logo_width = ''; }
?>
<div class="site-logo <?php echo esc_attr( $logo_padding ); ?>"  style="<?php echo esc_attr( $loveme_brand_logo_top ); echo esc_attr( $loveme_brand_logo_bottom ); ?>">
   <?php if ( $loveme_logo ) {
    ?>
      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img style="<?php echo esc_attr( $loveme_logo_width ); ?>" src="<?php echo esc_url( $loveme_logo_url ); ?>" alt=" <?php echo esc_attr( $loveme_logo_alt ); ?>">
     </a>
   <?php } elseif( has_custom_logo() ) {
      the_custom_logo();
    } else {
    ?>
    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img style="<?php echo esc_attr( $loveme_logo_width ); ?>" src="<?php echo esc_url( $loveme_logo_url ); ?>" alt="<?php echo get_bloginfo('name'); ?>">
     </a>
   <?php
  } ?>
</div>