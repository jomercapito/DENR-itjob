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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'DENR-website-db' );

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
define( 'AUTH_KEY',         'RAlpth3|K~-k2Q,.v6@9* A_au`!mSW@||)xS<5O*TThK;i([O3U@qp[FA{6*P<}' );
define( 'SECURE_AUTH_KEY',  'Jj4O5pDmtheX]H3%<OSipD3Y/|XRxNi6_o&@3li]<F#n@kos~iwg>;AtGUK9^=]-' );
define( 'LOGGED_IN_KEY',    '%t53,!&|UQoM+9GmGokah*3A87LJSn1!KttJj}4/evtZoL=%n3S2;IQB#K9Md~Ta' );
define( 'NONCE_KEY',        'f!vFXGl,ZGp:DWz&zoCwe{Q;lwS=QoVyfymG@SzM#m=Xzg1 $c9%?Lw|KROBH+7)' );
define( 'AUTH_SALT',        '&zhU>;I> p:C{$7M)N;p=w6T.E|)zS*UfD8$:G[)853SKKf6D+g{B}~!h*B#BnTR' );
define( 'SECURE_AUTH_SALT', '=.Xld-:2F umCUy i hJ`nUQSFw}A_j3sIA(!ELJWn?rubG* .rWJT8C[HMAk<}l' );
define( 'LOGGED_IN_SALT',   'xH/2D^@}RtiQyJe%z}7Hu5U9,w:2SE fs)@_}?j#&.whY6Py,)>7G84uV`b]6ut<' );
define( 'NONCE_SALT',       ',vs)Y],p3$3Ek#Yx3/J~vc]-]$.RYPo>Ba~Ki^i|na)[1@>(Zz,g1zG{xbVbvQ`t' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
