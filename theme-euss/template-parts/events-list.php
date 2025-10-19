<?php
/**
 * Events list template part.
 *
 * @package theme-euss
 */

$today      = wp_date( 'Ymd' );
$events_query = new WP_Query(
    [
        'post_type'      => 'news',
        'posts_per_page' => 4,
        'meta_key'       => 'event_date',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_type'      => 'DATE',
        'meta_query'     => [
            [
                'key'     => 'event_date',
                'value'   => $today,
                'compare' => '>=',
                'type'    => 'DATE',
            ],
        ],
    ]
);

if ( ! $events_query->have_posts() ) {
    wp_reset_postdata();
    return;
}
?>
<section class="events-section py-5">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5">
                <h2 class="h3 mb-3"><?php echo is_rtl() ? esc_html__( 'فعاليات الجامعة', 'theme-euss' ) : esc_html__( 'University Events', 'theme-euss' ); ?><?php // PDF p.18 ?></h2>
                <p class="text-muted mb-0"><?php echo is_rtl() ? esc_html__( 'تابع أحدث اللقاءات والأنشطة العلمية التي تنظمها الجامعة خلال العام الأكاديمي.', 'theme-euss' ) : esc_html__( 'Stay informed about upcoming academic engagements hosted by the university throughout the academic year.', 'theme-euss' ); ?><?php // PDF p.18 ?></p>
            </div>
            <div class="col-lg-7">
                <ul class="list-group list-group-flush events-list">
                    <?php
                    while ( $events_query->have_posts() ) :
                        $events_query->the_post();
                        $event_date_value = theme_euss_get_acf_field( 'event_date', '' );
                        $event_timestamp  = null;

                        if ( $event_date_value instanceof DateTime ) {
                            $event_timestamp = $event_date_value->getTimestamp();
                        } elseif ( is_string( $event_date_value ) && '' !== $event_date_value ) {
                            $parsed = DateTime::createFromFormat( 'Ymd', $event_date_value );
                            if ( $parsed instanceof DateTime ) {
                                $event_timestamp = $parsed->getTimestamp();
                            }
                        }

                        $event_date_label = '';
                        if ( $event_timestamp ) {
                            $event_date_label = wp_date( get_option( 'date_format' ), $event_timestamp );
                        }

                        $excerpt = get_the_excerpt();
                        if ( empty( $excerpt ) ) {
                            $excerpt = wp_trim_words( wp_strip_all_tags( get_the_content() ), 26 );
                        }
                        ?>
                        <li class="list-group-item px-0 py-3">
                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                                <div>
                                    <?php if ( ! empty( $event_date_label ) ) : ?>
                                        <span class="badge rounded-pill bg-secondary mb-2">
                                            <?php echo esc_html( $event_date_label ); ?>
                                        </span>
                                    <?php endif; ?>
                                    <h3 class="h5 mb-1">
                                        <a class="event-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <?php if ( ! empty( $excerpt ) ) : ?>
                                        <p class="mb-0 text-muted"><?php echo esc_html( $excerpt ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="text-md-end">
                                    <a class="btn btn-outline-primary event-details" href="<?php the_permalink(); ?>">
                                        <?php echo is_rtl() ? esc_html__( 'عرض التفاصيل', 'theme-euss' ) : esc_html__( 'View details', 'theme-euss' ); ?>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php
wp_reset_postdata();
