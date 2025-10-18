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
