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
                            <?php
                            $overview_key = 'overview_' . ( is_rtl() ? 'ar' : 'en' );
                            $overview_fallback = is_rtl()
                                ? 'تدعم هذه الكلية برامج بحثية ومهنية معتمدة ضمن الجامعة الأوروبية للعلوم الذكية، مع التركيز على التعليم المدمج وخدمة المجتمع.' // PDF p.7
                                : __( 'This college delivers accredited research and professional pathways within the European University for Smart Sciences, combining blended learning and community impact.', 'theme-euss' ); // PDF p.7
                            echo wp_kses_post( theme_euss_get_acf_field( $overview_key, $overview_fallback ) );
                            ?>
                        </div>
                    </section>
                    <section class="mb-5">
                        <h2 class="h4 fw-bold"><?php esc_html_e( 'Departments', 'theme-euss' ); ?> <small class="text-muted"><?php esc_html_e( '// PDF p.10', 'theme-euss' ); ?></small></h2>
                        <?php
                        $departments = theme_euss_get_acf_field( 'departments', [] );
                        if ( ! empty( $departments ) ) :
                        ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach ( $departments as $department ) :
                                    $name_key        = 'name_' . ( is_rtl() ? 'ar' : 'en' );
                                    $description_key = 'description_' . ( is_rtl() ? 'ar' : 'en' );
                                    ?>
                                    <li class="list-group-item">
                                        <strong><?php echo esc_html( $department[ $name_key ] ?? '' ); ?></strong>
                                        <p class="mb-0 small text-muted"><?php echo esc_html( $department[ $description_key ] ?? '' ); ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            <p><?php esc_html_e( 'Department details will appear once academic teams populate this profile.', 'theme-euss' ); ?><?php // PDF p.10 ?></p>
                        <?php endif; ?>
                    </section>
                    <section class="mb-5">
                        <h2 class="h4 fw-bold"><?php esc_html_e( 'Programs', 'theme-euss' ); ?> <small class="text-muted"><?php esc_html_e( '// PDF p.8', 'theme-euss' ); ?></small></h2>
                        <?php
                        $programs = theme_euss_get_acf_field( 'programs', [] );
                        if ( ! empty( $programs ) ) :
                        ?>
                            <div class="row g-3">
                                <?php foreach ( $programs as $program ) :
                                    $name_key = 'name_' . ( is_rtl() ? 'ar' : 'en' );
                                    ?>
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <h3 class="h5"><?php echo esc_html( $program[ $name_key ] ?? '' ); ?></h3>
                                            <p class="mb-1"><strong><?php esc_html_e( 'Level', 'theme-euss' ); ?>:</strong> <?php echo esc_html( $program['level'] ?? '' ); ?></p>
                                            <p class="mb-0"><strong><?php esc_html_e( 'Duration', 'theme-euss' ); ?>:</strong> <?php echo esc_html( $program['duration'] ?? '' ); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <p><?php esc_html_e( 'Program information will be listed here with levels and durations.', 'theme-euss' ); ?><?php // PDF p.8 ?></p>
                        <?php endif; ?>
                    </section>
                </div>
                <aside class="col-lg-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="h5 fw-bold"><?php esc_html_e( 'College Contacts', 'theme-euss' ); ?></h3>
                            <p class="mb-1"><strong><?php esc_html_e( 'Dean', 'theme-euss' ); ?>:</strong> <?php echo esc_html( theme_euss_get_acf_field( 'head_of_college', __( 'To be announced', 'theme-euss' ) ) ); ?></p>
                            <p class="mb-1"><?php esc_html_e( 'Phone', 'theme-euss' ); ?>: <?php echo esc_html( theme_euss_get_acf_field( 'contact_phone', '+46 763091170' ) ); ?><?php // PDF p.24 ?></p>
                            <p class="mb-1"><?php esc_html_e( 'Email', 'theme-euss' ); ?>: <?php echo esc_html( theme_euss_get_acf_field( 'contact_email', 'info@edu.renita.se' ) ); ?><?php // PDF p.24 ?></p>
                        </div>
                    </div>
                    <?php
                    $downloads = theme_euss_get_acf_field( 'downloads', [] );
                    if ( ! empty( $downloads ) ) :
                    ?>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h3 class="h5 fw-bold"><?php esc_html_e( 'Downloads', 'theme-euss' ); ?></h3>
                                <ul class="list-unstyled mb-0">
                                    <?php foreach ( $downloads as $download ) :
                                        $label_key = 'label_' . ( is_rtl() ? 'ar' : 'en' );
                                        $file      = $download['file']['url'] ?? '#';
                                        ?>
                                        <li class="mb-2">
                                            <a class="text-decoration-none" href="<?php echo esc_url( $file ); ?>"><?php echo esc_html( $download[ $label_key ] ?? '' ); ?></a>
                                        </li>
                                    <?php endforeach; ?>
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
