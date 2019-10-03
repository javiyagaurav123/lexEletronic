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
define( 'DB_NAME', 'lex_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Q4~sb@|w|ge8d3lJ5{W:)p=hFG=30,snr881q[u9PW0My6lb]{?)sj|>Re`R/*09' );
define( 'SECURE_AUTH_KEY',  'QYt;s3ddxV#4c!ir$t2/#=CX8ou@x6YrN*Dyo#uz/cFd;M8`$01Z.pixbC+kt>nm' );
define( 'LOGGED_IN_KEY',    'p?_ILs}zKsXBI;qiQp)j`V;/CkHILN194PQdmwcFSV;nNZ#vVWQ#Pm?Rz!YFY1VA' );
define( 'NONCE_KEY',        '+,IcBf3a4&[xQ3N%W{z`3VmNg]^s&3(XI*B+,*]#l%V1i5,S:_HVAmCIBIhR%=,b' );
define( 'AUTH_SALT',        'RG1+Px|%:[7r~G^r0P?cC1dcT_#KfI<?hz W$un`*35/~I$m;m4y.PHs4laIhf/0' );
define( 'SECURE_AUTH_SALT', 'yS.n=CY-c[*(r]M0W6sh!7}RCP1$d!au/EO2YF9JGiVJ?dy@o-iy6aw B2g?LwWP' );
define( 'LOGGED_IN_SALT',   ':kHgb [S(ioWGPaCQWFI:LHIu,3T:UuVpwjLtA|Ky~!c,g7,L*PsP.a*HCbyn$CL' );
define( 'NONCE_SALT',       ';B5?)`H ^xe3*JV@nHEonP@@X0.=)W{iq.#.<aVywFoQ*oTEl(<iFTI$8tK`@`}}' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
