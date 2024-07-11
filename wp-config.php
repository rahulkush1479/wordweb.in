<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordwebdata' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '226X(;e}&=Fo,SL.lyZCUT|v6A1Yq/:c))igupg_mQP=] !V=Q%}6 lt5-9WoRza' );
define( 'SECURE_AUTH_KEY',  '&5X!M<Fw6+?Mmz#,f3vnJ9B>H4*zGYaTK:7X|O@Dvqn_vU]A/lk-{%9Gg>ufB%<v' );
define( 'LOGGED_IN_KEY',    'dAB4xRZ/1b)m`{B`m=yt1a63w;)dM_7W?e8O.H/dVSxP,Baz_!i>A6j=G8@EhB)3' );
define( 'NONCE_KEY',        '=tjwT]=e@2*z4atV0RUKg8RP0#kiCJ)bdyP{[V*qQu}oo$zCmVXx&dKp.+`Lt<)J' );
define( 'AUTH_SALT',        '@Ko5(9(|^`JrWd>JeNeL8ERhwnD==^8JiugdT|FYZjzuL6ZK#z3=1*V/ijoiCV>u' );
define( 'SECURE_AUTH_SALT', 'rLmUmnifdq(_yOHUV82iT5)!F%gM{R;29K.,`~zZ2v]PrkEuBT05I[cNbjCsIURz' );
define( 'LOGGED_IN_SALT',   'l.h98HlPs{See6eKT0nb6NXt{c,es*/g+:<Xm2-K+ [cBSskua.HJa000gcRd-gT' );
define( 'NONCE_SALT',       'te9al 7_!mIhWF!dyg,1E8W+(EI}xP[7g_cGyxj!mk.1RG4g]Bwf7vvs|ju~/Jdn' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
