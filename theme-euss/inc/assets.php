<?php
/**
 * Asset management.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function theme_euss_enqueue_assets() {
    $version = THEME_EUSS_VERSION;

    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'classic-theme-styles' );

    $bootstrap_css_path = THEME_EUSS_DIR . '/assets/vendor/bootstrap/bootstrap.min.css';
    $bootstrap_js_path  = THEME_EUSS_DIR . '/assets/vendor/bootstrap/bootstrap.bundle.min.js';

    $bootstrap_css_uri = THEME_EUSS_URI . '/assets/vendor/bootstrap/bootstrap.min.css';
    $bootstrap_js_uri  = THEME_EUSS_URI . '/assets/vendor/bootstrap/bootstrap.bundle.min.js';

    $bootstrap_css_version = file_exists( $bootstrap_css_path ) ? filemtime( $bootstrap_css_path ) : '5.3.3';
    $bootstrap_js_version  = file_exists( $bootstrap_js_path ) ? filemtime( $bootstrap_js_path ) : '5.3.3';

    wp_enqueue_style( 'theme-euss-bootstrap', $bootstrap_css_uri, [], $bootstrap_css_version );

    wp_enqueue_style( 'theme-euss-style', get_stylesheet_uri(), [ 'theme-euss-bootstrap' ], $version );

    wp_enqueue_style(
        'theme-euss-editor-fonts',
        'https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Inter:wght@400;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_script( 'theme-euss-bootstrap', $bootstrap_js_uri, [ 'jquery' ], $bootstrap_js_version, true );

    wp_enqueue_script(
        'theme-euss-theme',
        THEME_EUSS_URI . '/assets/js/theme.js',
        [ 'jquery', 'theme-euss-bootstrap' ],
        $version,
        true
    );

    wp_localize_script(
        'theme-euss-theme',
        'themeEuss',
        [
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'isRtl'   => is_rtl(),
        ]
    );
}
add_action( 'wp_enqueue_scripts', 'theme_euss_enqueue_assets' );

function theme_euss_block_editor_assets() {
    wp_enqueue_style(
        'theme-euss-editor-style',
        THEME_EUSS_URI . '/assets/css/editor.css',
        [],
        THEME_EUSS_VERSION
    );
}
add_action( 'enqueue_block_editor_assets', 'theme_euss_block_editor_assets' );

function theme_euss_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = [
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'theme_euss_resource_hints', 10, 2 );

function theme_euss_filter_nav_menu_link_attributes( $atts ) {
    $atts['class'] = isset( $atts['class'] ) ? $atts['class'] . ' nav-link' : 'nav-link';
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'theme_euss_filter_nav_menu_link_attributes' );
