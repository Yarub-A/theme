<?php
/**
 * Mega menu walker tailored for Bootstrap-based navigation.
 *
 * @package theme-euss
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Theme_EUSS_Mega_Menu_Walker' ) ) {
    class Theme_EUSS_Mega_Menu_Walker extends Walker_Nav_Menu {
        /**
         * Starts the list before the elements are added.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param mixed  $args   Additional strings.
         */
        public function start_lvl( &$output, $depth = 0, $args = null ) {
            if ( 0 === $depth ) {
                $output .= "\n<div class=\"dropdown-menu mega-menu py-4\" role=\"menu\"><div class=\"container\"><div class=\"mega-menu-grid\">";
            } else {
                $output .= "\n<div class=\"mega-submenu depth-" . (int) $depth . "\">";
            }
        }

        /**
         * Ends the list of after the elements are added.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param mixed  $args   Additional strings.
         */
        public function end_lvl( &$output, $depth = 0, $args = null ) {
            if ( 0 === $depth ) {
                $output .= '</div></div></div>';
            } else {
                $output .= '</div>';
            }
        }

        /**
         * Starts the element output.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item   Menu item data object.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param mixed  $args   Additional arguments.
         * @param int    $id     Menu item ID.
         */
        public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $classes      = empty( $item->classes ) ? [] : (array) $item->classes;
            $has_children = in_array( 'menu-item-has-children', $classes, true );

            if ( 0 === $depth ) {
                $item_classes = [ 'nav-item' ];
                if ( $has_children ) {
                    $item_classes[] = 'dropdown';
                    $item_classes[] = 'mega-menu-parent';
                }

                if ( ! empty( $classes ) ) {
                    $item_classes = array_merge( $item_classes, array_filter( $classes ) );
                }

                $output .= '<li class="' . esc_attr( implode( ' ', array_unique( $item_classes ) ) ) . '">';

                $atts = [];
                $atts['class'] = 'nav-link' . ( $has_children ? ' dropdown-toggle' : '' );
                $atts['href']  = ! empty( $item->url ) ? $item->url : '#';

                if ( $has_children ) {
                    $atts['data-bs-toggle']    = 'dropdown';
                    $atts['data-bs-auto-close'] = 'outside';
                    $atts['aria-expanded']     = 'false';
                    $atts['role']              = 'button';
                }

                $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

                $attributes = '';
                foreach ( $atts as $attr => $value ) {
                    if ( empty( $value ) ) {
                        continue;
                    }
                    $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }

                $title = apply_filters( 'the_title', $item->title, $item->ID );

                $output .= '<a' . $attributes . '>' . esc_html( $title ) . '</a>';
            } else {
                $output .= '<div class="mega-menu-item">';

                $atts = [];
                $atts['class'] = 'mega-menu-link';
                $atts['href']  = ! empty( $item->url ) ? $item->url : '#';

                $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

                $attributes = '';
                foreach ( $atts as $attr => $value ) {
                    if ( empty( $value ) ) {
                        continue;
                    }
                    $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }

                $title = apply_filters( 'the_title', $item->title, $item->ID );

                $output .= '<a' . $attributes . '>' . esc_html( $title ) . '</a>';
            }
        }

        /**
         * Ends the element output.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item   Menu item data object.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param mixed  $args   Additional strings.
         */
        public function end_el( &$output, $item, $depth = 0, $args = null ) {
            if ( 0 === $depth ) {
                $output .= '</li>';
            } else {
                $output .= '</div>';
            }
        }
    }
}
