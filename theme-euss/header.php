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
<?php
if ( current_theme_supports( 'block-templates' ) && function_exists( 'block_template_part' ) && file_exists( get_theme_file_path( 'parts/header.html' ) ) ) {
    block_template_part( 'header' );
} else {
    get_template_part( 'template-parts/legacy-header' );
}
?>
<main id="primary" class="site-main">
