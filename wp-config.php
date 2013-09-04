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
define('DB_NAME', 'thuongmaidientu24h');

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
define('AUTH_KEY',         'nhvU?4G-5G!%]%9pNH>-5C-jA?zflB>>4x[hqp{YSYuD:pNTjCOcW}y+@#K[LnqL');
define('SECURE_AUTH_KEY',  'slfdwdnQC[/h1U:z95{Q^F7XAHNTUzM[U8-yM^4pF$gX@H^q&icX (ww=~DS%Dll');
define('LOGGED_IN_KEY',    'o6O{-}q1EsPW(-s6vS~<azzvN`^5C12=>gI`85?~>_j8{Tp~w=X6_Lb~<!En[^{c');
define('NONCE_KEY',        ':jssUiAIsk,l,@8h$c?{k(}FJPWY&wGGTP(D m%6qS>xMU7AW1!ttau2vN1(<V1t');
define('AUTH_SALT',        'C<$@MB{BA8u%5-f(l;qQTozuAf-[Jfp+8 AiZK=B0Xjm^[t1&E4R.o`UB*Teq-PJ');
define('SECURE_AUTH_SALT', '-E2t,0$Q9 DQ(<j3%c %dPrWu@`X*4)huTaxO(>)lii7UBT<J;#thY~b%5qp7kbe');
define('LOGGED_IN_SALT',   '{2JEGr1q}TpV~hzuBImaHQYAyI;s`IW,gvSF`tJrJ$O`Z O6q7oC!,0m}6cA;dE0');
define('NONCE_SALT',       '1O`2K75A;W.@B3lDGSn`!F5nIfi77vEh:jvmKeE?!s7eMJf*#1_/=S]/s5S7&>tk');

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
