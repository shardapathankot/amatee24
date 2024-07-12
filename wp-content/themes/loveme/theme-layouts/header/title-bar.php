<?php
	// Metabox
	$loveme_id    = ( isset( $post ) ) ? $post->ID : 0;
	$loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
	$loveme_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $loveme_id;
	$loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox', true );
	if ($loveme_meta && is_page()) {
		$loveme_title_bar_padding = $loveme_meta['title_area_spacings'];
	} else { $loveme_title_bar_padding = ''; }
	// Padding - Theme Options
	if ($loveme_title_bar_padding && $loveme_title_bar_padding !== 'padding-default') {
		$loveme_title_top_spacings = $loveme_meta['title_top_spacings'];
		$loveme_title_bottom_spacings = $loveme_meta['title_bottom_spacings'];
		if ($loveme_title_bar_padding === 'padding-custom') {
			$loveme_title_top_spacings = $loveme_title_top_spacings ? 'padding-top:'. loveme_check_px($loveme_title_top_spacings) .';' : '';
			$loveme_title_bottom_spacings = $loveme_title_bottom_spacings ? 'padding-bottom:'. loveme_check_px($loveme_title_bottom_spacings) .';' : '';
			$loveme_custom_padding = $loveme_title_top_spacings . $loveme_title_bottom_spacings;
		} else {
			$loveme_custom_padding = '';
		}
	} else {
		$loveme_title_bar_padding = cs_get_option('title_bar_padding');
		$loveme_titlebar_top_padding = cs_get_option('titlebar_top_padding');
		$loveme_titlebar_bottom_padding = cs_get_option('titlebar_bottom_padding');
		if ($loveme_title_bar_padding === 'padding-custom') {
			$loveme_titlebar_top_padding = $loveme_titlebar_top_padding ? 'padding-top:'. loveme_check_px($loveme_titlebar_top_padding) .';' : '';
			$loveme_titlebar_bottom_padding = $loveme_titlebar_bottom_padding ? 'padding-bottom:'. loveme_check_px($loveme_titlebar_bottom_padding) .';' : '';
			$loveme_custom_padding = $loveme_titlebar_top_padding . $loveme_titlebar_bottom_padding;
		} else {
			$loveme_custom_padding = '';
		}
	}
	// Banner Type - Meta Box
	if ($loveme_meta && is_page()) {
		$loveme_banner_type = $loveme_meta['banner_type'];
	} else { $loveme_banner_type = ''; }
	// Header Style
	if ($loveme_meta) {
	  $loveme_header_design  = $loveme_meta['select_header_design'];
	  $loveme_hide_breadcrumbs  = $loveme_meta['hide_breadcrumbs'];
	} else {
	  $loveme_header_design  = cs_get_option('select_header_design');
	  $loveme_hide_breadcrumbs = cs_get_option('need_breadcrumbs');
	}
	if ( $loveme_header_design === 'default') {
	  $loveme_header_design_actual  = cs_get_option('select_header_design');
	} else {
	  $loveme_header_design_actual = ( $loveme_header_design ) ? $loveme_header_design : cs_get_option('select_header_design');
	}
	if ( $loveme_header_design_actual == 'style_two') {
		$overly_class = ' overly';
	} else {
		$overly_class = ' ';
	}
	// Overlay Color - Theme Options
		if ($loveme_meta && is_page()) {
			$loveme_bg_overlay_color = $loveme_meta['titlebar_bg_overlay_color'];
			$title_color = isset($loveme_meta['title_color']) ? $loveme_meta['title_color'] : '';
		} else { $loveme_bg_overlay_color = ''; }
		if (!empty($loveme_bg_overlay_color)) {
			$loveme_bg_overlay_color = $loveme_bg_overlay_color;
			$title_color = $title_color;
		} else {
			$loveme_bg_overlay_color = cs_get_option('titlebar_bg_overlay_color');
			$title_color = cs_get_option('title_color');
		}
		$e_uniqid        = uniqid();
		$inline_style  = '';
		if ( $loveme_bg_overlay_color ) {
		 $inline_style .= '.wpo-page-title-'.$e_uniqid .'.wpo-page-title {';
		 $inline_style .= ( $loveme_bg_overlay_color ) ? 'background-color:'. $loveme_bg_overlay_color.';' : '';
		 $inline_style .= '}';
		}
		if ( $title_color ) {
		 $inline_style .= '.wpo-page-title-'.$e_uniqid .'.wpo-page-title h2, .page-title-'.$e_uniqid .'.wpo-page-title .breadcrumb li, .wpo-page-title-'.$e_uniqid .'.wpo-page-title .breadcrumbs ul li a {';
		 $inline_style .= ( $title_color ) ? 'color:'. $title_color.';' : '';
		 $inline_style .= '}';
		}
		// add inline style
		loveme_add_inline_style( $inline_style );
		$styled_class  = ' page-title-'.$e_uniqid;
	// Background - Type
	if( $loveme_meta ) {
		$title_bar_bg = $loveme_meta['title_area_bg'];
	} else {
		$title_bar_bg = '';
	}
	$loveme_custom_header = get_custom_header();
	$header_text_color = get_theme_mod( 'header_textcolor' );
	$background_color = get_theme_mod( 'background_color' );
	if( isset( $title_bar_bg['image'] ) && ( $title_bar_bg['image'] ||  $title_bar_bg['color'] ) ) {
	  extract( $title_bar_bg );
	  $loveme_background_image       = ( ! empty( $image ) ) ? 'background-image: url(' . esc_url($image) . ');' : '';
	  $loveme_background_repeat      = ( ! empty( $image ) && ! empty( $repeat ) ) ? ' background-repeat: ' . esc_attr( $repeat) . ';' : '';
	  $loveme_background_position    = ( ! empty( $image ) && ! empty( $position ) ) ? ' background-position: ' . esc_attr($position) . ';' : '';
	  $loveme_background_size    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-size: ' . esc_attr($size) . ';' : '';
	  $loveme_background_attachment    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-attachment: ' . esc_attr( $attachment ) . ';' : '';
	  $loveme_background_color       = ( ! empty( $color ) ) ? ' background-color: ' . esc_attr( $color ) . ';' : '';
	  $loveme_background_style       = ( ! empty( $image ) ) ? $loveme_background_image . $loveme_background_repeat . $loveme_background_position . $loveme_background_size . $loveme_background_attachment : '';
	  $loveme_title_bg = ( ! empty( $loveme_background_style ) || ! empty( $loveme_background_color ) ) ? $loveme_background_style . $loveme_background_color : '';
	} elseif( $loveme_custom_header->url ) {
		$loveme_title_bg = 'background-image:  url('. esc_url( $loveme_custom_header->url ) .');';
	} else {
		$loveme_title_bg = '';
	}
	if($loveme_banner_type === 'hide-title-area') { // Hide Title Area
	} elseif($loveme_meta && $loveme_banner_type === 'revolution-slider') { // Hide Title Area
		echo do_shortcode($loveme_meta['page_revslider']);
	} else {
	?>
	<section class="wpo-page-title <?php echo esc_attr( $overly_class.$styled_class.' '.$loveme_banner_type ); ?>" style="<?php echo esc_attr( $loveme_title_bg ); ?>" style="<?php echo esc_attr( $loveme_custom_padding ); ?>">
	  <div class="container">
	      <div class="row">
	          <div class="col col-xs-12">
                <div class="page-title">
                	<h2><?php echo loveme_title_area(); ?></h2>
                </div>
	              <?php if ( !$loveme_hide_breadcrumbs && function_exists( 'breadcrumb_trail' )) { breadcrumb_trail();  } ?>
	          </div>
	      </div> <!-- end row -->
	  </div> <!-- end container -->
	</section>
  <!-- end page-title -->
<?php } ?>