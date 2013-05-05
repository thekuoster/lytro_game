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
define('DB_NAME', 'ekuo8+lytro');

/** MySQL database username */
define('DB_USER', 'ekuo8');

/** MySQL database password */
define('DB_PASSWORD', 'zer80pul');

/** MySQL hostname */
define('DB_HOST', 'sql.mit.edu');

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
define('AUTH_KEY',         '(tJ]-S7&n%^r+<*)#Cqmu|V#,sCkR)D@-FW+}u3(b+d<9}@k#S?ws!Q15I,k?0}{');
define('SECURE_AUTH_KEY',  'hHTl1+CD:^>:kD+ruNK(@xbU(+3Una|gSiY~=h@>.#k@vmzir}^Y<I;ZPosGKM<i');
define('LOGGED_IN_KEY',    'Q#~YP;wDa-0DI<m1|xBg44&E/7`6kUlKTK+jI<a{2UW(X|h(CW#>q-P+i6bzd*mD');
define('NONCE_KEY',        'cCrh$HM+<,8_OTW*KbR57^ZH07dCxy5[-#rD*Ux~hD&-N=F@k, lpA}KD4d+3}|Z');
define('AUTH_SALT',        'V+x&R-GkM.4y56+wYxTB]#z~_ln|frA?|_4wNQM2ZPfY<(99xdk:?4/{AIs~b?1!');
define('SECURE_AUTH_SALT', '2UKK-K!,N09khZq6SHr8KOJ36PeCc#n?S=2*DP+++2FqyCOd9}/1t|qKJ7l5f,[-');
define('LOGGED_IN_SALT',   'Rw[&s*^oV^H@x]TxS|9]s<;`??YU?oqN D9Qf1gH/S;*.y-[ROa/^auo-[(<@-f3');
define('NONCE_SALT',       '/,UOGcyR/+Gh-r w$=/v/0DARsZccSt>V#E+6&a_=L~$tkBg2xbmRZQI_nt$/$B!');

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
