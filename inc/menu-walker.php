<?php
class Header_Menu_Walker extends Walker_Nav_Menu {

	function start_lvl(&$output, $depth = 0, $args = null) {
		$output .= '<ul class="sub-menu">';
	}

	function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {

		$classes = empty($item->classes) ? [] : (array) $item->classes;

		$has_children = in_array('menu-item-has-children', $classes);

		$output .= '<li class="menu-item' . ($has_children ? ' has-dropdown' : '') . '">';

		$output .= '<a href="' . esc_url($item->url) . '">';

		$output .= esc_html($item->title);

		if ($has_children) {
			$output .= ' <span class="menu-arrow"></span>';
		}

		$output .= '</a>';
	}
}