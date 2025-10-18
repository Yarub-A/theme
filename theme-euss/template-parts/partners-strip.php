<?php
/**
 * Partners strip template part.
 *
 * @package theme-euss
 */

$partners = theme_euss_get_acf_field( 'partners', [] );
if ( ! is_array( $partners ) ) {
    $partners = [];
}
?>
<section class="py-5 bg-white">
<div class="container">
<h2 class="h4 text-center mb-4"><?php esc_html_e( 'Strategic Partners', 'theme-euss' ); ?> <small class="text-muted"><?php esc_html_e( '// PDF p.25', 'theme-euss' ); ?></small></h2>
<div class="row g-4 align-items-center text-center">
<?php if ( ! empty( $partners ) ) : ?>
<?php foreach ( $partners as $partner ) : ?>
<div class="col-6 col-md-3">
<?php if ( ! empty( $partner['logo'] ) ) : ?>
<?php echo wp_get_attachment_image( $partner['logo'], 'medium', false, [ 'class' => 'img-fluid', 'loading' => 'lazy' ] ); ?>
<?php else : ?>
<img class="img-fluid" src="<?php echo esc_url( THEME_EUSS_URI . '/assets/img/partner-placeholder.png' ); ?>" alt="<?php esc_attr_e( 'Partner logo', 'theme-euss' ); ?>" loading="lazy">
<?php endif; ?>
<p class="mt-2 mb-0 fw-semibold"><?php echo esc_html( $partner['name_' . ( is_rtl() ? 'ar' : 'en' ) ] ?? __( 'TODO Partner Name', 'theme-euss' ) ); ?></p>
</div>
<?php endforeach; ?>
<?php else : ?>
<div class="col-12">
<p class="text-muted"><?php esc_html_e( 'TODO partners from PDF // PDF p.25', 'theme-euss' ); ?></p>
</div>
<?php endif; ?>
</div>
</div>
</section>
