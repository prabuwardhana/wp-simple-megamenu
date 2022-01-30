<?php

/**
 * Simple Megamenu Customizer Class
 *
 * @package  simple-megamenu
 * @since    0.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Simple_Megamenu_Customizer')) :

    /**
     * The Simple Megamenu Customizer class
     */
    class Simple_Megamenu_Customizer
    {
        /**
         * Setup class.
         *
         * @since 0.1.0
         */
        public function __construct()
        {
            add_action('customize_register', array($this, 'customize_register'), 10);
            add_action('customize_register', array($this, 'edit_default_customizer_settings'), 99);
            add_action('wp_enqueue_scripts', array($this, 'add_customizer_css'), 140);
            add_action('init', array($this, 'default_theme_mod_values'), 10);
        }

        /**
         * Returns an array of the desired default Simple Megamenu Options
         *
         * @return array
         */
        public function get_simple_megamenu_default_setting_values()
        {
            return apply_filters(
                'simple_megamenu_setting_default_values',
                $args = array(
                    'simple_megamenu_background_color' => '#ffffff',
                    'simple_megamenu_text_color'       => '#404040',
                    'simple_megamenu_link_color'       => '#333333',
                    'simple_megamenu_accent_color'     => '#333333',
                )
            );
        }

        /**
         * Adds a value to each Simple Megamenu setting if one isn't already present.
         *
         * @uses get_simple_megamenu_default_setting_values()
         */
        public function default_theme_mod_values()
        {
            foreach ($this->get_simple_megamenu_default_setting_values() as $mod => $val) {
                add_filter('theme_mod_' . $mod, array($this, 'get_theme_mod_value'), 10);
            }
        }

        /**
         * Get theme mod value.
         *
         * @param string $value Theme modification value.
         * @return string
         */
        public function get_theme_mod_value($value)
        {
            $key = substr(current_filter(), 10);

            $set_theme_mods = get_theme_mods();

            if (isset($set_theme_mods[$key])) {
                return $value;
            }

            $values = $this->get_simple_megamenu_default_setting_values();

            return isset($values[$key]) ? $values[$key] : $value;
        }

        /**
         * Set Customizer setting defaults.
         *
         * @param  object $wp_customize the Customizer object.
         * @uses   get_simple_megamenu_default_setting_values()
         */
        public function edit_default_customizer_settings($wp_customize)
        {
            foreach ($this->get_simple_megamenu_default_setting_values() as $mod => $val) {
                $wp_customize->get_setting($mod)->default = $val;
            }
        }

        /**
         * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
         *
         * @param WP_Customize_Manager $wp_customize Theme Customizer object.
         * @since  0.1.0
         */
        public function customize_register($wp_customize)
        {
            /**
             * Add plugin section
             */
            $wp_customize->add_section(
                'simple_megamenu_section',
                array(
                    'title'    => __('Simple Megamenu', 'simple-megamenu'),
                    'priority' => 100,
                    'description' => __('Customize your mega-menu navigation', 'simple-megamenu'),
                )
            );

            /**
             * Background Color
             */
            $wp_customize->add_setting(
                'simple_megamenu_background_color',
                array(
                    'default'           => apply_filters('simple_megamenu_default_background_color', '#ffffff'),
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'simple_megamenu_background_color',
                    array(
                        'label'    => __('Background color', 'simple-megamenu'),
                        'section'  => 'simple_megamenu_section',
                        'settings' => 'simple_megamenu_background_color',
                        'priority' => 15,
                    )
                )
            );

            /**
             * Text Color
             */
            $wp_customize->add_setting(
                'simple_megamenu_text_color',
                array(
                    'default'           => apply_filters('simple_megamenu_default_text_color', '#404040'),
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'simple_megamenu_text_color',
                    array(
                        'label'    => __('Text color', 'simple-megamenu'),
                        'section'  => 'simple_megamenu_section',
                        'settings' => 'simple_megamenu_text_color',
                        'priority' => 30,
                    )
                )
            );

            /**
             * Header link color
             */
            $wp_customize->add_setting(
                'simple_megamenu_link_color',
                array(
                    'default'           => apply_filters('simple_megamenu_default_link_color', '#333333'),
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'simple_megamenu_link_color',
                    array(
                        'label'    => __('Link color', 'simple_megamenu'),
                        'section'  => 'simple_megamenu_section',
                        'settings' => 'simple_megamenu_link_color',
                        'priority' => 45,
                    )
                )
            );

            /**
             * Accent Color
             */
            $wp_customize->add_setting(
                'simple_megamenu_accent_color',
                array(
                    'default'           => apply_filters('simple_megamenu_default_accent_color', '#333333'),
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'simple_megamenu_accent_color',
                    array(
                        'label'    => __('Link / accent color', 'simple-megamenu'),
                        'section'  => 'simple_megamenu_section',
                        'settings' => 'simple_megamenu_accent_color',
                        'priority' => 60,
                    )
                )
            );
        }

        /**
         * Get all of the Simple Megamenu theme mods.
         *
         * @return array $simple_megamenu_theme_mods The Simple Megamenu Theme Mods.
         */
        public function get_simple_megamenu_theme_mods()
        {
            $simple_megamenu_theme_mods = array(
                'background_color'            => get_theme_mod('simple_megamenu_background_color'),
                'text_color'                  => get_theme_mod('simple_megamenu_text_color'),
                'link_color'                  => get_theme_mod('simple_megamenu_link_color'),
                'accent_color'                => get_theme_mod('simple_megamenu_accent_color'),
            );

            return apply_filters('simple_megamenu_theme_mods', $simple_megamenu_theme_mods);
        }

        /**
         * Get Customizer css.
         *
         * @see get_simple_megamenu_theme_mods()
         * @return array $styles the css
         */
        public function get_css()
        {
            $simple_megamenu_theme_mods = $this->get_simple_megamenu_theme_mods();

            $styles = '
            .simple-megamenu-nav .menu-mobile-header,
            .simple-megamenu-nav > ul.menu-bar > li.menu-bar-item ul.menu-subs {
                background: ' . $simple_megamenu_theme_mods['background_color'] . ';
            }

            .simple-megamenu-nav > ul.menu-bar > li.menu-bar-item > a.menu-bar-link,
            .simple-megamenu-nav > ul.menu-bar > li.menu-bar-item ul.menu-subs > li.list-item > a.list-link,
            .simple-megamenu-nav > ul.menu-bar > li.menu-bar-item ul.menu-subs.menu-mega > li.list-item > ul.menu-list > li > a.list-link,
            .simple-megamenu-nav .menu-mobile-header .menu-mobile-arrow-left,
            .simple-megamenu-nav .menu-mobile-header .menu-mobile-title,
            .simple-megamenu-nav .menu-mobile-header .menu-mobile-close {
                color: ' . $simple_megamenu_theme_mods['text_color'] . ';
            }

            .simple-megamenu-nav
                > ul.menu-bar
                > li.menu-bar-item
                ul.menu-subs.menu-mega
                > li.list-item
                > ul.menu-list
                > li
                > a:hover,
            .simple-megamenu-nav > ul.menu-bar > li.menu-bar-item ul.menu-subs > li.list-item > a.list-link:hover,
            .simple-megamenu-nav > ul.menu-bar > li.menu-bar-item:hover > a {
                color: ' . $simple_megamenu_theme_mods['link_color'] . ';
            }

            .simple-megamenu-nav > ul.menu-bar > li.menu-bar-item ul.menu-subs.menu-column-multiple > li.list-item .title {
                color: ' . $simple_megamenu_theme_mods['accent_color'] . ';
            }

            .simple-megamenu-nav > ul.menu-bar > li.menu-bar-item ul.menu-subs {
                border-top: 3px solid ' . $simple_megamenu_theme_mods['accent_color'] . ';
            }
            @media screen and (max-width: 992px) {
                .simple-megamenu-nav ul.menu-bar {
                    background-color: ' . $simple_megamenu_theme_mods['background_color'] . ';
                }
            }';

            return apply_filters('simple_megamenu_customizer_css', $styles);
        }

        /**
         * Add CSS in <head> for styles handled by the theme customizer
         *
         * @since 0.1.0
         * @return void
         */
        public function add_customizer_css()
        {
            wp_add_inline_style('simple-megamenu-style', $this->get_css());
        }
    }

endif;

return new Simple_Megamenu_Customizer();
