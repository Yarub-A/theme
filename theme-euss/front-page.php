<?php
/**
 * Front page template.
 *
 * @package theme-euss
 */

get_header();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        $content = trim( get_the_content() );

        if ( ! empty( $content ) ) {
            the_content();
        } else {
            $fallback_blocks = '<!-- wp:group {"layout":{"type":"constrained"}} -->'
                . '<div class="wp-block-group"><!-- wp:heading -->'
                . '<h2>' . esc_html__( 'European University for Smart Sciences', 'theme-euss' ) . '</h2>'
                . '<!-- /wp:heading --><!-- wp:paragraph -->'
                . '<p>' . esc_html__( 'Update this page using the Site Editor to customise the hero, programmes, and calls to action.', 'theme-euss' ) . '</p>'
                . '<!-- /wp:paragraph --></div><!-- /wp:group -->'
                . '<!-- wp:theme-euss/news-grid {"postsToShow":3} /-->'
                . '<!-- wp:theme-euss/partners-strip /-->';

            echo do_blocks( $fallback_blocks );
        }
    }
}

get_footer();
