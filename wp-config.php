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
define( 'DB_NAME', 'wp' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define('DB_HOST', 'localhost');

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
define( 'AUTH_KEY',          '~4Z~qDfjF{B[6Gc-%ky^mkTm{g7fsWHCkJjci9dPZaI|5|5[@da|Z<lI^l<7W*y6' );
define( 'SECURE_AUTH_KEY',   'qaIBcp:E,0yS!x?S%U*hz.~nzmvTns:4/RoiME8OjrM)6epf6i+SlOCK9H9EIf^j' );
define( 'LOGGED_IN_KEY',     '$LSXdf-lQla)p5:Rxw1$&#X#(}SMZ,g^<=B8d-?bSG3*F4`8;s?/~Le`<_ZTZB38' );
define( 'NONCE_KEY',         'V/SM/!uV-Tl5w4N8c0DAV24mD10O2.: /d:-~zMc9mq%]Mddgkd]aCiK,0MuULVj' );
define( 'AUTH_SALT',         'Rn1<Nb;t%Rt+~cJo);QmDw4e!~[yV:O& N^nn;1)X@KaSZ5xd[w*^ PJ[mGa<Q8?' );
define( 'SECURE_AUTH_SALT',  'Cx=w%{{x$:Eqj<v(T4<>YGd82~$i|p&r[1!^wNgh0`NQHa-`.t(s}@H_zVsHySIf' );
define( 'LOGGED_IN_SALT',    'R%y/5R%h4a*}}HX:><ls:G_B}AWGU0D0gt]Z_vE)59N._&-ymoyi*}&?q57J7`c=' );
define( 'NONCE_SALT',        'Ja8#]_}:UT(6Mb:~?`4W}p!p$q.zyKh)xXVLmBX/JZ{Ig{}=5e/H{`jiY^M@`5.`' );
define( 'WP_CACHE_KEY_SALT', 'MVD>_D1@.*vT)QU(#-s|bqm6JX,?DD;{+M4yQ% E;i?IWsU3E9>oiFo0aL[Tm(ac' );


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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_REDIS_HOST', '10.44.10.10' );
define( 'WP_REDIS_PREFIX', 'TENWEBLXC-867774-object-cache-' );
define( 'WP_REDIS_PASSWORD', ["redis_user_867774","FichXHeTKYbx1fda28crAfzjnZPiUcPN4p"] );
define( 'WP_REDIS_MAXTTL', '360' );
define( 'WP_REDIS_IGNORED_GROUPS', ["comment","counts","plugins","wc_session_id"] );
define( 'WP_REDIS_GLOBAL_GROUPS', ["users","userlogins","useremail","userslugs","usermeta","user_meta","site-transient","site-options","site-lookup","site-details","blog-lookup","blog-details","blog-id-cache","rss","global-posts","global-cache-test"] );
define( 'WP_REDIS_TIMEOUT', '5' );
define( 'WP_REDIS_READ_TIMEOUT', '5' );
define( 'TENWEB_OBJECT_CACHE', '1' );
define( 'TENWEB_CACHE', '1' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
