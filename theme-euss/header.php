<?php
/**
 * Header template.
 *
 * @package theme-euss
 */

$theme_euss_direction = function_exists( 'theme_euss_get_direction' ) ? theme_euss_get_direction() : ( is_rtl() ? 'rtl' : 'ltr' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo esc_attr( $theme_euss_direction ); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "<?php echo esc_js( get_bloginfo( 'name' ) ); ?>",
        "url": "<?php echo esc_url( home_url() ); ?>",
        "address": "<?php echo esc_js( get_option( 'euss_contact_address', 'TODO address // PDF p.24' ) ); ?>",
        "telephone": "<?php echo esc_js( get_option( 'euss_contact_phone', 'TODO phone // PDF p.24' ) ); ?>"
    }
    </script>
</head>
<body <?php body_class(); ?>>
<a class="skip-link" href="#primary"><?php esc_html_e( 'Skip to content', 'theme-euss' ); ?></a>
<header class="site-header">
    <div class="top-bar py-2" style="background-color: var(--color-primary);">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="contact-info text-white small">
                    <span class="me-3"><?php esc_html_e( 'Phone:', 'theme-euss' ); ?> <?php echo esc_html( get_option( 'euss_contact_phone', 'TODO phone // PDF p.24' ) ); ?></span>
                    <span><?php esc_html_e( 'Email:', 'theme-euss' ); ?> <?php echo esc_html( get_option( 'euss_contact_email', 'TODO email // PDF p.24' ) ); ?></span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <nav class="top-menu" aria-label="Top menu">
                        <?php
                        wp_nav_menu( [
                            'theme_location' => is_rtl() ? 'top_ar' : 'top_en',
                            'container'      => false,
                            'menu_class'     => 'nav small',
                            'fallback_cb'    => '__return_empty_string',
                        ] );
                        ?>
                    </nav>
                    <div class="language-switcher text-white">
                        <?php theme_euss_language_switcher(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--color-neutral);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    echo '<span class="fw-bold text-uppercase">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
                }
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'theme-euss' ); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainMenu">
                <?php
                wp_nav_menu( [
                    'theme_location' => is_rtl() ? 'main_ar' : 'main_en',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0',
                    'fallback_cb'    => '__return_empty_string',
                ] );
                ?>
            </div>
        </div>
    </nav>
    <div class="offcanvas offcanvas-<?php echo is_rtl() ? 'end' : 'start'; ?> text-bg-dark" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileMenuLabel"><?php esc_html_e( 'Menu', 'theme-euss' ); ?></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="<?php esc_attr_e( 'Close', 'theme-euss' ); ?>"></button>
        </div>
        <div class="offcanvas-body">
            <?php
            wp_nav_menu( [
                'theme_location' => is_rtl() ? 'main_ar' : 'main_en',
                'container'      => false,
                'menu_class'     => 'navbar-nav',
                'fallback_cb'    => '__return_empty_string',
            ] );
            ?>
        </div>
    </div>
</header>
<main id="primary" class="site-main">
