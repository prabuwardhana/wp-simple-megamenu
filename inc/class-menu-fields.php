<?php

class Menu_Fields
{
    public function __construct()
    {
        add_action('wp_nav_menu_item_custom_fields', array($this, 'menu_item_custom_fields'), 10, 4);
        add_action('wp_update_nav_menu_item', array($this, 'update_nav_menu_item'), 10, 3);
        add_filter('manage_nav-menus_columns', array($this, 'manage_nav_menu_columns'), 99);
        if (!$this->is_wp_gte('5.4')) {
            add_filter('wp_edit_nav_menu_walker', array($this, 'nav_menu_walker_edit'), 99);
        }
    }

    protected function is_wp_gte($version = '5.4')
    {
        global $wp_version;
        return version_compare(strtolower($wp_version), strtolower($version), '>=');
    }

    protected function fieldsList()
    {
        //note that menu-item- gets prepended to field names
        //i.e.: field-01 becomes menu-item-field-01
        //i.e.: icon-url becomes menu-item-icon-url
        return [
            'mm-megamenu'       => 'Activate MegaMenu',
            'mm-featured-image' => 'Featured Image',
            'mm-centered-title' => 'Center Title',
        ];
    }

    // Setup fields
    public function menu_item_custom_fields($id, $item, $depth, $args)
    {
        $fields = $this->fieldsList();

        foreach ($fields as $_key => $label) :
            $key   = sprintf('menu-item-%s', $_key);
            $id    = sprintf('edit-%s-%s', $key, $item->ID);
            $name  = sprintf('%s[%s]', $key, $item->ID);
            $value = get_post_meta($item->ID, $key, true);
            $class = sprintf('field-%s', $_key);
?>
            <p class="description description-wide <?php echo esc_attr($class) ?>">
                <label for="<?php echo esc_attr($id); ?>"><input type="checkbox" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="1" <?php echo ($value == 1) ? 'checked="checked"' : ''; ?> /><?php echo esc_attr($label); ?></label>
            </p>
<?php
        endforeach;
    }

    // Create Columns
    public function manage_nav_menu_columns($columns)
    {
        $fields = $this->fieldsList();

        $columns = array_merge($columns, $fields);

        return $columns;
    }

    // Save fields
    public function update_nav_menu_item($menu_id, $menu_item_db_id, $menu_item_args)
    {
        if (defined('DOING_AJAX') && DOING_AJAX) {
            return;
        }

        check_admin_referer('update-nav_menu', 'update-nav-menu-nonce');

        $fields = $this->fieldsList();

        foreach ($fields as $_key => $label) {
            $key = sprintf('menu-item-%s', $_key);

            // Sanitize.
            if (!empty($_POST[$key][$menu_item_db_id])) {
                // Do some checks here...
                $value = $_POST[$key][$menu_item_db_id];
            } else {
                $value = null;
            }

            // Update.
            if (!is_null($value)) {
                update_post_meta($menu_item_db_id, $key, $value);
            } else {
                delete_post_meta($menu_item_db_id, $key);
            }
        }
    }

    public function nav_menu_walker_edit($walker)
    {
        require_once SMM_PATH . '/inc/walkers/Walker_Nav_Megamenu_Edit.php';

        $walker = 'Walker_Nav_Megamenu_Edit';

        return $walker;
    }
}

return new Menu_Fields;
