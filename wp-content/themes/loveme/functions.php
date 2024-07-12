<?php
/*
 * Loveme Theme's Functions
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Define - Folder Paths
 */

define( 'LOVEME_THEMEROOT_URI', get_template_directory_uri() );
define( 'LOVEME_CSS', LOVEME_THEMEROOT_URI . '/assets/css' );
define( 'LOVEME_IMAGES', LOVEME_THEMEROOT_URI . '/assets/images' );
define( 'LOVEME_SCRIPTS', LOVEME_THEMEROOT_URI . '/assets/js' );
define( 'LOVEME_FRAMEWORK', get_template_directory() . '/includes' );
define( 'LOVEME_LAYOUT', get_template_directory() . '/theme-layouts' );
define( 'LOVEME_CS_IMAGES', LOVEME_THEMEROOT_URI . '/includes/theme-options/framework-extend/images' );
define( 'LOVEME_CS_FRAMEWORK', get_template_directory() . '/includes/theme-options/framework-extend' ); // Called in Icons field *.json
define( 'LOVEME_ADMIN_PATH', get_template_directory() . '/includes/theme-options/cs-framework' ); // Called in Icons field *.json

/**
 * Define - Global Theme Info's
 */
if (is_child_theme()) { // If Child Theme Active
	$loveme_theme_child = wp_get_theme();
	$loveme_get_parent = $loveme_theme_child->Template;
	$loveme_theme = wp_get_theme($loveme_get_parent);
} else { // Parent Theme Active
	$loveme_theme = wp_get_theme();
}
define('LOVEME_NAME', $loveme_theme->get( 'Name' ));
define('LOVEME_VERSION', $loveme_theme->get( 'Version' ));
define('LOVEME_BRAND_URL', $loveme_theme->get( 'AuthorURI' ));
define('LOVEME_BRAND_NAME', $loveme_theme->get( 'Author' ));

/**
 * All Main Files Include
 */
require_once( LOVEME_FRAMEWORK . '/init.php' );


// Function to add custom menu item for 'gateman' role and main admin
function add_qr_scan_menu_item() {
    // Check if the user is logged in and has the 'gateman' role, or is the main admin
    if ( is_user_logged_in() && ( current_user_can( 'gateman' ) || current_user_can( 'administrator' ) ) ) {
        
        add_menu_page(
            'QR Scan',    // Menu name
            'Guest Scanner',    // Page title
            'read',       // Capability required to access the page
            'https://amatee24.com/qr-scan-page/', // URL to redirect to
            '',           // Callback function (not needed in this case)
            '',           // Icon URL (not needed in this case)
            5             // Position of the menu item in the admin menu
        );
        
        add_submenu_page(
            'https://amatee24.com/qr-scan-page/', // Parent menu slug
            'Download QR Code', // Page title
            'Photo Upload QR Code', // Menu title
            'read',       // Capability required to access the page
            'https://amatee24.com/wp-content/uploads/2024/04/upload-media-qr.png', // URL to redirect to
            '',           // Callback function (not needed in this case)
            1             // Position of the submenu item
        );
    }
}
// Hook the function to the admin_menu action
add_action( 'admin_menu', 'add_qr_scan_menu_item' );



