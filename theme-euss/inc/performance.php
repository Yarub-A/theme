<?php
/**
 * Performance optimisations.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action(
    'init',
    static function() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );
        remove_action( 'wp_head', 'wp_shortlink_wp_head' );
        remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
    }
);

add_filter(
    'script_loader_tag',
    static function( $tag, $handle, $src ) {
        $defer = [ 'theme-euss-theme' ];
        if ( in_array( $handle, $defer, true ) ) {
            return '<script src="' . esc_url( $src ) . '" defer></script>';
        }
        return $tag;
    },
    10,
    3
);

add_filter(
    'wp_lazy_loading_enabled',
    static function() {
        return true;
    }
);
