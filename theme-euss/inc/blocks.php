<?php
/**
 * Block registration.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action(
    'init',
    static function() {
        $blocks_dir = THEME_EUSS_DIR . '/blocks';
        if ( ! is_dir( $blocks_dir ) ) {
            return;
        }

        $iterator = new DirectoryIterator( $blocks_dir );
        foreach ( $iterator as $entry ) {
            if ( $entry->isDot() || ! $entry->isDir() ) {
                continue;
            }

            $block_path = $entry->getPathname();
            $block_json = $block_path . '/block.json';
            if ( file_exists( $block_json ) ) {
                register_block_type( $block_json );
            }
        }
    }
);

add_filter(
    'block_categories_all',
    static function( $categories ) {
        $categories[] = [
            'slug'  => 'theme-euss',
            'title' => __( 'EUSS Components', 'theme-euss' ),
        ];
        return $categories;
    }
);
