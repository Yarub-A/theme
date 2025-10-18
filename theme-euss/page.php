<?php
/**
 * Default page template.
 *
 * @package theme-euss
 */

get_header();
?>
<div class="container py-5">
    <?php theme_euss_breadcrumbs(); ?>
    <div class="row">
        <div class="col-lg-8">
            <?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
        <aside class="col-lg-4">
            <div class="bg-light p-4 rounded shadow-sm">
                <h2 class="h5 mb-3"><?php esc_html_e( 'Admissions Highlights', 'theme-euss' ); ?> <small class="text-muted"><?php esc_html_e( '// PDF p.23', 'theme-euss' ); ?></small></h2>
                <p class="small mb-0"><?php esc_html_e( 'TODO populate admissions highlights from PDF.', 'theme-euss' ); ?></p>
            </div>
        </aside>
    </div>
</div>
<?php get_footer(); ?>
