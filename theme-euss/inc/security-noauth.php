<?php
/**
 * Security hardening and no-auth enforcement.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action(
    'init',
    static function() {
        foreach ( [ 'post', 'page', 'news', 'colleges' ] as $type ) {
            remove_post_type_support( $type, 'comments' );
            remove_post_type_support( $type, 'trackbacks' );
        }
    }
);

add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );
add_filter( 'comments_array', '__return_empty_array', 20 );

add_action(
    'admin_init',
    static function() {
        remove_menu_page( 'edit-comments.php' );
        foreach ( [ 'post', 'page', 'news', 'colleges' ] as $type ) {
            remove_meta_box( 'commentstatusdiv', $type, 'normal' );
            remove_meta_box( 'commentsdiv', $type, 'normal' );
        }
    }
);

add_filter( 'show_admin_bar', '__return_false' );

add_action(
    'template_redirect',
    static function() {
        if ( is_author() || isset( $_GET['author'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            wp_safe_redirect( home_url(), 301 );
            exit;
        }
        $request_uri = $_SERVER['REQUEST_URI'] ?? '';
        $parsed      = wp_parse_url( $request_uri );
        $path        = isset( $parsed['path'] ) ? untrailingslashit( $parsed['path'] ) : '';
        $auth_paths  = [ '/wp-login.php', '/wp-login', '/wp-signup.php', '/wp-signup', '/wp-register.php' ];

        foreach ( $auth_paths as $auth_path ) {
            if ( 0 === strpos( $path, $auth_path ) ) {
                wp_safe_redirect( home_url(), 302 );
                exit;
            }
        }

        if ( ! empty( $parsed['query'] ) ) {
            parse_str( $parsed['query'], $query_vars );
            if ( isset( $query_vars['action'] ) && in_array( $query_vars['action'], [ 'register', 'lostpassword', 'rp' ], true ) ) {
                wp_safe_redirect( home_url(), 302 );
                exit;
            }
        }

        if ( isset( $_GET['action'] ) && in_array( $_GET['action'], [ 'register', 'lostpassword', 'rp' ], true ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            wp_safe_redirect( home_url(), 302 );
            exit;
        }
    }
);

add_filter(
    'rest_authentication_errors',
    static function( $result ) {
        if ( ! is_user_logged_in() ) {
            $request = rest_get_server()->get_current_request();
            if ( $request && 0 === strpos( $request->get_route(), '/wp/v2/users' ) ) {
                return new WP_Error( 'rest_forbidden', __( 'User data cannot be accessed.', 'theme-euss' ), [ 'status' => 401 ] );
            }
        }
        return $result;
    }
);

add_filter(
    'login_url',
    static function() {
        return home_url();
    }
);

add_action(
    'init',
    static function() {
        add_rewrite_rule( '^author/.*', 'index.php?error=404', 'top' );
    }
);
