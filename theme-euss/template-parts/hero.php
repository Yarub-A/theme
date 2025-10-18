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
$title     = $hero['title_' . ( is_rtl() ? 'ar' : 'en' ) ] ?? __( 'Welcome to European University for Smart Sciences', 'theme-euss' );
$cta_label = $hero['cta_label_' . ( is_rtl() ? 'ar' : 'en' ) ] ?? __( 'Apply Now', 'theme-euss' );
$cta_url   = $hero['cta_url'] ?? '#';
?>
<section class="hero-section">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-7 text-<?php echo is_rtl() ? 'end' : 'start'; ?>">
<h1 class="display-4 fw-bold mb-4"><?php echo esc_html( $title ); ?></h1>
<p class="lead mb-4"><?php echo esc_html__( 'TODO hero subtitle from PDF // PDF p.2', 'theme-euss' ); ?></p>
<a class="btn btn-primary btn-lg" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_label ); ?></a>
</div>
<div class="col-lg-5 text-center">
<img class="img-fluid rounded shadow" src="<?php echo esc_url( THEME_EUSS_URI . '/assets/img/placeholder-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'University campus', 'theme-euss' ); ?>" loading="lazy">
</div>
</div>
</div>
</section>
