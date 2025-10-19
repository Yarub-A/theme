<?php
/**
 * Server-rendered block: language switcher.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'theme_euss_language_switcher' ) ) {
    ob_start();
    echo '<div class="language-switcher-block">';
    theme_euss_language_switcher( 'block' );
    echo '</div>';
    return ob_get_clean();
}

return '';
