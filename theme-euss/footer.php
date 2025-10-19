<?php
/**
 * Footer template.
 *
 * @package theme-euss
 */
?>
</main>
<?php
if ( current_theme_supports( 'block-templates' ) && function_exists( 'block_template_part' ) && file_exists( get_theme_file_path( 'parts/footer.html' ) ) ) {
    block_template_part( 'footer' );
} else {
    get_template_part( 'template-parts/legacy-footer' );
}
wp_footer();
?>
</body>
</html>
