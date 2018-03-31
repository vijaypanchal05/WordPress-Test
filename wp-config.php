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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         '9nCyZS2F9yr[yq:MU# zJH 2TSj)|x ;D|_S)^Se>X2(|RYP;bhWg4tA#,Jn_B;@');
define('SECURE_AUTH_KEY',  'r@ioWm$j%u(V_zT-Cmrp6dngx2LI3`&vACT9 jq]n&*25>^H3fcT{(O+d 6|fkb$');
define('LOGGED_IN_KEY',    'tWY/hQT<95+tQH@CTj+(1a$u>,)-p_43(6=s(J#^]s #@8@)x<PLrVQA]Crb@23W');
define('NONCE_KEY',        'Uzt^npC]z)9BSAhI{Lw0eSecD =_<50CWN9nPV~qSEl6c|A^j_8nE$R4s%9V%<C<');
define('AUTH_SALT',        'CZ}W!`dX*5h#:<Osr`$jEL4tenZ wTKO3X+CcV9611p-20s/7Y{I.|m`<ZCn8L)*');
define('SECURE_AUTH_SALT', 'V!$+i6?8~mEUm1=Dn-ZPOjh0r_99E5 K:Ws~r@k1C>PC:!c!;1uX}+ab1@s.`SK]');
define('LOGGED_IN_SALT',   ';IQT_V$[4n#o~o[z8`R=b@4-x7WA1<@@< iRRjXZk+XE%zV| {reGqUvA!de4p1p');
define('NONCE_SALT',       'aJZ~P6P@FSVU$M:)iB!=(-l{S@*y<sEnQkh syD5@i]!2fQ{SF }BPH;3pwcJJcg');

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
define('WP_DEBUG', true);





/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
