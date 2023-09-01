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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'database_name_here' );

/** Database username */
define( 'DB_USER', 'username_here' );

/** Database password */
define( 'DB_PASSWORD', 'password_here' );

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
define( 'AUTH_KEY',         'B$Rk}J*@S}}l&fzanW=$-bl@[]8ZC:Q+9(2 E!rk9(Z7YP|k49qb]wUEp93Qz?kR' );
define( 'SECURE_AUTH_KEY',  '$+2`*n98o%dGFq:C&$eACYQ$;fYg@fFD)3+gn_ E|d)gK.cy*|5*lzx1cJh/:(Ga' );
define( 'LOGGED_IN_KEY',    'G|j9_xcw|Tg7$rZ-DnLe]Q(=`>P8TZ6&9]<F|0! w~j:14n>}SPZrtYq=I1@Q<Rg' );
define( 'NONCE_KEY',        ';%TD1h&?X?1b`UO:9LVvt?a1eB^_&a8& ?(u~j+?nk%OA/f`9xOb:+{[lP(wFE2$' );
define( 'AUTH_SALT',        'h7|2r>42]@SMF)WRdL0!KMTe*fc+C$W,]fDj7kKgO#/RMoYqZXBz]{.Z*@j&d6!p' );
define( 'SECURE_AUTH_SALT', 'KKO&9SQ)(A -+ZHTx6^ k|~iV.tT3+taC<tV $!ebwd$0S7>-34B5P,;fVWM=,ng' );
define( 'LOGGED_IN_SALT',   '|R+%}#Mqd98,SD{Mzu$|cWqy {WXmEP PB3V,gF5`;L$jB@^+E=wJp_<+SV>Ta&Z' );
define( 'NONCE_SALT',       '|a}o#KxzTT/9XqFvY5x|Ix>D&eTaviSx,<_?1hG!/&G[@jD{O!uAmqn7TcW)AUXN' );

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

define('FS_METHOD', 'direct');
