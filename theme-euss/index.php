<?php
/**
 * Index template.
 *
 * @package theme-euss
 */

get_header();
?>
<div class="container py-5">
    <?php theme_euss_breadcrumbs(); ?>
    <?php if ( have_posts() ) : ?>
        <div class="row g-4">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 shadow-sm">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium', [ 'class' => 'card-img-top', 'loading' => 'lazy' ] ); ?>
                        <?php endif; ?>
                        <div class="card-body">
                            <h2 class="h5"><a class="stretched-link text-decoration-none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                        </div>
                    </article>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="mt-4">
            <?php theme_euss_paginate(); ?>
        </div>
    <?php else : ?>
        <p><?php esc_html_e( 'No content available.', 'theme-euss' ); ?></p>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
