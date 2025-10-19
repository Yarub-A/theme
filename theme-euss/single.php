<?php
/**
 * Single post template.
 *
 * @package theme-euss
 */

get_header();
?>
<div class="container py-5">
    <?php theme_euss_breadcrumbs(); ?>
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>
<?php get_footer(); ?>
