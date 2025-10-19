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
            $indent      = str_repeat( "\t", max( 0, (int) $depth ) );
            $classes     = [ 'dropdown-menu' ];
            $classes[]   = ( $depth >= 1 ) ? 'dropdown-menu-nested' : 'dropdown-menu-root';
            $class_names = implode( ' ', array_map( 'sanitize_html_class', $classes ) );

            $output .= "\n{$indent}<ul class=\"{$class_names}\" role=\"menu\">";
        }

        /**
         * Ends the list of after the elements are added.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param mixed  $args   Additional strings.
         */
        public function end_lvl( &$output, $depth = 0, $args = null ) {
            $indent = str_repeat( "\t", max( 0, (int) $depth ) );
            $output .= "\n{$indent}</ul>";
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
            $args_object  = is_object( $args ) ? $args : (object) ( $args ?? [] );
            $has_children = ! empty( $args_object->has_children );

            if ( ! $has_children && in_array( 'menu-item-has-children', $classes, true ) ) {
                $has_children = true;
            }

            $indent = str_repeat( "\t", max( 0, (int) $depth ) );

            if ( 0 === $depth ) {
                $item_classes = [ 'nav-item' ];
                if ( $has_children ) {
                    $item_classes[] = 'dropdown';
                }

                $item_classes = array_merge( $item_classes, array_filter( $classes ) );
                $item_classes = array_map( 'sanitize_html_class', $item_classes );
                $item_classes = array_unique( $item_classes );

                $output .= "\n{$indent}<li class=\"" . esc_attr( implode( ' ', $item_classes ) ) . '\">';

                $atts = [];
                $atts['class'] = 'nav-link' . ( $has_children ? ' dropdown-toggle' : '' );
                $atts['href']  = ! empty( $item->url ) ? $item->url : '#';

                if ( $has_children ) {
                    $atts['data-bs-toggle']     = 'dropdown';
                    $atts['data-bs-auto-close'] = 'outside';
                    $atts['aria-expanded']      = 'false';
                    $atts['aria-haspopup']      = 'true';
                    $atts['role']               = 'button';
                }
            } else {
                $item_classes = [ 'dropdown-submenu' => $has_children, 'nav-sub-item' => true ];
                $sanitized    = [];

                foreach ( $item_classes as $class => $condition ) {
                    if ( $condition ) {
                        $sanitized[] = sanitize_html_class( $class );
                    }
                }

                if ( ! empty( $classes ) ) {
                    foreach ( $classes as $class ) {
                        $sanitized[] = sanitize_html_class( $class );
                    }
                }

                $sanitized = array_unique( array_filter( $sanitized ) );
                $class_attr = empty( $sanitized ) ? '' : ' class="' . esc_attr( implode( ' ', $sanitized ) ) . '"';

                $output .= "\n{$indent}<li{$class_attr}>";

                $atts = [];
                $atts['class'] = 'dropdown-item' . ( $has_children ? ' dropdown-toggle' : '' );
                $atts['href']  = ! empty( $item->url ) ? $item->url : '#';

                if ( $has_children ) {
                    $atts['data-bs-toggle']     = 'dropdown';
                    $atts['data-bs-auto-close'] = 'outside';
                    $atts['aria-expanded']      = 'false';
                    $atts['aria-haspopup']      = 'true';
                    $atts['role']               = 'button';
                }
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
            $title = esc_html( $title );

            $output .= '<a' . $attributes . '>' . $title . '</a>';
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
            $indent = str_repeat( "\t", max( 0, (int) $depth ) );
            $output .= "\n{$indent}</li>";
        }

        /**
         * Ensure children flag is passed down correctly.
         *
         * @param object $element           Data object.
         * @param array  $children_elements Children elements.
         * @param int    $max_depth         Max depth.
         * @param int    $depth             Depth.
         * @param array  $args              Args.
         * @param string $output            Output.
         */
        public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
            if ( ! $element ) {
                return;
            }

            $id_field = $this->db_fields['id'];
            $element_id = $element->{$id_field};

            if ( isset( $children_elements[ $element_id ] ) && is_array( $args ) ) {
                foreach ( $args as &$arg ) {
                    if ( is_object( $arg ) ) {
                        $arg->has_children = ! empty( $children_elements[ $element_id ] );
                    }
                }
            }

            parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }
    }
}
