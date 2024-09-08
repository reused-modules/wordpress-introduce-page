<?php
define( 'WP_CACHE', false ); // By Speed Optimizer by SiteGround

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
define( 'DB_NAME', getenv( 'DB_NAME' ) );

/** Database username */
define( 'DB_USER', getenv( 'DB_USER' ) );

/** Database password */
define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) );

/** Database hostname */
define( 'DB_HOST', getenv( 'DB_HOST' ) );

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
define( 'AUTH_KEY',          '@2OW3B5t|9hgC.$2C>0]b5/=ijL{Ke0E?|:NKyGVqNj[d<4upHfAY36v^7?+_9*B' );
define( 'SECURE_AUTH_KEY',   ':cES`=lBE{r7A5+RX7CVyF[Y;=G#Q0b$pb:W$gufHIL`_6a!K9/~OK.G%It:ro3B' );
define( 'LOGGED_IN_KEY',     '!!20UgxX:B`H!% K`HUz`DnPA]i>|+2YmkBvkf=)@4tm$t+u9x8A:+<E)axzA+Vx' );
define( 'NONCE_KEY',         'i}E)C~~9+BPXBOY,jv>Q6Rz,m>V=;Vp(3SzX!v+mzFZ4f&QQ?=ElRHi@.#U!gqNX' );
define( 'AUTH_SALT',         'w4O4E)2YEtyuB@rU0zl2qqdKcf1V;5!`[8n;VA>r.}@t#p+X!3;<e^1fo);{%llA' );
define( 'SECURE_AUTH_SALT',  'Ul@e^e@E?x[~S*Bm@Y?F&$HRT(n{[h1,fMm%>FA#51W^U]g~XMqcNw:JAkA!-XG1' );
define( 'LOGGED_IN_SALT',    ':n. G(34MX@b)MTarB*}qHc^s[%fb*I)C|hJoHKJ2PF!3~&qik_k>GHUb)o0rWyh' );
define( 'NONCE_SALT',        'B>W,_~b Z@O`ff#x9k]d]#5)gu-cLfIt#+}O;~R]crx[v%5UZ8Bi[((q}{ZP:yjC' );
define( 'WP_CACHE_KEY_SALT', 'XL.f%q2ju/`0#X.LzvxT}-qcWH%u]@@=^xwM(2Obe57~L]>|+>oA_i/TS8` fIg4' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'csl_';


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
	define('WP_DEBUG', true);
	define('WP_DEBUG_LOG', true);
	define('WP_DEBUG_DISPLAY', true); 
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
@include_once('/var/lib/sec/wp-settings-pre.php'); // Added by SiteGround WordPress management system
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
