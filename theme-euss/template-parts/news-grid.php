<?php
/**
 * News grid template part.
 *
 * @package theme-euss
 */

$news_query = new WP_Query(
    [
        'post_type'      => 'news',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]
);

$heading     = is_rtl() ? 'الأخبار والفعاليات' : __( 'News & Events', 'theme-euss' );
$more_label  = is_rtl() ? 'المزيد من الأخبار' : __( 'More News', 'theme-euss' );
$more_symbol = is_rtl() ? '‹' : '›';
$placeholder = THEME_EUSS_URI . '/assets/img/news-placeholder.svg';
?>
<section class="news-events-section">
    <div class="container">
        <div class="news-events-header">
            <h2 class="section-title"><?php echo esc_html( $heading ); ?></h2>
            <a class="news-more-link" href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>">
                <?php echo esc_html( $more_label ); ?>
                <span aria-hidden="true"><?php echo esc_html( $more_symbol ); ?></span>
            </a>
        </div>
        <div class="row g-4">
            <?php if ( $news_query->have_posts() ) : ?>
                <?php $index = 1; ?>
                <?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                    <div class="col-md-6 col-lg-4">
                        <article class="news-card">
                            <figure class="news-card-thumb">
                                <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy', 'class' => 'img-fluid' ] );
                                } else {
                                    echo '<img src="' . esc_url( $placeholder ) . '" alt="' . esc_attr( get_the_title() ) . '" loading="lazy">';
                                }
                                ?>
                            </figure>
                            <div class="news-card-body">
                                <span class="news-card-index"><?php echo esc_html( sprintf( '%02d', $index ) ); ?></span>
                                <h3 class="news-card-title"><?php the_title(); ?></h3>
                                <p class="news-card-meta"><?php echo esc_html( get_the_date() ); ?></p>
                                <p class="news-card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
                                <a class="news-card-link" href="<?php the_permalink(); ?>">
                                    <?php echo esc_html( is_rtl() ? 'قراءة التفاصيل' : __( 'Read full story', 'theme-euss' ) ); ?>
                                    <span aria-hidden="true"><?php echo esc_html( is_rtl() ? '↗' : '→' ); ?></span>
                                </a>
                            </div>
                        </article>
                    </div>
                    <?php $index++; ?>
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
    </div>
</section>
