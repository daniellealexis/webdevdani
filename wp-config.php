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
define('AUTH_KEY',         '$Q0}8F4+w^*w1Am,]_Qtc0>(yl?0CC~[~pmGPS&ewTy7l7p+){SBR y^&qWMB_;E');
define('SECURE_AUTH_KEY',  '`hkG!%*dzHq.Wh^dT-$rs;65D;N@kh//+FXm2k=2SrC<-R>o|,|pSI/R44 A-M&(');
define('LOGGED_IN_KEY',    'I#(Vcvh>86 #/R:e//Otjzd};4w2-583ug%pY~!H|xHS%qG6abJ`5n2=/ubD-xUk');
define('NONCE_KEY',        'Idm,4_V!vbC&|d9>8*GkuB@YY>?,z%48u1pZlxtd~<CKTb-lXyEo0,IcF9p|P,/f');
define('AUTH_SALT',        '-pmZzu8PwgArLYud}+2ln]Ko` gH|o,#YTPl4$l+~<BJ4S<^sA- ZI1Ch_SL~Y4)');
define('SECURE_AUTH_SALT', '8Q:eADHbe&g#$MgaU<f~(+=PHuMp<RX1+Nhw#y&b|-,:%h_*Vg^i8gf70+Z7/K-0');
define('LOGGED_IN_SALT',   '|j+<vQP rk,i.~|,iWXII>R!+BiuskPJCoc#v;B&l$vV2XlhX9]lgH y4h8byR*m');
define('NONCE_SALT',       '{pe#O^q2mfk*|drV|8O|})y{i8F5r5jXg||]jM[U*fO7![-}|ueg7S8LkKxm}d<`');

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
