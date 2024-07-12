<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php
$loveme_viewport = cs_get_option('theme_responsive');
if($loveme_viewport == 'on') { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php } else { }

// if the `wp_site_icon` function does not exist (ie we're on < WP 4.3)
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
  if (cs_get_option('brand_fav_icon')) {
    echo '<link rel="shortcut icon" href="'. esc_url(wp_get_attachment_url(cs_get_option('brand_fav_icon'))) .'" />';
  } else { ?>
    <link rel="shortcut icon" href="<?php echo esc_url(LOVEME_IMAGES); ?>/favicon.png" />
  <?php }
  if (cs_get_option('iphone_icon')) {
    echo '<link rel="apple-touch-icon" sizes="57x57" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_icon'))) .'" >';
  }
  if (cs_get_option('iphone_retina_icon')) {
    echo '<link rel="apple-touch-icon" sizes="114x114" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_retina_icon'))) .'" >';
    echo '<link name="msapplication-TileImage" href="'. esc_url(wp_get_attachment_url(cs_get_option('iphone_retina_icon'))) .'" >';
  }
  if (cs_get_option('ipad_icon')) {
    echo '<link rel="apple-touch-icon" sizes="72x72" href="'. esc_url(wp_get_attachment_url(cs_get_option('ipad_icon'))) .'" >';
  }
  if (cs_get_option('ipad_retina_icon')) {
    echo '<link rel="apple-touch-icon" sizes="144x144" href="'. esc_url(wp_get_attachment_url(cs_get_option('ipad_retina_icon'))) .'" >';
  }
}
$loveme_all_element_color  = cs_get_customize_option( 'all_element_colors' );
?>
<meta name="msapplication-TileColor" content="<?php echo esc_attr($loveme_all_element_color); ?>">
<meta name="theme-color" content="<?php echo esc_attr($loveme_all_element_color); ?>">

<link rel="profile" href="//gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php
wp_head();

// Metabox
$loveme_id    = ( isset( $post ) ) ? $post->ID : 0;
$loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
$loveme_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $loveme_id;
$loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox', true );
$maintenance_title = cs_get_option('maintenance_mode_title');
$maintenance_text = cs_get_option('maintenance_mode_text');
$maintenance_mode_bg = cs_get_option('maintenance_mode_bg');

$maintenance_title = ( $maintenance_title ) ? $maintenance_title : esc_html__( 'Our Website is Under Construction', 'loveme' );
$maintenance_text = ( $maintenance_text ) ? $maintenance_text : esc_html__( 'Please Visit After sometime or Contact us at hello@website.com. Thanks you.', 'loveme' );

if ($loveme_meta) {
  $loveme_content_padding = $loveme_meta['content_spacings'];
} else { $loveme_content_padding = ''; }
// Padding - Metabox
if ($loveme_content_padding && $loveme_content_padding !== 'padding-default') {
  $loveme_content_top_spacings = $loveme_meta['content_top_spacings'];
  $loveme_content_bottom_spacings = $loveme_meta['content_bottom_spacings'];
  if ($loveme_content_padding === 'padding-custom') {
    $loveme_content_top_spacings = $loveme_content_top_spacings ? 'padding-top:'. loveme_check_px($loveme_content_top_spacings) .';' : '';
    $loveme_content_bottom_spacings = $loveme_content_bottom_spacings ? 'padding-bottom:'. loveme_check_px($loveme_content_bottom_spacings) .';' : '';
    $loveme_custom_padding = $loveme_content_top_spacings . $loveme_content_bottom_spacings;
  } else {
    $loveme_custom_padding = '';
  }
} else {
  $loveme_custom_padding = '';
}
if ($maintenance_mode_bg) {
   extract( $maintenance_mode_bg );
   $loveme_background_image       = ( ! empty( $image ) ) ? 'background-image: url(' . $image . ');' : '';
   $loveme_background_repeat      = ( ! empty( $image ) && ! empty( $repeat ) ) ? ' background-repeat: ' . $repeat . ';' : '';
   $loveme_background_position    = ( ! empty( $image ) && ! empty( $position ) ) ? ' background-position: ' . $position . ';' : '';
   $loveme_background_size    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-size: ' . $size . ';' : '';
   $loveme_background_attachment    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-attachment: ' . $attachment . ';' : '';
   $loveme_background_color       = ( ! empty( $color ) ) ? ' background-color: ' . $color . ';' : '';
   $loveme_background_style       = ( ! empty( $image ) ) ? $loveme_background_image . $loveme_background_repeat . $loveme_background_position . $loveme_background_size . $loveme_background_attachment : '';
   $loveme_maintain_bg = ( ! empty( $loveme_background_style ) || ! empty( $loveme_background_color ) ) ? $loveme_background_style . $loveme_background_color : '';
  } else {
  $loveme_maintain_bg = '';
}
?>
</head>
<body <?php body_class(); ?>>
<section class="error-404-section comming-soon-section" style="<?php echo esc_attr($loveme_maintain_bg); ?>">
  <div class="container">
      <div class="row">
          <div class="col col-md-10 col-md-offset-1">
              <div class="content">
                  <h3><?php echo esc_html( $maintenance_title ); ?></h3>
                  <p><?php echo esc_html( $maintenance_text ); ?></p>
                  <div class="icon">
                      <i class="ti-microphone"></i>
                  </div>
              </div>
          </div>
      </div> <!-- end row -->
  </div> <!-- end container -->
</section>
  <?php wp_footer(); ?>
  </body>
</html>