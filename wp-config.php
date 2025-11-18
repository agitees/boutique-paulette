<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wppault' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'W mkT~*xD Pj=!TSFvf9oa#Oi>r[(q2/$t_?UgC2``<lkENpK/-CD5l-gs2pUf!%' );
define( 'SECURE_AUTH_KEY',  '&lgslVF4}MJWwMWS} *ySNpio Y9?){Uz:e,*I86lLt#*#Oq,<o)B%)p38z-Sdt6' );
define( 'LOGGED_IN_KEY',    'EWERxe.Hs<ut+eAgL~~c{M?q6NxsGlthRz$0j&%},XMX,_Y2}As qpj-hB1@=du ' );
define( 'NONCE_KEY',        'RY3$7gKfc_*L[j`8N^&6;^C^ZZA2B]Ivx`FLajuw^B#^j|*u3/@DKhbv}0Y!psv8' );
define( 'AUTH_SALT',        '6v^.AsXN3e%,>6[:>[3,-b07XoR$}.~/pZsZ,#_:{rhak_k9-Yo{/bv(e,y^62Fq' );
define( 'SECURE_AUTH_SALT', 'n?T!Pgs;3.mxyOrs/y|PpCS,khT0CVyb,GmDCK[p/w{z[7PjsBEL_&8?:U]lz0,W' );
define( 'LOGGED_IN_SALT',   '$vQoS-tkSofgw%ME3is8%oVNN!0y(M:gx@4a{:2[zdP3J*xj&?!g1Mu<N#h:k(4[' );
define( 'NONCE_SALT',       'F:ppH7&_=0TdD?W%ilu~UPn^q*~CS%+R6CAxw];gygWp1U9~G>#mP.cz(o}dZ-3|' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'pau50_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
