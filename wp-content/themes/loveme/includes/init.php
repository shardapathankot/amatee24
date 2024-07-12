<?php
/*
 * All Loveme Theme Related Functions Files are Linked here
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/* Theme All Loveme Setup */
require_once( LOVEME_FRAMEWORK . '/theme-support.php' );
require_once( LOVEME_FRAMEWORK . '/backend-functions.php' );
require_once( LOVEME_FRAMEWORK . '/frontend-functions.php' );
require_once( LOVEME_FRAMEWORK . '/enqueue-files.php' );
require_once( LOVEME_CS_FRAMEWORK . '/custom-style.php' );
require_once( LOVEME_CS_FRAMEWORK . '/config.php' );

/* Install Plugins */
require_once( LOVEME_FRAMEWORK . '/theme-options/plugins/activation.php' );

/* Breadcrumbs */
require_once( LOVEME_FRAMEWORK . '/theme-options/plugins/breadcrumb-trail.php' );

/* Aqua Resizer */
require_once( LOVEME_FRAMEWORK . '/theme-options/plugins/aq_resizer.php' );

/* Bootstrap Menu Walker */
require_once( LOVEME_FRAMEWORK . '/core/wp_bootstrap_navwalker.php' );

/* Sidebars */
require_once( LOVEME_FRAMEWORK . '/core/sidebars.php' );

if ( class_exists( 'WooCommerce' ) ) :
	require_once( LOVEME_FRAMEWORK . '/woocommerce-extend.php' );
endif;