<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */
define( 'DB_NAME', 'zero' );

/** MySQL database username */
define( 'DB_USER', 'mysql' );

/** MySQL database password */
define( 'DB_PASSWORD', 'mysql' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

define('WP_HOME','http://zero-project');
define('WP_SITEURL','http://zero-project');


/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/* for linux */
define( 'FS_METHOD','direct' );


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'mW7Y1&_M{?@(2(.G7@>J0;,UMwvqz#WA(zr]|U:m(AufT&`C&,PBw._9!| XoSm+');
define('SECURE_AUTH_KEY',  'qX2,cNV:Bg`-]Y*if& [P8$2HLI}|%qY*a{Ah&n8+-Rg1/>SK~9}5)$j)eNqE6o9');
define('LOGGED_IN_KEY',    '>p2G51#2?f5 p52zz_ml%+ET=3i]9BSH/e jNl|-Lf}U9 *DSd:E|l`^KO7+r(4s');
define('NONCE_KEY',        '4U(P48yg @_K*F!csKq;b{yN*l&PVC]&h9a!^w`<u/H>++4w?{O$-6/Xrxfp=%-!');
define('AUTH_SALT',        'UI_8KNT[?|V4_peL+DsFKbR~zMuo}T [2!e5/&:1f;n/9783+&>ppV mUD4=gd!R');
define('SECURE_AUTH_SALT', '6a)hFDt)+OXoS]45A? *x7@ogT*-3oE+r$vYS+X+`=uBKi[ia2ZC8rKdXR_n~f4J');
define('LOGGED_IN_SALT',   '.JrLd|y!}2n$S&;}pi+0XV%AV};n633W2LqfwnR_&}z!~7SR48{|A{!~!pr ;2JG');
define('NONCE_SALT',       '1|VPQ[D~3tt-MxD$()+|ZqNa4V{9l@-F&(p;oo|`ySprH^7i&Br;B[tFheU/5.?<');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
