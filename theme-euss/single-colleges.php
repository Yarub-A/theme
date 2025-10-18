<?php
/**
 * Single college template.
 *
 * @package theme-euss
 */

get_header();
?>
<div class="container py-5">
    <?php theme_euss_breadcrumbs(); ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <article class="college-single">
            <header class="mb-4">
                <h1 class="display-5 fw-bold"><?php the_title(); ?> <small class="text-muted"><?php esc_html_e( '// PDF p.7', 'theme-euss' ); ?></small></h1>
            </header>
            <div class="row g-5">
                <div class="col-lg-8">
                    <section class="mb-5">
                        <h2 class="h4 fw-bold"><?php esc_html_e( 'Overview', 'theme-euss' ); ?></h2>
                        <div class="mt-3">
                            <?php echo wp_kses_post( get_field( 'overview_' . ( is_rtl() ? 'ar' : 'en' ) ) ?: __( 'TODO overview from PDF.', 'theme-euss' ) ); ?>
                        </div>
                    </section>
                    <section class="mb-5">
                        <h2 class="h4 fw-bold"><?php esc_html_e( 'Departments', 'theme-euss' ); ?> <small class="text-muted"><?php esc_html_e( '// PDF p.10', 'theme-euss' ); ?></small></h2>
                        <?php if ( have_rows( 'departments' ) ) : ?>
                            <ul class="list-group list-group-flush">
                                <?php while ( have_rows( 'departments' ) ) : the_row(); ?>
                                    <li class="list-group-item">
                                        <strong><?php echo esc_html( get_sub_field( 'name_' . ( is_rtl() ? 'ar' : 'en' ) ) ); ?></strong>
                                        <p class="mb-0 small text-muted"><?php echo esc_html( get_sub_field( 'description_' . ( is_rtl() ? 'ar' : 'en' ) ) ); ?></p>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else : ?>
                            <p><?php esc_html_e( 'TODO departments from PDF.', 'theme-euss' ); ?></p>
                        <?php endif; ?>
                    </section>
                    <section class="mb-5">
                        <h2 class="h4 fw-bold"><?php esc_html_e( 'Programs', 'theme-euss' ); ?> <small class="text-muted"><?php esc_html_e( '// PDF p.8', 'theme-euss' ); ?></small></h2>
                        <?php if ( have_rows( 'programs' ) ) : ?>
                            <div class="row g-3">
                                <?php while ( have_rows( 'programs' ) ) : the_row(); ?>
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <h3 class="h5"><?php echo esc_html( get_sub_field( 'name_' . ( is_rtl() ? 'ar' : 'en' ) ) ); ?></h3>
                                            <p class="mb-1"><strong><?php esc_html_e( 'Level', 'theme-euss' ); ?>:</strong> <?php echo esc_html( get_sub_field( 'level' ) ); ?></p>
                                            <p class="mb-0"><strong><?php esc_html_e( 'Duration', 'theme-euss' ); ?>:</strong> <?php echo esc_html( get_sub_field( 'duration' ) ); ?></p>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php else : ?>
                            <p><?php esc_html_e( 'TODO programs from PDF.', 'theme-euss' ); ?></p>
                        <?php endif; ?>
                    </section>
                </div>
                <aside class="col-lg-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="h5 fw-bold"><?php esc_html_e( 'College Contacts', 'theme-euss' ); ?></h3>
                            <p class="mb-1"><strong><?php esc_html_e( 'Dean', 'theme-euss' ); ?>:</strong> <?php echo esc_html( get_field( 'head_of_college' ) ?: __( 'TODO name', 'theme-euss' ) ); ?></p>
                            <p class="mb-1"><?php esc_html_e( 'Phone', 'theme-euss' ); ?>: <?php echo esc_html( get_field( 'contact_phone' ) ?: __( 'TODO phone', 'theme-euss' ) ); ?></p>
                            <p class="mb-1"><?php esc_html_e( 'Email', 'theme-euss' ); ?>: <?php echo esc_html( get_field( 'contact_email' ) ?: __( 'TODO email', 'theme-euss' ) ); ?></p>
                        </div>
                    </div>
                    <?php if ( have_rows( 'downloads' ) ) : ?>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h3 class="h5 fw-bold"><?php esc_html_e( 'Downloads', 'theme-euss' ); ?></h3>
                                <ul class="list-unstyled mb-0">
                                    <?php while ( have_rows( 'downloads' ) ) : the_row(); ?>
                                        <li class="mb-2">
                                            <a class="text-decoration-none" href="<?php echo esc_url( get_sub_field( 'file' )['url'] ?? '#' ); ?>"><?php echo esc_html( get_sub_field( 'label_' . ( is_rtl() ? 'ar' : 'en' ) ) ); ?></a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </aside>
            </div>
        </article>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>
