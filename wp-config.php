<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bamboode_ludevine');

/** MySQL database username */
define('DB_USER', 'bamboode_db');

/** MySQL database password */
define('DB_PASSWORD', 'o-IKkT?P}hPs1');

/** MySQL hostname */
define('DB_HOST', 'bamboodev.us');

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
define('AUTH_KEY',         'mKd6XS74,NNU-a)P#ag1CmQ/vhCA=xNG&T uuuYWRP 6^+o<ny`|4B w[S1CuzY8');
define('SECURE_AUTH_KEY',  'f=hd=::PuOsM7{83[?C{8D9QeA|T0M?91lW=]8siBBw?__Yy{}0#GL@k!m2{s|Kj');
define('LOGGED_IN_KEY',    '_R.CD9x/FuwZ<@3KaD^)H1?1W~ou%#7LW[NyJY0J62cO-hzt9rA&gOy*HYf:nYU%');
define('NONCE_KEY',        'EyiX#>N{7{989NAZT6uRJ^jclgufWe;9v#N}0H>g=_O6vpXD&+Zb*d_.QlaIoYdX');
define('AUTH_SALT',        '<MU_ZG<[7TQ]rq=B%&X*?a6lj l:7A]h<$V^`=^P%()ET3q_+Eam_+)o&v1F!oN(');
define('SECURE_AUTH_SALT', 'iiL>X_7hO7-`^F4=H?PLMi=8S}-ITuZqe{XG>HC(P^6tr4Ixl^.CwQA:)v9+|J)k');
define('LOGGED_IN_SALT',   'Yc#D4pQ(h-j;T1oo;tr8(wdrRGc]S;4EmG(G}^>xaQ25d  =OABdK.cNbro`VbVJ');
define('NONCE_SALT',       'oaOa{yj0il_^l$>_(71PreDV.0*q_p$~:,h?sY^z]q6H29U2[.W,MOL&NyCHvLn3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
