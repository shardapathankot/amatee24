<?php
/*
 * The template for displaying all single posts.
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
		$loveme_content_padding = $loveme_meta['content_spacings'];
	} else { $loveme_content_padding = ''; }
	// Padding - Metabox
	if ( $loveme_content_padding && $loveme_content_padding !== 'padding-default' ) {
		$loveme_content_top_spacings = $loveme_meta['content_top_spacings'];
		$loveme_content_bottom_spacings = $loveme_meta['content_bottom_spacings'];
		if ( $loveme_content_padding === 'padding-custom' ) {
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
	$loveme_single_comment = cs_get_option( 'single_comment_form' );
	$loveme_sidebar_position = cs_get_option( 'blog_sidebar_position' );
	$loveme_sidebar_position = $loveme_sidebar_position ?$loveme_sidebar_position : 'sidebar-right';
	$loveme_blog_widget = cs_get_option( 'blog_widget' );
	$loveme_blog_widget = $loveme_blog_widget ? $loveme_blog_widget : 'sidebar-1';

	$loveme_sidebar_position = $loveme_sidebar_position ? $loveme_sidebar_position : 'sidebar-right';

	if (isset($_GET['sidebar'])) {
	  $loveme_sidebar_position = $_GET['sidebar'];
	}
	
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
<div class="wpo-blog-single-section section-padding <?php echo esc_attr( $loveme_content_padding .' '. $loveme_sidebar_class ); ?>" style="<?php echo esc_attr( $loveme_custom_padding ); ?>">
	<div class="container content-area ">
		<div class="row">
			<div class="single-content-wrap <?php echo esc_attr( $layout_class ); ?>">
				<div class="wpo-blog-content">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							if ( post_password_required() ) {
									echo '<div class="password-form">'.get_the_password_form().'</div>';
								} else {
									get_template_part( 'theme-layouts/post/content', 'single' );
									$loveme_single_comment = !$loveme_single_comment ? comments_template() : '';

								}
						endwhile;
					else :
						get_template_part( 'theme-layouts/post/content', 'none' );
					endif; ?>
				</div><!-- Blog Div -->
				<?php
		    wp_reset_postdata(); ?>
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