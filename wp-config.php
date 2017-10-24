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
define('DB_NAME', 'wp_first');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         ')}, ,zVsxVNV)HN$U2${,H]riXA~X5{|!,7T0g7/,#4z6IXBhb>@TGqftN28@`](');
define('SECURE_AUTH_KEY',  'rzHB&4uWE2rSoWe3kyMU;t:62O!kkdRos/3yrann&6IV:Dq}5xVt(pK*vIPLnniy');
define('LOGGED_IN_KEY',    'L4h^I].;xFenFy2*w5:t5+g(7xgUE@ IKL[{]L*m/=DN]pV>K$ZV&-wkksu6cIUJ');
define('NONCE_KEY',        'lyMDxed~z!_M|@eJ!y?J6NN:MP($fv]j/qYri*+U>h?5YEqk+d<n_w@EDBXuV)w]');
define('AUTH_SALT',        '|2jR+[C57&Tx@29 _`.me]{.G`hDxSF5_]OhUoO[r,d.snpHH`~sFGbQD~BWLXBG');
define('SECURE_AUTH_SALT', 'nxTY@a~/3#)-Td7hqGateu<eT:w_F8*K#eZ_j?^e-,0vu4.QRZ7+D]S=`fQH?o<F');
define('LOGGED_IN_SALT',   'PDQ#;#cs[4-%Q6TV%D^~o}f)bJh/:92!uQ|lLR?OHs]A|5l6=_KI83J9?sW@+ gS');
define('NONCE_SALT',       '_iDVbJVAYByu9k{2~(VcJ0f{Sy=3,z=rDWuZccS)%tILpMCKtZ^;cNiP,5rQ]A2{');

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
