<?php
/**
 * Polylang helpers.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action(
    'after_setup_theme',
    static function() {
        if ( function_exists( 'pll_the_languages' ) && function_exists( 'pll_register_string' ) ) {
            pll_register_string( 'euss_contact_phone', 'TODO phone from PDF', 'theme-euss' ); // PDF p.24
            pll_register_string( 'euss_contact_email', 'TODO email from PDF', 'theme-euss' ); // PDF p.24
            pll_register_string( 'euss_contact_address', 'TODO address from PDF', 'theme-euss' ); // PDF p.24
        }
    }
);

function theme_euss_get_translated_option( $option_key, $default = '' ) {
    $value = get_option( $option_key, $default );
    if ( function_exists( 'pll__' ) ) {
        return pll__( $value );
    }
    return $value;
}

function theme_euss_current_lang() {
    if ( function_exists( 'pll_current_language' ) ) {
        return pll_current_language();
    }
    return get_locale();
}

function theme_euss_language_switcher() {
    if ( function_exists( 'pll_the_languages' ) ) {
        pll_the_languages(
            [
                'dropdown'   => 0,
                'show_flags' => 1,
                'show_names' => 1,
                'hide_if_empty' => 0,
            ]
        );

        return;
    }

    $fallback_languages = [
        'ar' => [
            'label' => __( 'العربية', 'theme-euss' ),
            'url'   => home_url( '/home-ar' ),
        ],
        'en' => [
            'label' => __( 'English', 'theme-euss' ),
            'url'   => home_url( '/home-en' ),
        ],
    ];

    echo '<ul class="list-inline m-0">';
    foreach ( $fallback_languages as $code => $data ) {
        echo '<li class="list-inline-item"><a class="text-white" href="' . esc_url( $data['url'] ) . '">' . esc_html( $data['label'] ) . '</a></li>';
    }
    echo '</ul>';
}
