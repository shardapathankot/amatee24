<?php
// Metabox
global $post;
$loveme_id    = ( isset( $post ) ) ? $post->ID : false;
$loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
$loveme_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $loveme_id;
$loveme_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $loveme_id : false;
$loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox', true );
  if ($loveme_meta) {
    $loveme_topbar_options = $loveme_meta['topbar_options'];
  } else {
    $loveme_topbar_options = '';
  }

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

// Define Theme Options and Metabox varials in right way!
if ($loveme_meta) {
  if ($loveme_topbar_options === 'custom' && $loveme_topbar_options !== 'default') {
    $loveme_top_left          = $loveme_meta['top_left'];
    $loveme_top_right          = $loveme_meta['top_right'];
    $loveme_hide_topbar        = $loveme_topbar_options;
    $loveme_topbar_bg          = $loveme_meta['topbar_bg'];
    if ($loveme_topbar_bg) {
      $loveme_topbar_bg = 'background-color: '. $loveme_topbar_bg .';';
    } else {$loveme_topbar_bg = '';}
  } else {
    $loveme_top_left          = cs_get_option('top_left');
    $loveme_top_right          = cs_get_option('top_right');
    $loveme_hide_topbar        = cs_get_option('top_bar');
    $loveme_topbar_bg          = '';
  }
} else {
  // Theme Options fields
  $loveme_top_left         = cs_get_option('top_left');
  $loveme_top_right          = cs_get_option('top_right');
  $loveme_hide_topbar        = cs_get_option('top_bar');
  $loveme_topbar_bg          = '';
}
// All options
if ( $loveme_meta && $loveme_topbar_options === 'custom' && $loveme_topbar_options !== 'default' ) {
  $loveme_top_right = ( $loveme_top_right ) ? $loveme_meta['top_right'] : cs_get_option('top_right');
  $loveme_top_left = ( $loveme_top_left ) ? $loveme_meta['top_left'] : cs_get_option('top_left');
} else {
  $loveme_top_right = cs_get_option('top_right');
  $loveme_top_left = cs_get_option('top_left');
}
if ( $loveme_meta && $loveme_topbar_options !== 'default' ) {
  if ( $loveme_topbar_options === 'hide_topbar' ) {
    $loveme_hide_topbar = 'hide';
  } else {
    $loveme_hide_topbar = 'show';
  }
} else {
  $loveme_hide_topbar_check = cs_get_option( 'top_bar' );
  if ( $loveme_hide_topbar_check === true ) {
     $loveme_hide_topbar = 'hide';
  } else {
     $loveme_hide_topbar = 'show';
  }
}
if ( $loveme_meta ) {
  $loveme_topbar_bg = ( $loveme_topbar_bg ) ? $loveme_meta['topbar_bg'] : '';
} else {
  $loveme_topbar_bg = '';
}
if ( $loveme_topbar_bg ) {
  $loveme_topbar_bg = 'background-color: '. $loveme_topbar_bg .';';
} else { $loveme_topbar_bg = ''; }

if( $loveme_hide_topbar === 'show' && ( $loveme_top_left || $loveme_top_right ) ) {
?>
 <div class="topbar" style="<?php echo esc_attr( $loveme_topbar_bg ); ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-lg-7 col-md-12 col-12">
               <?php echo do_shortcode( $loveme_top_left ); ?>
            </div>
            <div class="col col-lg-5 col-md-12 col-12">
                <?php echo do_shortcode( $loveme_top_right ); ?>
            </div>
        </div>
    </div>
</div> <!-- end topbar -->
<?php } // Hide Topbar - From Metabox