<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * ------------------------------------------------------------------------------------------------
 *
 * Codestar Framework
 * A Lightweight and easy-to-use WordPress Options Framework
 *
 * Plugin Name: Codestar Framework
 * Plugin URI: http://codestarframework.com/
 * Author: Codestar
 * Author URI: http://codestarlive.com/
 * Version: 1.0.2
 * Description: A Lightweight and easy-to-use WordPress Options Framework
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: cs-framework
 *
 * ------------------------------------------------------------------------------------------------
 *
 * Copyright 2015 Codestar <info@codestarlive.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * ------------------------------------------------------------------------------------------------
 *
 */

// ------------------------------------------------------------------------------------------------
require_once plugin_dir_path( __FILE__ ) .'/cs-framework-path.php';
// ------------------------------------------------------------------------------------------------

$uscore_uri = plugins_url( '', basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ ) );
$uscore_dir = plugin_dir_path( __FILE__ );
define('CS_OPTIONS_PATH', $uscore_dir.'fields');

if( ! function_exists( 'cs_framework_init' ) && ! class_exists( 'CSFramework' ) ) {
  function cs_framework_init() {
    global $uscore_dir, $uscore_uri;

    // active modules
    defined( 'CS_ACTIVE_FRAMEWORK' )   or  define( 'CS_ACTIVE_FRAMEWORK',   true  );
    defined( 'CS_ACTIVE_METABOX'   )   or  define( 'CS_ACTIVE_METABOX',     true  );
    defined( 'CS_ACTIVE_TAXONOMY'   )  or  define( 'CS_ACTIVE_TAXONOMY',    true  );
    defined( 'CS_ACTIVE_SHORTCODE' )   or  define( 'CS_ACTIVE_SHORTCODE',   true  );
    defined( 'CS_ACTIVE_CUSTOMIZE' )   or  define( 'CS_ACTIVE_CUSTOMIZE',   true  );
    defined( 'CS_ACTIVE_LIGHT_THEME' ) or  define( 'CS_ACTIVE_LIGHT_THEME', false );

    // helpers
    require_once $uscore_dir .'/functions/deprecated.php'   ;
    require_once $uscore_dir .'/functions/fallback.php'     ;
    require_once $uscore_dir .'/functions/helpers.php'      ;
    require_once $uscore_dir .'/functions/actions.php'      ;
    require_once $uscore_dir .'/functions/enqueue.php'      ;
    require_once $uscore_dir .'/functions/sanitize.php'     ;
    require_once $uscore_dir .'/functions/validate.php'     ;

    // classes
    require_once $uscore_dir .'/classes/abstract.class.php' ;
    require_once $uscore_dir .'/classes/options.class.php'  ;
    require_once $uscore_dir .'/classes/framework.class.php';
    require_once $uscore_dir .'/classes/metabox.class.php'  ;
    require_once $uscore_dir .'/classes/taxonomy.class.php' ;
    require_once $uscore_dir .'/classes/shortcode.class.php';
    require_once $uscore_dir .'/classes/customize.class.php';

    // configs
    require_once $uscore_dir .'/config/framework.config.php';
    require_once $uscore_dir .'/config/metabox.config.php'  ;
    require_once $uscore_dir .'/config/taxonomy.config.php' ;
    require_once $uscore_dir .'/config/shortcode.config.php';
    require_once $uscore_dir .'/config/customize.config.php';

  }
  add_action( 'init', 'cs_framework_init', 10 );
}
