<?php
/**
 * Block patterns registration.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action(
    'init',
    static function() {
        register_block_pattern_category( 'euss', [ 'label' => __( 'EUSS Patterns', 'theme-euss' ) ] );

        register_block_pattern(
            'euss/hero',
            [
                'title'       => __( 'EUSS Hero', 'theme-euss' ),
                'description' => __( 'Hero section with bilingual heading and CTA.', 'theme-euss' ),
                'categories'  => [ 'euss' ],
                'content'     => '<section class="hero-section text-center text-lg-start"><div class="container"><div class="row align-items-center"><div class="col-lg-7"><h1 class="display-5 fw-bold">' . esc_html__( 'TODO Hero Title', 'theme-euss' ) . '</h1><p class="lead">' . esc_html__( 'TODO Hero Subtitle', 'theme-euss' ) . '</p><a class="btn btn-primary btn-lg" href="#">' . esc_html__( 'Apply Now', 'theme-euss' ) . '</a></div><div class="col-lg-5"><figure class="text-center"><img class="img-fluid rounded shadow" src="' . esc_url( THEME_EUSS_URI . '/assets/img/placeholder-hero.jpg' ) . '" alt="' . esc_attr__( 'Campus image', 'theme-euss' ) . '" loading="lazy"></figure></div></div></div></section>',
            ]
        );

        register_block_pattern(
            'euss/stats-grid',
            [
                'title'       => __( 'EUSS Stats Grid', 'theme-euss' ),
                'description' => __( 'Grid of key statistics.', 'theme-euss' ),
                'categories'  => [ 'euss' ],
                'content'     => '<section class="py-5 bg-light"><div class="container"><div class="row text-center g-4"><div class="col-6 col-md-3"><div class="p-4 border rounded-3"><span class="d-block fs-1 fw-bold text-primary">00</span><span>' . esc_html__( 'TODO Stat', 'theme-euss' ) . '</span></div></div><div class="col-6 col-md-3"><div class="p-4 border rounded-3"><span class="d-block fs-1 fw-bold text-primary">00</span><span>' . esc_html__( 'TODO Stat', 'theme-euss' ) . '</span></div></div><div class="col-6 col-md-3"><div class="p-4 border rounded-3"><span class="d-block fs-1 fw-bold text-primary">00</span><span>' . esc_html__( 'TODO Stat', 'theme-euss' ) . '</span></div></div><div class="col-6 col-md-3"><div class="p-4 border rounded-3"><span class="d-block fs-1 fw-bold text-primary">00</span><span>' . esc_html__( 'TODO Stat', 'theme-euss' ) . '</span></div></div></div></div></section>',
            ]
        );

        register_block_pattern(
            'euss/partners-strip',
            [
                'title'       => __( 'EUSS Partners Strip', 'theme-euss' ),
                'description' => __( 'Carousel-like partners strip.', 'theme-euss' ),
                'categories'  => [ 'euss' ],
                'content'     => '<section class="py-5"><div class="container"><h2 class="text-center mb-4">' . esc_html__( 'Strategic Partners', 'theme-euss' ) . '</h2><div class="row g-3 align-items-center text-center"><div class="col-6 col-md-3"><img class="img-fluid" src="' . esc_url( THEME_EUSS_URI . '/assets/img/partner-placeholder.png' ) . '" alt="' . esc_attr__( 'Partner logo', 'theme-euss' ) . '" loading="lazy"></div><div class="col-6 col-md-3"><img class="img-fluid" src="' . esc_url( THEME_EUSS_URI . '/assets/img/partner-placeholder.png' ) . '" alt="' . esc_attr__( 'Partner logo', 'theme-euss' ) . '" loading="lazy"></div><div class="col-6 col-md-3"><img class="img-fluid" src="' . esc_url( THEME_EUSS_URI . '/assets/img/partner-placeholder.png' ) . '" alt="' . esc_attr__( 'Partner logo', 'theme-euss' ) . '" loading="lazy"></div><div class="col-6 col-md-3"><img class="img-fluid" src="' . esc_url( THEME_EUSS_URI . '/assets/img/partner-placeholder.png' ) . '" alt="' . esc_attr__( 'Partner logo', 'theme-euss' ) . '" loading="lazy"></div></div></div></section>',
            ]
        );

        register_block_pattern(
            'euss/news-grid',
            [
                'title'       => __( 'EUSS News Grid', 'theme-euss' ),
                'description' => __( 'Three column news grid.', 'theme-euss' ),
                'categories'  => [ 'euss' ],
                'content'     => '<section class="py-5 bg-light"><div class="container"><div class="row"><div class="col-lg-8"><div class="row g-4"><div class="col-md-6"><div class="card h-100 shadow-sm"><img src="' . esc_url( THEME_EUSS_URI . '/assets/img/news-placeholder.jpg' ) . '" class="card-img-top" alt="' . esc_attr__( 'News thumbnail', 'theme-euss' ) . '" loading="lazy"><div class="card-body"><h3 class="h5">' . esc_html__( 'TODO News Title', 'theme-euss' ) . '</h3><p>' . esc_html__( 'TODO News excerpt', 'theme-euss' ) . '</p><a class="btn btn-link" href="#">' . esc_html__( 'Read more', 'theme-euss' ) . '</a></div></div></div><div class="col-md-6"><div class="card h-100 shadow-sm"><img src="' . esc_url( THEME_EUSS_URI . '/assets/img/news-placeholder.jpg' ) . '" class="card-img-top" alt="' . esc_attr__( 'News thumbnail', 'theme-euss' ) . '" loading="lazy"><div class="card-body"><h3 class="h5">' . esc_html__( 'TODO News Title', 'theme-euss' ) . '</h3><p>' . esc_html__( 'TODO News excerpt', 'theme-euss' ) . '</p><a class="btn btn-link" href="#">' . esc_html__( 'Read more', 'theme-euss' ) . '</a></div></div></div></div></div><aside class="col-lg-4"><div class="bg-white p-4 rounded shadow-sm h-100"><h3 class="h5 mb-3">' . esc_html__( 'Upcoming Events', 'theme-euss' ) . '</h3><ul class="list-unstyled mb-0"><li class="mb-3"><span class="d-block fw-bold">' . esc_html__( 'TODO Event', 'theme-euss' ) . '</span><small>' . esc_html__( 'TODO Date', 'theme-euss' ) . '</small></li><li class="mb-3"><span class="d-block fw-bold">' . esc_html__( 'TODO Event', 'theme-euss' ) . '</span><small>' . esc_html__( 'TODO Date', 'theme-euss' ) . '</small></li></ul><a class="btn btn-outline-primary w-100" href="#">' . esc_html__( 'More Events', 'theme-euss' ) . '</a></div></aside></div></div></section>',
            ]
        );

        register_block_pattern(
            'euss/cta-banner',
            [
                'title'       => __( 'EUSS CTA Banner', 'theme-euss' ),
                'description' => __( 'Call-to-action banner.', 'theme-euss' ),
                'categories'  => [ 'euss' ],
                'content'     => '<section class="py-5 text-center" style="background-color:var(--color-primary);color:#fff;"><div class="container"><h2 class="display-6 fw-bold mb-3">' . esc_html__( 'Join European University for Smart Sciences', 'theme-euss' ) . '</h2><p class="lead mb-4">' . esc_html__( 'TODO CTA Copy', 'theme-euss' ) . '</p><a class="btn btn-light btn-lg" href="#">' . esc_html__( 'Contact Admissions', 'theme-euss' ) . '</a></div></section>',
            ]
        );
    }
);
