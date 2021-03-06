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
define('DB_NAME', 'i2434995_wp8');

/** MySQL database username */
define('DB_USER', 'i2434995_wp8');

/** MySQL database password */
define('DB_PASSWORD', 'P#OCYek9e7G2fyk(^s#67^^0');

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
define('AUTH_KEY',         'Sl4p0ZujdJp1D7lgsg4kAYJ3QRtLFkkL6DQMF31oyNv7s8q9HlTNHr3axnyGYLW4');
define('SECURE_AUTH_KEY',  '2irThnXbWA1GGOlF41kEbdCt7CDrndDETzIbedtRvslMOP7zsaMtnfqFgOD4Aqd6');
define('LOGGED_IN_KEY',    'g1jw1Q2YtescHbfWGoAoiYWgGV3ZTQbMyadPNVMUayekOC8IabSi8rGqaLQZry5Y');
define('NONCE_KEY',        '1DqFrtuK3f1IuGFlfZoNx7g25KFXxhTHaQFo61AaOfkTYlRyZDFvQLUWkYxsmWxt');
define('AUTH_SALT',        'Qu4kPVIGTd7MdCLyFfMcWYq2h8c94e7THl1tmMGpA5NOxvh4JhABLHo5ANMmq4CO');
define('SECURE_AUTH_SALT', 'oZOkUHRa4gKBseOtDHDK3DwBvj3iHcyaLgNWQ51vlZWgaiEbeMDD4oKNZbb7ZDqH');
define('LOGGED_IN_SALT',   '4zxWuYL3hGXX8ZUhJTYOfT3aMu65yNfrMoJGJqBz11zf71EV5HgvlkiuLpSHzAK2');
define('NONCE_SALT',       'gj7HKfrcqkll1ZfSWcaMwaBLMVch2wGYZd2Gflst5NQ6ilE6BVmNjxdLAKoJEQEx');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
