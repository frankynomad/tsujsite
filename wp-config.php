<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tsuj');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '<#uA<?Gw!-^`M-eK3^]$-W`Cp:+!(Y&Hd?,vq.,3!dQ2u<^DnewxBe|:EA{fCKpV');
define('SECURE_AUTH_KEY',  'Jx{w<r+v[Wy/9ne;jK=];vI9#dZmdA~m0W[iHmwUT#E(x~|=?Fsn,G~gQeX}@<|4');
define('LOGGED_IN_KEY',    'qD|6dwY*rHf7Xm|vo8%RMEdkE@P`15t36Lt$klC]gc<=T?#DN.Jplkg^Vm5R9ej(');
define('NONCE_KEY',        '&|yh%Mr|hGGnU<+NcxOpxZ)|*2%^<i|Mz-^]?%c5`yG!W#*J(D#BK9J4|?wGqVVq');
define('AUTH_SALT',        'fb9+3++reVV-PAYI~-u^E}*K]Gt<ttP>%pwPWPA~_8*/<>tJy76w]/|m.CLdf`qx');
define('SECURE_AUTH_SALT', ' SzjH|75r%iVhVX<E`f%[VG3xj4c}aS+W`.2 +mSR}w;uyUA[ EJ?K;v4_q9|>g`');
define('LOGGED_IN_SALT',   'd=rDh-4eU:TBPp|UzjR(usq}~-rjLD}* teX<P-)(o+[|.i+r]V lK6&|eV=C%LN');
define('NONCE_SALT',       '#e<=sZ!&C^TPy3J1$)}|t(4ZL[nl`[>YS[}>eBdBBDx2hMG|PQhGE~ZURt_B{N7a');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
