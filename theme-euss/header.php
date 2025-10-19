<?php
/**
 * Header template.
 *
 * @package theme-euss
 */

$theme_euss_direction     = function_exists( 'theme_euss_get_direction' ) ? theme_euss_get_direction() : ( is_rtl() ? 'rtl' : 'ltr' );
$schema_contact_address    = get_option( 'euss_contact_address', 'Hildebrandsgatan 5, 41705 Gothenburg, Sweden' ); // PDF p.24
$schema_contact_phone      = get_option( 'euss_contact_phone', '+46 763091170' ); // PDF p.24
$theme_euss_schema_org_raw = [
    '@context'  => 'https://schema.org',
    '@type'     => 'EducationalOrganization',
    'name'      => get_bloginfo( 'name' ),
    'url'       => home_url(),
    'address'   => $schema_contact_address,
    'telephone' => $schema_contact_phone,
];
$theme_euss_schema_org     = array_filter(
    $theme_euss_schema_org_raw,
    static function ( $value ) {
        if ( is_string( $value ) ) {
            return '' !== trim( $value );
        }
        return null !== $value && false !== $value && '' !== $value;
    }
);
$theme_euss_should_render_schema = ! empty( $theme_euss_schema_org_raw['name'] ) && ! empty( $theme_euss_schema_org_raw['url'] );
?><!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo esc_attr( $theme_euss_direction ); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php if ( $theme_euss_should_render_schema && ! empty( $theme_euss_schema_org ) ) : ?>
        <script type="application/ld+json">
            <?php echo wp_json_encode( $theme_euss_schema_org, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?>
        </script>
    <?php endif; ?>
</head>
<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>
<a class="skip-link" href="#primary"><?php esc_html_e( 'Skip to content', 'theme-euss' ); ?></a>
<header class="site-header">
    <div class="top-bar py-2">
        <div class="container">
            <div class="top-bar-grid">
                <div class="top-bar-logo">
                    <?php
                    if ( has_custom_logo() ) {
                        the_custom_logo();
                    } elseif ( is_active_sidebar( 'header-top-brand' ) ) {
                        dynamic_sidebar( 'header-top-brand' );
                    } else {
                        $placeholder_logo = THEME_EUSS_URI . '/assets/img/logo-placeholder.svg';
                        echo '<a class="site-title-link" href="' . esc_url( home_url( '/' ) ) . '"><img class="placeholder-logo" src="' . esc_url( $placeholder_logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"></a>';
                    }
                    ?>
                </div>
                <div class="top-bar-actions d-none d-lg-flex ms-lg-auto">
                    <div class="top-bar-search">
                        <?php get_search_form(); ?>
                    </div>
                    <?php if ( is_active_sidebar( 'header-top-actions' ) ) : ?>
                        <div class="top-bar-custom">
                            <?php dynamic_sidebar( 'header-top-actions' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( function_exists( 'theme_euss_language_switcher' ) ) : ?>
                        <div class="top-bar-language">
                            <?php theme_euss_language_switcher( 'desktop' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark main-navbar" aria-label="<?php echo esc_attr( is_rtl() ? __( 'التنقل الرئيسي', 'theme-euss' ) : __( 'Main navigation', 'theme-euss' ) ); ?>">
        <div class="container">
            <div class="navbar-inner d-flex align-items-center w-100">
                <div class="navbar-brand-wrapper d-lg-none">
                    <?php
                    if ( has_custom_logo() ) {
                        the_custom_logo();
                    } else {
                        $placeholder_logo = THEME_EUSS_URI . '/assets/img/logo-placeholder.svg';
                        echo '<a class="navbar-brand fw-bold text-uppercase" href="' . esc_url( home_url( '/' ) ) . '"><img class="placeholder-logo" src="' . esc_url( $placeholder_logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"></a>';
                    }
                    ?>
                </div>
                <div class="mobile-controls d-flex align-items-center justify-content-between gap-2 d-lg-none">
                    <?php if ( function_exists( 'theme_euss_language_switcher' ) ) : ?>
                        <div class="mobile-language-switcher">
                            <?php theme_euss_language_switcher( 'mobile' ); ?>
                        </div>
                    <?php endif; ?>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'theme-euss' ); ?>">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-center" id="mainMenu">
                    <?php
                    $main_menu_location = is_rtl() ? 'main_ar' : 'main_en';
                    if ( has_nav_menu( $main_menu_location ) ) {
                        wp_nav_menu( [
                            'theme_location' => $main_menu_location,
                            'container'      => false,
                            'menu_class'     => 'navbar-nav mx-auto mb-2 mb-lg-0',
                            'fallback_cb'    => 'theme_euss_nav_fallback',
                            'walker'         => new Theme_EUSS_Mega_Menu_Walker(),
                        ] );
                    } else {
                        theme_euss_nav_fallback();
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="offcanvas offcanvas-<?php echo is_rtl() ? 'end' : 'start'; ?> text-bg-dark" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileMenuLabel"><?php esc_html_e( 'Menu', 'theme-euss' ); ?></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="<?php esc_attr_e( 'Close', 'theme-euss' ); ?>"></button>
        </div>
        <div class="offcanvas-body">
            <div class="offcanvas-search mb-4">
                <?php get_search_form(); ?>
            </div>
            <?php if ( function_exists( 'theme_euss_language_switcher' ) ) : ?>
                <div class="offcanvas-language mb-4 d-lg-none">
                    <?php theme_euss_language_switcher( 'mobile' ); ?>
                </div>
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'header-top-actions' ) ) : ?>
                <div class="offcanvas-widgets mb-4 d-lg-none">
                    <?php dynamic_sidebar( 'header-top-actions' ); ?>
                </div>
            <?php endif; ?>
            <?php
            wp_nav_menu( [
                'theme_location' => is_rtl() ? 'main_ar' : 'main_en',
                'container'      => false,
                'menu_class'     => 'navbar-nav',
                'fallback_cb'    => 'theme_euss_nav_fallback',
            ] );
            ?>
        </div>
    </div>
</header>
<main id="primary" class="site-main">
