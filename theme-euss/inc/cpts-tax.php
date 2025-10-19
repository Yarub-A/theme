<?php
/**
 * Custom post types and taxonomies.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'theme_euss_register_cpts', 0 );

function theme_euss_register_cpts() {
    $news_labels = [
        'name'                  => __( 'News', 'theme-euss' ),
        'singular_name'         => __( 'News Item', 'theme-euss' ),
        'menu_name'             => __( 'News', 'theme-euss' ),
        'name_admin_bar'        => __( 'News Item', 'theme-euss' ),
        'add_new'               => __( 'Add New', 'theme-euss' ),
        'add_new_item'          => __( 'Add New News', 'theme-euss' ),
        'new_item'              => __( 'New News', 'theme-euss' ),
        'edit_item'             => __( 'Edit News', 'theme-euss' ),
        'view_item'             => __( 'View News', 'theme-euss' ),
        'all_items'             => __( 'All News', 'theme-euss' ),
        'search_items'          => __( 'Search News', 'theme-euss' ),
        'not_found'             => __( 'No news found.', 'theme-euss' ),
        'not_found_in_trash'    => __( 'No news found in Trash.', 'theme-euss' ),
        'featured_image'        => __( 'News Cover Image', 'theme-euss' ),
        'set_featured_image'    => __( 'Set cover image', 'theme-euss' ),
        'remove_featured_image' => __( 'Remove cover image', 'theme-euss' ),
        'use_featured_image'    => __( 'Use as cover image', 'theme-euss' ),
        'archives'              => __( 'News archives', 'theme-euss' ),
    ];

    $news_args = [
        'labels'             => $news_labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-media-document',
        'supports'           => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ],
        'has_archive'        => true,
        'rewrite'            => [ 'slug' => 'news', 'with_front' => false ],
        'show_in_rest'       => true,
        'hierarchical'       => false,
        'show_in_nav_menus'  => true,
        'exclude_from_search'=> false,
    ];

    register_post_type( 'news', $news_args );

    $colleges_labels = [
        'name'                  => __( 'Colleges', 'theme-euss' ),
        'singular_name'         => __( 'College', 'theme-euss' ),
        'menu_name'             => __( 'Colleges', 'theme-euss' ),
        'name_admin_bar'        => __( 'College', 'theme-euss' ),
        'add_new'               => __( 'Add New', 'theme-euss' ),
        'add_new_item'          => __( 'Add New College', 'theme-euss' ),
        'new_item'              => __( 'New College', 'theme-euss' ),
        'edit_item'             => __( 'Edit College', 'theme-euss' ),
        'view_item'             => __( 'View College', 'theme-euss' ),
        'all_items'             => __( 'All Colleges', 'theme-euss' ),
        'search_items'          => __( 'Search Colleges', 'theme-euss' ),
        'not_found'             => __( 'No colleges found.', 'theme-euss' ),
        'not_found_in_trash'    => __( 'No colleges found in Trash.', 'theme-euss' ),
        'featured_image'        => __( 'College Image', 'theme-euss' ),
        'set_featured_image'    => __( 'Set image', 'theme-euss' ),
        'remove_featured_image' => __( 'Remove image', 'theme-euss' ),
        'use_featured_image'    => __( 'Use as image', 'theme-euss' ),
        'archives'              => __( 'College archives', 'theme-euss' ),
    ];

    $colleges_args = [
        'labels'             => $colleges_labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-welcome-learn-more',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ],
        'has_archive'        => true,
        'rewrite'            => [ 'slug' => 'colleges', 'with_front' => false ],
        'show_in_rest'       => true,
        'hierarchical'       => true,
        'show_in_nav_menus'  => true,
        'exclude_from_search'=> false,
    ];

    register_post_type( 'colleges', $colleges_args );
}

add_action( 'init', 'theme_euss_register_taxonomies', 0 );

function theme_euss_register_taxonomies() {
    $departments_labels = [
        'name'          => __( 'Departments', 'theme-euss' ),
        'singular_name' => __( 'Department', 'theme-euss' ),
        'search_items'  => __( 'Search Departments', 'theme-euss' ),
        'all_items'     => __( 'All Departments', 'theme-euss' ),
        'edit_item'     => __( 'Edit Department', 'theme-euss' ),
        'update_item'   => __( 'Update Department', 'theme-euss' ),
        'add_new_item'  => __( 'Add New Department', 'theme-euss' ),
        'new_item_name' => __( 'New Department Name', 'theme-euss' ),
        'menu_name'     => __( 'Departments', 'theme-euss' ),
    ];

    register_taxonomy(
        'departments',
        [ 'colleges' ],
        [
            'hierarchical'      => true,
            'labels'            => $departments_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rewrite'           => [ 'slug' => 'departments' ],
        ]
    );

    $programs_labels = [
        'name'          => __( 'Programs', 'theme-euss' ),
        'singular_name' => __( 'Program', 'theme-euss' ),
        'search_items'  => __( 'Search Programs', 'theme-euss' ),
        'all_items'     => __( 'All Programs', 'theme-euss' ),
        'edit_item'     => __( 'Edit Program', 'theme-euss' ),
        'update_item'   => __( 'Update Program', 'theme-euss' ),
        'add_new_item'  => __( 'Add New Program', 'theme-euss' ),
        'new_item_name' => __( 'New Program Name', 'theme-euss' ),
        'menu_name'     => __( 'Programs', 'theme-euss' ),
    ];

    register_taxonomy(
        'programs',
        [ 'colleges', 'news' ],
        [
            'hierarchical'      => true,
            'labels'            => $programs_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rewrite'           => [ 'slug' => 'programs' ],
        ]
    );
}
