<?php
/**
 * Template helper functions.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function theme_euss_get_direction() {
    $locale = '';
    if ( function_exists( 'pll_current_language' ) ) {
        $locale = pll_current_language( 'locale' );
    }

    if ( empty( $locale ) ) {
        $locale = get_locale();
    }

    if ( ! $locale ) {
        return is_rtl() ? 'rtl' : 'ltr';
    }

    $rtl_locales = apply_filters( 'theme_euss_rtl_locales', [ 'ar', 'ar_SA', 'ar_EG', 'he_IL', 'fa_IR' ] );

    foreach ( $rtl_locales as $rtl_locale ) {
        if ( str_starts_with( $locale, $rtl_locale ) ) {
            return 'rtl';
        }
    }

    return 'ltr';
}

function theme_euss_get_acf_field( $field_key, $default = null, $post_id = null ) {
    if ( ! function_exists( 'get_field' ) ) {
        return $default;
    }

    $value = null === $post_id ? get_field( $field_key ) : get_field( $field_key, $post_id );

    if ( null === $value || false === $value ) {
        return $default;
    }

    return $value;
}

function theme_euss_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }
    echo '<nav class="breadcrumb-wrapper" aria-label="breadcrumb"><ol class="breadcrumb">';
    echo '<li class="breadcrumb-item"><a href="' . esc_url( home_url() ) . '">' . esc_html__( 'Home', 'theme-euss' ) . '</a></li>';

    if ( is_singular() ) {
        $post = get_post();
        if ( $post->post_type !== 'post' ) {
            $post_type = get_post_type_object( $post->post_type );
            if ( $post_type ) {
                echo '<li class="breadcrumb-item"><a href="' . esc_url( get_post_type_archive_link( $post->post_type ) ) . '">' . esc_html( $post_type->labels->name ) . '</a></li>';
            }
        }
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
    } elseif ( is_post_type_archive() ) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html( post_type_archive_title( '', false ) ) . '</li>';
    } elseif ( is_tax() ) {
        $term = get_queried_object();
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html( $term->name ) . '</li>';
    }
    echo '</ol></nav>';
}

function theme_euss_paginate() {
    the_posts_pagination( [
        'mid_size'           => 2,
        'prev_text'          => __( 'Previous', 'theme-euss' ),
        'next_text'          => __( 'Next', 'theme-euss' ),
        'screen_reader_text' => __( 'Posts navigation', 'theme-euss' ),
    ] );
}

add_action(
    'init',
    static function() {
        add_shortcode( 'theme_euss_news_grid', 'theme_euss_shortcode_news_grid' );
        add_shortcode( 'theme_euss_events', 'theme_euss_shortcode_events' );
        add_shortcode( 'theme_euss_partners', 'theme_euss_shortcode_partners' );
    }
);

function theme_euss_shortcode_news_grid() {
    ob_start();
    get_template_part( 'template-parts/news-grid' );
    return ob_get_clean();
}

function theme_euss_shortcode_events() {
    ob_start();
    get_template_part( 'template-parts/events-list' );
    return ob_get_clean();
}

function theme_euss_shortcode_partners() {
    ob_start();
    get_template_part( 'template-parts/partners-strip' );
    return ob_get_clean();
}

function theme_euss_nav_fallback() {
    $output  = '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
    $output .= '<li class="nav-item">';
    $output .= '<a class="nav-link" href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Configure navigation', 'theme-euss' ) . '</a>';
    $output .= '</li>';
    $output .= '</ul>';

    echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
