<?php
/**
 * ACF field registrations.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( [
        'page_title' => __( 'EUSS Options', 'theme-euss' ),
        'menu_title' => __( 'EUSS Options', 'theme-euss' ),
        'menu_slug'  => 'euss-options',
        'capability' => 'manage_options',
        'redirect'   => false,
    ] );
}

if ( function_exists( 'acf_add_local_field_group' ) ) {
    acf_add_local_field_group( [
        'key'    => 'group_euss_options',
        'title'  => __( 'EUSS Global Options', 'theme-euss' ),
        'fields' => [
            [
                'key'   => 'field_euss_university_name_ar',
                'label' => __( 'University Name (AR)', 'theme-euss' ),
                'name'  => 'university_name_ar',
                'type'  => 'text',
                'default_value' => 'الجامعة الأوروبية للعلوم الذكية', // PDF p.2
                'instructions'  => ' // PDF p.2',
            ],
            [
                'key'   => 'field_euss_university_name_en',
                'label' => __( 'University Name (EN)', 'theme-euss' ),
                'name'  => 'university_name_en',
                'type'  => 'text',
                'default_value' => 'European University for Smart Sciences', // PDF p.2
                'instructions'  => ' // PDF p.2',
            ],
            [
                'key'   => 'field_euss_address_ar',
                'label' => __( 'Address (AR)', 'theme-euss' ),
                'name'  => 'address_ar',
                'type'  => 'textarea',
                'default_value' => '5 هيلدبراندسغاتان، 41705 غوتنبورغ، السويد', // PDF p.24
                'instructions'  => ' // PDF p.24',
            ],
            [
                'key'   => 'field_euss_address_en',
                'label' => __( 'Address (EN)', 'theme-euss' ),
                'name'  => 'address_en',
                'type'  => 'textarea',
                'default_value' => 'Hildebrandsgatan 5, 41705 Gothenburg, Sweden', // PDF p.24
                'instructions'  => ' // PDF p.24',
            ],
            [
                'key'   => 'field_euss_phone',
                'label' => __( 'Phone', 'theme-euss' ),
                'name'  => 'phone',
                'type'  => 'text',
                'default_value' => '+46 763091170', // PDF p.24
                'instructions'  => ' // PDF p.24',
            ],
            [
                'key'   => 'field_euss_email',
                'label' => __( 'Email', 'theme-euss' ),
                'name'  => 'email',
                'type'  => 'email',
                'default_value' => 'info@edu.renita.se', // PDF p.24
                'instructions'  => ' // PDF p.24',
            ],
            [
                'key'   => 'field_euss_map_embed',
                'label' => __( 'Map Embed', 'theme-euss' ),
                'name'  => 'map_embed',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'field_euss_social_links',
                'label' => __( 'Social Links', 'theme-euss' ),
                'name'  => 'social_links',
                'type'  => 'repeater',
                'button_label' => __( 'Add Social Link', 'theme-euss' ),
                'sub_fields'   => [
                    [
                        'key'   => 'field_euss_social_label',
                        'label' => __( 'Label', 'theme-euss' ),
                        'name'  => 'label',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_social_url',
                        'label' => __( 'URL', 'theme-euss' ),
                        'name'  => 'url',
                        'type'  => 'url',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'euss-options',
                ],
            ],
        ],
    ] );

    acf_add_local_field_group( [
        'key'    => 'group_euss_homepage',
        'title'  => __( 'Homepage Sections', 'theme-euss' ),
        'fields' => [
            [
                'key'   => 'field_euss_hero',
                'label' => __( 'Hero', 'theme-euss' ),
                'name'  => 'hero',
                'type'  => 'group',
                'sub_fields' => [
                    [
                        'key'   => 'field_euss_hero_title_ar',
                        'label' => __( 'Title (AR)', 'theme-euss' ),
                        'name'  => 'title_ar',
                        'type'  => 'text',
                        'default_value' => 'الجامعة الأوروبية للعلوم الذكية', // PDF p.2
                        'instructions'  => ' // PDF p.2',
                    ],
                    [
                        'key'   => 'field_euss_hero_title_en',
                        'label' => __( 'Title (EN)', 'theme-euss' ),
                        'name'  => 'title_en',
                        'type'  => 'text',
                        'default_value' => 'European University for Smart Sciences', // PDF p.2
                        'instructions'  => ' // PDF p.2',
                    ],
                    [
                        'key'   => 'field_euss_hero_subtitle_ar',
                        'label' => __( 'Subtitle (AR)', 'theme-euss' ),
                        'name'  => 'subtitle_ar',
                        'type'  => 'textarea',
                        'default_value' => 'تأسست الجامعة الأوروبية للعلوم الذكية في غوتنبورغ السويدية عام 2019/2020 برقم التسجيل 559306-7902، لتوفر تعليماً بحثياً حديثاً بثلاث لغات.', // PDF p.2
                        'instructions'  => ' // PDF p.2',
                    ],
                    [
                        'key'   => 'field_euss_hero_subtitle_en',
                        'label' => __( 'Subtitle (EN)', 'theme-euss' ),
                        'name'  => 'subtitle_en',
                        'type'  => 'textarea',
                        'default_value' => 'Founded in Gothenburg, Sweden in 2019/2020 under registration 559306-7902, the European University for Smart Sciences blends research-driven learning in Arabic, English, and Swedish.', // PDF p.2
                        'instructions'  => ' // PDF p.2',
                    ],
                    [
                        'key'   => 'field_euss_hero_cta_label_ar',
                        'label' => __( 'CTA Label (AR)', 'theme-euss' ),
                        'name'  => 'cta_label_ar',
                        'type'  => 'text',
                        'default_value' => 'قدّم الآن', // PDF p.23
                        'instructions'  => ' // PDF p.23',
                    ],
                    [
                        'key'   => 'field_euss_hero_cta_label_en',
                        'label' => __( 'CTA Label (EN)', 'theme-euss' ),
                        'name'  => 'cta_label_en',
                        'type'  => 'text',
                        'default_value' => 'Apply Now', // PDF p.23
                        'instructions'  => ' // PDF p.23',
                    ],
                    [
                        'key'   => 'field_euss_hero_cta_url',
                        'label' => __( 'CTA URL', 'theme-euss' ),
                        'name'  => 'cta_url',
                        'type'  => 'url',
                    ],
                ],
            ],
            [
                'key'   => 'field_euss_stats',
                'label' => __( 'Stats', 'theme-euss' ),
                'name'  => 'stats',
                'type'  => 'repeater',
                'button_label' => __( 'Add Stat', 'theme-euss' ),
                'sub_fields'   => [
                    [
                        'key'   => 'field_euss_stats_label_ar',
                        'label' => __( 'Label (AR)', 'theme-euss' ),
                        'name'  => 'label_ar',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_stats_label_en',
                        'label' => __( 'Label (EN)', 'theme-euss' ),
                        'name'  => 'label_en',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_stats_value',
                        'label' => __( 'Value', 'theme-euss' ),
                        'name'  => 'value',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_stats_icon',
                        'label' => __( 'Icon Class', 'theme-euss' ),
                        'name'  => 'icon',
                        'type'  => 'text',
                    ],
                ],
            ],
            [
                'key'   => 'field_euss_partners',
                'label' => __( 'Partners', 'theme-euss' ),
                'name'  => 'partners',
                'type'  => 'repeater',
                'button_label' => __( 'Add Partner', 'theme-euss' ),
                'sub_fields'   => [
                    [
                        'key'   => 'field_euss_partner_name_ar',
                        'label' => __( 'Name (AR)', 'theme-euss' ),
                        'name'  => 'name_ar',
                        'type'  => 'text',
                        'instructions' => ' // PDF p.25',
                    ],
                    [
                        'key'   => 'field_euss_partner_name_en',
                        'label' => __( 'Name (EN)', 'theme-euss' ),
                        'name'  => 'name_en',
                        'type'  => 'text',
                        'instructions' => ' // PDF p.25',
                    ],
                    [
                        'key'   => 'field_euss_partner_logo',
                        'label' => __( 'Logo', 'theme-euss' ),
                        'name'  => 'logo',
                        'type'  => 'image',
                    ],
                    [
                        'key'   => 'field_euss_partner_url',
                        'label' => __( 'URL', 'theme-euss' ),
                        'name'  => 'url',
                        'type'  => 'url',
                    ],
                ],
            ],
            [
                'key'   => 'field_euss_announcements',
                'label' => __( 'Announcements', 'theme-euss' ),
                'name'  => 'announcements',
                'type'  => 'repeater',
                'button_label' => __( 'Add Announcement', 'theme-euss' ),
                'sub_fields'   => [
                    [
                        'key'   => 'field_euss_announcement_title',
                        'label' => __( 'Title', 'theme-euss' ),
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_announcement_date',
                        'label' => __( 'Date', 'theme-euss' ),
                        'name'  => 'date',
                        'type'  => 'date_picker',
                    ],
                    [
                        'key'   => 'field_euss_announcement_link',
                        'label' => __( 'Link', 'theme-euss' ),
                        'name'  => 'link',
                        'type'  => 'url',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'front-page.php',
                ],
            ],
        ],
    ] );

    acf_add_local_field_group( [
        'key'    => 'group_euss_colleges',
        'title'  => __( 'College Details', 'theme-euss' ),
        'fields' => [
            [
                'key'   => 'field_euss_college_overview_ar',
                'label' => __( 'Overview (AR)', 'theme-euss' ),
                'name'  => 'overview_ar',
                'type'  => 'wysiwyg',
                'instructions' => ' // PDF p.7',
            ],
            [
                'key'   => 'field_euss_college_overview_en',
                'label' => __( 'Overview (EN)', 'theme-euss' ),
                'name'  => 'overview_en',
                'type'  => 'wysiwyg',
                'instructions' => ' // PDF p.7',
            ],
            [
                'key'   => 'field_euss_college_head',
                'label' => __( 'Head of College', 'theme-euss' ),
                'name'  => 'head_of_college',
                'type'  => 'text',
                'instructions' => ' // PDF p.7',
            ],
            [
                'key'   => 'field_euss_college_contact_email',
                'label' => __( 'Contact Email', 'theme-euss' ),
                'name'  => 'contact_email',
                'type'  => 'email',
            ],
            [
                'key'   => 'field_euss_college_contact_phone',
                'label' => __( 'Contact Phone', 'theme-euss' ),
                'name'  => 'contact_phone',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_euss_college_departments',
                'label' => __( 'Departments', 'theme-euss' ),
                'name'  => 'departments',
                'type'  => 'repeater',
                'button_label' => __( 'Add Department', 'theme-euss' ),
                'sub_fields'   => [
                    [
                        'key'   => 'field_euss_college_department_name_ar',
                        'label' => __( 'Name (AR)', 'theme-euss' ),
                        'name'  => 'name_ar',
                        'type'  => 'text',
                        'instructions' => ' // PDF p.10',
                    ],
                    [
                        'key'   => 'field_euss_college_department_name_en',
                        'label' => __( 'Name (EN)', 'theme-euss' ),
                        'name'  => 'name_en',
                        'type'  => 'text',
                        'instructions' => ' // PDF p.10',
                    ],
                    [
                        'key'   => 'field_euss_college_department_description_ar',
                        'label' => __( 'Description (AR)', 'theme-euss' ),
                        'name'  => 'description_ar',
                        'type'  => 'textarea',
                    ],
                    [
                        'key'   => 'field_euss_college_department_description_en',
                        'label' => __( 'Description (EN)', 'theme-euss' ),
                        'name'  => 'description_en',
                        'type'  => 'textarea',
                    ],
                ],
            ],
            [
                'key'   => 'field_euss_college_programs',
                'label' => __( 'Programs', 'theme-euss' ),
                'name'  => 'programs',
                'type'  => 'repeater',
                'button_label' => __( 'Add Program', 'theme-euss' ),
                'sub_fields'   => [
                    [
                        'key'   => 'field_euss_college_program_name_ar',
                        'label' => __( 'Name (AR)', 'theme-euss' ),
                        'name'  => 'name_ar',
                        'type'  => 'text',
                        'instructions' => ' // PDF p.8',
                    ],
                    [
                        'key'   => 'field_euss_college_program_name_en',
                        'label' => __( 'Name (EN)', 'theme-euss' ),
                        'name'  => 'name_en',
                        'type'  => 'text',
                        'instructions' => ' // PDF p.8',
                    ],
                    [
                        'key'   => 'field_euss_college_program_level',
                        'label' => __( 'Level', 'theme-euss' ),
                        'name'  => 'level',
                        'type'  => 'select',
                        'choices' => [
                            'prep'       => __( 'Preparatory', 'theme-euss' ),
                            'bachelor'   => __( 'Bachelor', 'theme-euss' ),
                            'graduate'   => __( 'Graduate', 'theme-euss' ),
                            'postdoc'    => __( 'Post-Doctorate', 'theme-euss' ),
                            'professional'=> __( 'Professional', 'theme-euss' ),
                        ],
                    ],
                    [
                        'key'   => 'field_euss_college_program_duration',
                        'label' => __( 'Duration', 'theme-euss' ),
                        'name'  => 'duration',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_college_program_brochure',
                        'label' => __( 'Brochure', 'theme-euss' ),
                        'name'  => 'brochure',
                        'type'  => 'file',
                    ],
                ],
            ],
            [
                'key'   => 'field_euss_college_staff',
                'label' => __( 'Staff', 'theme-euss' ),
                'name'  => 'staff',
                'type'  => 'repeater',
                'button_label' => __( 'Add Staff Member', 'theme-euss' ),
                'sub_fields'   => [
                    [
                        'key'   => 'field_euss_staff_name',
                        'label' => __( 'Name', 'theme-euss' ),
                        'name'  => 'name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_staff_role',
                        'label' => __( 'Role', 'theme-euss' ),
                        'name'  => 'role',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_staff_photo',
                        'label' => __( 'Photo', 'theme-euss' ),
                        'name'  => 'photo',
                        'type'  => 'image',
                    ],
                    [
                        'key'   => 'field_euss_staff_bio_ar',
                        'label' => __( 'Bio (AR)', 'theme-euss' ),
                        'name'  => 'bio_ar',
                        'type'  => 'textarea',
                    ],
                    [
                        'key'   => 'field_euss_staff_bio_en',
                        'label' => __( 'Bio (EN)', 'theme-euss' ),
                        'name'  => 'bio_en',
                        'type'  => 'textarea',
                    ],
                ],
            ],
            [
                'key'   => 'field_euss_college_downloads',
                'label' => __( 'Downloads', 'theme-euss' ),
                'name'  => 'downloads',
                'type'  => 'repeater',
                'button_label' => __( 'Add Download', 'theme-euss' ),
                'sub_fields'   => [
                    [
                        'key'   => 'field_euss_download_label_ar',
                        'label' => __( 'Label (AR)', 'theme-euss' ),
                        'name'  => 'label_ar',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_download_label_en',
                        'label' => __( 'Label (EN)', 'theme-euss' ),
                        'name'  => 'label_en',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_download_file',
                        'label' => __( 'File', 'theme-euss' ),
                        'name'  => 'file',
                        'type'  => 'file',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'colleges',
                ],
            ],
        ],
    ] );

    acf_add_local_field_group( [
        'key'    => 'group_euss_research',
        'title'  => __( 'Research & Twinning', 'theme-euss' ),
        'fields' => [
            [
                'key'   => 'field_euss_research_partners',
                'label' => __( 'Research Partners', 'theme-euss' ),
                'name'  => 'research_partners',
                'type'  => 'repeater',
                'button_label' => __( 'Add Research Partner', 'theme-euss' ),
                'sub_fields'   => [
                    [
                        'key'   => 'field_euss_research_partner_name_ar',
                        'label' => __( 'Name (AR)', 'theme-euss' ),
                        'name'  => 'name_ar',
                        'type'  => 'text',
                        'instructions' => ' // PDF p.21',
                    ],
                    [
                        'key'   => 'field_euss_research_partner_name_en',
                        'label' => __( 'Name (EN)', 'theme-euss' ),
                        'name'  => 'name_en',
                        'type'  => 'text',
                        'instructions' => ' // PDF p.21',
                    ],
                    [
                        'key'   => 'field_euss_research_partner_country',
                        'label' => __( 'Country', 'theme-euss' ),
                        'name'  => 'country',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_euss_research_partner_link',
                        'label' => __( 'Link', 'theme-euss' ),
                        'name'  => 'link',
                        'type'  => 'url',
                    ],
                    [
                        'key'   => 'field_euss_research_partner_doc',
                        'label' => __( 'Document', 'theme-euss' ),
                        'name'  => 'doc',
                        'type'  => 'file',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page.php',
                ],
            ],
        ],
    ] );

    acf_add_local_field_group( [
        'key'    => 'group_euss_news_meta',
        'title'  => __( 'News Meta', 'theme-euss' ),
        'fields' => [
            [
                'key'   => 'field_euss_news_event_date',
                'label' => __( 'Event Date', 'theme-euss' ),
                'name'  => 'event_date',
                'type'  => 'date_picker',
                'instructions' => ' // PDF p.18',
            ],
            [
                'key'   => 'field_euss_news_highlight',
                'label' => __( 'Highlight', 'theme-euss' ),
                'name'  => 'highlight',
                'type'  => 'true_false',
                'ui'    => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'news',
                ],
            ],
        ],
    ] );
}
