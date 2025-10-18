<?php
/**
 * Front page template.
 *
 * @package theme-euss
 */

get_header();
?>
<?php get_template_part( 'template-parts/hero' ); ?>
<?php get_template_part( 'template-parts/news-grid' ); ?>
<?php get_template_part( 'template-parts/events-list' ); ?>
<?php get_template_part( 'template-parts/partners-strip' ); ?>
<?php get_footer(); ?>
