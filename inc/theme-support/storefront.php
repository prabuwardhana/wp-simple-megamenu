<?php

$theme = wp_get_theme();

if ('Storefront' == $theme->name || 'Storefront' == $theme->parent_theme) {
    add_action('wp', 'ssm_unhook_storefront_functions');
    function ssm_unhook_storefront_functions()
    {
        remove_action('storefront_header', 'storefront_primary_navigation', 50);
        remove_action('storefront_header', 'storefront_primary_navigation_wrapper', 42);
    }

    add_action('storefront_header', 'smm_primary_navigation', 50);
    if (!function_exists('smm_primary_navigation')) {
        function smm_primary_navigation()
        {
            wp_nav_menu(
                array(
                    'theme_location'  => 'primary',
                )
            );
        }
    }

    add_action('storefront_header', 'smm_primary_navigation_wrapper', 42);
    if (!function_exists('smm_primary_navigation_wrapper')) {
        function smm_primary_navigation_wrapper()
        {
            echo '<div class="storefront-primary-navigation"><div class="col-full">';
            echo '
            <div class="menu-mobile-toggle">
                <svg height="32px" id="menu-btn" viewBox="0 0 32 32">
                    <path fill="black" d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,22,28,22z" />
                </svg>
            </div>';
        }
    }

    add_action('wp_head', 'simple_megamenu_storefront_css');
    function simple_megamenu_storefront_css()
    {
?>
        <style>
            @media (min-width: 993px) {
                .simple-megamenu-nav {
                    display: inline-block;
                    padding: 1rem 0;
                }
            }

            @media screen and (max-width: 992px) {
                .menu-mobile-toggle {
                    justify-content: flex-end;
                    width: unset;
                }
            }
        </style>
<?php
    }
}
