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
    'ar' => 'تأسست الجامعة الأوروبية للعلوم الذكية في غوتنبورغ السويدية عام 2019/2020 برقم التسجيل 559306-7902، لتوفر تعليماً بحثياً حديثاً بثلاث لغات.', // PDF p.2
    'en' => __( 'Founded in Gothenburg, Sweden in 2019/2020 under registration 559306-7902, the European University for Smart Sciences blends research-driven learning in Arabic, English, and Swedish.', 'theme-euss' ), // PDF p.2
];
$subtitle = $hero[ 'subtitle_' . $lang ] ?? $subtitle_defaults[ $lang ];
$cta_label_defaults = [
    'ar' => 'قدّم الآن', // PDF p.23
    'en' => __( 'Apply Now', 'theme-euss' ), // PDF p.23
];
$cta_label = $hero[ 'cta_label_' . $lang ] ?? $cta_label_defaults[ $lang ];
$cta_url   = $hero['cta_url'] ?? '#';
?>
<section class="hero-section">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-7 text-<?php echo is_rtl() ? 'end' : 'start'; ?>">
<h1 class="display-4 fw-bold mb-4"><?php echo esc_html( $title ); ?></h1>
<p class="lead mb-4"><?php echo esc_html( $subtitle ); ?></p>
<a class="btn btn-primary btn-lg" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_label ); ?></a>
</div>
<div class="col-lg-5 text-center">
<img class="img-fluid rounded shadow" src="<?php echo esc_url( THEME_EUSS_URI . '/assets/img/placeholder-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'University campus', 'theme-euss' ); ?>" loading="lazy">
</div>
</div>
</div>
</section>
