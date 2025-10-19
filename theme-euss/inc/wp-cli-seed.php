<?php
/**
 * WP-CLI commands for theme.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
    WP_CLI::add_command( 'euss seed', 'theme_euss_cli_seed' );
}

function theme_euss_cli_seed() {
    theme_euss_seed_content();
    WP_CLI::success( 'EUSS content seeded.' );
}
