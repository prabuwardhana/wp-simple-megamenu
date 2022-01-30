<?php
class Simple_Megamenu_Init
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_plugin_scripts'));
    }

    public function enqueue_plugin_scripts()
    {
        wp_enqueue_style('simple-megamenu-style', SMM_URL . 'dist/css/megamenu.css', []);
        wp_register_script('simple-megamenu-script', SMM_URL . 'dist/js/megamenu.min.js', ['jquery'], false, true);

        wp_enqueue_script('simple-megamenu-script');
    }
}

return new Simple_Megamenu_Init;
