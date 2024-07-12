<?php
/*
 * The main template file.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
get_header();
	// Metabox
	$loveme_id    = ( isset( $post ) ) ? $post->ID : 0;
	$loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
	$loveme_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $loveme_id;
	$loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox', true );
	if ( $loveme_meta ) {
		$loveme_content_padding = isset( $loveme_meta['content_spacings'] ) ? $loveme_meta['content_spacings'] : '';
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
	// Theme Options
	$loveme_sidebar_position = cs_get_option( 'blog_sidebar_position' );
	$loveme_sidebar_position = $loveme_sidebar_position ?$loveme_sidebar_position : 'sidebar-right';
	$loveme_blog_widget = cs_get_option( 'blog_widget' );
	$loveme_blog_widget = $loveme_blog_widget ? $loveme_blog_widget : 'sidebar-1';

	if (isset($_GET['sidebar'])) {
	  $loveme_sidebar_position = $_GET['sidebar'];
	}

	$loveme_sidebar_position = $loveme_sidebar_position ? $loveme_sidebar_position : 'sidebar-right';

	// Sidebar Position
	if ( $loveme_sidebar_position === 'sidebar-hide' ) {
		$layout_class = 'col col-lg-10 offset-lg-1';
		$loveme_sidebar_class = 'hide-sidebar';
	} elseif ( $loveme_sidebar_position === 'sidebar-left' && is_active_sidebar( $loveme_blog_widget ) ) {
		$layout_class = 'col col-lg-8 order-lg-2';
		$loveme_sidebar_class = 'left-sidebar';
	} elseif( is_active_sidebar( $loveme_blog_widget ) ) {
		$layout_class = 'col col-lg-8';
		$loveme_sidebar_class = 'right-sidebar';
	} else {
		$layout_class = 'col col-lg-12';
		$loveme_sidebar_class = 'hide-sidebar';
	}

	?>
<div class="wpo-blog-pg-section section-padding">
	<div class="container <?php echo esc_attr( $loveme_content_padding .' '. $loveme_sidebar_class ); ?>" style="<?php echo esc_attr( $loveme_custom_padding ); ?>">
		<div class="row">
			<div class="<?php echo esc_attr( $layout_class ); ?>">
				<div class="wpo-blog-content">
				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						get_template_part( 'theme-layouts/post/content' );
					endwhile;
				else :
					get_template_part( 'theme-layouts/post/content', 'none' );
				endif;
				loveme_posts_navigation();
		    wp_reset_postdata(); ?>
		    </div>
			</div><!-- Content Area -->
			<?php
			if ( $loveme_sidebar_position !== 'sidebar-hide' && is_active_sidebar( $loveme_blog_widget ) ) {
				get_sidebar(); // Sidebar
			} ?>
		</div>
	</div>
</div>
<?php
get_footer();