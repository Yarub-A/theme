<?php
/**
 * Auto-provisioning of content on activation.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'after_switch_theme', 'theme_euss_seed_content' );

function theme_euss_seed_content() {
    theme_euss_disable_discussion_settings();
    theme_euss_create_languages();
    $pages = theme_euss_create_pages();
    theme_euss_create_menus( $pages );
    theme_euss_seed_terms();
    theme_euss_seed_posts();
    theme_euss_seed_options();
}

function theme_euss_disable_discussion_settings() {
    update_option( 'default_comment_status', 'closed' );
    update_option( 'default_ping_status', 'closed' );
}

function theme_euss_create_languages() {
    if ( function_exists( 'pll_register_string' ) && function_exists( 'pll_languages_list' ) ) {
        $languages = pll_languages_list();
        if ( empty( $languages ) ) {
            // Developers should configure languages manually. This placeholder ensures documentation is explicit.
        }
    }
}

function theme_euss_create_pages() {
    $page_tree = [
        'home' => [
            'template'      => 'front-page.php',
            'translations'  => [
                'ar' => [
                    'title'   => 'الرئيسية',
                    'slug'    => 'home-ar',
                    'content' => __( 'TODO homepage Arabic content // PDF p.2', 'theme-euss' ),
                ],
                'en' => [
                    'title'   => 'Home',
                    'slug'    => 'home-en',
                    'content' => __( 'TODO homepage English content // PDF p.2', 'theme-euss' ),
                ],
            ],
        ],
        'admissions' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'القبول والتسجيل',
                    'slug'    => 'admissions-ar',
                    'content' => __( 'TODO admissions overview // PDF p.23', 'theme-euss' ),
                ],
                'en' => [
                    'title'   => 'Admissions',
                    'slug'    => 'admissions',
                    'content' => __( 'TODO admissions overview // PDF p.23', 'theme-euss' ),
                ],
            ],
            'children'    => [
                'admission-requirements' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'شروط القبول',
                            'slug'    => 'admission-requirements-ar',
                            'content' => __( 'TODO admission requirements // PDF p.23', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Admission Requirements',
                            'slug'    => 'admission-requirements',
                            'content' => __( 'TODO admission requirements // PDF p.23', 'theme-euss' ),
                        ],
                    ],
                ],
                'admissions-documents' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الوثائق',
                            'slug'    => 'admissions-documents-ar',
                            'content' => __( 'TODO required documents // PDF p.23', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Required Documents',
                            'slug'    => 'admissions-documents',
                            'content' => __( 'TODO required documents // PDF p.23', 'theme-euss' ),
                        ],
                    ],
                ],
                'admissions-online' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'التقديم الإلكتروني',
                            'slug'    => 'admissions-online-ar',
                            'content' => __( 'TODO online admission details // PDF p.23', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Online Application',
                            'slug'    => 'admissions-online',
                            'content' => __( 'TODO online admission details // PDF p.23', 'theme-euss' ),
                        ],
                    ],
                ],
                'admissions-fees' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الرسوم',
                            'slug'    => 'admissions-fees-ar',
                            'content' => __( 'TODO tuition and fees // PDF p.23', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Tuition & Fees',
                            'slug'    => 'admissions-fees',
                            'content' => __( 'TODO tuition and fees // PDF p.23', 'theme-euss' ),
                        ],
                    ],
                ],
                'admissions-faq' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الأسئلة الشائعة',
                            'slug'    => 'admissions-faq-ar',
                            'content' => __( 'TODO admissions FAQ // PDF p.23', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Admissions FAQ',
                            'slug'    => 'admissions-faq',
                            'content' => __( 'TODO admissions FAQ // PDF p.23', 'theme-euss' ),
                        ],
                    ],
                ],
            ],
        ],
        'academics' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'البرامج الأكاديمية',
                    'slug'    => 'academics-ar',
                    'content' => __( 'TODO academic overview // PDF p.8', 'theme-euss' ),
                ],
                'en' => [
                    'title'   => 'Academics',
                    'slug'    => 'academics',
                    'content' => __( 'TODO academic overview // PDF p.8', 'theme-euss' ),
                ],
            ],
            'children'    => [
                'academics-preparatory' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'المسارات التأهيلية',
                            'slug'    => 'academics-preparatory-ar',
                            'content' => __( 'TODO preparatory tracks // PDF p.8', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Preparatory Tracks',
                            'slug'    => 'academics-preparatory',
                            'content' => __( 'TODO preparatory tracks // PDF p.8', 'theme-euss' ),
                        ],
                    ],
                ],
                'academics-undergraduate' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'البكالوريوس',
                            'slug'    => 'academics-undergraduate-ar',
                            'content' => __( 'TODO undergraduate programs // PDF p.8', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Undergraduate',
                            'slug'    => 'academics-undergraduate',
                            'content' => __( 'TODO undergraduate programs // PDF p.8', 'theme-euss' ),
                        ],
                    ],
                ],
                'academics-graduate' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الدراسات العليا',
                            'slug'    => 'academics-graduate-ar',
                            'content' => __( 'TODO graduate programs // PDF p.9', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Graduate Studies',
                            'slug'    => 'academics-graduate',
                            'content' => __( 'TODO graduate programs // PDF p.9', 'theme-euss' ),
                        ],
                    ],
                ],
                'academics-postdoc' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'ما بعد الدكتوراه',
                            'slug'    => 'academics-postdoc-ar',
                            'content' => __( 'TODO postdoctoral programs // PDF p.9', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Postdoctoral',
                            'slug'    => 'academics-postdoc',
                            'content' => __( 'TODO postdoctoral programs // PDF p.9', 'theme-euss' ),
                        ],
                    ],
                ],
                'academics-professional' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الدورات المهنية',
                            'slug'    => 'academics-professional-ar',
                            'content' => __( 'TODO professional courses // PDF p.9', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Professional Courses',
                            'slug'    => 'academics-professional',
                            'content' => __( 'TODO professional courses // PDF p.9', 'theme-euss' ),
                        ],
                    ],
                ],
            ],
        ],
        'colleges' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'الكليات',
                    'slug'    => 'colleges-ar',
                    'content' => __( 'TODO colleges overview // PDF p.7', 'theme-euss' ),
                ],
                'en' => [
                    'title'   => 'Colleges',
                    'slug'    => 'colleges',
                    'content' => __( 'TODO colleges overview // PDF p.7', 'theme-euss' ),
                ],
            ],
        ],
        'research' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'البحث العلمي',
                    'slug'    => 'research-ar',
                    'content' => __( 'TODO research overview // PDF p.18', 'theme-euss' ),
                ],
                'en' => [
                    'title'   => 'Research',
                    'slug'    => 'research',
                    'content' => __( 'TODO research overview // PDF p.18', 'theme-euss' ),
                ],
            ],
            'children'    => [
                'research-twinning' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'اتفاقيات التوأمة',
                            'slug'    => 'research-twinning-ar',
                            'content' => __( 'TODO twinning agreements // PDF p.21', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Twinning Agreements',
                            'slug'    => 'research-twinning',
                            'content' => __( 'TODO twinning agreements // PDF p.21', 'theme-euss' ),
                        ],
                    ],
                ],
                'research-outcomes' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'المخرجات البحثية',
                            'slug'    => 'research-outcomes-ar',
                            'content' => __( 'TODO research outcomes // PDF p.18', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Research Outcomes',
                            'slug'    => 'research-outcomes',
                            'content' => __( 'TODO research outcomes // PDF p.18', 'theme-euss' ),
                        ],
                    ],
                ],
                'research-journals' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'المجلات العلمية',
                            'slug'    => 'research-journals-ar',
                            'content' => __( 'TODO scientific journals // PDF p.18', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Scientific Journals',
                            'slug'    => 'research-journals',
                            'content' => __( 'TODO scientific journals // PDF p.18', 'theme-euss' ),
                        ],
                    ],
                ],
            ],
        ],
        'about' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'عن الجامعة',
                    'slug'    => 'about-ar',
                    'content' => __( 'TODO about overview // PDF p.2', 'theme-euss' ),
                ],
                'en' => [
                    'title'   => 'About',
                    'slug'    => 'about',
                    'content' => __( 'TODO about overview // PDF p.2', 'theme-euss' ),
                ],
            ],
            'children'    => [
                'about-mission' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الرسالة',
                            'slug'    => 'about-mission-ar',
                            'content' => __( 'TODO mission statement // PDF p.4', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Mission',
                            'slug'    => 'about-mission',
                            'content' => __( 'TODO mission statement // PDF p.4', 'theme-euss' ),
                        ],
                    ],
                ],
                'about-vision' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الرؤية',
                            'slug'    => 'about-vision-ar',
                            'content' => __( 'TODO vision statement // PDF p.4', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Vision',
                            'slug'    => 'about-vision',
                            'content' => __( 'TODO vision statement // PDF p.4', 'theme-euss' ),
                        ],
                    ],
                ],
                'about-structure' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الهيكل التنظيمي',
                            'slug'    => 'about-structure-ar',
                            'content' => __( 'TODO organizational structure // PDF p.4', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Organizational Structure',
                            'slug'    => 'about-structure',
                            'content' => __( 'TODO organizational structure // PDF p.4', 'theme-euss' ),
                        ],
                    ],
                ],
                'about-centers' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'المراكز التابعة',
                            'slug'    => 'about-centers-ar',
                            'content' => __( 'TODO affiliated centers // PDF p.21', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Affiliated Centers',
                            'slug'    => 'about-centers',
                            'content' => __( 'TODO affiliated centers // PDF p.21', 'theme-euss' ),
                        ],
                    ],
                ],
                'about-faculty' => [
                    'template'     => 'page.php',
                    'translations' => [
                        'ar' => [
                            'title'   => 'الكادر التدريسي',
                            'slug'    => 'about-faculty-ar',
                            'content' => __( 'TODO faculty staff // PDF p.22', 'theme-euss' ),
                        ],
                        'en' => [
                            'title'   => 'Faculty & Staff',
                            'slug'    => 'about-faculty',
                            'content' => __( 'TODO faculty staff // PDF p.22', 'theme-euss' ),
                        ],
                    ],
                ],
            ],
        ],
        'news-events' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'الأخبار والفعاليات',
                    'slug'    => 'news-events-ar',
                    'content' => __( 'TODO news overview // PDF p.18', 'theme-euss' ),
                ],
                'en' => [
                    'title'   => 'News & Events',
                    'slug'    => 'news-events',
                    'content' => __( 'TODO news overview // PDF p.18', 'theme-euss' ),
                ],
            ],
        ],
        'contact' => [
            'template'     => 'page.php',
            'translations' => [
                'ar' => [
                    'title'   => 'الاتصال بنا',
                    'slug'    => 'contact-ar',
                    'content' => __( 'TODO contact details // PDF p.24', 'theme-euss' ),
                ],
                'en' => [
                    'title'   => 'Contact',
                    'slug'    => 'contact',
                    'content' => __( 'TODO contact details // PDF p.24', 'theme-euss' ),
                ],
            ],
        ],
    ];

    $flat_pages = [];
    theme_euss_create_page_branch( $page_tree, [], $flat_pages );

    return $flat_pages;
}

function theme_euss_create_page_branch( array $nodes, array $parent_ids, array &$flat ) {
    foreach ( $nodes as $key => $node ) {
        $translations = $node['translations'];
        $created_ids  = [];

        foreach ( $translations as $lang => $data ) {
            $parent_id = $parent_ids[ $lang ] ?? 0;
            $created_ids[ $lang ] = theme_euss_upsert_page( $data, $node['template'], $parent_id );

            if ( function_exists( 'pll_set_post_language' ) ) {
                pll_set_post_language( $created_ids[ $lang ], $lang );
            }
        }

        if ( function_exists( 'pll_save_post_translations' ) && count( $created_ids ) > 1 ) {
            pll_save_post_translations( $created_ids );
        }

        $flat[ $key ] = $created_ids;

        if ( ! empty( $node['children'] ) ) {
            theme_euss_create_page_branch( $node['children'], $created_ids, $flat );
        }
    }
}

function theme_euss_upsert_page( array $page_data, $template, $parent_id = 0 ) {
    $defaults = [
        'title'   => __( 'Untitled Page', 'theme-euss' ),
        'slug'    => wp_unique_post_slug( uniqid( 'page-' ), 0, 'publish', 'page', 0 ),
        'content' => __( 'TODO content from PDF', 'theme-euss' ),
    ];

    $page_data = wp_parse_args( $page_data, $defaults );
    $existing  = get_page_by_path( $page_data['slug'] );

    if ( $existing ) {
        $update = [ 'ID' => $existing->ID ];
        $needs_update = false;

        if ( $existing->post_title !== $page_data['title'] ) {
            $update['post_title'] = $page_data['title'];
            $needs_update         = true;
        }

        if ( (int) $existing->post_parent !== (int) $parent_id ) {
            $update['post_parent'] = $parent_id;
            $needs_update          = true;
        }

        if ( $needs_update ) {
            wp_update_post( $update );
        }

        $page_id = $existing->ID;
    } else {
        $page_id = wp_insert_post( [
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_title'   => $page_data['title'],
            'post_name'    => $page_data['slug'],
            'post_parent'  => $parent_id,
            'post_content' => $page_data['content'],
        ] );
    }

    if ( $template ) {
        update_post_meta( $page_id, '_wp_page_template', $template );
    }

    return $page_id;
}

function theme_euss_create_menus( $pages ) {
    $locations = [
        'main_ar'   => 'main_ar',
        'main_en'   => 'main_en',
        'top_ar'    => 'top_ar',
        'top_en'    => 'top_en',
        'footer_ar' => 'footer_ar',
        'footer_en' => 'footer_en',
    ];

    $menus = [];
    foreach ( $locations as $location => $key ) {
        $menu = wp_get_nav_menu_object( $key );
        if ( ! $menu ) {
            $menu_id = wp_create_nav_menu( $key );
        } else {
            $menu_id = $menu->term_id;
        }
        $menus[ $location ] = $menu_id;
    }

    $menu_structure = [
        'main_ar' => [
            [ 'key' => 'home' ],
            [
                'key'      => 'admissions',
                'children' => [ 'admission-requirements', 'admissions-documents', 'admissions-online', 'admissions-fees', 'admissions-faq' ],
            ],
            [
                'key'      => 'academics',
                'children' => [ 'academics-preparatory', 'academics-undergraduate', 'academics-graduate', 'academics-postdoc', 'academics-professional' ],
            ],
            [ 'key' => 'colleges' ],
            [
                'key'      => 'research',
                'children' => [ 'research-twinning', 'research-outcomes', 'research-journals' ],
            ],
            [
                'key'      => 'about',
                'children' => [ 'about-mission', 'about-vision', 'about-structure', 'about-centers', 'about-faculty' ],
            ],
            [ 'key' => 'news-events' ],
            [ 'key' => 'contact' ],
        ],
        'main_en' => [
            [ 'key' => 'home' ],
            [
                'key'      => 'admissions',
                'children' => [ 'admission-requirements', 'admissions-documents', 'admissions-online', 'admissions-fees', 'admissions-faq' ],
            ],
            [
                'key'      => 'academics',
                'children' => [ 'academics-preparatory', 'academics-undergraduate', 'academics-graduate', 'academics-postdoc', 'academics-professional' ],
            ],
            [ 'key' => 'colleges' ],
            [
                'key'      => 'research',
                'children' => [ 'research-twinning', 'research-outcomes', 'research-journals' ],
            ],
            [
                'key'      => 'about',
                'children' => [ 'about-mission', 'about-vision', 'about-structure', 'about-centers', 'about-faculty' ],
            ],
            [ 'key' => 'news-events' ],
            [ 'key' => 'contact' ],
        ],
        'top_ar'    => [ [ 'key' => 'contact' ] ],
        'top_en'    => [ [ 'key' => 'contact' ] ],
        'footer_ar' => [ [ 'key' => 'home' ], [ 'key' => 'admissions' ], [ 'key' => 'academics' ] ],
        'footer_en' => [ [ 'key' => 'home' ], [ 'key' => 'admissions' ], [ 'key' => 'academics' ] ],
    ];

    foreach ( $menu_structure as $location => $items ) {
        $lang        = str_contains( $location, '_ar' ) ? 'ar' : 'en';
        $menu_id     = $menus[ $location ];
        $existing    = wp_get_nav_menu_items( $menu_id, [ 'post_status' => 'any' ] );
        $existing_map = [];

        if ( $existing ) {
            foreach ( $existing as $menu_item ) {
                $key = $menu_item->object_id . ':' . (int) $menu_item->menu_item_parent;
                $existing_map[ $key ] = (int) $menu_item->ID;
            }
        }

        theme_euss_sync_menu_branch( $items, $pages, $menu_id, $lang, 0, $existing_map );
    }

    set_theme_mod( 'nav_menu_locations', [
        'main_ar'   => $menus['main_ar'],
        'main_en'   => $menus['main_en'],
        'top_ar'    => $menus['top_ar'],
        'top_en'    => $menus['top_en'],
        'footer_ar' => $menus['footer_ar'],
        'footer_en' => $menus['footer_en'],
    ] );
}

function theme_euss_sync_menu_branch( array $items, array $pages, $menu_id, $lang, $parent_item_id = 0, array &$existing_map = [] ) {
    foreach ( $items as $item ) {
        if ( empty( $item['key'] ) || empty( $pages[ $item['key'] ][ $lang ] ) ) {
            continue;
        }

        $object_id = (int) $pages[ $item['key'] ][ $lang ];
        $map_key   = $object_id . ':' . (int) $parent_item_id;

        if ( isset( $existing_map[ $map_key ] ) ) {
            $menu_item_id = $existing_map[ $map_key ];
        } else {
            $menu_item_id = wp_update_nav_menu_item(
                $menu_id,
                0,
                [
                    'menu-item-title'     => get_the_title( $object_id ),
                    'menu-item-object'    => 'page',
                    'menu-item-type'      => 'post_type',
                    'menu-item-object-id' => $object_id,
                    'menu-item-status'    => 'publish',
                    'menu-item-parent-id' => $parent_item_id,
                ]
            );

            $existing_map[ $map_key ] = (int) $menu_item_id;
        }

        if ( ! empty( $item['children'] ) ) {
            theme_euss_sync_menu_branch( $item['children'], $pages, $menu_id, $lang, $menu_item_id, $existing_map );
        }
    }
}

function theme_euss_seed_terms() {
    $departments = [ 'TODO Department 1 // PDF p.10', 'TODO Department 2 // PDF p.11' ];
    foreach ( $departments as $department ) {
        if ( ! term_exists( $department, 'departments' ) ) {
            wp_insert_term( $department, 'departments' );
        }
    }

    $programs = [ 'TODO Program 1 // PDF p.8', 'TODO Program 2 // PDF p.9' ];
    foreach ( $programs as $program ) {
        if ( ! term_exists( $program, 'programs' ) ) {
            wp_insert_term( $program, 'programs' );
        }
    }
}

function theme_euss_seed_posts() {
    $news_exists = get_posts( [ 'post_type' => 'news', 'numberposts' => 1 ] );
    if ( empty( $news_exists ) ) {
        $news_id = wp_insert_post( [
            'post_type'    => 'news',
            'post_status'  => 'publish',
            'post_title'   => __( 'TODO First News', 'theme-euss' ), // PDF p.18
            'post_content' => __( 'TODO news content from PDF.', 'theme-euss' ),
        ] );
        if ( function_exists( 'pll_set_post_language' ) ) {
            pll_set_post_language( $news_id, 'ar' );
        }
    }

    $college_exists = get_posts( [ 'post_type' => 'colleges', 'numberposts' => 1 ] );
    if ( empty( $college_exists ) ) {
        $college_id = wp_insert_post( [
            'post_type'    => 'colleges',
            'post_status'  => 'publish',
            'post_title'   => __( 'TODO College Name', 'theme-euss' ), // PDF p.7
            'post_content' => __( 'TODO college description from PDF.', 'theme-euss' ),
        ] );
        if ( function_exists( 'pll_set_post_language' ) ) {
            pll_set_post_language( $college_id, 'ar' );
        }
    }
}

function theme_euss_seed_options() {
    update_option( 'euss_contact_phone', 'TODO phone from PDF // PDF p.24' );
    update_option( 'euss_contact_email', 'TODO email from PDF // PDF p.24' );
    update_option( 'euss_contact_address', 'TODO address from PDF // PDF p.24' );
}
