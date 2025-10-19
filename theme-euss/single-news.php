<?php
/**
 * Single news template.
 *
 * @package theme-euss
 */

get_header();
?>
<div class="container py-5">
    <?php theme_euss_breadcrumbs(); ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <article class="news-single">
            <header class="mb-4">
                <h1 class="display-5 fw-bold"><?php the_title(); ?></h1>
                <p class="text-muted"><small><?php echo esc_html( get_the_date() ); ?></small></p>
            </header>
            <?php if ( has_post_thumbnail() ) : ?>
                <figure class="mb-4">
                    <?php the_post_thumbnail( 'large', [ 'class' => 'img-fluid rounded shadow', 'loading' => 'lazy' ] ); ?>
                </figure>
            <?php endif; ?>
            <div class="news-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>
