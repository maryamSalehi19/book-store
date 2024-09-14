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
define('DB_NAME', 'bookStore');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123');

/** MySQL hostname */
define('DB_HOST', 'db');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'iezp/ZKUkwcG]YpA)LLP:wu:Vu]uE{{7M8P0k-E+{PBs(.4-Ng-$,J}<ZT(cnY-,');
define('SECURE_AUTH_KEY',  ':&@!lMWkBwWx?I6VGAk$G@))R+pwl{(O|lg;X>3)?&-z;{qwBiP(0pnO3?)CD8Em');
define('LOGGED_IN_KEY',    '62PV +Q3aYk{91j~1JO/K2@+&/G;-3|^_dF(4o52B~oqY<V>NIR7Y[II.]*Pg_``');
define('NONCE_KEY',        ',e0(Qt]u)xqUj|xTX!8+P?U!N+,NBT=/jlT`/Cgv6,><.4FtHCg`?uHhP5jgFfBr');
define('AUTH_SALT',        'U=?iv5fCgPlE8?a/PQ`7:7)w s^*/0!o;!;2sCH<},7k4nqtpEyl_crOK]_,*A!E');
define('SECURE_AUTH_SALT', 'H lP6%x=}Bum)cI +v=}6{|NX7+;ES?b|)6_&Q0FL=pw1 *A,-I=AK@s<.NXI8ou');
define('LOGGED_IN_SALT',   ':Ci>$}-v$9p14(Hu$Y+O888S!TE|q8WEi:{J{8Y7}h6EsOo^{|VO;?-`ez:C!?8k');
define('NONCE_SALT',       '*]Vmc|Fl|l7<86p[!d|(c|vt&:,A|)m=<{JJZ^6V )l4eLaL$Ss|)6{p:{o-j_#}');
define('WP_SITEURL','http://' . $_SERVER['HTTP_HOST']);
define('WP_HOME','http://' . $_SERVER['HTTP_HOST']);

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ps_';

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
define('WP_POST_REVISIONS', false);
define('DISALLOW_FILE_EDIT', true);
define( 'WP_MEMORY_LIMIT', '256M' );
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD','direct');
