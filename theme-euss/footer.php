<?php
/**
 * Footer template.
 *
 * @package theme-euss
 */
?>
</main>
<footer class="site-footer mt-5">
    <div class="footer-widgets">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 text-white">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    <?php else : ?>
                        <h5 class="text-uppercase fw-bold mb-3"><?php bloginfo( 'name' ); ?></h5>
                        <p><?php esc_html_e( 'Established in Gothenburg, Sweden in 2019/2020, the European University for Smart Sciences delivers blended Arabic, English, and Swedish higher education across research-driven colleges.', 'theme-euss' ); ?><?php // PDF p.2 ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-3 text-white">
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    <?php else : ?>
                        <h6 class="text-uppercase fw-bold mb-3"><?php esc_html_e( 'Quick Links', 'theme-euss' ); ?></h6>
                        <?php
                        wp_nav_menu( [
                            'theme_location' => is_rtl() ? 'footer_ar' : 'footer_en',
                            'container'      => false,
                            'menu_class'     => 'list-unstyled footer-menu',
                            'fallback_cb'    => '__return_empty_string',
                        ] );
                        ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-3 text-white">
                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    <?php else : ?>
                        <h6 class="text-uppercase fw-bold mb-3"><?php esc_html_e( 'Contact', 'theme-euss' ); ?></h6>
                        <ul class="list-unstyled small">
                            <li><?php echo esc_html( get_option( 'euss_contact_address', 'Hildebrandsgatan 5, 41705 Gothenburg, Sweden' ) ); ?><?php // PDF p.24 ?></li>
                            <li><?php echo esc_html( get_option( 'euss_contact_phone', '+46 763091170' ) ); ?><?php // PDF p.24 ?></li>
                            <li><?php echo esc_html( get_option( 'euss_contact_email', 'info@edu.renita.se' ) ); ?><?php // PDF p.24 ?></li>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="col-md-3 text-white">
                    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-4' ); ?>
                    <?php else : ?>
                        <h6 class="text-uppercase fw-bold mb-3"><?php esc_html_e( 'Location', 'theme-euss' ); ?></h6>
                        <div class="ratio ratio-4x3 rounded overflow-hidden">
                            <?php echo wp_kses_post( get_option( 'euss_map_embed', '<iframe src="about:blank" title="EUSS Map" loading="lazy"></iframe>' ) ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <small>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'theme-euss' ); ?></small>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
