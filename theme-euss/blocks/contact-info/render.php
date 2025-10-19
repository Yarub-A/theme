<?php
/**
 * Contact info dynamic block.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$address = get_option( 'euss_contact_address', 'Hildebrandsgatan 5, 41705 Gothenburg, Sweden' ); // PDF p.24
$phone   = get_option( 'euss_contact_phone', '+46 763091170' ); // PDF p.24
$email   = get_option( 'euss_contact_email', 'info@edu.renita.se' ); // PDF p.24

ob_start();
?>
<ul class="contact-info list-unstyled small">
    <?php if ( ! empty( $address ) ) : ?>
        <li class="contact-info-item contact-address"><?php echo esc_html( $address ); ?></li>
    <?php endif; ?>
    <?php if ( ! empty( $phone ) ) : ?>
        <li class="contact-info-item contact-phone"><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
    <?php endif; ?>
    <?php if ( ! empty( $email ) ) : ?>
        <li class="contact-info-item contact-email"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
    <?php endif; ?>
</ul>
<?php
return ob_get_clean();
