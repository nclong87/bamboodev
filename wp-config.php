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
define('DB_NAME', 'noithat');

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
define('AUTH_KEY',         ';7 W_!H@a{Y:HjX t2@r)}n(N<wKT#AAYy[ !O2bbj}{;J]B:V9L4{7V`x4]*([P');
define('SECURE_AUTH_KEY',  'rW2jy,<L9GO]$.y^kZ/]vT0+W85a4ekA-?F_ReC!eWnlvtaXC94)6xW4=3p$;w)y');
define('LOGGED_IN_KEY',    '`|{3v#btkP?KAB,|.Naf?(gT?UlJQLJjQndhZvh~Cx,g[u`k$ok|0nKzHY`,Ysa%');
define('NONCE_KEY',        'cPzFE2/w<l%r2[iBY~c@Fg}xtR61FY`|,D|!,E8|zU=5+i0#P_DJ?Bh:67jM#~58');
define('AUTH_SALT',        'X>>>a@Yp2M3 g{S/>5N|Qcxh|+l(=eXw,vd$oG[27$A$I~l4H}_q;3z79BE^lsu:');
define('SECURE_AUTH_SALT', 'V]|@?jpQZrdO)4}E2V?xJ1c**xmWS4s=ePnZff*;t7s5ZF-?Q^&q3?~yc1v1uUc@');
define('LOGGED_IN_SALT',   'zbkV_[Hsi2=n{Vu4GQ$c#PoS]~Rz_V%J9mS&mYu9mbeL32GwRJ DWW$l[NScO1-G');
define('NONCE_SALT',       'C_1!m.MG_I)?vAu#3qwP0cLvdq_G2#I_qjO-fJi#;$WC8Xkv0Ff~L8?by)$OT,+f');

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
