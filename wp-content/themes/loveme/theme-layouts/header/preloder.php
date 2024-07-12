<?php
	// Logo Image
	// Metabox - Header Transparent
	$loveme_id    = ( isset( $post ) ) ? $post->ID : 0;
	$loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
	$loveme_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $loveme_id;
	$loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox'. true );
	$loveme_preloader_image  = cs_get_option( 'preloader_image' );

	$loveme_preloader_url = wp_get_attachment_url( $loveme_preloader_image );
	$loveme_preloader_alt = get_post_meta( $loveme_preloader_image, '_wp_attachment_image_alt', true );

	if ( $loveme_preloader_url ) {
		$loveme_preloader_url = $loveme_preloader_url;
	} else {
		$loveme_preloader_url = LOVEME_IMAGES.'/preloader.png';
	}

?>
<!-- start preloader -->
<div class="preloader">
    <div class="vertical-centered-box">
        <div class="content">
            <div class="loader-circle"></div>
            <div class="loader-line-mask">
                <div class="loader-line"></div>
            </div>
            <img src="<?php echo esc_url( $loveme_preloader_url ); ?>" alt="<?php echo esc_attr( $loveme_preloader_alt ); ?>">
        </div>
    </div>
</div>
<!-- end preloader -->