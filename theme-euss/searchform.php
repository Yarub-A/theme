<?php
/**
 * Custom search form.
 *
 * @package theme-euss
 */

$unique_id = 'search-form-' . wp_rand( 1000, 9999 );
$placeholder = is_rtl() ? __( 'ابحث في الموقع...', 'theme-euss' ) : __( 'Search the site…', 'theme-euss' );
$button_label = is_rtl() ? __( 'بحث', 'theme-euss' ) : __( 'Search', 'theme-euss' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="visually-hidden" for="<?php echo esc_attr( $unique_id ); ?>"><?php esc_html_e( 'Search for:', 'theme-euss' ); ?></label>
    <input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php echo esc_attr( $placeholder ); ?>" />
    <button type="submit" class="search-submit">
        <span class="search-submit-icon" aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" focusable="false">
                <path d="M10.5 3a7.5 7.5 0 015.94 12.15l4.2 4.21a1 1 0 01-1.42 1.42l-4.2-4.2A7.5 7.5 0 1110.5 3zm0 2a5.5 5.5 0 100 11 5.5 5.5 0 000-11z" fill="currentColor" />
            </svg>
        </span>
        <span class="search-submit-label"><?php echo esc_html( $button_label ); ?></span>
    </button>
</form>
