<?php
/**
 * News grid template part.
 *
 * @package theme-euss
 */

$news_query = new WP_Query( [
    'post_type'      => 'news',
    'posts_per_page' => 4,
] );
?>
<section class="py-5 bg-light">
<div class="container">
<div class="row">
<div class="col-lg-8">
<div class="row g-4">
<?php if ( $news_query->have_posts() ) : ?>
<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
<div class="col-md-6">
<article class="card h-100 shadow-sm">
<?php if ( has_post_thumbnail() ) : ?>
<?php the_post_thumbnail( 'medium_large', [ 'class' => 'card-img-top', 'loading' => 'lazy' ] ); ?>
<?php endif; ?>
<div class="card-body">
<h3 class="h5"><a class="stretched-link text-decoration-none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<p class="mb-0 text-muted"><small><?php echo esc_html( get_the_date() ); ?></small></p>
<p class="mt-2"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
</div>
</article>
</div>
<?php endwhile; ?>
<?php else : ?>
<p><?php esc_html_e( 'Latest academic announcements will appear here as soon as news items are published.', 'theme-euss' ); ?><?php // PDF p.18 ?></p>
<?php endif; wp_reset_postdata(); ?>
</div>
<div class="text-center mt-4">
<a class="btn btn-outline-primary" href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>"><?php esc_html_e( 'More News', 'theme-euss' ); ?></a>
</div>
</div>
<aside class="col-lg-4">
<div class="bg-white p-4 rounded shadow-sm h-100">
<h3 class="h5 mb-3"><?php esc_html_e( 'Upcoming Events', 'theme-euss' ); ?></h3>
<ul class="list-unstyled mb-0">
<li class="mb-3">
<span class="d-block fw-bold"><?php esc_html_e( 'Final term examinations (Sweden campus)', 'theme-euss' ); ?><?php // PDF p.18 ?></span>
<small class="text-muted"><?php esc_html_e( 'Held on-site for resident students with remote options for international cohorts.', 'theme-euss' ); ?><?php // PDF p.18 ?></small>
</li>
</ul>
<a class="btn btn-primary w-100" href="#"><?php esc_html_e( 'More Events', 'theme-euss' ); ?></a>
</div>
</aside>
</div>
</div>
</section>
