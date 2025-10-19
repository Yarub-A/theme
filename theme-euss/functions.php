<?php
/**
 * Theme bootstrap file.
 *
 * @package theme-euss
 */

define( 'THEME_EUSS_VERSION', '1.0.0' );
define( 'THEME_EUSS_DIR', get_template_directory() );
define( 'THEME_EUSS_URI', get_template_directory_uri() );

require_once THEME_EUSS_DIR . '/inc/setup.php';
require_once THEME_EUSS_DIR . '/inc/assets.php';
require_once THEME_EUSS_DIR . '/inc/performance.php';
require_once THEME_EUSS_DIR . '/inc/security-noauth.php';
require_once THEME_EUSS_DIR . '/inc/cpts-tax.php';
require_once THEME_EUSS_DIR . '/inc/polylang.php';
require_once THEME_EUSS_DIR . '/inc/acf-fields.php';
require_once THEME_EUSS_DIR . '/inc/patterns.php';
require_once THEME_EUSS_DIR . '/inc/blocks.php';
require_once THEME_EUSS_DIR . '/inc/templates-helpers.php';
require_once THEME_EUSS_DIR . '/inc/seed.php';

// Optional WP-CLI command.
if ( defined( 'WP_CLI' ) && WP_CLI ) {
    require_once THEME_EUSS_DIR . '/inc/wp-cli-seed.php';
}
