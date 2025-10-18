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
            get_template_part( 'template-parts/hero' );
            get_template_part( 'template-parts/news-grid' );
            get_template_part( 'template-parts/events-list' );
            get_template_part( 'template-parts/partners-strip' );
        }
    }
}

get_footer();
