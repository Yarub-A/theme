<?php
/**
 * Footer copy block.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$year = date_i18n( 'Y' );
$name = get_bloginfo( 'name' );

return sprintf(
    '<p class="footer-copy">&copy; %1$s %2$s. %3$s</p>',
    esc_html( $year ),
    esc_html( $name ),
    esc_html__( 'All rights reserved.', 'theme-euss' )
);
