<?php

/**
 * Plugin initialization class
 *
 * @since    0.1.0
 * @package  simple-megamenu
 */

class Simple_Megamenu_Init
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_plugin_scripts'));
        add_filter('wp_nav_menu_args', array($this, 'modify_nav_menu_args'));
    }

    /**
     * Enqueue plugin's scripts and styles.
     *
     * @since  0.1.0
     */
    public function enqueue_plugin_scripts()
    {
        wp_enqueue_style('simple-megamenu-style', SMM_URL . 'dist/css/megamenu.min.css', []);
        wp_register_script('simple-megamenu-script', SMM_URL . 'dist/js/megamenu.min.js', ['jquery'], false, true);

        wp_enqueue_script('simple-megamenu-script');
    }

    /**
     * This method is hooked into wp_nav_menu_args filter hook.
     * It lets us modify the arguments passed to wp_nav_menu before they are processed.
     *
     * @link https://developer.wordpress.org/reference/hooks/wp_nav_menu_args/
     */
    public function modify_nav_menu_args($args)
    {
        $options = get_option('simple_megamenu_plugin_options');

        $html = '
        <div class="menu-mobile-header">
            <svg width="256px" height="256px" class="menu-mobile-arrow-left" viewBox="0 0 256 256" id="Flat" xmlns="http://www.w3.org/2000/svg">
                <path d="M160,220a11.96287,11.96287,0,0,1-8.48535-3.51465l-80-80a12.00062,12.00062,0,0,1,0-16.9707l80-80a12.0001,12.0001,0,0,1,16.9707,16.9707L96.9707,128l71.51465,71.51465A12,12,0,0,1,160,220Z"/>
            </svg>
         <div class="menu-mobile-title"></div>
            <svg width="24px" height="24px" class="menu-mobile-close" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.22566 4.81096C5.83514 4.42044 5.20197 4.42044 4.81145 4.81096C4.42092 5.20148 4.42092 5.83465 4.81145 6.22517L10.5862 11.9999L4.81151 17.7746C4.42098 18.1651 4.42098 18.7983 4.81151 19.1888C5.20203 19.5793 5.8352 19.5793 6.22572 19.1888L12.0004 13.4141L17.7751 19.1888C18.1656 19.5793 18.7988 19.5793 19.1893 19.1888C19.5798 18.7983 19.5798 18.1651 19.1893 17.7746L13.4146 11.9999L19.1893 6.22517C19.5799 5.83465 19.5799 5.20148 19.1893 4.81096C18.7988 4.42044 18.1657 4.42044 17.7751 4.81096L12.0004 10.5857L6.22566 4.81096Z" fill="black"/>
            </svg>
         </div>';

        if ($options['nav_location'] == $args['theme_location']) {
            $args['container'] = 'nav';
            $args['container_class'] = 'simple-megamenu-nav';
            $args['menu_class'] = 'menu-bar';
            $args['items_wrap'] = $html . '<ul id="%1$s" class="%2$s">%3$s</ul>';
            $args['walker'] = new Walker_Nav_Megamenu();
        }

        return $args;
    }
}

return new Simple_Megamenu_Init;
