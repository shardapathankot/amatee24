<?php
/*
 * The template for displaying the footer.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

$loveme_id    = ( isset( $post ) ) ? $post->ID : 0;
$loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
$loveme_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $loveme_id;
$loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox', true );
$loveme_ft_bg = cs_get_option('loveme_ft_bg');
$loveme_attachment = wp_get_attachment_image_src( $loveme_ft_bg , 'full' );
$loveme_attachment = $loveme_attachment ? $loveme_attachment[0] : '';

if ( $loveme_attachment ) {
	$bg_url = ' style="';
	$bg_url .= ( $loveme_attachment ) ? 'background-image: url( '. esc_url( $loveme_attachment ) .' );' : '';
	$bg_url .= '"';
} else {
	$bg_url = '';
}

if ( $loveme_meta ) {
	$loveme_hide_footer  = $loveme_meta['hide_footer'];
} else { $loveme_hide_footer = ''; }
if ( !$loveme_hide_footer ) { // Hide Footer Metabox
	$hide_copyright = cs_get_option('hide_copyright');
	
?>

	<!-- Footer -->
	<footer class="wpo-site-footer clearfix"  <?php echo wp_kses( $bg_url, array('img' => array('src' => array(), 'alt' => array()),) ); ?>>
		<?php
			$footer_widget_block = cs_get_option( 'footer_widget_block' );
			if ( $footer_widget_block ) {
	      get_template_part( 'theme-layouts/footer/footer', 'widgets' );
	    }
			if ( !$hide_copyright ) {
      	get_template_part( 'theme-layouts/footer/footer', 'copyright' );
	    }
    ?>
	</footer>
	
	<!-- Footer -->
<?php } // Hide Footer Metabox ?>
</div><!--loveme-theme-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
