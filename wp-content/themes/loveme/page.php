<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
$loveme_id    = ( isset( $post ) ) ? $post->ID : 0;
$loveme_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $loveme_id;
$loveme_meta  = get_post_meta( $loveme_id, 'page_type_metabox', true );
if ( $loveme_meta ) {
	$loveme_content_padding = $loveme_meta['content_spacings'];
} else { $loveme_content_padding = 'section-padding'; }
// Top and Bottom Padding
if ( $loveme_content_padding && $loveme_content_padding !== 'padding-default' ) {
	$loveme_content_top_spacings = isset( $loveme_meta['content_top_spacings'] ) ? $loveme_meta['content_top_spacings'] : '';
	$loveme_content_bottom_spacings = isset( $loveme_meta['content_bottom_spacings'] ) ? $loveme_meta['content_bottom_spacings'] : '';
	if ( $loveme_content_padding === 'padding-custom' ) {
		$loveme_content_top_spacings = $loveme_content_top_spacings ? 'padding-top:'. loveme_check_px( $loveme_content_top_spacings ) .';' : '';
		$loveme_content_bottom_spacings = $loveme_content_bottom_spacings ? 'padding-bottom:'. loveme_check_px($loveme_content_bottom_spacings) .';' : '';
		$loveme_custom_padding = $loveme_content_top_spacings . $loveme_content_bottom_spacings;
	} else {
		$loveme_custom_padding = '';
	}
	$padding_class = '';
} else {
	$loveme_custom_padding = '';
	$padding_class = '';
}

// Page Layout
$page_layout_options = get_post_meta( get_the_ID(), 'page_layout_options', true );
if ( $page_layout_options ) {
	$loveme_page_layout = $page_layout_options['page_layout'];
	$page_sidebar_widget = $page_layout_options['page_sidebar_widget'];
} else {
	$loveme_page_layout = 'right-sidebar';
	$page_sidebar_widget = '';
}
$page_sidebar_widget = $page_sidebar_widget ? $page_sidebar_widget : 'sidebar-1';
if ( $loveme_page_layout === 'extra-width' ) {
	$loveme_page_column = 'extra-width';
	$loveme_page_container = 'container-fluid';
} elseif ( $loveme_page_layout === 'full-width' ) {
	$loveme_page_column = 'col-md-12';
	$loveme_page_container = 'container ';
} elseif( ( $loveme_page_layout === 'left-sidebar' || $loveme_page_layout === 'right-sidebar' ) && is_active_sidebar( $page_sidebar_widget ) ) {
	if( $loveme_page_layout === 'left-sidebar' ){
		$loveme_page_column = 'col-md-8 order-12';
	} else {
		$loveme_page_column = 'col-md-8';
	}
	$loveme_page_container = 'container ';
} else {
	$loveme_page_column = 'col-md-12';
	$loveme_page_container = 'container ';
}
$loveme_theme_page_comments = cs_get_option( 'theme_page_comments' );
get_header();
?>
<div class="page-wrap <?php echo esc_attr( $padding_class.''.$loveme_content_padding ); ?>">
	<div class="<?php echo esc_attr( $loveme_page_container.''.$loveme_page_layout ); ?>" style="<?php echo esc_attr( $loveme_custom_padding ); ?>">
		<div class="row">
			<div class="<?php echo esc_attr( $loveme_page_column ); ?>">
				<div class="page-wraper clearfix">
				<?php
				while ( have_posts() ) : the_post();
					the_content();
					if ( !$loveme_theme_page_comments && ( comments_open() || get_comments_number() ) ) :
						comments_template();
					endif;
				endwhile; // End of the loop.
				?>
				</div>
				<div class="page-link-wrap">
					<?php loveme_wp_link_pages(); ?>
				</div>
			</div>
			<?php
			// Sidebar
			if( ($loveme_page_layout === 'left-sidebar' || $loveme_page_layout === 'right-sidebar') && is_active_sidebar( $page_sidebar_widget )  ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php
get_footer();