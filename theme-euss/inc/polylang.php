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
            pll_register_string( 'euss_contact_phone', '+46 763091170', 'theme-euss' ); // PDF p.24
            pll_register_string( 'euss_contact_email', 'info@edu.renita.se', 'theme-euss' ); // PDF p.24
            pll_register_string( 'euss_contact_address', 'Hildebrandsgatan 5, 41705 Gothenburg, Sweden', 'theme-euss' ); // PDF p.24
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

function theme_euss_language_switcher( $context = 'desktop' ) {
    $context = in_array( $context, [ 'desktop', 'mobile', 'block' ], true ) ? $context : 'desktop';
    $container_classes = [ 'language-switcher', 'dropdown', 'language-switcher-' . $context ];
    $button_id        = 'language-switcher-' . wp_rand( 1000, 9999 );
    $alignment        = is_rtl() ? 'dropdown-menu-start' : 'dropdown-menu-end';

    if ( 'mobile' === $context ) {
        $alignment = is_rtl() ? 'dropdown-menu-end' : 'dropdown-menu-start';
    }

    if ( function_exists( 'pll_the_languages' ) ) {
        $languages = pll_the_languages(
            [
                'raw'           => 1,
                'hide_if_empty' => 0,
            ]
        );

        if ( empty( $languages ) ) {
            return;
        }

        $current = null;
        foreach ( $languages as $language ) {
            if ( ! empty( $language['current_lang'] ) ) {
                $current = $language;
                break;
            }
        }

        if ( null === $current ) {
            $current = reset( $languages );
        }

        $current_code = strtoupper( $current['slug'] ?? $current['code'] ?? substr( $current['locale'] ?? 'en', 0, 2 ) );
        $current_name = $current['name'] ?? $current_code;

        $icon_svg     = '<span class="language-icon" aria-hidden="true"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 2c1.24 0 2.39.27 3.43.76-.45.57-.86 1.22-1.22 1.91h-4.42A7.92 7.92 0 018.57 4.76 7.95 7.95 0 0112 4zm-6 6c0-.7.09-1.37.25-2h2.72a20.7 20.7 0 000 4H6.25A7.97 7.97 0 016 10zm.25 4h2.72a20.7 20.7 0 000 4H6.25A7.97 7.97 0 016 14zm1.32 5.24A7.92 7.92 0 0110.79 18h4.42c.36.69.77 1.34 1.22 1.91A7.95 7.95 0 0112 20a7.92 7.92 0 01-4.43-1.24zM18 14c0 .7-.09 1.37-.25 2h-2.72a20.7 20.7 0 000-4h2.72c.16.63.25 1.3.25 2zm-.25-4h-2.72a20.7 20.7 0 000-4h2.72c.16.63.25 1.3.25 2s-.09 1.37-.25 2z" fill="currentColor"/></svg></span>';
        $button_label = sprintf( /* translators: %s: language name */ __( 'Change language. Current language: %s', 'theme-euss' ), $current_name );

        echo '<div class="' . esc_attr( implode( ' ', $container_classes ) ) . '">';
        echo '<button class="btn btn-language-toggle" type="button" id="' . esc_attr( $button_id ) . '" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false" aria-label="' . esc_attr( $button_label ) . '">';
        echo $icon_svg;
        echo '<span class="language-code">' . esc_html( $current_code ) . '</span>';
        echo '<span class="language-name">' . esc_html( $current_name ) . '</span>';
        echo '<span class="language-caret" aria-hidden="true">▾</span>';
        echo '</button>';
        echo '<ul class="dropdown-menu ' . esc_attr( $alignment ) . '" aria-labelledby="' . esc_attr( $button_id ) . '" role="menu">';
        foreach ( $languages as $language ) {
            $active   = ! empty( $language['current_lang'] );
            $code     = strtoupper( $language['slug'] ?? $language['code'] ?? substr( $language['locale'] ?? '', 0, 2 ) );
            $name     = $language['name'] ?? $code;
            $item_cls = 'dropdown-item' . ( $active ? ' active' : '' );
            $current  = $active ? ' aria-current="true"' : '';

            echo '<li role="none"><a class="' . esc_attr( $item_cls ) . '" role="menuitem" href="' . esc_url( $language['url'] ) . '"' . $current . '>';
            echo '<span class="language-option-code">' . esc_html( $code ) . '</span>';
            echo '<span class="language-option-name">' . esc_html( $name ) . '</span>';
            echo '</a></li>';
        }
        echo '</ul>';
        echo '</div>';

        return;
    }

    $default_front_id  = (int) get_option( 'page_on_front' );
    $default_front_url = $default_front_id ? get_permalink( $default_front_id ) : home_url( '/' );

    $resolve_page_url = static function ( $slug_candidates ) {
        $slug_candidates = (array) $slug_candidates;

        foreach ( $slug_candidates as $candidate_slug ) {
            $candidate_slug = trim( (string) $candidate_slug );

            if ( '' === $candidate_slug ) {
                continue;
            }

            $page = get_page_by_path( $candidate_slug );

            if ( $page instanceof WP_Post ) {
                return get_permalink( $page );
            }
        }

        return '';
    };
    $language_definitions = [
        'ar' => [
            'label'          => __( 'العربية', 'theme-euss' ),
            'code'           => 'AR',
            'slug_candidates' => [ 'home-ar', 'ar/home', 'ar' ],
        ],
        'en' => [
            'label'          => __( 'English', 'theme-euss' ),
            'code'           => 'EN',
            'slug_candidates' => [ 'home-en', 'home', 'en/home' ],
        ],
    ];

    $fallback_languages = [];

    foreach ( $language_definitions as $lang_code => $definition ) {
        $url       = '';
        $seed_meta = sanitize_key( 'page-home-' . $lang_code );

        if ( $default_front_id && function_exists( 'pll_get_post' ) ) {
            $translated_front = pll_get_post( $default_front_id, $lang_code );
            if ( $translated_front ) {
                $url = get_permalink( $translated_front );
            }
        }

        if ( '' === $url && $seed_meta ) {
            $seed_page = get_posts(
                [
                    'post_type'   => 'page',
                    'post_status' => 'publish',
                    'numberposts' => 1,
                    'meta_key'    => '_theme_euss_seed_key',
                    'meta_value'  => $seed_meta,
                ]
            );

            if ( $seed_page ) {
                $url = get_permalink( $seed_page[0] );
            }
        }

        if ( '' === $url ) {
            $url = $resolve_page_url( $definition['slug_candidates'] );
        }

        if ( '' === $url ) {
            if ( 'en' === $lang_code ) {
                $url = $default_front_url;
            } else {
                $url = home_url( '/' . $lang_code . '/' );
            }
        }

        $fallback_languages[ $lang_code ] = [
            'label' => $definition['label'],
            'code'  => $definition['code'],
            'url'   => $url,
        ];
    }

    $icon_svg     = '<span class="language-icon" aria-hidden="true"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 2c1.24 0 2.39.27 3.43.76-.45.57-.86 1.22-1.22 1.91h-4.42A7.92 7.92 0 018.57 4.76 7.95 7.95 0 0112 4zm-6 6c0-.7.09-1.37.25-2h2.72a20.7 20.7 0 000 4H6.25A7.97 7.97 0 016 10zm.25 4h2.72a20.7 20.7 0 000 4H6.25A7.97 7.97 0 016 14zm1.32 5.24A7.92 7.92 0 0110.79 18h4.42c.36.69.77 1.34 1.22 1.91A7.95 7.95 0 0112 20a7.92 7.92 0 01-4.43-1.24zM18 14c0 .7-.09 1.37-.25 2h-2.72a20.7 20.7 0 000-4h2.72c.16.63.25 1.3.25 2zm-.25-4h-2.72a20.7 20.7 0 000-4h2.72c.16.63.25 1.3.25 2s-.09 1.37-.25 2z" fill="currentColor"/></svg></span>';
    $button_label = __( 'Change language', 'theme-euss' );

    echo '<div class="' . esc_attr( implode( ' ', $container_classes ) ) . '">';
    echo '<button class="btn btn-language-toggle" type="button" id="' . esc_attr( $button_id ) . '" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false" aria-label="' . esc_attr( $button_label ) . '">';
    echo $icon_svg;
    echo '<span class="language-code">EN</span><span class="language-name">' . esc_html__( 'Language', 'theme-euss' ) . '</span>';
    echo '<span class="language-caret" aria-hidden="true">▾</span>';
    echo '</button>';
    echo '<ul class="dropdown-menu ' . esc_attr( $alignment ) . '" aria-labelledby="' . esc_attr( $button_id ) . '" role="menu">';
    foreach ( $fallback_languages as $lang ) {
        echo '<li role="none"><a class="dropdown-item" role="menuitem" href="' . esc_url( $lang['url'] ) . '">';
        echo '<span class="language-option-code">' . esc_html( $lang['code'] ) . '</span>';
        echo '<span class="language-option-name">' . esc_html( $lang['label'] ) . '</span>';
        echo '</a></li>';
    }
    echo '</ul>';
    echo '</div>';
}
