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
                    <h5 class="text-uppercase fw-bold mb-3"><?php bloginfo( 'name' ); ?></h5>
                    <p><?php esc_html_e( 'TODO university overview // PDF p.2', 'theme-euss' ); ?></p>
                </div>
                <div class="col-md-3 text-white">
                    <h6 class="text-uppercase fw-bold mb-3"><?php esc_html_e( 'Quick Links', 'theme-euss' ); ?></h6>
                    <?php
                    wp_nav_menu( [
                        'theme_location' => is_rtl() ? 'footer_ar' : 'footer_en',
                        'container'      => false,
                        'menu_class'     => 'list-unstyled footer-menu',
                        'fallback_cb'    => '__return_empty_string',
                    ] );
                    ?>
                </div>
                <div class="col-md-3 text-white">
                    <h6 class="text-uppercase fw-bold mb-3"><?php esc_html_e( 'Contact', 'theme-euss' ); ?></h6>
                    <ul class="list-unstyled small">
                        <li><?php echo esc_html( get_option( 'euss_contact_address', 'TODO address // PDF p.24' ) ); ?></li>
                        <li><?php echo esc_html( get_option( 'euss_contact_phone', 'TODO phone // PDF p.24' ) ); ?></li>
                        <li><?php echo esc_html( get_option( 'euss_contact_email', 'TODO email // PDF p.24' ) ); ?></li>
                    </ul>
                </div>
                <div class="col-md-3 text-white">
                    <h6 class="text-uppercase fw-bold mb-3"><?php esc_html_e( 'Location', 'theme-euss' ); ?></h6>
                    <div class="ratio ratio-4x3 rounded overflow-hidden">
                        <?php echo wp_kses_post( get_option( 'euss_map_embed', '<iframe src="about:blank" title="EUSS Map" loading="lazy"></iframe>' ) ); ?>
                    </div>
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
