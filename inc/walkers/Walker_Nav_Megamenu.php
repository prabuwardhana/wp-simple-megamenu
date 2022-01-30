<?php

class Walker_Nav_Megamenu extends Walker_Nav_menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        // The root ul element's classes are controlled by 'menu_class' parameter of wp_nav_menu() function
        $indent = str_repeat("\t", $depth);
        $classes = ($depth > 0) ? 'menu-list' :  'menu-subs menu-column-single';
        $output .= "\n$indent<ul class=\"depth_$depth $classes\">\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $li_attributes = '';
        $li_classes = $value = '';
        $link_classes = '';

        if ($depth == 0) {
            $li_classes .= 'menu-bar-item';
            $link_classes .= 'menu-bar-link';
        } else if ($depth >= 1) {
            $li_classes .= 'list-item';
            $link_classes .= 'list-link';
        }

        if (in_array("menu-item-has-children", $item->classes) && ($depth == 0)) {
            $li_classes .= ' has-popup';
        }

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

        // output the li tag
        $output .= $indent . '<li' . $id . $value . $li_attributes . 'class="' . $li_classes . '">';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="' . $link_classes . '"';

        $item_output = $args->before; // Text before the link markup

        if ((in_array("menu-item-has-children", $item->classes) || !empty($item->post_content)) && ($depth > 0)) {
            $item_output .= '<h4 class="title">' . apply_filters('the_title', $item->title, $item->ID) . '</h4>';
        } else {
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before; // Text before the link text
            $item_output .= apply_filters('the_title', $item->title, $item->ID);
            $item_output .= $args->link_after; // Text after the link text
            $item_output .= '</a>';
        }

        $item_output .= $args->after; // Text after the link markup	

        if ($depth == 1 && (!empty($item->post_content) && (strlen($item->post_content) > 1))) {
            $item_output .= '<p class="menu-item-desc">' . $item->post_content . '</p>';
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
