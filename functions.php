<?php
/**
 * Theme functions
 */

// ==============================
// LOAD CORE FILES
// ==============================

$includes = [
	'inc/helpers.php',
	'inc/menu-walker.php',
	'inc/setup.php',
	'inc/assets.php',
	'inc/blocks.php',
	'inc/editor.php',
	'inc/widgets.php',
	'inc/cleanup.php',
	'inc/woocommerce.php',
	'inc/acf-placeholder.php',
];

foreach ($includes as $file) {
	$path = get_stylesheet_directory() . '/' . $file;

	if (file_exists($path)) {
		require_once $path;
	}
}