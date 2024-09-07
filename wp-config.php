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

define('WP_HOME', 'http://localhost:8080');
define('WP_SITEURL', 'http://localhost:8080');

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
define( 'AUTH_KEY',          'Z;h#;1Eg*g:Bp&I2v[O~*Z}gD)tUTy*1x9:2+}jo??h*7)dX!IdYeXIvZVoPJfxJ' );
define( 'SECURE_AUTH_KEY',   '=hXqbeQwS,N)3tZ67->P7Ok2S&iIhCqI;|G~~kU;W|Z#eRP,?#[ ^ R 5ICCqO1a' );
define( 'LOGGED_IN_KEY',     '>c.dzA_t+b$RM[Fvq,T$0s8pHZb/i5ivH8zL!iIyL0>2#(u=[+ -9!Eg{zOv+?>P' );
define( 'NONCE_KEY',         'K&oSC7fs,u-mf(mgztX`1U2*$}i^Vo>lEYt1~!o|M;8be#}>mu+bYO[ WwJ_d*B1' );
define( 'AUTH_SALT',         '+eTU*7dA^Tlmx)Uh.NUKFi[B=h+:4#Fxk!1p_/g^, TF#Ck|ZX(7tmRa);Nq(+?1' );
define( 'SECURE_AUTH_SALT',  'It)$]/(1WdwZNNrpkAOL_MJcI;?Z#UsVy^{t9L%zAdk]%Q^{8J^yqM^o4E72;Nn,' );
define( 'LOGGED_IN_SALT',    '=ZwHLKYw<]/K${qdKc9fCrv5aB}L2h&boe7=6[OvoO97P:p@WoT7/|Q%tqFeS8< ' );
define( 'NONCE_SALT',        'mPrY7-x-m(odD%>gqD{n2p;M*7K*rGW+D:c=TZtP*+GaGP2OGwI*c]fE%YQ{[NmU' );
define( 'WP_CACHE_KEY_SALT', '<~) hsvj*SsQPbbONx|~IbM`yQmSSzAO(G9}7*3H7*m*5nkt #y*O#?yd,?rO%?n' );


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
