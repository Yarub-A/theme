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
                <ul class="small mb-0 ps-3">
                    <li><?php esc_html_e( 'Accepts graduates of scientific, literary, commercial, and intermediate institutes.', 'theme-euss' ); ?><?php // PDF p.23 ?></li>
                    <li><?php esc_html_e( 'Inclusive admissions for international and special-needs applicants without certificate restrictions.', 'theme-euss' ); ?><?php // PDF p.23 ?></li>
                    <li><?php esc_html_e( 'Bachelor applicants must hold a baccalaureate diploma and submit passport copy, CV, photo, contact details, and registration fees.', 'theme-euss' ); ?><?php // PDF p.23 ?></li>
                </ul>
            </div>
        </aside>
    </div>
</div>
<?php get_footer(); ?>
