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
define('DB_NAME', 'danautoba');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '( 5HmAr=>2}#YtSW#FF`tcsx>VHrR1HF<O[dM*#rh.uQ8s{5jr9NnwK9_i!z8F7V');
define('SECURE_AUTH_KEY',  '>ms(%JVCX#])zKE,>oVq<zWV >0M;OO}=G.jAk&YQ^L!Q<^BZy1?-7n-s}$Bu3T?');
define('LOGGED_IN_KEY',    '_7E!L=0%fwGr%>9?(?YnHx&gTZlQ^#0+Lw[)>bb3/0cPlJ5+sBH9H~Vj>)|!ZlaN');
define('NONCE_KEY',        '+),(g|FoZR8:4 N,q@yx@7i`YYyD2Rc=*-C>@qOOxv<[GzU|lhz_H:2fq>X+D0|^');
define('AUTH_SALT',        '2+9vLE|!LHKpZbFD9UxB};u6qU s1=p#t`E7l OED@Eu9w.tV/O#Is6;Pl=L|}yH');
define('SECURE_AUTH_SALT', '.zs@nxHui3XYvcJ=S}D?x@DZ)aB&m5EZ|[QJEf!|g[gkMT]AMQdkmt25D(9uo! d');
define('LOGGED_IN_SALT',   '.+]fSp-*`v8>=?JtW11?2Vbe)k>t`%evJ:r~ZWaeFi18Ih8uihmcsOr1,HI](dap');
define('NONCE_SALT',       'Q:S{?lh9qTe~5ujyz~522aC4-dZ[Pm6j[us8++{wIQ?@.gg(FU_qQ`Eo[XxoKtE-');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'toba_';

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
