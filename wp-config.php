<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '-%+=MYUL0xHgr9)^sF#WClu[[IkFUwAb81{(!L$c/qb^b^Y&CkP&?2b.Ue7!.]8x' );
define( 'SECURE_AUTH_KEY',   'NygO0}**m?AocOJqj$> 0X?mrYuR%G1]^{nyG1hw,NSJ|RVF0:T93 |KYom&+t>d' );
define( 'LOGGED_IN_KEY',     'uQ~?JBz[q9AYCK%sCdcKike?f.9&sa~Tbh/AVIxZz,d.2ybGm31>8QwlJz$zWrBW' );
define( 'NONCE_KEY',         'w-EQ9)>iv!k]WLzZDlOyU&-pgG+UxWJx[.Y/s`}[P}&jmY2&6bqe sEe1+77A]Tm' );
define( 'AUTH_SALT',         'I:<#[DRM;4BHZZ$(F<hSLjfI8Wy-} 3}>3.=x8l)HnoQeuauwSLZJ8Q:&UYUo[!y' );
define( 'SECURE_AUTH_SALT',  'Mr_3QF9}Z5Tp!eX;<Bd{b!i{KfPbWe@w7G:*kMXz5wPvkL{l!F=?dNkX@b;q/![{' );
define( 'LOGGED_IN_SALT',    'bf&A/J^Wzn&6FT@L?<02P.!a)$(YST6qca@,| b=h7U*Xt?v$xvA}l-qC#lNDTHN' );
define( 'NONCE_SALT',        'yN-[E;Iu(,49Wwk9EWVF*&MA2F&GD 56i!/4_:ogp+C +^n+y2DFj,h6 FeLu%Yh' );
define( 'WP_CACHE_KEY_SALT', 'RZk]$r`csL}@h,k~o;:&`Ml[MDCg7c{Kx,a1E1O2[mm9+46)?`m%mdiEkbr-3g:`' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
