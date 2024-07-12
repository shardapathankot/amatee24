<?php
/*
 * The template for displaying 404 pages (not found).
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
// Theme Options
$loveme_error_heading = cs_get_option('error_heading');
$loveme_error_subheading = cs_get_option('error_subheading');
$loveme_error_page_content = cs_get_option('error_page_content');
$loveme_error_btn_text = cs_get_option('error_btn_text');
$loveme_error_heading = ( $loveme_error_heading ) ? $loveme_error_heading : '404';
$loveme_error_subheading = ( $loveme_error_subheading ) ? $loveme_error_subheading : 'Oops! Page Not Found!';
$loveme_error_page_content = ( $loveme_error_page_content ) ? $loveme_error_page_content : 'We’re sorry but we can’t seem to find the page you requested. This might be because you have typed the web address incorrectly.';
$loveme_error_btn_text = ( $loveme_error_btn_text ) ? $loveme_error_btn_text : 'BACK TO HOME';
get_header(); ?>
<section class="error-404-section section-padding">
  <div class="container">
      <div class="row">
          <div class="col col-xs-12">
              <div class="content clearfix">
                  <div class="error">
                      <h2><?php echo esc_html( $loveme_error_heading ); ?></h2>
                  </div>
                  <div class="error-message">
                      <h3><?php echo esc_html( $loveme_error_subheading ); ?>!</h3>
                      <p><?php echo esc_html( $loveme_error_page_content ); ?></p>
                      <a href="<?php echo esc_url(home_url( '/' )); ?>" class="theme-btn-s4">
                        <?php echo esc_html( $loveme_error_btn_text ); ?>
                      </a>
                  </div>
              </div>
          </div>
      </div> <!-- end row -->
  </div> <!-- end container -->
</section>
<?php
get_footer();