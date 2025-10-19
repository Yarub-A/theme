<?php
/**
 * Hero template part.
 *
 * @package theme-euss
 */

$hero = theme_euss_get_acf_field( 'hero', [] );
if ( ! is_array( $hero ) ) {
    $hero = [];
}
$lang      = is_rtl() ? 'ar' : 'en';
$title     = $hero[ 'title_' . $lang ] ?? ( 'ar' === $lang ? 'الجامعة الأوروبية للعلوم الذكية' : __( 'European University for Smart Sciences', 'theme-euss' ) ); // PDF p.2
$subtitle_defaults = [
    'ar' => '',
    'en' => '',
];
$subtitle = $hero[ 'subtitle_' . $lang ] ?? $subtitle_defaults[ $lang ];
$cta_label_defaults = [
    'ar' => '', // PDF p.23 optional admissions CTA suppressed by default.
    'en' => '', // PDF p.23 optional admissions CTA suppressed by default.
];
$cta_label = trim( (string) ( $hero[ 'cta_label_' . $lang ] ?? $cta_label_defaults[ $lang ] ) );
$cta_url   = $hero['cta_url'] ?? '';

$image_field = $hero['image'] ?? null;
$image_url   = '';
$image_alt   = '';

if ( is_array( $image_field ) && ! empty( $image_field['url'] ) ) {
    $image_url = $image_field['url'];
    $image_alt = $image_field['alt'] ?? '';
} elseif ( is_numeric( $image_field ) ) {
    $image_data = wp_get_attachment_image_src( (int) $image_field, 'large' );
    if ( $image_data ) {
        $image_url = $image_data[0];
    }
    $image_alt = get_post_meta( (int) $image_field, '_wp_attachment_image_alt', true );
}

if ( empty( $image_url ) ) {
    $image_url = THEME_EUSS_URI . '/assets/img/hero-placeholder.svg';
    $image_alt = get_bloginfo( 'name' );
}

if ( empty( $image_alt ) ) {
    $image_alt = get_bloginfo( 'name' );
}
?>
<section class="hero-section">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-7 text-<?php echo is_rtl() ? 'end' : 'start'; ?>">
<h1 class="display-4 fw-bold mb-4"><?php echo esc_html( $title ); ?></h1>
<?php if ( ! empty( $subtitle ) ) : ?>
<p class="lead mb-4"><?php echo esc_html( $subtitle ); ?></p>
<?php endif; ?>
<?php if ( ! empty( $cta_label ) && ! empty( $cta_url ) ) : ?>
<a class="btn btn-primary btn-lg" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_label ); ?></a>
<?php endif; ?>
</div>
<div class="col-lg-5 text-center">
<img class="img-fluid rounded shadow" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy">
</div>
</div>
</div>
</section>
