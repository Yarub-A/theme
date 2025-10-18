<?php
/**
 * Theme setup.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'theme_euss_setup' ) ) {
    function theme_euss_setup() {
        load_theme_textdomain( 'theme-euss', THEME_EUSS_DIR . '/languages' );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'gallery',
            'caption',
            'style',
            'script',
        ] );
        add_theme_support( 'align-wide' );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'custom-logo', [
            'height'      => 120,
            'width'       => 120,
            'flex-width'  => true,
            'flex-height' => true,
        ] );

        register_nav_menus( [
            'main_ar'   => __( 'Main Menu (Arabic)', 'theme-euss' ),
            'main_en'   => __( 'Main Menu (English)', 'theme-euss' ),
            'top_ar'    => __( 'Top Bar Menu (Arabic)', 'theme-euss' ),
            'top_en'    => __( 'Top Bar Menu (English)', 'theme-euss' ),
            'footer_ar' => __( 'Footer Menu (Arabic)', 'theme-euss' ),
            'footer_en' => __( 'Footer Menu (English)', 'theme-euss' ),
        ] );

        add_editor_style( 'assets/css/editor.css' );
    }
}
add_action( 'after_setup_theme', 'theme_euss_setup' );

add_filter(
    'language_attributes',
    static function() {
        $locale = function_exists( 'pll_current_language' ) ? pll_current_language( 'locale' ) : get_locale();
        if ( ! $locale ) {
            $locale = 'en_US';
        }

        return 'lang="' . esc_attr( $locale ) . '"';
    }
);

add_filter(
    'body_class',
    static function( $classes ) {
        $direction = function_exists( 'theme_euss_get_direction' ) ? theme_euss_get_direction() : ( is_rtl() ? 'rtl' : 'ltr' );
        $classes[] = $direction;
        return array_unique( $classes );
    }
);

add_action(
    'init',
    static function() {
        remove_action( 'wp_head', 'wp_generator' );
        add_filter( 'use_block_editor_for_post_type', '__return_true' );
    }
);
