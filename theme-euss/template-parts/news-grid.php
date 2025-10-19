<?php
/**
 * News grid template part.
 *
 * @package theme-euss
 */

$news_query = new WP_Query(
    [
        'post_type'      => 'news',
        'posts_per_page' => 4,
    ]
);
?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="row g-4">
                    <?php if ( $news_query->have_posts() ) : ?>
                        <?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                            <div class="col-md-6">
                                <article class="card h-100 shadow-sm">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'medium_large', [ 'class' => 'card-img-top', 'loading' => 'lazy' ] ); ?>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h3 class="h5">
                                            <a class="stretched-link text-decoration-none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <p class="mb-0 text-muted"><small><?php echo esc_html( get_the_date() ); ?></small></p>
                                        <p class="mt-2"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <div class="col-12">
                            <div class="alert alert-info mb-0" role="status">
                                <?php esc_html_e( 'Latest academic announcements will appear here as soon as news items are published.', 'theme-euss' ); ?><?php // PDF p.18 ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-outline-primary" href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>"><?php esc_html_e( 'More News', 'theme-euss' ); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
