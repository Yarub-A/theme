<?php
/**
 * Legacy PHP header markup used when block template parts are unavailable.
 *
 * @package theme-euss
 */
?>
<header class="site-header legacy-header">
    <div class="top-bar py-2">
        <div class="container">
            <div class="top-bar-layout">
                <div class="top-bar-brand">
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
                <div class="top-bar-tools">
                    <div class="top-bar-search d-none d-lg-flex">
                        <?php get_search_form(); ?>
                    </div>
                    <div class="top-bar-language d-flex align-items-center">
                        <?php
                        if ( function_exists( 'theme_euss_language_switcher' ) ) {
                            theme_euss_language_switcher( 'desktop' );
                        }
                        ?>
                    </div>
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
                        wp_nav_menu(
                            [
                                'theme_location' => $main_menu_location,
                                'container'      => false,
                                'menu_class'     => 'navbar-nav mx-auto mb-2 mb-lg-0',
                                'fallback_cb'    => 'theme_euss_nav_fallback',
                                'walker'         => class_exists( 'Theme_EUSS_Mega_Menu_Walker' ) ? new Theme_EUSS_Mega_Menu_Walker() : null,
                            ]
                        );
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
            wp_nav_menu(
                [
                    'theme_location' => is_rtl() ? 'main_ar' : 'main_en',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav',
                    'fallback_cb'    => 'theme_euss_nav_fallback',
                ]
            );
            ?>
        </div>
    </div>
</header>
