<?php
/*
Plugin Name: Loveme Core
Plugin URI: http://themeforest.net/user/wpoceans
Description: Plugin to contain shortcodes and custom post types of the loveme theme.
Author: wpoceans
Author URI: http://themeforest.net/user/wpoceans/portfolio
Version: 1.0.7
Text Domain: loveme-core
*/

if (!function_exists('loveme_block_direct_access')) {
  function loveme_block_direct_access()
  {
    if (!defined('ABSPATH')) {
      exit('Forbidden');
    }
  }
}

// Plugin URL
define('LOVEME_PLUGIN_URL', plugins_url('/', __FILE__));

// Plugin PATH
define('LOVEME_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('LOVEME_PLUGIN_ASTS', LOVEME_PLUGIN_URL . 'assets');
define('LOVEME_PLUGIN_IMGS', LOVEME_PLUGIN_ASTS . '/images');
define('LOVEME_PLUGIN_INC', LOVEME_PLUGIN_PATH . 'include');

// DIRECTORY SEPARATOR
define('DS', DIRECTORY_SEPARATOR);

// Loveme Elementor Shortcode Path
define('LOVEME_EM_SHORTCODE_BASE_PATH', LOVEME_PLUGIN_PATH . 'elementor/');
define('LOVEME_EM_SHORTCODE_PATH', LOVEME_EM_SHORTCODE_BASE_PATH . 'widgets/');

/**
 * Check if Codestar Framework is Active or Not!
 */
function loveme_framework_active()
{
  return (defined('CS_VERSION')) ? true : false;
}

/* LOVEME_THEME_NAME_PLUGIN */
define('LOVEME_THEME_NAME_PLUGIN', 'Loveme');

// Initial File
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('loveme-core/loveme-core.php')) {

  // Custom Post Type
  require_once(LOVEME_PLUGIN_INC . '/custom-post-type.php');

  if (is_plugin_active('kingcomposer/kingcomposer.php')) {

    define('LOVEME_KC_SHORTCODE_BASE_PATH', LOVEME_PLUGIN_PATH . 'kc/');
    define('LOVEME_KC_SHORTCODE_PATH', LOVEME_KC_SHORTCODE_BASE_PATH . 'shortcodes/');
    // Shortcodes
    require_once(LOVEME_KC_SHORTCODE_BASE_PATH . '/kc-setup.php');
    require_once(LOVEME_KC_SHORTCODE_BASE_PATH . '/library.php');
  }

  // Theme Custom Shortcode
  require_once(LOVEME_PLUGIN_INC . '/custom-shortcodes/theme-shortcodes.php');
  require_once(LOVEME_PLUGIN_INC . '/custom-shortcodes/custom-shortcodes.php');

  // Importer
  require_once(LOVEME_PLUGIN_INC . '/demo/importer.php');


  if (class_exists('WP_Widget') && is_plugin_active('codestar-framework/cs-framework.php')) {
    // Widgets

    require_once(LOVEME_PLUGIN_INC . '/widgets/nav-widget.php');
    require_once(LOVEME_PLUGIN_INC . '/widgets/recent-posts.php');
    require_once(LOVEME_PLUGIN_INC . '/widgets/footer-posts.php');
    require_once(LOVEME_PLUGIN_INC . '/widgets/text-widget.php');
    require_once(LOVEME_PLUGIN_INC . '/widgets/widget-extra-fields.php');

    // Elementor
    if (file_exists(LOVEME_EM_SHORTCODE_BASE_PATH . '/em-setup.php')) {
      require_once(LOVEME_EM_SHORTCODE_BASE_PATH . '/em-setup.php');
      require_once(LOVEME_EM_SHORTCODE_BASE_PATH . 'lib/fields/icons.php');
      require_once(LOVEME_EM_SHORTCODE_BASE_PATH . 'lib/icons-manager/icons-manager.php');
    }
  }

  add_action('wp_enqueue_scripts', 'loveme_plugin_enqueue_scripts');
  function loveme_plugin_enqueue_scripts()
  {
    wp_enqueue_script('plugin-scripts', LOVEME_PLUGIN_ASTS . '/plugin-scripts.js', array('jquery'), '', true);
  }
}

// Extra functions
require_once(LOVEME_PLUGIN_INC . '/theme-functions.php');
