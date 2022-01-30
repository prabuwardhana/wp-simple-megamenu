<?php

class Admin_Settings
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'simple_megamenu_add_settings_page'));
        add_action('admin_init', array($this, 'simple_megamenu_register_settings'));
    }

    public function simple_megamenu_add_settings_page()
    {
        add_options_page('Simple Megamenu Page', 'Simple Megamenu', 'manage_options', 'simple-megamenu', array($this, 'simple_megamenu_render_plugin_settings_page'));
    }

    public function simple_megamenu_render_plugin_settings_page()
    {
?>
        <form action="options.php" method="post">
            <?php
            settings_fields('simple_megamenu_plugin_options');
            do_settings_sections('simple_megamenu_plugin'); ?>
            <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save Setting'); ?>" />
        </form>
<?php
    }

    public function simple_megamenu_register_settings()
    {
        register_setting('simple_megamenu_plugin_options', 'simple_megamenu_plugin_options');
        add_settings_section('nav_location_settings', 'Megamenu Location Settings', array($this, 'simple_megamenu_plugin_section_text'), 'simple_megamenu_plugin');

        add_settings_field('simple_megamenu_plugin_setting_nav_location', 'Select Menu Location', array($this, 'simple_megamenu_plugin_setting_nav_location'), 'simple_megamenu_plugin', 'nav_location_settings');
    }


    public function simple_megamenu_plugin_section_text()
    {
        echo '<p>Here you can set which navigation menu will have the megamenu option </p>';
    }

    public function simple_megamenu_plugin_setting_nav_location()
    {
        $options = get_option('simple_megamenu_plugin_options');
        $locations = get_nav_menu_locations();

        echo "<select name='simple_megamenu_plugin_options[nav_location]' value='" . esc_attr($options['nav_location']) . "'>";
        foreach ($locations as $location => $value) {
            echo "<option value='" . $location . "' " . ($options['nav_location'] == $location ? ' selected="selected"' : '') . ">" . $location . "</option>";
        }
        echo "</select>";
    }
}

return new Admin_Settings;
