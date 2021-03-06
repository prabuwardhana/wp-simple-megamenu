<?php

/**
 * Plugin Name: Simple MegaMenu
 * Description: Turn your Wordpress navigation menu into a megamenu in simple steps
 * Version:     0.1.0
 * Author:      Dian Nandiwardhana
 * Author URI:  https://github.com/prabuwardhana
 * Text Domain: simple-megamenu
 * License:     GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('ABSPATH') || exit;

define('WP_SIMPLE_MEGAMENU_PATH', plugin_dir_path(__FILE__));
define('WP_SIMPLE_MEGAMENU_URL', plugin_dir_url(__FILE__));

require_once WP_SIMPLE_MEGAMENU_PATH . '/inc/theme-support/storefront.php';

require_once WP_SIMPLE_MEGAMENU_PATH . '/inc/walkers/Walker_Nav_Megamenu.php';
require_once WP_SIMPLE_MEGAMENU_PATH . '/inc/customizer/class-customizer.php';
require_once WP_SIMPLE_MEGAMENU_PATH . '/inc/class-admin.php';
require_once WP_SIMPLE_MEGAMENU_PATH . '/inc/class-menu-fields.php';
require_once WP_SIMPLE_MEGAMENU_PATH . '/inc/class-plugin-init.php';
